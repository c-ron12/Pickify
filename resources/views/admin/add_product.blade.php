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
                    <h2 class="text-center mb-5 mt-3" style="color:white;">Add Product</h2>

                    <form action="{{url('upload_product')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="category" class="form-label">Product Category</label>
                            <select name="product_category" class="form-control" required>
                                <option value="">Select a category</option>
                                @foreach ($category as $categories )

                                <option value="{{$categories->category_name}}">{{$categories->category_name}}</option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="imageInput" class="image-label" id="imageLabel">
                                Upload Image
                            </label>
                            <br>
                            <input type="file" name="image" id="imageInput" class="" accept="image/*"
                                style="width: 220px;">
                            <!-- Image preview container -->
                            <div id="imagePreviewContainer" style="margin-top: 10px;">
                                <img id="imagePreview" src="#" alt="Image Preview"
                                    style="max-width: 100%; display: none; height:200px;">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control"
                                required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="price" clas s="form-label">Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-white bg-primary">RS</span>
                                </div>
                                <input type="text" name="price" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" name="quantity" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary m-auto d-block">Add Product</button>
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
            const preview = document.getElementById('imagePreview');
    
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader(); 
    
                reader.onload = function(e) {
                    preview.src = e.target.result; 
                    preview.style.display = 'block'; 
                };
    
                reader.readAsDataURL(file); 
            } else {
                preview.src = '#'; 
                preview.style.display = 'none'; 
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> {{--this is cdn link of sweetalert --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('toastr'))
        toastr.options.closeButton = true;
        toastr.options.timeOut = 2000;
        toastr.success("{{ Session::get('toastr') }}");
        @endif
    </script>
</body>

</html>