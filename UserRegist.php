<?php include 'header.php';?>
<body class="">
  <?php include 'config.php'; 
//echo $_POST['email'];exit;
if(!empty($_POST)){
		$email     = $_POST['email'];
	$ContactNo = $_POST['ContactNo'];
	$InstitutionName     = $_POST['InstitutionName'];
	$FirstName = $_POST['FirstName'];
	$LastName     = $_POST['LastName'];
	$Address = $_POST['Address'];
	$City     = $_POST['City'];
	$Country = $_POST['Country'];
	$PinCode     = $_POST['PinCode'];
	$Password=randomPassword();
	//echo $Password;exit;
	//$ContactNo = $_POST['ContactNo'];
	$query=mysqli_query($conn,"insert into user_register(Email_Id,Contact_Number,InstitueName,FirstName,LastName,IsActive,City,Pincode,Address,Country,Password) values ('".$email."','".$ContactNo."','".$InstitutionName."','".$FirstName."','".$LastName."','Y','".$City."','".$PinCode."','".$Address."','".$Country."','".$Password."')");
	
	$output='<p>Hi '.$FirstName.',</p>';
$output.='<p>Your are Successfully registered the MS@Home.</p>';	
$output.='<p>Please use the following Credentials to login in your site.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="http://msathome.vkmsoftware.com/" target="_blank">
http://msathome.vkmsoftware.com/</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';

$output.='<p>User Name : '.$email.'</p>'; 
$output.='<p>Password  : '.$Password.'</p>';   	
$output.='<p>Thanks,</p>';

$body = $output; 
$subject = "Registration Mail at MS@Home";

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
	
	

<script>alert("Registered Successfully !");window.location.href='UserProfile.php'</script>

<?php } }

function randomPassword(int $passwordLength = 10): string {
   $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
   $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < $passwordLength; $i++) {
        $n = random_int(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

	?>
  <div class="wrapper ">
  <?php include 'menu.php';?>
 
    <div class="main-panel">
     <?php include 'topPanel.php';?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
		 <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <h4 class="card-title">
                   User Registraion
                  </h4>
                </div>
                <div class="card-body">
                  <form id="RegisterValidation" action="" method="post">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address *</label>
                          <input type="email" name="email" Id="email" class="form-control" required="true">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Contact Number *</label>
                          <input type="text" name="ContactNo" Id="ContactNo" class="form-control" required="true">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Institution Name</label>
                          <input type="text" name="InstitutionName" Id="InstitutionName" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fist Name *</label>
                          <input type="text" name="FirstName" Id="FirstName" class="form-control" required="true">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" name="LastName" Id="LastName" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Address</label>
                          <input type="text" name="Address" Id="Address" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">City *</label>
                          <input type="text" name="City" Id="City" class="form-control" required="true">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Country</label>
                          <input type="text" name="Country" Id="Country" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Pin Code *</label>
                          <input type="text" name="PinCode" Id="PinCode" class="form-control" required="true">
                        </div>
                      </div>
                    </div>
                  <div class="category form-category">* Required fields</div>
                    <button type="submit" class="btn btn-rose pull-right">Create</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
			 <div class="col-md-2"></div>
            <!--<div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="assets/img/faces/avatar5.png" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray">Admin</h6>
                 
                  <p class="card-description">
                    If you want to Disable the Reocrd?
                  </p>
                  <a href="#pablo" class="btn btn-rose btn-round">Lock</a>
                </div>
              </div>
            </div> !-->
          </div>
        </div>
      </div>
     <?php require_once('footer.php'); ?>
    </div>
  </div>
  
  
  
  <script>
    function setFormValidation(id) {
      $(id).validate({
        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function(error, element) {
          $(element).closest('.form-group').append(error);
        },
      });
    }

    $(document).ready(function() {
      setFormValidation('#RegisterValidation');
      
    });
  </script>
</body>

</html>