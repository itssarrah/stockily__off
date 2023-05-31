@extends('layouts.app')

@section('title', 'Stockily | Warehouse Manager')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stokili | Warehouse Manager</title>
</head>
<body>
    <!-- the _hero includes the head of the landing page!-->
    @include('partials._hero')
<section class="section__one">
  <div class="one__left">
    <h1>
      Manage Your Goods as a <span>Boss</span>, Be Aware Of Your
      <span>Stock !</span>
    </h1>
    <p>
      Our Inventory Management System is designed to streamline your inventory operations, reduce stockouts and overstocks, improve order accuracy, and ultimately boost your business efficiency and profitability. 
      <br />
      <br /><br />
  Try our system today and experience the benefits of effective inventory management!SO 
      <br /><br />
    </p>
  </div>
  <div class="one__right">
    <div class="photo__container photo__container--1" src="{{asset('Pic/pic1.png')}}" ></div>
    <div class="photo__container photo__container--2" src="{{asset('Pic/pic2.png')}}" ></div>
  </div>
</section>
<img class="one__img" src="{{asset('Pic/cartona.png')}}" />
<!-- Section 2 stats + slider-->
    <!--categries !-->
    @include('partials._categories')
    <!--end of categiries !-->
    <!--slider!-->
    @include('partials._slider')
    <!--end of slider!-->
    <!--search!-->
    @include('partials._search')
    <!--end of search!-->
</body>
</html>

@endsection