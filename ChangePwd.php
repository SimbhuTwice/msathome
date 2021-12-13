<?php session_start();
include 'header.php';
include 'config.php';
if(!empty($_POST)){
$username = $_SESSION['user_id'];
        $pass = $_POST['password'];
		//echo $password;exit;
		//$password="";
        $newpassword = $_POST['newpassword'];
		//echo $newpassword;exit;
        $confirmnewpassword = $_POST['password_confirmation'];
        $result = mysqli_query($conn,"SELECT password FROM user_register WHERE 
Email_Id='$username'");

        if(!$result)
        {
        echo "The username you entered does not exist";
        }
        else 
        {
			$resultpass="";
			while($row = mysqli_fetch_array($result))
{
	//echo $row['password'];exit;
	
	$resultpass=$row['password'];
}
//echo $resultpass;exit;
//echo $pass;exit;
		  if($pass!= $resultpass)	{ ?>
		  <script>alert("You entered an incorrect password");</script>
       <?php //echo "You entered an incorrect password";exit;
		  }
		  else{
			  if($newpassword=$confirmnewpassword)
        $sql=mysqli_query($conn,"UPDATE user_register SET password='$newpassword' where  Email_Id='$username'");
        if($sql)
        {?>
	 <script>alert("Congratulations You have successfully changed your password");</script>
      
        <?php }
       else
        { ?>
     	 <script>alert("Passwords do not match");</script>  
    <?php   }
		  }
        }
        
}
?>
<body class="">
  
  <div class="wrapper ">
  <?php include 'menu.php';?>
 
    <div class="main-panel">
    <?php include 'topPanel.php';?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
		  <div class="col-md-3"></div>
            <div class="col-md-6">
              <form id="RegisterValidation" action="" method="post">
                <div class="card ">
                  <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons">mail_outline</i>
                    </div>
                    <h4 class="card-title">Change Password</h4>
                  </div>
                  <div class="card-body ">
                    <div class="form-group">
                      <label for="exampleEmail" class="bmd-label-floating"> Old Password *</label>
                      <input type="password" class="form-control" id="password"   required="true" name="password">
                    </div>
                    <div class="form-group">
                      <label for="examplePassword" class="bmd-label-floating"> Password *</label>
                      <input type="password" class="form-control" id="examplePassword" required="true" name="newpassword">
                    </div>
                    <div class="form-group">
                      <label for="examplePassword1" class="bmd-label-floating"> Confirm Password *</label>
                      <input type="password" class="form-control" id="examplePassword1" required="true" equalTo="#examplePassword" name="password_confirmation">
                    </div>
                    <div class="category form-category">* Required fields</div>
                  </div>
                  <div class="card-footer text-right">
                    <div class="form-check mr-auto">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="" onclick="myFunction()" required> Show Password
                        <span class="form-check-sign">
                          <span class="check"></span>
                        </span>
                      </label>
                    </div>
                    <button type="submit" class="btn btn-rose">Change Now</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-3"></div>
           
            
          </div>
        </div>
      </div>
     <?php require_once('footer.php'); ?>
    </div>
  </div>
  
  
  
  <script>
  function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  
  var y = document.getElementById("examplePassword");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
  
  var z = document.getElementById("examplePassword1");
  if (z.type === "password") {
    z.type = "text";
  } else {
    z.type = "password";
  }
}
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