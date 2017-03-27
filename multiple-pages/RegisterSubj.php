<?php require ('connection/conect.php');
	$sql = "SELECT * FROM images";
	$res = $con -> query($sql);
?>
<?php
session_start();
if(isset($_POST['next']))
{
   			$id = $_POST["ID_number"];
            $name = $_POST["First_name"];
            $lname = $_POST["Last_name"];
            $sname = $_POST["Surname"];

            //initials
            $iname = substr($name,0,1);
			$inameUp = strtoupper($iname);
            $ilname = substr($lname,0,1);
			$ilnameUp = strtoupper($ilname);
            $isname1 = substr($sname,0,1);
			$isname1Up = strtoupper($isname1);
            $isname2 = substr($sname,1);
			$isname2Low = strtolower($isname2);
			
            $initials = "Initials :" . " " . $inameUp. "." . " " . $ilnameUp . "." . " " . $isname1Up . $isname2Low . "<br/>";
            //fullnames
            $fname2 = substr($name,1);
			$fname2Low = strtolower($fname2);
            $flname2 = substr($lname,1);
			$flname2Low = strtolower($flname2);

            $fullnames = "First Name :" . " " . $inameUp . $fname2Low . "<br/>" . "Second Name :" . " " . $ilnameUp . $flname2Low . "<br/>" . "Surname :" . " " . $isname1Up . $isname2Low . "<br/>";

            $length = strlen($id);
            $months = substr($id,2,2);
			$password = $inameUp.$ilnameUp.$months;
			$username = $months.$isname1Up.$isname2Low;
            if ($length == 13 && $months > 0 && $months < 13)
            {
                //Date of birth
                //get day
                $day = substr($id,4,2);
                if ($day <= 10)
                {
                    $getday = "0" . $day . " ";
                }
                else
				{
                    $getday = $day . " ";
				}
                //get month
                //array
                $month = array( "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                $montha = array( 01, 02, 03, 04, 05, 06, 07, 08, 09, 10, 11, 12);
                for ($i = 0; $i <12; $i++)
                {
                    if($months == $montha[$i])
                    {
                        $getmongth = $month[$i] . " ";
                    }
                }

                //get year
                $year = substr($id,0,2);
                if ($year > 17 && $year <= 99)
                {
                    $getyear = "19" . $year;
                }
                else if ($year < 18)
                {
                    if ($year < 10)
                    {
                        $getyear = "200" . $year;
                    }
                    else
                    {
                        $getyear = "20" . $year;
                    }
                }

                //Age
                //90's
                if ($year > 17 && $year <= 99)
                {
                    $age = 2017 - (1900 + $year);
                    if ($age <= 25)
                    {
                        $getage = "Age :" . " " . $age . "<br>";
                    }
                    else
                    {
                        $getage = "Your age does not allow you to create account as a learner." . "<br/>" . "Age : " . $age . "<br>";
                    }
                }
                //2000's
                else if ($year < 18)
                {
                    $age = 2017 - (2000 + $year);
                    if($age>13)
                    {
                        $getage = "Age :" . " " . $age . "<br>";
                    }
                    else
                    {
                        $getage = "Your age does not allow you to create account as a learner." . "<br/>" . "Age :" . " " . $age . "<br>";
                    }
                }

                //get gender
                $output = substr($id,6,1);
                if ($output >= 5)
                {
                    $gender = "Male";
                }
                else
                {
                    $gender = "Female";
                }

                //Citizenship
                $citizen = substr($id,10,1);
                if($citizen == 0)
                {
                    $citizenship = "SA Citizen";
                }
                else
                {
                    $citizenship = "Non SA Citizen";
                }
            }
            else
            {
                $validity = "Invalid ID number!!!!";
            }
			//processing
			if(isset($getday))
			{
				$exist = $con -> query ("SELECT * FROM learner where IDNumber = '$id'");
				$result = $exist -> fetch_array(MYSQLI_BOTH);
				if($result<1)
				{
					//to the database
					$_SESSION["initials"] = $inameUp.$ilnameUp;
					$_SESSION["name"] = $name;
					$_SESSION["lname"] = $lname;
					$_SESSION["sname"] = $sname;
					$_SESSION["dob"] = $getday."/".$getmongth."/".$getyear;
					$_SESSION["gender"] = $gender;
					$_SESSION["ID_number"] = $_POST["ID_number"];
					$_SESSION["Present_school"] = $_POST["Present_school"];
					$_SESSION["Learners_address"] = $_POST["Learners_address"];
					$_SESSION["Home_Language"] = $_POST["Home_Language"];
					$_SESSION["Relative"] = $_POST["rel_First_name"]."-".$_POST["rel_Surname"]."-".$_POST["rel_Grade"]."-".$_POST["rel_Section"];
					$_SESSION["citizenship"] = $citizenship;
					$_SESSION["username"] = $username;
					$_SESSION["password"] = $password;
					$_SESSION["Mobile_number"] = $_POST["Mobile_number"];
					if(isset($_POST["parent"]))
					{
						$_SESSION["elder"] = "Parent";
					}
					else if(isset($_POST["gardien"]))
					{
						$_SESSION["elder"] = "Gardien";
					}
					//Inserting documents
					$doc_name = "ID/Certeficate".$id;
					$myfile = $_FILES['myfile']['name'];
					$tmp_name = $_FILES['myfile']['tmp_name'];
					if($myfile&&$doc_name)
					{
						$location = $myfile;
						move_uploaded_file($tmp_name,"document/".$myfile);
						$query = $con -> query("INSERT INTO images(imagename, imagepath,image,username) VALUES ('{$doc_name}', '{$location}', '{$tmp_name}','{$username}')");
						$_SESSION["doc_name"] = $doc_name;
					}					
					
					header('Location: Parent-details.php');
				 }
				 else
				 {
					 $error = "Your alreadey exist in the system";
				 }
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
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="assets/animate/animate.css" rel="stylesheet">
<link href="assets/owl-carousel/css/owl.carousel.css" rel="stylesheet">
<link href="assets/owl-carousel/css/owl.theme.css" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="images/fav.png">
</head>
<body>
<div id="dvLoading"></div>
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
              <form action="#" method="post">
                <input type="text" name="name" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" class="btn">Login</button>
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
              <li><a href="contact-us.html">Register</a></li>
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
      <h2>Register</h2>
    </div>
    <div class="col-sm-12 inner-breadcrumb">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li>Register</li>
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
        <div class="container">
        <div class="col-sm-12">
          <h2>Register of subjects</h2>
        </div>
        </div>
          <div class="col-sm-12 col-md-12 no-space-right">
          <div class="col-sm-12 col-md-9 no-space-left" style="text-align:center; padding-left:25%;">
            <div class="form"  style="text-align:center; border-radius:10px;">
              <form action="" method="post" id="contactFrm" name="contactFrm" enctype="multipart/form-data">
                <input type="text" required placeholder="Surname" value="" name="Surname" class="txt">
                <input type="text" required placeholder="First name" value="" name="First_name" class="txt">
                <input type="text" required placeholder="Last name" value="" name="Last_name" class="txt">
                <input type="text" required placeholder="ID Number" value="" name="ID_number" class="txt">
                <input type="email" required placeholder="Email" value="" name="email" class="txt">
                <p>
                <?php
                	if(isset($validity))
					{
						echo "<p style='color:red'>".$validity."</p>"."You can not proceed.";
					}
					if(isset($error))
					{
						echo "<p style='color:red'>".$error."</p>"."You can not proceed.";
					}
				?>
                </p>
                <input type="text" required placeholder="Mobile Number" value="" name="Mobile_number" class="txt">
                <table>
                	<tr>
                    	<th style="text-align:center; color:#fff;"><em>Upload files</em></th>
                        <tr>
                        	<td style="color:#fff;"><input type="file" required placeholder="Insert image" value="" name="myfile" class="txt"></td>
                        </tr>
                    </tr>
                </table>
                <input type="text" required placeholder="Present School" value="" name="Present_school" class="txt">
                <textarea placeholder="Learners Address" name="Learners_address" type="text" class="txt_3"></textarea>
                <input type="text" required placeholder="Home Language" value="" name="Home_Language" class="txt">
                <table style="color:#fff;">
                	<tr><th colspan="4" style="text-align:center;"><em>Brother(s)/Sister(s) @ Bhevu H.</em></th></tr>
                	<tr>
                    	<th>Name</th>
                        <th>Surname</th>
                        <th>Grade</th>
                        <th>Section</th>
                    </tr>
                    <tr style="color:red;">
                    	<td><input type="text" required placeholder="First name" value="" name="rel_First_name" class="txt"></td>
                        <td><input type="text" required placeholder="Surname" value="" name="rel_Surname" class="txt"></td>
                        <td><input type="text" required placeholder="Grade" value="" name="rel_Grade" class="txt"></td>
                        <td><input type="text" required placeholder="Section" value="" name="rel_Section" class="txt"></td>
                    </tr>
                </table>
                <table style="width:100%;">
                	<tr>
                    	<th colspan="2" style=" text-align:center; color:#fff;">Position</th>
                    </tr>
                    <tr>
                    	<td><input type="radio" name="Teacher" <?php if (isset($elder) && $elder=="Teacher") {$elder="Teacher";}?> value="Teacher">Teacher</td>
                        <td><input type="radio" name="Principal" <?php if (isset($elder) && $elder=="Principal") {$elder="Principal";}?> value="Principal">Principal</td>
                        <td><input type="radio" name="HOD" <?php if (isset($elder) && $elder=="HOD") {$elder="HOD";}?> value="HOD">HOD</td>
                    </tr>
                </table>
                <input type="submit" value="Next..." name="next" class="txt2">
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