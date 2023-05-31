@extends('manager.admin.admin_master')
@section('admin')
<?php 
use Illuminate\Support\Facades\Auth;
$user=Auth::user();
?>
<div class="page-content">
<div class="container-fluid">
             <img class="wavie" src="{{asset('/Pic/wave2.png')}}">
             <img class="dot--1" src="{{asset('/Pic/es2.png')}}">
            <img class="dot--2" src="{{asset('/Pic/es3.png')}}">
            @if ($user->role === 'manager')
            <div class="main__comp">
                <img src="{{ Storage::url('public/images/' . $company->company_logo) }}" class="profile__img" >
            @endif

            @if ($user->role === 'normal user')
            <div class="main__comp">
                <img src="{{ (!empty($image->profile_image))? Storage::url('public/images/'.$image->profile_image):url('images/no_image.jpg') }}" class="profile__img" >
            @endif

            <h1 class="profile__name"> {{ $adminData->name}}</h1>
        
       
                <div class="profile__company">
                    <h1 class="company__name">{{ $company->name_company }}.</h1>
                    <img class="backdrop" src="{{asset('/Pic/backdrop.png')}}">
                </div>
           

               
                <a href="{{ route('edit.profile') }}" class="btn btn-info btn-rounded waves-effect waves-light bluish" > Edit Profile</a>
            </div>
           
          
            
            <div class="info__comp">
                <div class="sec__about">
                    <h1>About {{{ $company->name_company }}}:</h1>
                    <p>{{ $company->company_description }}</p>
                </div>
        
                @if ($user->role === 'manager')
                <div class="sec__employee">
                    <h1>Invited People :</h1>
                    
                    <div class="employees">
                    @foreach($employeeData as $key => $emp)
                        <div class="employee employee--{{ $key+1 }}">
                            @if(isset($employeeImages[$key]))
                                <img class="employee__img" src="{{ Storage::url('public/images/'.$employeeImages[$key]->profile_image) }}">
                            @else
                                <img class="employee__img" src="{{ url('images/no_image.jpg') }}">
                            @endif
                            <h3 class="employee__role">{{ $emp->name }}</h3>
                        </div>
                    @endforeach
                    </div> 
                </div>
                @endif
            </div>
        
        

<!--
            <div class="card-body">
                <h4 class="card-title">Name : {{ $adminData->name}} </h4>
                <hr>
                <h4 class="card-title">User Email : {{ $adminData->email }} </h4>
                <hr>
                <hr>
                <a href="{{ route('edit.profile') }}" class="btn btn-info btn-rounded waves-effect waves-light" > Edit Profile</a>
                
            </div>-->
        
                            
        
            


</div>
</div>



@endsection 
