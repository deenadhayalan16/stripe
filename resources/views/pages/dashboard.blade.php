@extends("main")
@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-12 border mt-5">
            <h3 class="text-center text-primary mt-3">List Page</h3>
            @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
            <div class="row">
                @if(count($productlist)>0)

                @foreach($productlist as $product)
                <div class="col-md-3 p-1 mb-3">
                    <div class="card p-2 bg bg-warning">
                        <p>Name : {{$product->name}}</p>
                        <p>Price : {{$product->price}}</p>

                        <a href="{{ route('product-details',$product->id)}}" class="btn btn-info buy_button">Buy Now</a>
                    </div>
                </div>
                @endforeach

                @else
                <p class="text-danger">No data Found</p>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection