@extends('manager.admin.admin_master')
@section('admin')

<div class="page-content">
<div class="container-fluid">



    
        
             <img class="wavie" src="{{asset('/Pic/wave2.png')}}">
             <img class="dot--1" src="{{asset('/Pic/es2.png')}}">
            <img class="dot--2" src="{{asset('/Pic/es3.png')}}">
        
            <div class="main__comp">
                <img class="profile__img" src="{{asset('/Pic/es.png')}}">
                <h1 class="profile__name"> {{ $adminData->name}}</h1>
                <div class="profile__company">
                    <h1 class="company__name">Stockily Inc.</h1>
                    <img class="backdrop" src="{{asset('/Pic/backdrop.png')}}">
                </div>
                <a href="{{ route('edit.profile') }}" class="btn btn-info btn-rounded waves-effect waves-light bluish" > Edit Profile</a>
            </div>
            
            <div class="info__comp">
                <div class="sec__about">
                    <h1>About Stockily:</h1>
                    <p>Lorem ipsum dolor sit amet consectetur. Ut tristique eget mattis venenatis consequat dignissim mattis morbi sollicitudin.</p>
                </div>

                <div class="sec__employee">
                    <h1>My Employees :</h1>
                    <div class="employees">
                        <div class="employee employee--1">
                            <img class="employee__img" src="{{asset('/Pic/es.png')}}">
                            <h3 class="employee__name">Jimmie Sh.</h3>
                            <h3 class="employee__role">Role: Edit</h3>
                        </div>
                        <div class="employee employee--1">
                            <img class="employee__img" src="{{asset('/Pic/es.png')}}">
                            <h3 class="employee__name">Jimmie Sh.</h3>
                            <h3 class="employee__role">Role: Edit</h3>
                        </div>
                        <div class="employee employee--1">
                            <img class="employee__img" src="{{asset('/Pic/es.png')}}">
                            <h3 class="employee__name">Jimmie Sh.</h3>
                            <h3 class="employee__role">Role: Edit</h3>
                        </div>
                        <div class="employee employee--1">
                            <img class="employee__img" src="{{asset('/Pic/es.png')}}">
                            <h3 class="employee__name">Jimmie Sh.</h3>
                            <h3 class="employee__role">Role: Edit</h3>
                        </div>
                    </div>
                </div>
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
