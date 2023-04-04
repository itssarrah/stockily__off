@extends('layout')

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
      Horem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
      vulputate libero et velit interdum, ac aliquet odio mattis.
      <br />
      <br /><br />
      Class aptent taciti sociosqu ad litora torquent per conubia nostra,
      per inceptos himenaeos. Curabitur tempus urna at turpis condimentum
      lobortis.
      <br /><br />
      Ut commodo efficitur neque.
    </p>
  </div>
  <div class="one__right">
    <div class="photo__container photo__container--1"></div>
    <div class="photo__container photo__container--2"></div>
  </div>
</section>
<img class="one__img" src="{{asset('Pic/cartona.png')}}" />
<!-- Section 2 stats + slider-->
    <section class="section__two">
    <div class="two__stats">
        <!--each one of the four can be added through a model and only use one with a loop  !-->
        <div class="stats__container">
        <h1 class="stats__num stats__num--1">+ 80%</h1>
        <h3 class="stats__desc stats__desc--1">Found it life changing</h3>
        </div>

        <div class="stats__container">
        <h1 class="stats__num stats__num--1">+ 89%</h1>
        <h3 class="stats__desc stats__desc--1">
            Kept Using it from first sign up
        </h3>
        </div>

        <div class="stats__container">
        <h1 class="stats__num stats__num--1">+ 40%</h1>
        <h3 class="stats__desc stats__desc--1">
            Increase Employee’s Productivity
        </h3>
        </div>
    
        <div class="stats__container">
        <h1 class="stats__num stats__num--1">+ 80%</h1>
        <h3 class="stats__desc stats__desc--1">
            Recommended by Business Entrepreneurs
        </h3>
        </div>
    </div>
    </section>
</body>
</html>
</section>
@endsection