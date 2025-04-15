<!DOCTYPE html>
<html>

<head>
    @include ('adminTemplateLayout.css')
    <style>
        .form-wrapper {
            width: 45%;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 37px;

        }

        label {
            color: white !important;
            font-size: 17px !important;
        }

        .form-control {
            background: whitesmoke !important;
            color: black !important;
        }

        input:focus {
            border: 2.5px solid #c13a58 !important;
            outline: none;
        }

        textarea:focus {
            border: 2.5px solid #c13a58 !important;
            outline: none;
        }

        select:focus {
            border: 2.5px solid #c13a58 !important;
            outline: none;
        }
    </style>
</head>

<body>
    @include('adminTemplateLayout.header')
    @include('adminTemplateLayout.sidebar')

    <div class="page-content" style="background:#2d3035;">
        <div class="page-header">
            <div class="container-fluid">
                <div class="form-wrapper">
                    <h2 class="text-center mb-5 mt-3" style="color:white;">Update Product</h2>

                    <form action="{{url('update_product/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control"
                                value="{{$product->product_name}}" required>
                        </div>

                        <div class="form-group">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control" value="{{$product->brand}}" required>
                        </div>

                        <div class="form-group">
                            <label for="brand" class="form-label">Store Name</label>
                            <input type="text" name="store_name" class="form-control" value="{{$product->store_name}}" required>
                        </div>

                        <div class="form-group">
                            <label for="category" class="form-label">Product Category</label>
                            <select name="product_category" class="form-control" required>
                                <option value="">Select a category</option>
                                @foreach ($category as $categories )

                                <option value="{{$categories->category_name}}" {{ $categories->category_name ==
                                    $product->category ? 'selected' : '' }}>
                                    {{$categories->category_name}}
                                </option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="">Current Image</label>
                                <!-- Image preview container -->
                                <img id="imagePreview" src="{{asset('/images/database_img/'.$product->image)}}"
                                    height="200px" class="ml-3 style="max-width: 100%;663">
                            </div>

                            <label for="imageInput" class="image-label" id="imageLabel" style="display: block; margin-top: 10px; font-weight: bold; cursor: pointer;">
                                Upload New Image
                            </label>
                            <br>
                            <!-- File input -->
                            <input type="file" name="image" id="imageInput" class="" accept="image/*"
                                style="width: 220px;">
                        </div>


                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control"
                                required>{{$product->description}} </textarea>
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-label">Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-white bg-primary">RS</span>
                                </div>
                                <input type="text" name="price" class="form-control" value="{{$product->price}}"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" name="quantity" class="form-control" value="{{$product->quantity}}"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary m-auto d-block">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @include('adminTemplateLayout.footer')

    <!--JavaScript Files-->
    @include('adminTemplateLayout.js')

    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0]; 
            if (file) {
                const reader = new FileReader(); 
    
                reader.onload = function(e) {
                    // Update the src attribute of the image preview
                    document.getElementById('imagePreview').src = e.target.result;
                };
    
                reader.readAsDataURL(file); 
            }
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> {{--this is cdn link of sweetalert --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('toastr'))
        toastr.options.closeButton = true;~
        toastr.options.timeOut = 2000;
        toastr.success("{{ Session::get('toastr') }}");
        @endif
    </script>
</body>

</html>