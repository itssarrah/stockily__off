@extends('manager.admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Add Customer Page</h4><br>

            <form method="post" action="{{ route('customer.store')}}" id="myForm" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Name</label>
                    <div class="col-sm-10 form-group">
                        <input name="name" class="form-control" type="text" >
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Mobile</label>
                    <div class="col-sm-10 form-group">
                        <input name="mobile_no" class="form-control" type="text" >
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Email</label>
                    <div class="col-sm-10 form-group">
                        <input name="email" class="form-control" type="email" >
                    </div>
                </div>
                <!-- end row -->
    
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Address</label>
                    <div class="col-sm-10 form-group">
                        <input name="address" class="form-control" type="text" >
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Image </label>
                <div class="col-sm-10">
                    <input name="customer_image" class="form-control" type="file"  id="image">
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-10" form-group>
                    <img id="showImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="Card image cap">
                </div>
            </div>

                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Customer">
            </form>
        </div>
    </div>
</div> <!-- end col -->




</div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                mobile_no: {
                    required : true,
                },
                email: {
                    required : true,
                },
                address: {
                    required : true,
                },
                customer_image: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter Name',
                },
                mobile_no: {
                    required : 'Please Enter Mobile Number',
                },
                email: {
                    required : 'Please Enter Email',
                },
                address: {
                    required : 'Please Enter Address',
                },
                customer_image: {
                    required : 'Please Select Image',
                }
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>
<script type="text/javascript">
    
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection 