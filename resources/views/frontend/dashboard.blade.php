@extends('layouts/templete_frontend')

@section('contents')
  <div class="card-deck">
    @foreach ($data["products"] as $product)
      <div class="card" style="width: 18rem;">
        <div class="container-img" style="height:300px">
            <a href=""><img src="/img/{{$product->image}}" class="card-img-top" alt="image product" width="100%" height="100%"></a>
        </div>
          <div class="card-body">
            <h2 class="card-title text-center">{{$product->name}}</h2>
            <h4 class="card-title text-center text-danger">{{$product->price}}</h4>
              <button type="button" class="btn btn-info">Detail</button>
          </div>
      </div>
    @endforeach
</div>
@endsection
