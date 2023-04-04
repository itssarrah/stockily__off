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
    <!-- Content of the register.blade.php file goes here -->
     <section class="sec__right">
        <h1 class="right__title">Welcome to the virtual <span>Warehouse Manager</span></h1>
        <!--added by nesrine!-->
        <h1 class="right__title">register to start</h1>
        <div class="right__form">
            <!--user name add icon !-->
            <div class="input__container">
                <img src="pic/mail.png" class="input__icon input__icon--1">
                <div class="input__desc">
                    <h3>user name :</h3>
                    <input class="input__field" type="text" placeholder="your name" name="username">
                  
                </div>
            </div>
            <!--email !-->
             <div class="input__container">
                 <img src="pic/mail.png" class="input__icon input__icon--1">
                <div class="input__desc">
                  <h3>email  :</h3>
                  <input class="input__field" type="email" placeholder=".com" name="email">
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
            <!-- confirm password!-->
            <div class="input__container">
                <img src="pic/password.png" class="input__icon">
                <div class="input__desc">
                    <h3>confirm password :</h3>
                    <input class="input__field" type="password" placeholder="********" name="usrnm" name="confirm_pw">
                </div>
            </div>
            <label class="form-control">
                <input type="radio" name="radio" />
                <h2>I read and agree with the <span>terms of use</span>.</h2>
            </label>
        </div>
        <!--end of the form !-->

        <div class="right_btns">
            <div class="nav__btn nav__btn--2">Sign Up</div>
            <a href="login"class="nav__btn nav__btn--1">Log In</a>
            
        </div>
 
    </section>
</body>