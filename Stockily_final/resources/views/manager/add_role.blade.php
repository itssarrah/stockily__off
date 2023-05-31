<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up | Role Creation</title>
    <link rel="stylesheet" href="/manager_page/role/styles.css" />
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
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
    <div class="left">
      <h1 class="txt">Invite Your <span>Employees !</span></h1>
      <div class="left__form">

        <p class="para" >Note that your employees will receive a unique link for the register/log In, they must authentificate with the same email you invited them</p>
        <form action="{{ route('send_email') }}" mathod="post" class="form">
          <div class="input__container container--1">
            <img src="{{asset('/Pic/mail.png')}}" class="input__icon input__icon--1" />
            <div class="input__desc">
              <h3>Mail Adress :</h3>
              <input
                class="input__field"
                type="email"
                id="email"
                placeholder="abcdef@example.com"
                name="empeml"
                required
              />
            </div>
          </div>
        </div>
          <input type="submit" class="btn btn-primary btn-rounded" value="Send Mail" >
        </form>
            @if(session('error'))
              <div class="alert alert-danger">
                  {{ session('error') }}
              </div>
            @endif

            @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif


      
      <div class="chip"></div>
      <div class="left__btns">
        <div class="nav__btn nav__btn--2"><a href="admin/index">Continue</a></div>
      </div>
    </div>
    <div class="right">
      <img class="right__img--1" src="{{asset('/Pic/STOCKILY LOGO.png')}}" />
      <img class="right__img--2" src="{{asset('/Pic/illumanager.png')}}" />
    </div>
  </body>
</html>
