<section class="sec__beforefooter">
    <h1>Ready to manage like a boss ?</h1>
    <input type="email" placeholder="abcdef@stockily.dz" class="sec__input" />
    <?php 
use Illuminate\Support\Facades\Auth;
$user=Auth::user();
?>
    @if (empty($user))
    <a href="users/register" class="nav__btn nav__btn--2">Register</a>
    @else
    <a href="manager/admin/index" class="nav__btn nav__btn--2">Go To Dashboard</a>
    @endif
  </section>