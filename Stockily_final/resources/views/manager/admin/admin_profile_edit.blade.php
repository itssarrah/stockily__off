@extends('manager.admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
use Illuminate\Support\Facades\Auth;
$user=Auth::user();
?>
<div class="page-content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Edit Profile Page </h4>
            
            <form method="post" action="{{ route('store.profile') }}" enctype="multipart/form-data">
                @csrf

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                <input name="name" class="form-control" type="text" value="{{ $editData->name }}" pattern="^[^\d]{1,20}$" title="Username can only contain up to 20 characters and no numbers" id="example-text-input" required>
                </div>
            </div>
            <!-- end row -->

              <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">User Email</label>
                <div class="col-sm-10">
                    <input name="email" class="form-control" type="text" value="{{ $editData->email }}"  id="example-text-input" required>
                </div>
            </div>
            @if ($user->role === 'manager')
              <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Company Name:</label>
                <div class="col-sm-10">
                    <input name="name_company" class="form-control" type="text" value="{{ $company->name_company }}"  id="example-text-input" required>
                </div>
            </div>
              <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Company Description :</label>
                <div class="col-sm-10">
                    <input name="company_description" class="form-control" type="text" value="{{ $company->company_description }}"  id="example-text-input" >
                </div>
            </div>
            <!-- end row -->
            <!-- end row -->


            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Company Logo: </label>
                <div class="col-sm-10">
       <input name="company_logo" class="form-control" type="file"  id="image">
                </div>
            </div>
            
            
            <!-- end row -->

              <div class="row mb-3">
                 <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-10">
                    <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($company->company_logo))? url('images/'.$company->company_logo):url('images/no_image.jpg') }}" alt="Card image cap">
                </div>
            </div>
            @endif
            @if ($user->role === 'normal user')
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image: </label>
                <div class="col-sm-10">
                 <input name="profile_image" class="form-control" type="file"  id="image">
                </div>
            </div>
            
            
            <!-- end row -->

              <div class="row mb-3">
                 <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                <div class="col-sm-10">
                    <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($image->profile_image))? url('images/'.$image->profile_image):url('images/no_image.jpg') }}" alt="Card image cap">
                </div>
            </div>
            @endif
            <!-- end row -->
<input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile">
            </form>
             
           
           
        </div>
    </div>
</div> <!-- end col -->
</div>
 


</div>
</div>


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
