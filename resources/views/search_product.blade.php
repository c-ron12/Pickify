@extends('layoutTemplate.main')
@section('main-container')

<div class="container">
    <h2 class="text-center" style="text-transform: uppercase; font-weight: bold; margin-top: 90px; margin-bottom: 55px">
        Search Results for "{{ $search }}"
    </h2>

    @if($products->isEmpty())
        <div class="text-center py-5">
            <h4>No products found matching "{{ $search }}"</h4>
        </div>
    @else
        <!-- Special grid container -->
        <div class="row justify-content-center">
            @foreach($products as $product)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <div class="card text-center d-flex flex-column align-items-center p-3 mb-5"
                    style="width: 100%; min-height: 400px; background-color: #f5f5f5; border:none !important;">
                    
                    <img src="/images/database_img/{{ $product->image }}" style="width: 220px; height: 220px;">

                    <div class="card-body d-flex flex-column align-items-center">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text">Price: Rs. {{ $product->price }}</p>
                        <p class="card-text">Category: {{ $product->category }}</p>

                        <div class="mt-auto">
                            <a href="{{ url('buy_product/' . $product->id) }}" class="btn btn-success">Buy Now</a>
                            <a class="btn btn-primary add-to-cart" href="{{url('add_to_cart', $product->id)}}">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(['search' => $search])->links() }}
        </div>
    @endif
</div>

<div class="container mt-5">
    <h2 class="text-center" style="text-transform: uppercase; font-weight: bold;">Recommended Products</h2>
</div>

@endsection