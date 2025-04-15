@extends('layoutTemplate.main')
@section('main-container')
<div class="container" style="background-color: #f5f5f5;">
    <h2 class="text-center" style="text-transform: uppercase; font-weight: bold; padding-top:90px; margin-bottom: 55px">
        Order Details</h2>

    <div class="card p-3" style="margin-bottom: 3px">
        <div class="d-flex align-items-center">
            <h5><strong>{{ $order->product->store_name ?? 'Store Name' }}</strong></h5>
            <a href="#" class="btn btn-outline-primary btn-sm" style="margin-left: 60px">Chat with Seller</a>
        </div>
    </div>

    <div class="card p-3 mb-3">
        <div class="d-flex justify-content-between align-items-center"
            style="border-radius:8px; padding: 11px 10px; background-color: #f5f5f5; margin-bottom: 22px;">
            <div>
                Get by {{ $order->created_at->addDays(2)->format('d/m/Y') }}
                <span class="text-muted">| Standard Delivery</span>
            </div>
            @php
            $finalTotal = $order->total_price + 100 + 50;
            @endphp
            <strong>Rs. {{ number_format($finalTotal, 2) }}</strong>
        </div>

        <div class="row">
            <div class="col-md-5 d-flex" style="margin-left: 28px">
                <img src="{{ asset('images/database_img/' . $order->product->image) }}" alt="Product Image"
                    class="img-thumbnail me-3 border-0" style="width: 140px; height: 140px;">

                <div class="d-flex flex-column ml-4">
                    <h6>{{$order->product->product_name}}</h6>
                    <p class="text-muted">Color Family: {{$order->color_family}}</p>
                </div>
            </div>

            <div class="col-md-6 d-flex justify-content-between px-5 mt-2 mt-md-0">
                <p class="price">Rs. {{ number_format($order->total_price, 2) }}</p>
                <p class="quantity">Qty: {{$order->quantity}}</p>
                <form action="{{ route('order.cancel', $order->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to cancel this order?');">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" onclick="confirmation(event)">Cancel
                        Order</button>
                </form>
            </div>
        </div>

        <div class="card p-3 mb-3">
            <p>Order 7305821409825847</p>
            <p class="text-muted">Placed on: {{ $order->created_at->format('d/m/Y') }}</p>
            <p>Payment Method: Cash on Delivery</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card p-3 mb-3">
                    <h6><strong>Rohan Chettri</strong></h6>
                    <p style="margin-bottom:7px;">Balkumari, Kathmandu</p>
                    <p style="margin-bottom:7px;">9824063524</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3 summary-card">
                    <h6><strong>Total Summary</strong></h6>
                    <p>Subtotal ({{ $order->quantity }} Item{{ $order->quantity > 1 ? 's' : '' }}): Rs. {{
                        number_format($order->total_price, 2) }}</p>
                    <p>Shipping Fee: Rs. 100</p>
                    <p>COD Handling Fee: Rs. 50</p>
                    <hr>
                    @php
                    $finalTotal = $order->total_price + 100 + 50;
                    @endphp
                    <h6><strong>Total: Rs. {{ number_format($finalTotal, 2) }}</strong></h6>
                    <p>Paid by Cash on Delivery</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function confirmation(e) {
    e.preventDefault();
    
    swal({
        title: "Are you sure you want to cancel your order?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willCancel) => {
        if (willCancel) {
            e.target.closest("form").submit(); // Submit the form properly
        }
    });
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script> {{--this is cdn link of sweetalert --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> {{--cdn link for
toastr--}}

<script>
    @if(Session::has('toastr'))
    toastr.options.closeButton = true;
    toastr.options.timeOut = 2000;
    toastr.success("{{ Session::get('toastr') }}");
    @endif
</script>