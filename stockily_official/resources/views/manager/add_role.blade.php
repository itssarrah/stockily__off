<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up | Role Creation</title>
    <link rel="stylesheet" href="/manager_page/role/styles.css" />
    <script defer src="/manager_page/role/script.js"></script>
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
    <div class="left">
      <h1 class="txt">Sign Up as <span>a Manager</span></h1>
      <h3 class="sub__txt">Role Creation :</h3>
      <div class="left__form">
        <div class="input__container">
          <img src="{{asset('Pic/user.png')}}" class="input__icon input__icon--1" />
          <div class="input__desc">
            <h3>Role Name :</h3>
            <input
              class="input__field"
              type="text"
              placeholder="Tech Monitor"
              name="role"
            />
          </div>
        </div>

        <div class="input__container">
          <img src="{{asset('/Pic/set.png')}}" class="input__icon input__icon--1" />
          <div class="input__desc">
            <h3>Role Type :</h3>
            <select class="input__field" type="text" name="role">
              <option value="select" disabled>Please Select An Option</option>
              <option value="view">View Only</option>
              <option value="edit">Edit And View</option>
            </select>
          </div>
        </div>

        <h3 class="sub__txt txt--2">Invite your Employees :</h3>
        <form action="#" class="form">
          <div class="input__container container--1">
            <img src="{{asset('/Pic/mail.png')}}" class="input__icon input__icon--1" />
            <div class="input__desc">
              <h3>Mail Adress :</h3>
              <input
                class="input__field"
                type="email"
                id="email"
                placeholder="abcdef@example.com"
                name="usrnm"
              />
            </div>
          </div>
        </form>
      </div>
      <div class="chip"></div>
      <div class="left__btns">
        <div class="nav__btn nav__btn--2"><a href="inprocess_page">Continue</a></div>
        <div class="nav__btn nav__btn--2"><a href="admin/index">back</a></div>
        <h3 class="btn--2">
            You already have a DataBase?  <a href="admin/index"><span>Click Here !</span></a> 
            </h3>
      </div>
    </div>
    <div class="right">
      <img class="right__img--1" src="{{asset('/Pic/STOCKILY LOGO.png')}}" />
      <img class="right__img--2" src="{{asset('/Pic/illumanager.png')}}" />
    </div>
  </body>
</html>
