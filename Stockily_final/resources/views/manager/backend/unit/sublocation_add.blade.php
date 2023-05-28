@extends('manager.admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Add Locations To Your Warehouse </h4><br><br>
            <?php 
            use Illuminate\Support\Facades\Auth;
            $user_id=Auth::user()->id;
            ?>
          
            <form method="post" action="{{ route('sublocation.store') }}" id="myForm">
                @csrf
                <div class="row mb-3">
                    <label  class="col-sm-2 col-form-label">location </label>
                    <div class="col-sm-10">
                      <select name="unit_id"class="form-select" aria-label="Default select example">
                        <option selected="">
                          Select the location 
                        </option>
                          @foreach($unit as $uni)
                          @if ($uni->created_by==$user_id)
                        <option value="{{$uni->id}}">{{$uni->name}}</option>
                        @endif
                        @endforeach
                        
                      </select>
                    </div>
                   </div>
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">sublocation name</label>
                <div class="form-group col-sm-10">
                    <input name="name" class="form-control" type="text" >
                </div>
            </div>
            <!-- end row -->

<input type="submit" class="btn btn-info waves-effect waves-light" value="Add sublocation">
            </form>
             
           
           
        </div>
    </div>
</div> <!-- end col -->
</div>
 

</div>
</div>


<!--<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                }, 
            },
            messages :{
                name: {
                    required : 'Please Enter the  name  of the unit',
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
!-->


 
@endsection 
