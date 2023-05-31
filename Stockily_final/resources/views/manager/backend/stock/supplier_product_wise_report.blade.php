@extends('manager.admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Supplier Product Report</h4>


                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <strong>Supplier Report</strong>
                                                <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value"> &nbsp;&nbsp;

                                                
                                            </div>
                                        </div>
                                        
                                        <!-- Supplier Wise -->
                                        <div class="show_supplier" style="display: none">
                                            <form method="get" action="{{ route('supplier.wise.pdf') }}" id="myForm" target="_blank">
                                                <div class="row">
                                                    <div class="col-sm-8 form-group">
                                                        <label>Supplier Name</label>
                                                        <select name="supplier_id" class="form-select select2" aria-label="Default select example">
                                                            <option value="">Select Supplier</option>
                                                            @foreach($suppliers as $supplier)
                                                           
                                                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                           
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4" style="padding-top: 25px">
                                                        <button type="submit" class="btn btn-primary">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> <!-- End Supplier Wise -->

                                        <!-- Product Wise -->
                                        <div class="show_product" style="display: none">
                                            <form method="get" action="{{ route('product.wise.pdf') }}" id="myForm" target="_blank">
                                                <div class="row">
                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Category Name </label>
                                                        <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                                                            <option selected="">Open this select menu</option>
                                                            @foreach($categories as $category)
                                                            
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>        


                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Product Name </label>
                                                        <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                                                            <option selected="">Open this select menu</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                    <div class="col-md-4" style="padding-top: 25px">
                                                        <button type="submit" class="btn btn-primary">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> <!-- End Product Wise -->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>

                <script>
    $(function(){
        $(document).on('change', '#category_id', function(){
            var category_id = $(this).val();
            $.ajax({
                url: "{{ route('get-product') }}",
                type: "GET",
                data: {category_id:category_id},
                success:function(data){
                    var html = '<option value="">Select Product</optionj>';
                    $.each(data, function(key, value){
                        html += '<option value="'+value.id+' ">'+value.name+'</option>';
                    });
                    $('#product_id').html(html);
                }
            })
        })
    });
</script>


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                supplier_id: {
                    required : true,
                }, 
            },
            messages :{
                supplier_id: {
                    required : 'Please Select Supplier',
                },
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
    $(document).on('change','.search_value', function(){
        var search_value = $(this).val();
        if (search_value == 'supplier_wise') {
            $('.show_supplier').show();
        }else{
            $('.show_supplier').hide();
        }
    });
</script>

<script type="text/javascript">
    $(document).on('change','.search_value', function(){
        var search_value = $(this).val();
        if (search_value == 'product_wise') {
            $('.show_product').show();
        }else{
            $('.show_product').hide();
        }
    });
</script>

                <!-- End Page-content -->
@endsection