@extends('manager.admin.admin_master')
@section('admin')

<div class="page-content">
<div class="container-fluid">


<div class="row">
    <div class="col-lg-6">
        <div class="card"><br><br>
<center>
            <img class="rounded-circle avatar-xl" src="Pic/no_image.jpg" alt="Card image cap">
            <!--add pic from table companies !-->
</center>

            <div class="card-body">
                <h4 class="card-title">Name : {{ $adminData->name}} </h4>
                <hr>
                <h4 class="card-title">User Email : {{ $adminData->email }} </h4>
                <hr>
                <hr>
                <a href="{{ route('edit.profile') }}" class="btn btn-info btn-rounded waves-effect waves-light" > Edit Profile</a>
                
            </div>
        </div>
    </div> 
                            
        
                        </div> 


</div>
</div>

@endsection 
