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
    </style>
</head>

<body>
    @include('adminTemplateLayout.header')
    @include('adminTemplateLayout.sidebar')

    <div class="page-content" style="background:#2d3035;">
        <div class="page-header">
            <div class="container-fluid">

                <h2 class="text-center mt-3 text-white">Products</h2>

                <div class="search-area mx-auto w-100 mt-3" style="max-width: 650px;">
                    <form action="{{ url('admin/search_product') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control mr-3" id="searchInput" placeholder="Search Product"
                            value="{{ request('search') }}">
                        <span id="clearBtn" style="cursor:pointer; display:none; position: relative; top: 8px;
                        right: 48px; color: white;">&times;</span>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Product Name</th>
                                <th>Brand</th>
                                <th>Store Name</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $data as $product ) {{--in AdminController, search section use this $data
                            variable--}}

                            <tr>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->brand}}</td>
                                <td>{{$product->store_name}}</td>
                                <td>{{$product->category}}</td>
                                <td><img height="100" width="100" src="/images/database_img/{{$product->image}}" alt="">
                                </td>
                                {{-- <td>{{$product->description}}</td> --}}
                                {{-- <td>{!!Str::limit($product->description, 15)!!}</td> --}}
                                <td>{!!Str::Words($product->description, 10)!!}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td><a href="{{url('edit_product', $product->id)}}" class="btn btn-success">Edit</a>
                                </td>
                                <td><a href="{{url('delete_product', $product->id)}}" class="btn btn-danger"
                                        onclick="confirmation(event)">Delete</a></td>
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

    <script>
        function confirmation(e) {
            e.preventDefault();
            var url = e.currentTarget.getAttribute('href');

            swal({
                title:"Are your sure to delete this item",
                text: "Once deleted, you will not be able to recover this item",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            .then((willCancel) => {
                if(willCancel) {
                    window.location.href = url;
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

    <script>
    const searchInput = document.getElementById('searchInput');
    const clearBtn = document.getElementById('clearBtn');

    function toggleClearButton() {
        clearBtn.style.display = searchInput.value ? 'inline' : 'none';
    }

    // When input changes
    searchInput.addEventListener('input', toggleClearButton);

    // On load (after page reload)
    window.addEventListener('DOMContentLoaded', toggleClearButton);

    // Clear input when '×' is clicked
    clearBtn.addEventListener('click', function () {
        searchInput.value = '';
        toggleClearButton();
        searchInput.focus();
    });
    </script>

</body>

</html>