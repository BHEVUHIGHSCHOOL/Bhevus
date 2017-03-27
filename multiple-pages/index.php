<?php require ('connection/conect.php');?>
<?php
session_start();
if(isset($_POST['login']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$admin = $con -> query ("SELECT * FROM qazwsxedc WHERE username = '$username' and password = '$password'");
	$resultadmin = mysqli_num_rows($admin);
	
	//Learner
	$learner = $con -> query ("SELECT * FROM learner WHERE Username = '$username' and Password = '$password'");
	$resultlearner = mysqli_num_rows($learner);
	
	//Parent
	$parent = $con -> query ("SELECT * FROM parent WHERE Username = '$username' and Password = '$password'");
	$resultparent = mysqli_num_rows($parent);
	
	if($resultadmin>0 || $resultlearner>0 || $resultparent>0)
	{
		$queryadmin = $admin -> fetch_array(MYSQLI_BOTH);
		$_SESSION['usernamea'] = $queryadmin['username'];
		$_SESSION['userid'] = $queryadmin['userId'];
		
		//Learner
		$querylearner = $learner -> fetch_array(MYSQLI_BOTH);
		$_SESSION['username'] = $querylearner['Username'];
		$_SESSION["ID_number"] = $querylearner['IDNumber'];
		$_SESSION['Status'] = $querylearner['Status'];
		
		if(isset($_SESSION['userid']))
		{
			header('Location: qazwsxedc.php');
		}
		if(isset($_SESSION['username']))
		{
			//learner
			if($_SESSION['Status'] == "Aproved")
			{
				header('Location: RegisterSubj.php');
				$_SESSION["report"] = "Report".$_SESSION["ID_number"];
			}
			else
			{
				header('Location: After-Confirm.php');
			}
		}
		
		//parent
		$queryparent = $parent -> fetch_array(MYSQLI_BOTH);
	}
	else
	{
		$error = "<p style='color:red'>User Account not found.....</p>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bhevu High&reg;</title>
<!-- Bootstrap CSS -->
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome CSS-->
<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/style.css" rel="stylesheet">
<!-- Animate CSS -->
<link href="assets/animate/animate.css" rel="stylesheet">
<!-- Owl Carousel -->
<link href="assets/owl-carousel/css/owl.carousel.css" rel="stylesheet">
<link href="assets/owl-carousel/css/owl.theme.css" rel="stylesheet">
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="images/fav.png">
</head>
<body>
<div id="dvLoading"></div>
<!-- Header Start -->
<header>
  <div class="top-wrapper hidden-xs">
    <div class="container">
      <div class="col-md-4 col-sm-6 hidden-xs top-wraper-left no-padding">
        <ul class="header-social-icons">
          <li class="facebook"><a href="javascript:void(0)" target="_blank"><i class="fa fa-facebook"></i></a></li>
          <li class="twitter"><a href="javascript:void(0)" target="_blank"><i class="fa fa-twitter"></i></a></li>
          <li class="linkedin"><a href="javascript:void(0)" target="_blank"><i class="fa fa-linkedin"></i></a></li>
          <li class="pinterest"><a href="javascript:void(0)" target="_blank"><i class="fa fa-pinterest"></i></a></li>
          <li class="google-plus"><a href="javascript:void(0)" target="_blank"><i class="fa fa-google-plus"></i></a></li>
          <li class="youtube"><a href="javascript:void(0)" target="_blank"><i class="fa fa-youtube"></i></a></li>
          <li class="dribbble"><a href="javascript:void(0)" target="_blank"><i class="fa fa-dribbble"></i></a></li>
        </ul>
      </div>
      <div class="col-md-8 col-sm-6">
        <ul class="top-right pull-right ">
          <!-- Login -->
          <li class="login"><a href="javascript:void(0)"><i class="fa fa-lock"></i>Login</a>
            <div class="login-form">
              <h4>Login</h4>
              <form action="" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <?php if(isset($error)){echo $error;}?>
                <button type="submit" name="login" class="btn">Login</button>
              </form>
            </div>
          </li>
          <!-- Apply -->
          <li class="register"><a href="javascript:void(0)"><i class="fa fa-user"></i>Apply</a>
            <div class="register-form">
              <h4>Apply</h4>
            </div>
           </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="logo-bar hidden-xs">
    <div class="container">
      <!-- Logo -->
      <div class="row">
        <div class="col-sm-4"><a href="index.html"> <img src="Bhevu Pics/Edited/Logo/logo2.png" alt="Bhevu Logo" style="width:218px; height:46px;"></a> </div>
        <div class="col-sm-8">
          <ul class="contact-info pull-right">
            <li><i class="fa fa-phone"></i>
              <p> <span>Call us</span><br>
                +1-012-345-6789</p>
            </li>
            <li><i class="fa fa-envelope"></i>
              <p><span>Email Us</span><br>
                <a href="mailto:support@sbtechnosoft.com">support@sbtechnosoft.com</a></p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="wow fadeInDown navigation" data-offset-top="197" data-spy="affix">
    <div class="container">
      <nav class="navbar navbar-default">
        <div class="row">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href="index.html"><img src="Bhevu Pics/Edited/Logo/Bhevu Logo.jpg" alt="Education World"/></a> </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.html">Home</a></li>
              <li class="dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Elements <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="grid.html">Grid</a></li>
                  <li><a href="table.html">Tables</a></li>
                  <li><a href="tabs.html">Tabs</a></li>
                  <li><a href="accordions.html">Accordions</a></li>
                  <li><a href="forms.html">Forms</a></li>
                  <li><a href="buttons.html">Buttons</a></li>
                  <li><a href="lists.html">Lists</a></li>
                  <li><a href="typography.html">Typography</a></li>
                </ul>
              </li>
              <li class="dropdown mega-menu"> <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Portfolio <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">
                  <li>
                    <div class="row">
                      <div class="col-md-2 col-md-offset-1">
                        <ul class="list-unstyled">
                          <li><a href="Apply.php"><span>Apply</span></a></li>
                        </ul>
                      </div>
                      <div class="col-md-2">
                        <ul class="list-unstyled">
                          <li><span>Courses</span></li>
                            <li><a href="course-list.html"><span class="fa fa-angle-right menu-icon"></span>Course List</a></li>
                  			<li><a href="course-grid.html"><span class="fa fa-angle-right menu-icon"></span>Course Grid</a></li>
                  			<li><a href="course-details.html"><span class="fa fa-angle-right menu-icon"></span>Course Details</a></li>
                        </ul>
                      </div>
                      <div class="col-md-2">
                        <ul class="list-unstyled">
                          <li><span>News</span></li>
                            <li><a href="classic-news.html"><span class="fa fa-angle-right menu-icon"></span>Classic News</a></li>
                  			<li><a href="grid-news.html"><span class="fa fa-angle-right menu-icon"></span>Grid News</a></li>
                  			<li><a href="masonry-news.html"><span class="fa fa-angle-right menu-icon"></span>Masonry News</a></li>
                  			<li><a href="news-post-page.html"><span class="fa fa-angle-right menu-icon"></span>News Post Page</a></li>
                        </ul>
                      </div>
                      <div class="col-md-2">
                        <ul class="list-unstyled">
                         <li><span>Gallery</span></li>
                          <li><a href="grid-gallery.html"><span class="fa fa-angle-right menu-icon"></span>Grid Gallery</a></li>
                          <li><a href="full-gallery.html"><span class="fa fa-angle-right menu-icon"></span>Full Width Gallery</a></li>
                          <li><a href="masonry-gallery.html"><span class="fa fa-angle-right menu-icon"></span>Masonry Gallery</a></li>
                          <li><a href="modern-gallery.html"><span class="fa fa-angle-right menu-icon"></span>Modern Gallery</a></li>
                        </ul>
                      </div>
                      <div class="col-md-2">
                        <ul class="list-unstyled">
                          <li><span>Pages</span></li>
                          <li><a href="about-us.html"><span class="fa fa-angle-right menu-icon"></span>About Us</a></li>
                          <li><a href="coming-soon.html"><span class="fa fa-angle-right menu-icon"></span>Coming Soon</a></li>
                          <li><a href="404.html"><span class="fa fa-angle-right menu-icon"></span>404</a></li>
                          <li><a href="faq.html"><span class="fa fa-angle-right menu-icon"></span>FAQ</a></li>
						 </ul>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
              <li class="dropdown"> <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courses <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="course-list.html">Course List</a></li>
                  <li><a href="course-grid.html">Course Grid</a></li>
                  <li><a href="course-details.html">Course Details</a></li>
                </ul>
              </li>
              <li class="dropdown"> <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">News <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="classic-news.html">Classic News</a></li>
                  <li><a href="grid-news.html">Grid News</a></li>
                  <li><a href="masonry-news.html">Masonry News</a></li>
                  <li><a href="news-post-page.html">News Post Page</a></li>
                </ul>
              </li>
              <li class="dropdown"> <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gallery <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="grid-gallery.html">Grid Gallery</a></li>
                  <li><a href="full-gallery.html">Full Width Gallery</a></li>
                  <li><a href="masonry-gallery.html">Masonry Gallery</a></li>
                  <li><a href="modern-gallery.html">Modern Gallery</a></li>
                </ul>
              </li>
              <li class="dropdown"> <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <i class="fa fa-angle-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="about-us.html">About Us</a></li>
                  <li><a href="coming-soon.html">Coming Soon</a></li>
                  <li><a href="404.html">404</a></li>
                  <li><a href="faq.html">FAQ</a></li>
                </ul>
              </li>
              <li><a href="contact-us.html">Contact Us</a></li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
        </div>
      </nav>
    </div>
  </div>
</header>
<!-- Header End -->
<!-- Banner Wrapper Start -->
<div class="banner-wrapper">
  <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
    <!-- Overlay -->
    <div class="overlay"></div>
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
      <li data-target="#bs-carousel" data-slide-to="1"></li>
      <li data-target="#bs-carousel" data-slide-to="2"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item slides active">
        <div class="slide-1"></div>
        <div class="hero">
          <h1 class="animated1">Bhevu High School</h1>
          <h3 class="animated2">Aspire to Inspire........</h3>
        </div>
      </div>
      <div class="item slides">
        <div class="slide-2"></div>
        <div class="hero">
          <h1 class="animated1">Bhevu High School</h1>
          <h3 class="animated2">Aspire to Inspire........</h3>
        </div>
      </div>
      <div class="item slides">
        <div class="slide-3"></div>
        <div class="hero">
          <h1 class="animated1">Bhevu High School</h1>
          <h3 class="animated2">Aspire to Inspire........</h3>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Banner Wrapper End -->
<!-- About Us -->
<div class="about-us">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <h2>HARD WORK &amp; PRESEVERANCE<br>
          IS THE <span> MOTHER OF SUCCESS</span></h2>
        <p><strong>Here is a bit of the history of the School:</strong>
Late in 2008, Principal(Gugu Ntshangase) was told that a new High school would be opening in the rural area of Roosboom, just outside Ladysmith. She was shocked to hear that there would be no school buildings by the time the learners arrived in January 2009. The new year began with learners sitting in the sun (there are very few trees and none near the site of the school) using lap desks. There were total of 64 learners in the first Grade 8 Class.</p>
        <a href="about-us.html">More...</a> </div>
      <div class="col-sm-12 col-md-4 pull-right hidden-sm"> <img src="Bhevu Pics/Edited/Logo/Bhevu Logo.jpg" alt="World-edu"> </div>
    </div>
  </div>
</div>
<!-- Callouts Wrapper Start -->
<div class="callouts-wrapper">
  <div class="container">
    <h2>Welcome to <span>Bhevu High</span></h2>
    <p class="center">I am very proud to welcome you to Bhevu High School website Ladysmith, KZN, South Africa.</p>
    <p class="center">This is where leaners and teachers are working together, and leaners are dedicated, well-behaved &amp; appriciate what their teachers do for them.</p>
    <div class="row">
      <div class="col-sm-6 col-md-4 wow fadeIn animated" data-wow-duration="1.5s">
        <div class="callouts">
          <div class="icon"><i class="fa fa-desktop" aria-hidden="true"></i></div>
          <div class="content">
            <h3>Fully Responsive</h3>
            <p>Coccaecat cupidatat aliqu proident sunt.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 wow fadeIn animated" data-wow-duration="1.5s" data-wow-delay="0.3s">
        <div class="callouts">
          <div class="icon"> <i class="fa fa-paint-brush" aria-hidden="true"></i></div>
          <div class="content">
            <h3>Clean Design</h3>
            <p>Coccaecat cupidatat aliqu proident sunt.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 wow fadeIn animated" data-wow-duration="1.5s" data-wow-delay="0.5s">
        <div class="callouts">
          <div class="icon"><i class="fa fa-magic" aria-hidden="true"></i></div>
          <div class="content">
            <h3>Retina Ready</h3>
            <p>Coccaecat cupidatat aliqu proident sunt.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 wow fadeIn animated" data-wow-duration="1.5s">
        <div class="callouts">
          <div class="icon"><i class="fa fa-cogs" aria-hidden="true"></i></div>
          <div class="content">
            <h3>Multipurpose</h3>
            <p>Coccaecat cupidatat aliqu proident sunt.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 wow fadeIn animated" data-wow-duration="1.5s" data-wow-delay="0.3s">
        <div class="callouts">
          <div class="icon"> <i class="fa fa-users" aria-hidden="true"></i></div>
          <div class="content">
            <h3>Customer Support</h3>
            <p>Coccaecat cupidatat aliqu proident sunt.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 wow fadeIn animated" data-wow-duration="1.5s" data-wow-delay="0.5s">
        <div class="callouts">
          <div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
          <div class="content">
            <h3>Marketing</h3>
            <p>Coccaecat cupidatat aliqu proident sunt.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Callouts Wrapper End -->
<!-- Satisfied Wrapper start -->
<div class="satisfied-wrapper">
  <div class="container">
    <h2>Statistics of <span><strong>School</strong></span></h2>
    <p class="center">Bhevu is proof that hard work and perseverance can overcome all odds.</p>
    <p class="center">This school got 100% rate on it first Matric on 2013.</p>
    <div class="statistics">
      <div class="col-sm-3 counter"> <i class="fa fa-list-alt" aria-hidden="true"></i>
        <div class="number animateNumber" data-num="28"> <span>28</span></div>
        <p>Our Branches</p>
      </div>
      <div class="col-sm-3 counter"> <i class="fa fa-user" aria-hidden="true"></i>
        <div class="number animateNumber" data-num="180"> <span>180</span></div>
        <p>Our teachers</p>
      </div>
      <div class="col-sm-3 counter"> <i class="fa fa-users" aria-hidden="true"></i>
        <div class="number animateNumber" data-num="3600"> <span>3600</span></div>
        <p>Students</p>
      </div>
      <div class="col-sm-3 counter"> <i class="fa fa-graduation-cap" aria-hidden="true"></i>
        <div class="number animateNumber" data-num="768"> <span>768</span></div>
        <p>Graduates</p>
      </div>
    </div>
  </div>
</div>
<!-- satisfied Wrapper End -->
<!-- Call to Action start -->
<div class="call-to-action">
  <div class="container">
    <!-- <h3><strong>B.H.S.</strong></h3>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. printing and typesetting industry.</p>
    <a href="javascript:void(0)">Sign Up</a> --> </div>
</div>
<!-- Call to Action End -->
<!-- Faculty Wrapper Start -->
<div class="team-wrapper">
  <div class="container">
    <div class="row">
      <h2>Meet The <span>Teachers</span></h2>
      <div id="owl-demo" class="owl-carousel owl-theme">
        <div class="item">
          <div class="img-box"> <img src="images/team-img1.jpg" alt="Team1" title="Team1" />
            <div class="text-center">
              <h4>Sarah Norris</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="img-box"> <img src="images/team-img2.jpg" alt="Team2" title="Team2" />
            <div class="text-center">
              <h4>Doris Wilson</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="img-box"> <img src="images/team-img3.jpg" alt="Team3" title="Team3" />
            <div class="text-center">
              <h4>Anne Kemper</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="img-box"> <img src="images/team-img4.jpg" alt="Team4" title="Team4" />
            <div class="text-center">
              <h4>Ruth Carman</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="img-box"> <img src="images/team-img1.jpg" alt="Team1" title="Team1" />
            <div class="text-center">
              <h4>Sarah Norris</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="img-box"> <img src="images/team-img2.jpg" alt="Team2" title="Team2" />
            <div class="text-center">
              <h4>Doris Wilson</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="img-box"> <img src="images/team-img3.jpg" alt="Team3" title="Team3" />
            <div class="text-center">
              <h4>Anne Kemper</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="img-box"> <img src="images/team-img4.jpg" alt="Team4" title="Team4" />
            <div class="text-center">
              <h4>Ruth Carman</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Faculty Wrapper End -->
<!-- Principal Wrapper Start -->
<div class="testimonials-wrapper">
  <div class="container">
    <h2>Principal</h2>
    <div id="testimonials" class="owl-carousel owl-theme" style="padding-left:33%;">
      <div class="item"> <a href="javascript:void(0)" data-toggle="modal" data-target="#5">
              <img src="Bhevu Pics/Edited/Principal/principal1.jpg" alt="Mrs. Ntshangase(Principal)"> </a>
        <p>I am very proud to tell you about Bhevu High School Ladysmith, KZN, South Africa. Bhevu is proof that hard work and perseverance can overcome all odds. Under the guidance of the principal, Gugu Ntshangase, the school has grown from literally learners sitting on the rocks with lap desks, to what it is now. She and her team of dedicated teachers provide a stable environment where teaching and learning continues even under very severe conditions. Her learners are dedicated, well-behaved young people who appreciate what their teachers do for them.</p>
        <a href="about-us.html"><h3>- G. F. <span>Ntshangase</span></h3></a>
      </div>
      <!-- If i want to put onother person -->
      <!-- <div class="item"> <img src="Bhevu Pics/Edited/Principal/principal1.jpg" alt="G. F. Ntshangase(Principal)">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        <h3>- Mary Williams <span>Service manager</span></h3>
      </div> -->
    </div>
  </div>
</div>
<!-- Principal Wrapper End -->
<!-- sponsers Start -->
<div class="sponsers">
  <div class="container">
    <h2>Our <span>Sponsers</span></h2>
    <div id="sponsers" class="owl-carousel owl-theme">
      <div class="item"> <img src="images/edu-logo1.jpg" alt="Education Logos"></div>
      <div class="item"> <img src="images/edu-logo2.jpg" alt="Education Logos"></div>
      <div class="item"> <img src="images/edu-logo3.jpg" alt="Education Logos"></div>
      <div class="item"> <img src="images/edu-logo4.jpg" alt="Education Logos"></div>
      <div class="item"> <img src="images/edu-logo5.jpg" alt="Education Logos"></div>
      <div class="item"> <img src="images/edu-logo6.jpg" alt="Education Logos"></div>
      <div class="item"> <img src="images/edu-logo1.jpg" alt="Education Logos"></div>
      <div class="item"> <img src="images/edu-logo2.jpg" alt="Education Logos"></div>
      <div class="item"> <img src="images/edu-logo3.jpg" alt="Education Logos"></div>
    </div>
  </div>
</div>
<!-- sponsers End -->
<!-- Gallery Start -->
<div class="gal-container full-width">
          <div class="col-md-3 col-sm-6 co-xs-12 gal-item">
            <div class="box"> <a href="javascript:void(0)" data-toggle="modal" data-target="#1">
              <div class="caption">
                <h4>Netball Team</h4>
                <p><strong>.........</strong></p>
                <i class="fa fa-search" aria-hidden="true"></i> </div>
              <img src="Bhevu Pics/Edited/Gallery/netball.jpg" alt="Netbal Team"> </a>
              <div class="modal fade" id="1" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <div class="modal-body"> <img src="Bhevu Pics/Edited/Gallery/netball full.jpg" alt="Gallery Image"> </div>
                    <div class="col-md-12 description">
                      <h4>Netball Team</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 co-xs-12 gal-item">
            <div class="box"> <a href="javascript:void(0)" data-toggle="modal" data-target="#2">
              <div class="caption">
                <h4>Gallery Image2</h4>
                <p>Lorem Ipsum is simply dummy text of the printing</p>
                <i class="fa fa-search" aria-hidden="true"></i> </div>
              <img src="images/gallery-img2.jpg" alt="Gallery Image"> </a>
              <div class="modal fade" id="2" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <div class="modal-body"> <img src="images/gallery-img2.jpg" alt="Gallery Image"> </div>
                    <div class="col-md-12 description">
                      <h4>This is the second one on my Gallery</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 co-xs-12 gal-item">
            <div class="box"> <a href="javascript:void(0)" data-toggle="modal" data-target="#3">
              <div class="caption">
                <h4>Gallery Image3</h4>
                <p>Lorem Ipsum is simply dummy text of the printing</p>
                <i class="fa fa-search" aria-hidden="true"></i> </div>
              <img src="images/gallery-img3.jpg" alt="Gallery Image"> </a>
              <div class="modal fade" id="3" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <div class="modal-body"> <img src="images/gallery-img3.jpg" alt="Gallery Image"> </div>
                    <div class="col-md-12 description">
                      <h4>This is the third one on my Gallery</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 co-xs-12 gal-item">
            <div class="box"> <a href="javascript:void(0)" data-toggle="modal" data-target="#4">
              <div class="caption">
                <h4>Gallery Image4</h4>
                <p>Lorem Ipsum is simply dummy text of the printing</p>
                <i class="fa fa-search" aria-hidden="true"></i> </div>
              <img src="images/gallery-img4.jpg" alt="Gallery Image"> </a>
              <div class="modal fade" id="4" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <div class="modal-body"> <img src="images/gallery-img4.jpg" alt="Gallery Image"> </div>
                    <div class="col-md-12 description">
                      <h4>This is the fourth one on my Gallery</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 co-xs-12 gal-item">
            <div class="box"> 
              <div class="modal fade" id="5" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <div class="modal-body"> <img src="Bhevu Pics/Edited/Principal/principal2.jpg" alt="Mrs. Ntshangase(Principal)"> </div>
                    <div class="col-md-12 description">
                      <h4>Mrs. G. F. Ntshangase (Principal)</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>          
        </div>
<!-- Gallery End -->
<!-- Footer Links Start-->
<footer>
  <div class="container">
    <div class="col-sm-3"><img src="Bhevu Pics/Edited/Logo/logo2.png" alt="World Education"> </div>
    <div class="col-sm-5">
      <div class="contactus">
        <h2>Contact Us</h2>
        <ul class="list-ul">
          <li><i class="fa fa-map-marker"></i>Department of State, 300 E-Block Building, USA</li>
          <li><i class="fa fa-phone"></i>0800 123 46 0000</li>
          <li><i class="fa fa-envelope"></i><a href="mailto:support@yourdomain.com">support@yourdomain.com</a></li>
        </ul>
      </div>
    </div>
    <div class="col-sm-4 subscirbe pull-right">
      <h2>Newsletter</h2>
      <p class="sub"><span>Subscribe</span> to Our Newsletter to get Important Blog Posts &amp; Inside Scoops:</p>
      <div class="form">
        <input type="text" placeholder="Enter your Email" id="exampleInputName" class="form-control first">
        <input type="text" class="bttn" value="Subscribe">
      </div>
    </div>
  </div>
</footer>
<!-- Footer Links End -->
<!-- Copy Rights Start -->
<div class="footer-wrapper">
  <div class="container">
    <p>&copy; Copyright 
	<script type="text/javascript">
	var d=new Date();
	document.write(d.getFullYear());
	</script> 
      Bhevu High School | All Rights Reserved.</p>
  </div>
  <a id="scrool-top" href="javascript:void(0)"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a> 
</div>
<!-- Copy Rights End --> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="assets/jquery/jquery-3.1.1.min.js"></script> 
<script src="assets/jquery/jquery.animateNumber.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="assets/easing/jquery.easing.min.js"></script> 
<script src="assets/bootstrap/js/bootstrap.min.js"></script> 
<script src="assets/wow/wow.min.js"></script> 
<script src="assets/owl-carousel/js/owl.carousel.js"></script> 
<script src="js/custom.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-83282272-2', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>