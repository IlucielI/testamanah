<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Products";
        $products = Product::all();
        return view('backend.products.show', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.add', ['title' => 'Add Product']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products|min:3',
            'category' => 'required|min:2|max:2',
            'branch' => 'required|min:3|max:3',
            'month' => 'required|min:2|max:2',
            'year' => 'required|min:2|max:2',
            'image' => ['image','file' ,'max:6250'],
        ]);

        $lastId = Product::select('code')->whereRaw('SUBSTRING(code, 1,  9) = '. "'".$request->category.$request->branch.$request->month.$request->year."'")
        ->latest()->first();
        if(!$lastId){
            $lastId = 1;
        }else{
            $lastId = intval(substr($lastId->code,9))+1;
        }
        $validatedData = [
            'code' => $request->category.$request->branch.$request->month.$request->year.$lastId,
            'name' => $request->name,
        ];

        if($request->file('image')){
            $filename = bin2hex(random_bytes(5)).'-'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $filename);
            $validatedData['image'] = $filename;
        };

        QrCode::generate($validatedData['code'], '../public/qrcodes/'.$validatedData['code'].'.svg');

        Product::create($validatedData);
        return redirect('/admin/products')->with('message', 'Add Product Success.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        echo json_encode($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('backend.products.edit', ['title' => 'Edit Product', 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'category' => 'required|min:2|max:2',
            'branch' => 'required|min:3|max:3',
            'month' => 'required|min:2|max:2',
            'year' => 'required|min:2|max:2',
            'image' => ['image','file' ,'max:6250'],
        ]);
        $product = Product::select('code')->where('id', $id)->first();
        if(substr($product->code,0,9) === $request->category.$request->branch.$request->month.$request->year){
            $validatedData = [
                'name' => $request->name,
            ];
        }else {
            $lastId = Product::select('code')->whereRaw('SUBSTRING(code, 1,  9) = '. "'".$request->category.$request->branch.$request->month.$request->year."'")
            ->latest()->first();
            if(!$lastId){
                $lastId = 1;
            }else{
                $lastId = intval(substr($lastId->code,9))+1;
            }
            $validatedData = [
                'code' => $request->category.$request->branch.$request->month.$request->year.$lastId,
                'name' => $request->name,
            ];
            QrCode::generate($validatedData['code'], '../public/qrcodes/'.$validatedData['code'].'.svg');
            unlink(public_path('qrcodes/'. $product->code . '.svg'));
            //  Product::create($validatedData);
        }
        if($request->file('image')){
            $filename = bin2hex(random_bytes(5)).'-'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $filename);
            $validatedData['image'] = $filename;
            $product = Product::select('image')->where('id', $request->id)->first();
            if($product->image != null){
                unlink(public_path('img/'. $product->image));
            }
        };
        Product::where('id', $id)->update($validatedData);
        return redirect('/admin/products')->with('message', 'Update Product Success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::select('image','code')->where('id', $request->id)->first();
        unlink(public_path('qrcodes/'. $product->code . '.svg'));
        if($product->image != null){
            unlink(public_path('img/'. $product->image));
        }
        Product::destroy($request->id);
        return redirect('/admin/products')->with('message', 'Product has been Delete.');
    }
}
