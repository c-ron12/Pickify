<!DOCTYPE html>
<html>

<head>
    @include ('adminTemplateLayout.css')
    <style>
        .table-responsive {
            margin: 27px auto;
            width: 100%;
            max-width: 1200px;
        }

        .table {
            text-align: center;
            margin: 27px auto;
            width: 100%;
            max-width: 1200px;
        }

        th {
            background-color: #c13a58;
            font-size: 18px;
            font-weight: bold;
            color: Black;
            border: 1px solid black !important;
        }

        td {
            color: white;
        }

        .print-btn:focus { 
            color: white !important;
        }
        
    </style>
</head>

<body>
    @include('adminTemplateLayout.header')
    @include('adminTemplateLayout.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <div class="table-responsive">
                    <table class="table table-bordered align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Customer Name</th>
                                <th>Delivery Address</th>
                                <th>Phone Number</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Change Status</th>
                                {{-- <th>Delete</th> --}}
                                <th>Print PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $data as $customer ) {{--$data is a variable used in AdminController view_order
                            function--}}

                            <tr>
                                <td>{{$customer->recipient_name}}</td>
                                <td>{{$customer->delivery_address}}</td>
                                <td>{{$customer->recipient_phone}}</td>
                                <td>{{$customer->product->product_name}}</td> {{--there is now Product_name in orders
                                table and fetching this data through products table by using Foreign key --}}

                                <td>{{$customer->total_price}}</td>
                                <td><img height="100" width="100"
                                        src="/images/database_img/{{$customer->product->image}}" alt=""></td>{{--there
                                is now image column in orders
                                table and fetching this data through products table by using Foreign key --}}

                                <td>{{$customer->quantity}}</td>
                                <td>
                                    @if($customer->status == 'in process')
                                    <span style="color:red"> {{$customer->status}} </span>

                                    @elseif($customer->status == 'On the way')
                                    <span style="color: #d44658"> {{$customer->status}} </span>

                                    @else <span style="color:#28a745"> {{$customer->status}} </span>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-primary mb-3" href="{{url('on_the_way', $customer->id)}}">On the
                                        way</a>
                                    <a class="btn btn-success" href="{{url('delivered', $customer->id)}}">Delivered</a>
                                </td>

                                <td><a href="{{url('print_pdf', $customer->id)}}"
                                        class=" btn btn-secondary print-btn">Print
                                        PDF</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center pt-5">
                        {{ $data->links()}}
                        {{-- {{ $data->onEachSide()->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('adminTemplateLayout.footer')

    <!--JavaScript Files-->
    @include('adminTemplateLayout.js')
</body>

</html>