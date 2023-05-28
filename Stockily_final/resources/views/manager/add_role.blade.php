<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up | Role Creation</title>
    <link rel="stylesheet" href="/manager_page/role/styles.css" />
   
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
      <h1 class="txt">Sign Up as <span>a Manager</span></h1>
      <div class="left__form">
        <h3 class="sub__txt txt--2">Invite your Employees :</h3>
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
              />
            </div>
          </div>
        </div>
          <input type="submit" class="nav__btn nav__btn--2" >
        </form>
      
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
