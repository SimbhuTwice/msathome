 <?php include 'config.php';
 if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
&& ($_GET["action"]=="reset") && !isset($_POST["action"])){
	//echo "dnfjd";
  $key = $_GET["key"];
  $email = $_GET["email"];
  $curDate = date("Y-m-d H:i:s");
  $error ="";
  $query = mysqli_query($conn,
  "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';"
  );
 // echo "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';";exit;
  $row = mysqli_num_rows($query);
  //echo $row;exit;
  if ($row=="0"){
  $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is 
deactivated.</p>
<p><a href="http://msathome.vkmsoftware.com/forgotPwd.php">
Click here</a> to reset password.</p>';
	?>
<script>alert($error);</script>
	<?php } else{
  $row = mysqli_fetch_assoc($query);
  $expDate = $row['expDate'];
  if ($expDate >= $curDate){
  ?>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
   Medical Services at Home - Reset Password
  </title>
  
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.min.css?v=2.2.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  
</head>

<body class="off-canvas-sidebar">
 
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="javascript:;">Reset Password</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper wrapper-full-page">
    <div class="page-header register-page header-filter" filter-color="black" style="background-image: url('assets/img/doctor.jpg')">
      <div class="container">
        <div class="row">
          <div class="col-md-10 ml-auto mr-auto">
            <div class="card card-signup">
              <h2 class="card-title text-center">Reset Password</h2>
              <div class="card-body">
			  <form method="post" action="" name="update">
                <div class="row">
				<div class="col-md-2 mr-auto"></div>
                  <div class="col-md-5 ml-auto">
                   
					  <div class="form-group has-default">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons"></i>
                            </span>
                          </div>
						  <input type="hidden" name="action" value="update" />
                          <input type="password" id="pass1" name="pass1" class="form-control" placeholder="Password..." required="true">
                        </div>
                      </div>
					  <div class="form-group has-default">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons"></i>
                            </span>
                          </div>
                          <input type="password" id="pass2" name="pass2" class="form-control" placeholder="Confirm Password..." required="true" equalTo="#pass1">
                        </div>
                      </div>
					   <div class="form-group has-default">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons"></i>
                            </span>
                          </div>
						  <input type="hidden" name="email" value="<?php echo $email;?>"/>
                          <button type="submit" class="btn btn-rose">Change Now</button>
                        </div>
                      </div>
					  
                  </div>
                  <div class="col-md-3 mr-auto">
                   
                    
                     
                    
                  </div>
                </div>
				</form>
              </div>
            </div>
          </div>
        </div>
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
  
  <?php
}else{
$error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which 
as valid only 24 hours (1 days after request).<br /><br /></p>";
            }
      }
if($error!=""){
  echo "<div class='error'>".$error."</div><br />";
  }			
} // isset email key validate end


if(isset($_POST["email"]) && isset($_POST["action"]) &&
 ($_POST["action"]=="update")){
	// echo "bdfdk";exit;
$error="";

$pass1 = mysqli_real_escape_string($conn,$_POST["pass1"]);

$pass2 = mysqli_real_escape_string($conn,$_POST["pass2"]);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
//echo $pass1;exit;
if ($pass1!=$pass2){
$error.= "<p>Password do not match, both password should be same.<br /><br /></p>";
  }
 // echo $error;exit;
  if($error!=""){
echo "<div class='error'>".$error."</div><br />";
}else{
//$pass1 = md5($pass1);
//echo "UPDATE `user_register` SET `Password`='".$pass1."' WHERE `Email_Id`='".$email."'";exit;
mysqli_query($conn,
"UPDATE `user_register` SET `Password`='".$pass1."' WHERE `Email_Id`='".$email."'"
);

mysqli_query($conn,"DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");
	
echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>
<p><a href="http://msathome.vkmsoftware.com/">
Click here</a> to Login.</p></div><br />';
	  }		
}
?>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=2.2.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  
  
  <script>
    $(document).ready(function() {
      md.checkFullPageBackgroundImage();
    });
  </script>
</body>

</html>