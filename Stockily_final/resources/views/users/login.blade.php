<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Stockily | Sign up !</title>
        <link rel="stylesheet" href="{{asset('styles_login.css')}}" />
        <script defer src="{{asset('script_login.js')}}"></script>
    
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
     <header>
      <img class="header__asset asset--1" src="/Pic/es1.png" />
      <img class="header__asset asset--2" src="/Pic/wave.png" />
    </header>
    <img src="/Pic/20945218.png" class="main__pic" />
    <form action="/users/authenticate" metho="POST">
      <main>
      <div class="left__form">
        <img class="header__asset asset--3" src="/Pic/es2.png" />
        <div class="left__title">
          <img
            class="form__asset form__asset--1"
            src="/Pic/STOCKILY LOGO cropped shadowed.png"
          />
          <div class="form__txt">
            <h1>Good To See You Again</h1>
            <!--<h3>
              Did You <span class="title__span">Forget Your Password ?</span>
            </h3>-->
          </div>
        </div>

        <img class="header__asset asset--4" src="/Pic/es3.png" />
      </div>
        <div class="form__inputs">
            <!--email !-->
              <div class="input__container container--1">
          <img src="../Pic/mail.png" class="input__icon input__icon--1" />
          <div class="input__desc">
            <h3>Mail Adress :</h3>
            <input
              class="input__field"
              type="email"
              placeholder="abcdef@example.com"
              name="email"
            value="{{old('email')}}"
            />
            @error('email')
                    <P class="text-yellow-500 text-xs mt-1">{{$message}}</P>
            @enderror
          </div>
        </div>


             <!-- password !-->
 <div class="input__container">
          <img src="../Pic/pass.png" class="input__icon" />
          <div class="input__desc">
            <h3>Password :</h3>
            <input
              class="input__field"
              type="password"
              placeholder="*******"
              name="password"
           value="{{old('password')}}" />
                    @error('password')
                    <P class="text-yellow-500 text-xs mt-1">{{$message}}</P>
                @enderror
          </div>
        </div>

        <div class="remember">
          <input type="checkbox" id="check" />
          <label for="check">Remember me</label>
        </div>
</div>
        <div class="log">
        <button  type="submit" class="modal__btn">Log In</button>
        <h3 class="here">Don't Have an Account? <span>  <a href="register" >Register</a></span></h3>
    </div>
    </main>

</form>
<img src="/Pic/blob2.png" class="header__asset asset--5" />
</body>