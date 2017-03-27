<?php require 'Files/connections/connection.php'; ?>
<?php error_reporting(0);
  session_start();
	  $user = $_SESSION["userId"];
	  $sql = $db->query("select * from orion where UserName='$user'");
	  $result = $sql->fetch_array(MYSQLI_BOTH);
	  $_SESSION["user"] = $result['UserName'];
	  $_SESSION["sponsor"]= $result['Number'];
	  $sponsor = $_SESSION["sponsor"];
    
	  $ref= $db->query("select * from orion where SponsorNumber='$sponsor'");
	  $num= mysqli_num_rows($ref);
	  $_SESSION["recruits"]=$num;
  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="Files/css/dashboard.css"/>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale: 1.0,user-scalable=0"/>
<title>Support</title>
</head>
<?php
   if(isset($_POST['send'])){
	   $emailbody=$_POST['message'];
	   mail('amenderpolela@gmail.com','Customer Support',$emailbody);
   }
 ?>
<body>
  <div class="head">
     <div class="logo"><span><strong>O</strong>rion &#x265b;</span> 
     </div>
     <div class="user">
       <i class="fa fa-user" aria-hidden="true"></i> <p>Logged in as <?php echo $_SESSION["user"]; ?></p>
     </div>
  </div>
  <div class="Container">
    <div class="sidemenu">
      <nav>
          <ul>
             <li class="list"><a href="AccountHome.php" style="color:#CDEB28;"><i class="fa fa-home" aria-hidden="true"></i> Account Home</a></li>
             <li class="selected" ><a href="BankingDetails.php" style="color:#e5e4e2;"><i class="fa fa-university" aria-hidden="true" ></i> Bank Details</a></li>
             <li class="list" ><a href="Update.php" style="color:#171717;"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a></li>
            <li class="list"><a href="Transactions.php" style="color:#49cd0b;"><i class="fa fa-money" aria-hidden="true"></i> Transactions</a></li>
             <li class="selected"><a href="Recruits.php" style="color:#DE1FCE;"><i class="fa fa-users" aria-hidden="true"></i> Recruits</a></li>
             <li class="list"><a href="#" style="color:#C77218"><i class="fa fa-life-ring" aria-hidden="true"></i> Support</a></li>
             <li class="list" ><a href="Logout.php" style="color:#8C8A85;">
             <i class="fa fa-user-times" aria-hidden="true"></i>Log out</a></li>
          </ul>
      </nav>
    </div>
    <div class="content" align="center">
      <form method="post">
       <div class="box" align="center">
                   <label for="message" style="font-size:1.3em;">Enter Message.</label><br>
                   <textarea rows="6" cols="32" style="font-size:1.3em;margin-bottom:5px;" name="message" />
                   </textarea>
                   <input type="submit" style="width:auto;margin-right:62%;" class="button" name="send" value="Send Message">
                   </div>
                      <div>
                   <label for="upload" style="margin-top:10px;color:#000;font-size:1.3em">Upload proof of payment.</label><br>
                   <input type="file" style="font-size:1em;border:1px solid #535353;" name="upload"/>
                  </div>
       </form>
     
   
   </div>

</div>
</body>
</html>