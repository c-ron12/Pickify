<!DOCTYPE html>
<html>

<head>
    @include ('adminTemplateLayout.css')
    <style>
        input[type="text"] {
            width: 100%;
            height: 38px;
            margin-right: 10px;
            color: black !important;
            width: 100%;
        }

        .form-div {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .form-div form {
            width: 100%;
            max-width: 400px;
        }

        .addCategory {
            color: white;
            text-align: center;
            margin-bottom: 35px;
        }

        .form-label {
            color: black;
            font-size: 18px
        }

        .table {
            text-align: center;
            margin: 60px auto;
            /* width: 50%; */
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

    <div class="page-content" style="background: #2d3035;">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="addCategory">Add Category</h2>
                <div class="form-div container mt-4">
                    <form action="{{ url('add_category') }}" method="POST" class="bg-light p-4 rounded">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryInput" class="form-label fw-bold">Category Name</label>
                            <input type="text" id="categoryInput" name="category"
                                class="form-control border-primary text-dark" required>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Add Category</button>
                    </form>
                </div>


                <div>
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Category Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $category)  <!-- $data is the variable that we passed from  the controller -->
                            <tr>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    <a href="{{ route('edit.category', ['id' => $category->id]) }}"
                                        class="btn btn-success btn-sm">Edit</a>
                                </td>
                                <td>
                                    <a href="{{ route('delete.category', ['id' => $category->id]) }}"
                                        class="btn btn-danger btn-sm" onclick="confirmation(event)">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        @include('adminTemplateLayout.footer')
    </div>


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


    <!-- JavaScript files-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> {{--this is cdn link of sweetalert --}}

    @include('adminTemplateLayout.js')

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