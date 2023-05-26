@extends('manager.admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Update Product Page </h4><br><br>
            

      


            <form method="post" action="{{ route('product.update') }}" id="myForm">
                @csrf

              <input type="hidden" name="id" value="{{$product->id}}">  
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Product name</label>
                <div class="form-group col-sm-10">
                    <input name="name" class="form-control" value="{{$product->name}}" type="text" >
                </div>
            </div>
            <div class="row mb-3">
              <label for="example-text-input" class="col-sm-2 col-form-label">Product status</label>
              <div class="form-group col-sm-10">
                  <input name="status" class="form-control" value="{{$product->status}}" type="text" >
              </div>
          </div>
            <!-- end row -->


             <div class="row mb-3">
              <label  class="col-sm-2 col-form-label">Supplier Name</label>
              <div class="col-sm-10">
                <select name="supplier_id" class="form-select" aria-label="Default select example">
                  <option selected="">
                    Select the supplier 
                  </option>
                    @foreach($supplier as $supp)
                  <option value="{{$supp->id}}" {{$supp->id == $product->supplier_id ? 'selected ': ''}}>{{$supp->name}}</option>
                  @endforeach
                  
                </select>
              </div>
             </div>
            <!-- end row -->

            
             <div class="row mb-3">
              <label  class="col-sm-2 col-form-label">Unit </label>
              <div class="col-sm-10">
                <select name="unit_id"class="form-select" aria-label="Default select example">
                  <option selected="">
                    Select the Unit 
                  </option>
                    @foreach($unit as $uni)
                  <option value="{{$uni->id}}" {{$uni->id == $product->unit_id ? 'selected ': ''}}>{{$uni->name}}</option>
                  @endforeach
                  
                </select>
              </div>
             </div>
            <!-- end row -->

            
             <div class="row mb-3">
              <label  class="col-sm-2 col-form-label">Category </label>
              <div class="col-sm-10">
                <select name="category_id" class="form-select" aria-label="Default select example">
                  <option selected="">
                    Select the category 
                  </option>
                    @foreach($category as $cat)
                  <option value="{{$cat->id}}" {{$cat->id == $product->category_id ? 'selected ': ''}}>{{$cat->name}}</option>
                  @endforeach
                  
                </select>
              </div>
             </div>
            <!-- end row -->




        
<input type="submit" class="btn btn-info waves-effect waves-light" value="Update Product">
            </form>
             
           
           
        </div>
    </div>
</div> <!-- end col -->
</div>
 

</div>
</div>


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                }, 
                supplier_id: {
                    required : true,
                },
                unit_id: {
                    required : true,
                },
                category_id: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter the name of the prodcut',
                },
                supplier_id: {
                    required : 'Please select a supplier',
                },
                unit_id: {
                    required : 'Please select a unit',
                },
                category_id: {
                    required : 'Please select a category',
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



 
@endsection 
