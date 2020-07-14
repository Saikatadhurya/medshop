<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.php">MedShop</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fas fa-bars ml-1"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                    <?php if(!isset($_SESSION['loginas'])){ ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#findshop">Book a Doctor</a></li>
                <?php }else if($_SESSION['loginas'] == "patient"){?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#findshop">Book a Doctor</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="tokenstatus.php">Token Status</a></li>
                    <?php }else if($_SESSION['loginas'] == "doctor"){?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="doctor.php">Home</a></li>
                    <?php }else if($_SESSION['loginas'] == "clinic"){?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="patientdetails.php">Home</a></li>
                  
                    <?php }?>
                         <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
                        <?php if (!isset($_SESSION['email'])) 
    { ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="signup.php">Sign up</a></li>
    <?php }else{?>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout.php">Logout</a></li>
                       
    <?php  } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        