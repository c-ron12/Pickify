@extends('layoutTemplate.main')
@section('main-container')
<div class="container my-5">
    <div class="row justify-content-center mx-auto w-100" style="max-width: 1400px !important;">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <h3 class="text-center mb-4">BUY PRODUCT</h3>

                <form action="{{ url('place_order/' . $data->id)}}" method="POST">
                    @csrf

                    <div class="row justify-content-center mb-4">
                        <div class="col-auto">
                            <div class="img-box mt-4 mb-5">
                                <img src="/images/database_img/{{$data->image}}" class="detail-img img-fluid"
                                    style="max-width: 400px;">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center text-center mb-4">
                        <div class="col-md-10">

                            <div class="mb-3">
                                <h5 class="mb-2">{{$data->product_name}}</h5>
                                <h4 id="product_price">Rs {{ $data->price}}</h4>
                                <input type="hidden" id="total_price" name="total_price" value="{{ $data->price }}">

                            </div>

                            <!-- Color Family -->
                            <div class="form-group mb-3">
                                <label for="color_family" class="form-label mr-2"><strong>Color Family:</strong></label>
                                <select id="color_family" name="color_family" class="form-select mx-auto"
                                    style="width: 200px;">
                                    <option value="Red">Red</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Green">Green</option>
                                    <option value="Black">Black</option>
                                    <option value="White">White</option>
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div class="form-group">
                                <div class="d-flex justify-content-center align-items-center">
                                    <label for="quantity" class="form-label mr-2"
                                        style="padding-top: 9px"><strong>Quantity:</strong></label>
                                    <button class="btn btn-danger px-3" id="decrease" type="button">-</button>
                                    <input type="text" id="quantity" name="quantity"
                                        class="form-control text-center mx-2" value="1" style="width: 60px;" readonly>
                                    <button class="btn btn-success px-3" id="increase" type="button">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Details -->
                    <div class="mb-3">
                        <label class="form-label"><strong>Recipient Full Name:</strong></label>
                        <input type="text" class="form-control" name="recipient_name" value="{{ Auth::user()->name }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Recipient Phone Number:</strong></label>
                        <input type="text" class="form-control" name="recipient_phone" value="{{ Auth::user()->phone }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Email Address</strong></label>
                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"
                            required>
                    </div> 

                    <div class="mb-3">
                        <label class="form-label"><strong>Delivery Address:</strong></label>
                        <textarea class="form-control" name="delivery_address" rows="3"
                            required>{{ Auth::user()->address }} </textarea>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-3">
                        <label class="form-label"><strong>Payment Method:</strong></label>
                        <select class="form-control" name="payment_method" required>
                            <option value="COD">Cash on Delivery</option>
                            <option value="esewa">eSewa</option>
                            <option value="khalti">Khalti</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                        
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const decreaseBtn = document.getElementById("decrease");
        const increaseBtn = document.getElementById("increase");
        const quantityInput = document.getElementById("quantity");
        const priceElement = document.getElementById("product_price");
        const totalPriceInput = document.getElementById("total_price"); // Hidden input

        // Get the initial price from the HTML content
        const initialPrice = parseFloat("{{ $data->price }}");

        // Function to update the price
        function updatePrice() {
            const quantity = parseInt(quantityInput.value);
            const newPrice = initialPrice * quantity;
            priceElement.textContent = `Rs ${newPrice.toFixed(2)}`;
            totalPriceInput.value = newPrice.toFixed(2); // Update hidden input
        }

        decreaseBtn.addEventListener("click", function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updatePrice();
            }
        });

        increaseBtn.addEventListener("click", function() {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
            updatePrice();
        });

        // Initialize the price on page load
        updatePrice();
    });
</script>