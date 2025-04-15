@extends('layoutTemplate.main')
@section('main-container')

<div class="container">
    <h2 class="text-center" style="text-transform: uppercase; font-weight: bold; margin-top: 90px; margin-bottom: 55px">
        My Orders</h2>

    <!-- Order Tabs -->
    <ul class="nav order-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" href="#">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">To Pay</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">To Ship <span class="badge bg-secondary text-white">3</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">To Receive <span class="badge bg-secondary text-white">1</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">To Review <span class="badge bg-secondary text-white">2</span></a>
        </li>
    </ul>

    <!-- Show Options -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="show-options">
            <span>Show:</span>
            <select class="form-select form-select-sm show-select">
                <option selected>Last 5 orders</option>
                <option>Last 15 days</option>
                <option>Last 3 months</option>
                <option>Last 6 months</option>
                <option>Last year</option>
            </select>
        </div>
    </div>

    <hr class="mb-4">
    @foreach ($order as $item )

    <!-- Order Cards -->
    <a href="{{ route('order.details', ['id' => $item->id]) }}" class="text-decoration-none text-dark">
        <div class="order-card mb-3" style="cursor: pointer">
            <div class="order-card-header d-flex justify-content-between">
                <h5 class="mb-0">{{ $item->product->store_name ?? 'Store Name' }}</h5>
                <span class="order-status">{{ $item->status ?? 'Seller to Pack' }}</span>
            </div>

            <div class="order-item">
                <div class="product-details-row row">
                    <div class="col-md-7 col-12 product-name">
                        <h6 class="mb-1">{{ $item->product->product_name }}</h6>
                        <p class="text-muted mb-0">Color Family: {{ $item->color_family }}</p>
                        @if($item->size)
                        <p class="text-muted mb-0">Size: {{ $item->size }}</p>
                        @endif
                    </div>
                    <div class="col-md-3 col-6 product-price text-md-left">
                        <strong>Rs. {{ $item->product->price }}</strong>
                    </div>
                    <div class="col-md-2 col-6 product-qty text-left">
                        Qty: {{ $item->quantity }}
                    </div>
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endsection