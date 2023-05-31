<!--here is the head of the landing page !-->


<?php 
use Illuminate\Support\Facades\Auth;
$user=Auth::user();
?>

<main class="main__container" id="main-container">
          
    <div class="main__left">
      <h1>Your Intelligent<span> Warehouse</span></h1>
            @if(session('error'))
              <div class="alert alert-danger">
                  {{ session('error') }}
              </div>
            @endif
      <p>
        Welcome to our state-of-the-art STOCKILY website, designed specifically to meet the needs of businesses in Algeria. Our platform is designed to provide you with the most efficient and effective tools to manage your warehouse operations.  <br />
        <br />
        With our website, you will have access to a wide range of features that will help you manage your inventory, optimize your space utilization, and streamline your supply chain. Our user-friendly interface makes it easy for you to track your shipments, monitor your stock levels, and manage your orders.<br />
        <br />
        Sign up today and start experiencing the benefits of our platform for yourself.
      </p>
      @if (empty($user))
      <a href="users/login" class="main__btn main__btn--1">Get Started</a>
      @endif
    </div>
    <div class="main__right">
      <img class="main__illu" src="{{asset('Pic/Illustration.png')}}" />
    </div>
  </main>