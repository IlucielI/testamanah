@extends('layouts/templete_backend')

@section('contents')
    <div class="container-fluid">
        <div class="container w-75 text-dark mt-5">
            <div class="row">
                <div class="col-6">
                    <img src="/img/{{$product->image}}" alt="image product" width="100%" height="100%">
                </div>
                <div class="col-6">
                    <h3 class="text-primary">{{$product->name}}</h3>
                    <h3 class="text-primary">{{$product->price}}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
