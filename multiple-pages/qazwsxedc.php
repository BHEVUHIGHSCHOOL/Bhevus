<?php require ('connection/conect.php');?>
<?php
session_start();
if(isset($_SESSION['userid']))
{
}
else
{
	header('Location: index.php');
}
	$status = "waiting";
	$query = $con -> query ("SELECT * FROM learner where Status = '$status'");
	$result = $query -> fetch_array(MYSQLI_BOTH);
	//SDFGHJKL
	
	$_SESSION["initials"] = $result['Initials'];
	$_SESSION["name"] = $result['Firstname'];
	$_SESSION["lname"] = $result['LastName'];
	$_SESSION["sname"] = $result['Surname'];
	$_SESSION["dob"] = $result['DOB'];
	$_SESSION["gender"] = $result['Gender'];
	$_SESSION["ID_number"] = $result['IDNumber'];
	//$_SESSION["Present_school"] = $$result['PresentSchool'];
	$_SESSION["Learners_address"] = $result['LearnersAddress'];
	$_SESSION["Home_Language"] = $result['HomeLanguage'];
	$_SESSION["Relative"] = $result['Relative'];
	$_SESSION["citizenship"] = $result['Citizenship'];
	$_SESSION["Mobile_number"] = $result['Mobilenumber'];
	$_SESSION["elder"] = $result['Elder'];
	$_SESSION["elderid"] = $result['ElderID'];
	$_SESSION["cell"] = $result['Mobilenumber'];
	$_SESSION["password"] = $result['Password'];
	$_SESSION["username"] = $result['Username'];
	
	
	if(isset($_POST['aprove']))
	{
		$updatestatus = "Aproved";
		$applicantid = $_SESSION["ID_number"];
		$sql = $con -> query("UPDATE learner SET Status = '{$updatestatus}' where $applicantid = IDNumber");
	}
	if(isset($_POST['reject']))
	{
		$updatestatusr = "Rejected";
		$applicantid = $_SESSION["ID_number"];
		$sql = $con -> query("DELETE FROM learner WHERE IDNumber = '$applicantid'");

		$sname =  $_SESSION["sname"];
		$name = $_SESSION["name"];
		$lname = $_SESSION["lname"];
		$id = $_SESSION["ID_number"];
		$cell = $_SESSION["cell"];
		$leaners_addr = $_SESSION["Learners_address"];
		$home_lang = $_SESSION["Home_Language"];
		$password = $_SESSION["password"];
		$username = $_SESSION["username"];
		$gender = $_SESSION["gender"];
		$citizesh = $_SESSION["citizenship"];
		$dob =  $_SESSION["dob"];
		$initials = $_SESSION["initials"];
		$elder = $_SESSION["elder"];
		$relative = $_SESSION["Relative"];
		$elder_id = $result['ElderID'];
		$status = $updatestatusr;
		if(isset($_SESSION["initials"]))
		{
			$sql2 = $con -> query("INSERT INTO rejected (Surname, Firstname, LastName, IDNumber, Mobilenumber, LearnersAddress, HomeLanguage, Password, Username, Gender, Citizenship, DOB, Initials, Elder, Relative, ElderID, Status) VALUES ('{$sname}','{$name}','{$lname}','{$id}','{$cell}','{$leaners_addr}','{$home_lang}','{$password}', '{$username}', '{$gender}', '{$citizesh}', '{$dob}', '{$initials}', '{$elder}', '{$relative}', '{$elder_id}', '{$status}')");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Education World</title>
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
<!-- Pre Loader -->
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
          <li class="login"><a href="javascript:void(0)"><i class="fa fa-lock"></i>Logout</a>
            <div class="login-form">
              <h4>Logout</h4>
              <form action="Logout.php" method="post">
                <button type="submit" class="btn">Logout</button>
              </form>
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
        <div class="col-sm-4"><a href="index.php"> <img src="images/logo.png" alt="Education World"></a> </div>
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
            <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Education World"/></a> </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
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
                          <li><span>Eliments</span></li>
                          <li><a href="grid.html"><span class="fa fa-angle-right menu-icon"></span>Grid</a></li>
                          <li><a href="table.html"><span class="fa fa-angle-right menu-icon"></span>Tables</a></li>
                          <li><a href="tabs.html"><span class="fa fa-angle-right menu-icon"></span>Tabs</a></li>
                          <li><a href="accordions.html"><span class="fa fa-angle-right menu-icon"></span>Accordions</a></li>
                          <li><a href="forms.html"><span class="fa fa-angle-right menu-icon"></span>Forms</a></li>
                          <li><a href="buttons.html"><span class="fa fa-angle-right menu-icon"></span>Buttons</a></li>
                          <li><a href="lists.html"><span class="fa fa-angle-right menu-icon"></span>Lists</a></li>
                          <li><a href="typography.html"><span class="fa fa-angle-right menu-icon"></span>Typography</a></li>
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
<!-- Inner Banner Wrapper Start -->
<div class="inner-banner">
  <div class="container">
    <div class="col-sm-12">
      <h2>Contact Us</h2>
    </div>
    <div class="col-sm-12 inner-breadcrumb">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li>Contact Us</li>
      </ul>
    </div>
  </div>
</div>
<!-- Inner Banner Wrapper End -->
<section class="inner-wrapper contact-wrapper">
  <div class="container">
    <div class="row">
      <div class="inner-wrapper-main">
        <div class="contact-address">
          <div class="col-sm-12 col-md-12 no-space-left">
            <div class="form">
              <form action="" method="post" id="contactFrm" name="contactFrm">
                 <table style="color:#fff; width:100%; border-radius:5px; background-color:#458CBF;">
                	<tr>
                    	<th colspan="12" style="text-align:center;"><h4><em>Learner's Information</em></h4></th>
                    </tr>
                    <tr style="background-color:#363FA3; text-align:center;">
                    	<th style="text-align:center;">Initials</th>
                        <th style="text-align:center;">First name</th>
                        <th style="text-align:center;">Second name</th>
                        <th style="text-align:center;">Surname</th>
                        <th style="text-align:center;">Date of Birth</th>
                        <th style="text-align:center;">Gander</th>
                        <th style="text-align:center;">ID Number</th>
                    </tr>
                    <tr>
                    	<td><?php echo $_SESSION["initials"]?></td>
                        <td><?php echo $_SESSION["name"]?></td>
                        <td><?php echo $_SESSION["lname"]?></td>
                        <td><?php echo $_SESSION["sname"]?></td>
                        <td><?php echo $_SESSION["dob"]?></td>
                        <td><?php echo $_SESSION["gender"]?></td>
                        <td><?php echo $_SESSION["ID_number"]?></td>
                    </tr>
                    <tr style="background-color:#363FA3; text-align:center;">
                    	<th style="text-align:center;">Elder</th>
                        <th style="text-align:center;">Address</th>
                        <th style="text-align:center;">Home Language</th>
                        <th style="text-align:center;">Relative</th>
                        <th style="text-align:center;">Present school</th>
                        <th style="text-align:center;">Citizenship</th>
                        <th style="text-align:center;">Documents</th>
                    </tr>
                    <tr>
                    	<td><?php echo $_SESSION["elder"]?></td>                        
                        <td><?php echo $_SESSION["Learners_address"]?></td>
                        <td><?php echo $_SESSION["Home_Language"]?></td>
                        <td><?php echo $_SESSION["Relative"]?></td>
                        <td><?php //echo $_SESSION["Present_school"]?></td>
                        <td><?php echo $_SESSION["citizenship"]?></td>
                        <td><a href="docs.php">Click here</a></td>
                    </tr>
                </table>
                <input type="submit" value="Aprove" name="aprove" class="txt2">
                <input type="submit" value="Reject" name="reject" class="txt2">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="google-map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d198710.35112897935!2d-98.51489117772236!3d38.904562823631146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited+States!5e0!3m2!1sen!2sin!4v1471865832140" allowfullscreen></iframe>
        </div>
</section>
<!-- Call to Action start -->
<div class="call-to-action">
  <div class="container">
    <h3>Lorem Ipsum is simply dummy text</h3>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. printing and typesetting industry.</p>
    <a href="javascript:void(0)">Sign Up</a> </div>
</div>
<!-- Call to Action End -->
<!-- Footer Links Start-->
<footer>
  <div class="container">
    <div class="col-sm-3"><img src="images/footer-logo.jpg" alt="World Education"> </div>
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
      Education World | All Rights Reserved.</p>
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

<!-- Mirrored from sbtechnosoft.com/education-world/multiple-pages/contact-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Feb 2017 11:36:17 GMT -->
</html>