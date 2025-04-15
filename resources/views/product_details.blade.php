@include('layoutTemplate.header')
<div class="container">
    <div class="row mx-auto w-100" style="max-width: 1400px !important;">
        <div class="col-md-12" style="background-color: #f5f5f5; margin-top: -24px;">
            <div class="d-flex justify-content-center">
                <div class="img-box mt-5 mb-2">
                    <img src="/images/database_img/{{$data->image}}" class="detail-img img-fluid"
                        style="max-width: 340px; width: 100%;">
                </div>
            </div>
            <br>
            <div class="detail-box px-3">
                <h6><strong>Product Name:</strong> {{$data->product_name}}</h6>
                <h6><strong>Price:</strong> <span>Rs. {{ $data->price}}</span></h6>
                <h6><strong>Category:</strong> {{ $data->category}}</h6>
                <h6><strong>Brand:</strong> {{ $data->brand}}</h6>
                <h6><strong>Description:</strong></h6>
                <p>{{ $data->description}}</p>
            </div>
           

            <a href="{{url('buy_product', $data->id)}}" class="btn btn-success text-white mb-5 mx-3" style="margin-top: 20px">Buy Now</a>    
        </div>
    </div>
</div>
  
@include('layoutTemplate.footer')

