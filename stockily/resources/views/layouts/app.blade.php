<!--this is for teh layout that have the head with navbar and the footer -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Stockily | Warehouse Manager</title>
    <link rel="stylesheet" href="{{asset('styles.css')}}" />
    <script defer src="{{asset('script.js')}}"></script>
    <!-- FOnts-->
    <link
      href="https://fonts.googleapis.com/css?family=Outfit"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Orbitron"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- navbar start -->
    <header class="header">
      <nav class="nav">
        <img class="nav__logo" src="{{asset('Pic/STOCKILY LOGO.png')}}" />
        <ul class="nav__items">
          <li class="nav__item">Home</li>
          <li class="nav__item">Why Us?</li>
          <li class="nav__item">Discover</li>
          <li class="nav__item">Contact Us</li>
        </ul>
        <div class="nav__btns">
        @auth
        {{-- here we will put whatever the user will see if he is logged in --}}
        <div class="nav__btns">
        <h3 class="welcome__msg">
          Welcome {{auth()->user()->name}}
        </h3>
        {{-- this section is for the logout i did it but it doesn't work we will do it later! --}}
        <form class="inline" method="POST" action="/logout">
          @csrf
          <button type="submit" class="nav__btn nav__btn--2">Logout</button>
        </form>
        </div>
@else 
{{-- this is the else part if he is not logged in  --}}
        <a href="users/login"class="nav__btn nav__btn--1">Log In</a>
        <!--start model !-->
            
        <!--end model!-->
        
        <a href="users/register" class="nav__btn nav__btn--2">Sign Up</a>
        @endauth
        </div>
      </nav>
    </header>
    <!-- navbar ends -->
    <main>
      @yield('content')
    </main>

    <!-- Footer begins  -->
    <footer class="footer">
      <div class="footer__left"></div>
      <div class="footer__right">
        <div class="foo__content">
          <div class="right__content--1">
            <h1>Stockily?</h1>
            <p>
              Stockily is a creative Software, implementing leading technologies
              to help you effectively manage your supply chain. <br /><br />
              We aim to program logistic software environments that are easy to
              use and excel at enabling our users to accomplish their goals.
            </p>
          </div>

          <div class="right__content--2">
            <h1>Navigate</h1>
            <div class="two__nav">
              <a href="#home">Home</a>
              <a href="#why">Why Stockily ?</a>
              <a href="#discover">Discover More</a>
              <a>Contact us</a>
            </div>
          </div>

          <div class="right__content--3">
            <h1>Get In Touch</h1>
            <div class="contact">
              <h6>Email :</h6>
              <h6 class="contact__mail">stockily@contact.dz</h6>
            </div>
            <div class="contact">
              <h6>Tel :</h6>
              <h6>(+33)6 55 59 32 88</h6>
            </div>
            <div class="contact">
              <h6>Fax :</h6>
              <h6>8641 4615</h6>
            </div>
          </div>
        </div>

        <h3>Copyrights | 2023 ORCHODE TEAM - STOCKILY . All rights reserved</h3>
      </div>
    </footer>
    <!-- Footer ends  -->
  </body>
</html>
