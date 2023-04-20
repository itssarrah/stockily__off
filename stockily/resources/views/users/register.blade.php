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
    <section class="sec__left">
        <img src="../Pic/STOCKILY LOGO.png" class="sign__logo">
        <img class="sign__illu" src="../Pic/illu2.png">
    </section>
    <!-- Content of the register.blade.php file goes here -->
     <section class="sec__right">
    <form  method="POST" action="/users">
        @csrf
        <h1 class="right__title">Welcome to the virtual <span>Warehouse Manager</span></h1>
        <!--added by nesrine!-->
        <h1 class="right__title">register to start</h1>
        <div class="right__form">
            <!--user name add icon !-->
            <div class="input__container">
                <img src="../Pic/mail.png" class="input__icon input__icon--1">
                <div class="input__desc">
                    <h3>user name :</h3>
                    <input class="input__field" type="text" placeholder="your name" name="name" value="{{old('name')}}" />
                @error('name')
                    <P class="text-yellow-500 text-xs mt-1">{{$message}}</P>
                @enderror
                </div>
            </div>
            <!--email !-->
            <div class="input__container">
                <img src="../Pic/mail.png" class="input__icon input__icon--1">
                <div class="input__desc">
                <h3>email  :</h3>
                <input class="input__field" type="email" placeholder=".com" name="email"
                value="{{old('email')}}"/>
                @error('email')
                    <P class="text-yellow-500 text-xs mt-1">{{$message}}</P>
                @enderror
                </div>
                
            </div>
            <div class="input__container">
                 <img src="/Pic/set.png" class="input__icon " />
                   <div class="input__desc">
                <h3>Role Type :</h3>
                <select class="input__field" type="text" name="role">
                  <option value="select" disabled>Please Select An Option</option>
                  <option value="manager">Manager</option>
                  <option value="normal user">Normal User</option>
                </select>
                @error('role')
                    <p class="text-yellow-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
                
            </div>
            <!-- password !-->
            <div class="input__container">
                <img src="../Pic/password.png" class="input__icon">
                <div class="input__desc">
                    <h3>Password :</h3>
                    <input class="input__field" type="password" placeholder="*******" name="password" value="{{old('password')}}" />
                    @error('password')
                    <P class="text-yellow-500 text-xs mt-1">{{$message}}</P>
                @enderror
                </div>
            </div>
            <!-- confirm password!-->
            <div class="input__container">
                <img src="../Pic/password.png" class="input__icon">
                <div class="input__desc">
                    <h3>confirm password :</h3>
                    <input class="input__field" type="password" placeholder="********"  name="password_confirmation" value="{{old('password_confirmation')}}"/>
                    @error('password_confirmation')
                    <P class="text-yellow-500 text-xs mt-1">{{$message}}</P>
                @enderror
                </div>
            </div>
            <label class="form-control">
                <input type="radio" name="radio" required/>
                <h2>I read and agree with the <span>terms of use</span>.</h2>
            </label>
        </div>
        <!--end of the form !-->

        <div class="right_btns">
                <button type="submit" class="nav__btn nav__btn--2">
                    Sign Up
                </button>
            <a href="login" class="nav__btn nav__btn--1">Log In</a>
            
        </div>
    </form>
    </section>
</body>