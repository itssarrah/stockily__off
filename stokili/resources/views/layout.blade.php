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
        <img class="nav__logo" src="Pic/STOCKILY LOGO.png" />
        <ul class="nav__items">
          <li class="nav__item">Home</li>
          <li class="nav__item">Why Us?</li>
          <li class="nav__item">Discover</li>
          <li class="nav__item">Contact Us</li>
        </ul>
        <div class="nav__btns">
        <a href="login"class="nav__btn nav__btn--1">Log In</a>
        <a href="register" class="nav__btn nav__btn--2">Sign Up</a>
        </div>
      </nav>
    </header>
    <!-- navbar ends -->
    <main>
      @yield('content')
    </main>
    <!-- Footer begins  -->
    <footer>
      <!-- Footer content goes here -->
      <h2>add footer do no forget it </h2>
    </footer>
    <!-- Footer ends  -->
  </body>
</html>
