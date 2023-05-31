@extends('manager.admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Add Product Page </h4><br><br>
            <form method="post" action="{{ route('product.store') }}" id="myForm">
                @csrf

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Product name</label>
                <div class="form-group col-sm-10">
                    <input name="name" class="form-control" type="text" required>
                </div>
            </div>
             <div class="row mb-3">
              <label  class="col-sm-2 col-form-label">Supplier Name</label>
              <div class="col-sm-10">
                <select name="supplier_id" class="form-select" aria-label="Default select example" required>
                  <option value="" selected="">
                    Select the supplier 
                  </option>
                    @foreach($supplier as $supp)
                    
                    <option value="{{$supp->id}}">{{$supp->name}}</option>
                    
                    @endforeach
                    
                  
                  
                </select>
              </div>
             </div>
            <!-- end row -->

            
             <div class="row mb-3">
              <label  class="col-sm-2 col-form-label">location </label>
              <div class="col-sm-10">
                <select id="location_id" name="unit_id"class="form-select" aria-label="Default select example" required>
                  <option value="" selected="">
                    Select the location 
                  </option>
                    @foreach($unit as $uni)
                    
                  <option value="{{$uni->id}}">{{$uni->name}}</option>
                  
                  @endforeach
                  
                </select>
              </div>
             </div>
            <!-- end row -->
            <div class="row mb-3">
                <label  class="col-sm-2 col-form-label">sublocation </label>
                <div class="col-sm-10">
                  <select name="sublocation_id" id="sublocation_id" class="form-select" aria-label="Default select example">
                    <option value="" selected="">
                      Select the sublocation 
                    </option>
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
                    
                  <option value="{{$cat->id}}">{{$cat->name}}</option>
                  
                  @endforeach
                  
                </select>
              </div>
             </div>
            <!-- end row -->        
<input type="submit" class="btn btn-info waves-effect waves-light" value="Add Product">
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




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#location_id').change(function() {
            var locationId = $(this).val();
            var url = '{{ route("get.sublocations", ":id") }}'.replace(':id', locationId);

            // Disable the sublocation select input
            $('#sublocation_id').prop('disabled', true);

            // Clear the previous options
            $('#sublocation_id').html('<option value="" selected>Select a sublocation</option>');

            if (locationId !== '') {
                // Make the Ajax request to fetch sublocations
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        // Enable the sublocation select input
                        $('#sublocation_id').prop('disabled', false);

                        // Add sublocation options to the select input
                        response.sublocations.forEach(function(sublocation) {
                            $('#sublocation_id').append('<option value="' + sublocation.id + '">' + sublocation.name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>

 
@endsection 