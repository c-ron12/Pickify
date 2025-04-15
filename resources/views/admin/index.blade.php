<!DOCTYPE html>
<html>

<head>
    @include ('adminTemplateLayout.css')
</head>

<body>
    @include('adminTemplateLayout.header')
    @include('adminTemplateLayout.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                @include ('adminTemplateLayout.body')
            </div>       
        </div>
    </div>
    
    @include('adminTemplateLayout.footer')

    <!--JavaScript Files-->
    @include('adminTemplateLayout.js')
</body>

</html>