<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class PagesController extends Controller
{
    public function index()
    {
        return redirect('/products');
    }

    public function products()
    {
        $data = [
            'title' => 'Products',
            'products' => Product::all(),
        ];
        return view('frontend.dashboard', compact('data'));
    }
    public function admin_dashboard()
    {
        $title = 'Dashboard';
        $products = Product::count();
        $users = User::count();
        return view('backend.dashboard', compact('title', 'products','users'));
    }
    public function miniGame()
    {
        return view('backend.minigame.index', ["title" => "Mini Game"]);
    }
}
