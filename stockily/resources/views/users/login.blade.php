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
    <form action="/users/authenticate" metho="POST">
     <section class="sec__right">
        <h1 class="right__title">Welcome to the virtual <span>Warehouse Manager</span></h1>
        <!--added by nesrine!-->
        <h1 class="right__title">login with your account</h1>
        <div class="right__form">
            <!--email !-->
            <div class="input__container">
                 <img src="/Pic/mail.png" class="input__icon input__icon--1">
                <div class="input__desc">
                  <h3>email  :</h3>
                  <input class="input__field" type="email" placeholder=".com" name="email"
                value="{{old('email')}}"/>
                @error('email')
                    <P class="text-yellow-500 text-xs mt-1">{{$message}}</P>
                @enderror
                </div>
                
            </div>

             <!-- password !-->
             <div class="input__container">
                <img src="/Pic/password.png" class="input__icon">
                <div class="input__desc">
                    <h3>Password :</h3>
                    <input class="input__field" type="password" placeholder="*******" name="password" value="{{old('password')}}" />
                    @error('password')
                    <P class="text-yellow-500 text-xs mt-1">{{$message}}</P>
                @enderror
                </div>
            </div>

        <div class="right_btns">
            <button  type="submit" class="nav__btn nav__btn--2">Sign In</button>
            <p>
                <h1>Don't have an account ?</h1> 
                {{-- should fix the h1 above --}}
                <a href="/users/register" class="nav__btn nav__btn--1">Sign Up</a>
            </p>
            </div>
        </div>
 </form>
    </section>
</body>