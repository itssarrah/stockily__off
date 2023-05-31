<!--here is this part the slider before teh serach bar kept here for any other work and modiications !-->
<section class="section__three" id="discover">
    <h1>
      Speeds up the flow of <span>goods</span> and information to enable
      flawless execution across inventory, labour, and space.
    </h1>

    <div class="three__slider">
      <div class="slider__card">
        <div class="card_rect card_rect--1"></div>
        <h6 class="card__txt">Staff / Roles Distribution</h6>
      </div>

      <div class="slider__card">
        <div class="card_rect card_rect--2"></div>
        <h6 class="card__txt">Goods <br />Utilization</h6>
      </div>

      <div class="slider__card activated__card">
        <div class="card_rect card_rect--3"></div>
        <h6 class="card__txt">Stock Control</h6>
      </div>

      <div class="slider__card">
        <div class="card_rect card_rect--4"></div>
        <h6 class="card__txt">
          Warehouse <br />
          managment
        </h6>
      </div>

      <div class="slider__card">
        <div class="card_rect card_rect--5"></div>
        <h6 class="card__txt">
          Goods <br />
          Locations
        </h6>
      </div>
    </div>
    <?php 
use Illuminate\Support\Facades\Auth;
$user=Auth::user();
?>
    @if (empty($user))
    <div class="main__btn main__btn--1 sec3__btn"><a href="users/login">Get Started</a></div>
    @endif
  </section>