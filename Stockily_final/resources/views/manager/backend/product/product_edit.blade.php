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
                    <input name="name" class="form-control" value="{{$product->name}}" type="text" required>
                </div>
            </div>
            
            <!-- end row -->


             <div class="row mb-3">
              <label  class="col-sm-2 col-form-label">Supplier Name</label>
              <div class="col-sm-10">
                <select name="supplier_id" class="form-select" aria-label="Default select example" required> 
                  <option selected="" value="">
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
              <label  class="col-sm-2 col-form-label">Location </label>
              <div class="col-sm-10">
                <select id="location_id" name="unit_id"class="form-select" aria-label="Default select example" required>
                  <option selected="" value="">
                    Change the location 
                  </option>
                    @foreach($unit as $uni)
                  <option value="{{$uni->id}}" {{$uni->id == $product->unit_id ? 'selected ': ''}}>{{$uni->name}}</option>
                  @endforeach
                  
                </select>
              </div>
             </div>

             <div class="row mb-3">
              <label  class="col-sm-2 col-form-label">Sub-Location</label>
              <div class="col-sm-10">
                <select id="sublocation_id" name="sublocation_id" class="form-select" aria-label="Default select example">
                  <option selected="" value="" >
                    Change the Sub-Location 
                  </option>
                    @foreach($sub_location as $subloc)
                  <option value="{{$subloc->id}}" {{$subloc->id == $product->sublocation_id ? 'selected ': ''}}>{{$subloc->name}}</option>
                  @endforeach
                  
                </select>
              </div>
             </div>
            <!-- end row -->

            
             <div class="row mb-3">
              <label  class="col-sm-2 col-form-label">Category </label>
              <div class="col-sm-10">
                <select name="category_id" class="form-select" aria-label="Default select example" required>
                  <option value="" selected="">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                }, 
                supplier_id: {
                    required: true,
                },
                unit_id: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: 'Please enter the name of the product',
                },
                supplier_id: {
                    required: 'Please select a supplier',
                },
                unit_id: {
                    required: 'Please select a unit',
                },
                category_id: {
                    required: 'Please select a category',
                },
            },
            errorElement: 'span', 
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                if (element.hasClass('form-select')) {
                    if (element.attr('name') !== 'sublocation_id') { // Exclude sublocation select input
                        error.insertAfter(element.closest('.form-group').find('.form-select'));
                    }
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                var selectInputs = $('select').not('[name="sublocation_id"]');
                var invalidSelectInputs = selectInputs.filter(function() {
                    return this.value === '';
                });
                if (invalidSelectInputs.length > 0) {
                    invalidSelectInputs.addClass('is-invalid');
                    invalidSelectInputs.closest('.form-group').find('.invalid-feedback').text('Please select an option');
                } else {
                    form.submit();
                }
            }
        });
    });
    
</script>



 
@endsection 
