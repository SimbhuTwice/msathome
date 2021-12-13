<?php include 'config.php'; 

if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
$error="";
if (!$email) { 
$error .="<p>Invalid email address please type a valid email address!</p>";
?>
<script>alert("Invalid email address please type a valid email address!");</script>
   
  <?php }else{
   $sel_query = "SELECT * FROM `user_register` WHERE Email_Id='".$email."'";
   $result = mysqli_query($conn,$sel_query);
   //$row = mysqli_num_rows($results);
   
  if (mysqli_num_rows($result) == 0){ 
$error .="<p>No user is registered with this email address!</p>";  ?>
 
  <script>alert("No user is registered with this email address!");</script>
   
 
 <?php  }
  }
   if($error!=""){  ?>
   
   <?php }else{
	 
   $expFormat = mktime(
   date("H"), date("i"), date("s"), date("m") ,date("d")+2, date("Y")
   );
   $expDate = date("Y-m-d H:i:s",$expFormat);
  // $key = md5(2418*2+$email);
  $key = md5(2418*2);
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $key = $key . $addKey;
// Insert Temp Table
mysqli_query($conn,
"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");

$output='<p>Dear user,</p>';
$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="http://msathome.vkmsoftware.com/ResetPassword.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">
http://msathome.vkmsoftware.com/ResetPassword.php?key='.$key.'&email='.$email.'&action=reset</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';   	
$output.='<p>Thanks,</p>';

$body = $output; 
$subject = "Password Recovery";

$email_to = $email;
$fromserver = "deepavrsh@gmail.com"; 
$from="deepavrsh@gmail.com"; 
$from_name="Deepa";
require("PHPMailer/PHPMailerAutoload.php");
 $mail = new PHPMailer();  // create a new object
 
   $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
   $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->SMTPAutoTLS = false;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
	$mail->isHTML(true);	
    $mail->Username = "deepavrsh@gmail.com"; 
    $mail->Password = "Deepa@16";  
//$mail->isSMTP();
//$mail->Host = 'localhost';
//$mail->SMTPAuth = false;
//$mail->SMTPAutoTLS = false; 
//$mail->Port = 25;    
    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($email_to);
	
    if(!$mail->Send()) {
		//echo 'Mail error: '.$mail->ErrorInfo;exit;
        $error = 'Mail error: '.$mail->ErrorInfo; 
        return false;
    } else {  ?>
	<script>alert("Message sent!");</script>
        
   <?php     //return true;
   header("location:index.php");
    }

//exit;



   }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
   Medical Services at Home - Forgot Password
  </title>
  
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.min.css?v=2.2.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
  </script>
  <!-- End Google Tag Manager -->
</head>

<body class="off-canvas-sidebar">

  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="javascript:;">Forgot Password</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
         <!-- <li class="nav-item ">
            <a href="ChangePwd.php" class="nav-link">
              <i class="material-icons">email</i>
              Admin Pages
            </a>
          </li> 
          <li class="nav-item ">
            <a href="register.php" class="nav-link">
              <i class="material-icons">person_add</i>
              Register
            </a>-->
          </li>
          <li class="nav-item  active ">
            <a href="index.php" class="nav-link">
              <i class="material-icons">fingerprint</i>
              Login
            </a>
          </li>
          <li class="nav-item ">
            <a href="forgotPwd.php" class="nav-link">
              <i class="material-icons">lock_open</i>
              Forgot Password
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
<div class="wrapper wrapper-full-page">
    <div class="page-header  header-filter" style="background-image: url('assets/img/doctor.jpg')">
      <!--   you can change the color of the filter page using: data-color="blue | green | orange | red | purple" -->
     
	  
	  <div class="container">
	<div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="card card-profile text-center ">
              <div class="card-header ">
			  <h4 class="card-title">Forgot your password?</h4>
               
              </div>
              <div class="card-body">
			    <p class="card-category">
                         Change your password in three easy steps. This will help you to secure your password!
                        </p>
                      
<br>
1. Enter your email address below.<br>
2. Our system will send you a temporary link<br>
3. Use the link to reset your password
                       
                      </div>
              
            </div>
          </div>
        </div>
	  <form class="form" action="" method="post">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="card card-profile text-center ">
              
              <div class="card-body ">
                
                <div class="form-group">
                  <label for="exampleInput1" class="bmd-label-floating">Enter Email</label>
                  <input type="text" name="email" id="email" class="form-control" id="exampleInput1">
                </div>
              </div>
              <div class="card-footer justify-content-center">
			  <input type="submit" class="btn btn-rose btn-link btn-lg" value="Send My Password" />
                
              </div>
            </div>
          </div>
        </div>
		</form>
      </div>
      <footer class="footer">
        <div class="container">
         
          <div class="copyright float-right">
            Copyright ©
            <script>
              document.write(new Date().getFullYear())
            </script>  
            <a href="http://www.icand.in/" target="_blank">icanD.</a> All rights reserved.
          </div>
        </div>
      </footer>
    </div>
  </div>
    

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=2.2.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  
  <!-- Sharrre libray -->
  <script src="assets/demo/jquery.sharrre.js"></script>
  
  
 
 
</body>

</html>