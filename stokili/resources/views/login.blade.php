<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Stockily | Sign up !</title>
        <link rel="stylesheet" href="{{asset('styles_register.css')}}" />
        <script defer src="{{asset('script_register.js')}}"></script>
    
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
    <!-- Content of the login.blade.php file goes here -->
     <section class="sec__right">
        <h1 class="right__title">Welcome to the virtual <span>Warehouse Manager</span></h1>
        <!--added by nesrine!-->
        <h1 class="right__title">login with your account</h1>
        <div class="right__form">
            <!--user name add icon !-->
            <div class="input__container">
                <img src="pic/mail.png" class="input__icon input__icon--1">
                <div class="input__desc">
                    <h3>user name :</h3>
                    <input class="input__field" type="text" placeholder="your name" name="username">
                  
                </div>
            </div>

             <!-- password !-->
            <div class="input__container">
                <img src="pic/password.png" class="input__icon">
                <div class="input__desc">
                    <h3>Password :</h3>
                    <input class="input__field" type="password" placeholder="*******" >
                </div>
            </div>
        </div>

        <div class="right_btns">
            <div class="nav__btn nav__btn--2">Log In</div>
            <a href="register" class="nav__btn nav__btn--1">Sign Up</a>
            
        </div>
 
    </section>
</body>