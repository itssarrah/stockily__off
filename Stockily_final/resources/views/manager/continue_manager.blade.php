<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manager Sign Up</title>
    <link rel="stylesheet" href={{asset('manager_page/styles.css')}} />
    <script defer src={{asset('manager_page/script.js')}}></script>
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
    <form  method="post" action="{{ route('company') }}" enctype="multipart/form-data">
    <div class="left__form">
            @csrf
        <div class="input__container">
        <img src="/Pic/com.png" class="input__icon input__icon--1" />
        <div class="input__desc">
            <h3>Company Name :</h3>
            <input
            class="input__field"
            type="text"
            placeholder="Stockily"
            name="name_company"
            />
            @error('name_company')
                    <P class="text-yellow-500 text-xs mt-1">{{$message}}</P>
                @enderror
        </div>
        </div>

        <div class="input__container">
        <img id="sec__photo__container" src="{{asset('/Pic/ec.png')}}" />
        <!-- circle-->
        <div class="input__desc">
            <h3>Company Logo :</h3>
            <input
            type="file"
            name="company_logo"
            accept="image/png, image/jpeg"
            id="image-input"
            />
            @error('company_logo')
                    <P class="text-yellow-500 text-xs mt-1">{{$message}}</P>
            @enderror
            <div class="form__photo__label">
              <img class="import-icon" src="{{asset('/Pic/img.png')}}" />
              <label for="image-input" class="form__photo">Import</label>
            </div>
          </div>
        </div>

        <div class="input__container input__container--3">
          <img src="/Pic/com.png" class="input__icon input__icon--1" />
          <div class="input__desc">
            <h3>Company Description :</h3>
            <textarea name="company_description"
              rows="8"
              cols="40"
              maxlength="500"
              class="input__field"
              placeholder="describe your company,your business!"
            ></textarea>
            @error('company_description')
                    <P class="text-yellow-500 text-xs mt-1">{{$message}}</P>
            @enderror
          </div>
        </div>
    
    </div>
        <div class="left__btns">
            <button name="continue_comp" type="submit" class="nav__btn nav__btn--2">
                Continue
            </button>
        </div>
    </form>
    </div>
    <div class="right">
      <img class="right__img--1" src="{{asset('/Pic/STOCKILY LOGO.png')}}" />
      <img class="right__img--2" src="{{asset('/Pic/illumanager.png')}}" />
    </div>
  </body>
</html>
