
<nav class="navbar fixed-top navbar-light bg-white navbar-offcanvas">
<button class="navbar-toggler" type="button" id="navToggle"><span class="navbar-toggler-icon"></span> </button>

<a class="navbar-brand mr-auto ml-auto" href="#">Employee Admin Pannel</a>



<div class="navbar-collapse offcanvas-collapse" >
<ul class="navbar-nav mr-auto ml-2">

<li class="nav-item active">
<a class="nav-link text-white" href="index.php?clinic=clinic">Approve Clinic</a>
</li>
<div class="dropdown-divider"></div> 
<li class="nav-item">
<a class="nav-link text-white" href="index.php?doctor=doctor">Approve Doctor</a>
</li>
<li class="nav-item">
<a class="nav-link text-white" href="index.php?assigndoctor=assigndoctor">Assign Doctor</a>
</li>
</ul>
</div>
<span class="navbar-text order-sm-6 d-none d-sm-block">
	 <?php if (!isset($_SESSION['email'])) 
    { ?>
          <a href="login.php" style="text-decoration:none;">
              <span class="fa fa-sign-in-alt"></span> Login
          </a>
	<?php }else{ ?>
   <a href="logout.php" style="text-decoration:none;">
              <span class="fa fa-sign-in-alt"></span> Logout
          </a>

	<?php } ?>
      </span>
</nav>

   