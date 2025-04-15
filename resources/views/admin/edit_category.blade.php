<!DOCTYPE html>
<html>

<head>
    @include ('adminTemplateLayout.css')
    <style>
        input[type="text"] {
            width: 400px;
            height: 38px;
            margin-right: 15px;
            color: black !important;
            width: 100%
        }

        .edit-div {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .edit-div form {
            max-width: 400px;
            width: 100%
        }

        .container-fluid h2 {
            margin-bottom: 35px;
        }
        
        .form-label {
            color: black;
            font-size: 18px
        }

        .container-fluid h2 {
            color: white;
            /* text-align: center; */
        }
    </style>
</head>

<body>
    @include('adminTemplateLayout.header')
    @include('adminTemplateLayout.sidebar')

    <div class="page-content" style="background: #2d3035;">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="text-center">Update Category</h2>

                <div class="edit-div container mt-4">
                    <form action="{{ url('update_category/'.$category->id) }}" method="POST" class="bg-light p-4 rounded">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryInput" class="form-label fw-bold">Category Name</label>
                            <input type="text" class="form-control border-primary text-dark" id="categoryInput" name="category" value="{{ $category->category_name }}" required>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Update Category</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    @include('adminTemplateLayout.footer')

    <!--JavaScript Files-->
    @include('adminTemplateLayout.js')
</body>

</html>