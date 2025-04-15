@extends('layoutTemplate.main')
@section('main-container')

<div class="container">
    <h2 class="text-center" style="text-transform: uppercase; font-weight: bold; margin-top: 90px; margin-bottom: 55px">My Cart</h2>
    <div class="row">
        @foreach($cart as $item)
        @if ($item->product)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
            <div class="card text-center d-flex flex-column align-items-center p-3"
                style="width: 100%; min-height: 400px; background-color: #f5f5f5; border:none !important;">
                <!-- Centered Image -->
                <img src="/images/database_img/{{ $item->product->image }}" style="width: 220px; height: 220px;">

                <!-- Card Body -->
                <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="c ard-title">{{ $item->product->product_name }}</h5>
                    <p class="card-text">Price: Rs. {{ $item->product->price }}</p>

                    <div class="mt-auto">
                        <!-- Buttons at the bottom -->
                        <a href="{{url('buy_product/' . $item->product->id)}}" class="btn btn-success">Buy Now</a>
                        <a href="{{ url('remove_from_cart/' . $item->product->id) }}" class="btn btn-danger">Remove</a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-4 mb-4 d-flex justify-content-center">
            <div class="card text-center p-3" style="width: 100%; min-height: 400px;">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <h5 class="card-title">Product not found</h5>
                    <p class="card-text">This product is no longer available.</p>
                </div>
            </div> 
        </div>
        @endif
        @endforeach
    </div>
</div>

<div class="container mt-5">
    <h2 class="text-center" style="text-transform: uppercase; font-weight: bold;">Recommended Products</h2>
</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('toastr'))
    toastr.options.closeButton = true;
    toastr.options.timeOut = 2000;
    toastr.success("{{ Session::get('toastr') }}");
    @endif
</script>