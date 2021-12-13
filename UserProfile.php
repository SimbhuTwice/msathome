<?php session_start();
include 'header.php';
include 'config.php';
//echo $_SESSION['user_id'];exit;
if(isset($_GET['id'])){
$id=$_GET['id'];
}
else{
	$id=$_SESSION['user_id'];
}
if(!empty($_POST)){
	//	$email     = $_POST['email'];
	$ContactNo = $_POST['ContactNo'];
	$InstitueName     = $_POST['InstitutionName'];
	$FirstName = $_POST['FirstName'];
	$LastName     = $_POST['LastName'];
	$Address = $_POST['Address'];
	$City     = $_POST['City'];
	$Country = $_POST['Country'];
	$PinCode     = $_POST['PinCode'];
	$query= mysqli_query($conn,"update user_register set InstitueName='".$InstitueName."',FirstName='".$FirstName."',LastName='".$LastName."',City='".$City."',Pincode='".$PinCode."',Contact_Number='".$ContactNo."',Country='".$Country."',Address='".$Address."' where ID='$id'");	

?>
<script>alert("User Profile Updated Successfully !");window.location.href='ViewUserRegist.php'</script>

<?php }

if($_SESSION['user_id'] == ''){
	$FirstName       = '';
	$LastName  	= '';
	$InstitueName 	='';
	$City 	='';
	$Pincode       = '';
	$Contact_Number  	= '';
	$Country 	='';
	$Address 	='';
	$Email 	='';
} else {
	$result_query = mysqli_query($conn,"select InstitueName,FirstName,LastName,City,Pincode,Contact_Number,Country,Address,Email_Id from user_register where ID='$id'");
	//echo "select FirstName,LastName,,City,Pincode,Contact_Number,Country,Address from user_register where Email_Id='$_SESSION[user_id]'";
	if($result_query === FALSE) { 
    //echo"error";exit;
}
else{
while($result = mysqli_fetch_array($result_query))
{
    //echo $row['FirstName'];

	
	//$result=mysqli_fetch_array($result_query,MYSQLI_ASSOC);
	$FirstName            = $result['FirstName'];
	$LastName       	 = $result['LastName'];
	$City  		 = $result['City'];
	$Pincode 	=$result['Pincode'];
	$Contact_Number            = $result['Contact_Number'];
	$Country       	 = $result['Country'];
	$Address  		 = $result['Address'];
	$InstitueName  		 = $result['InstitueName'];
	$Email 	=$result['Email_Id'];
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
		 <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <h4 class="card-title">Edit Profile -
                    <small class="category">Complete your profile</small>
                  </h4>
                </div>
                <div class="card-body">
                  <form id="RegisterValidation" action="" method="post">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address (disabled)</label>
                          <input type="email" name="email" Id="email" class="form-control" disabled value="<?php echo $Email?>" required="true">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Contact Number</label>
                          <input type="text"  name="ContactNo" Id="ContactNo" class="form-control" value="<?php echo $Contact_Number?>" required="true">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Institution Name</label>
                          <input type="text" name="InstitutionName" Id="InstitutionName" class="form-control" value="<?php echo $InstitueName?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fist Name</label>
                          <input type="text"  name="FirstName" Id="FirstName" class="form-control" required="true" value="<?php echo $FirstName?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" name="LastName" Id="LastName" class="form-control" value="<?php echo $LastName?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Adress</label>
                          <input type="text" name="Address" Id="Address" class="form-control" value="<?php echo $Address?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">City</label>
                          <input type="text" name="City" Id="City" class="form-control" required="true" value="<?php echo $City?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Country</label>
                          <input type="text" name="Country" Id="Country" class="form-control" value="<?php echo $Country?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Pin Code</label>
                          <input type="text" name="PinCode" Id="PinCode" class="form-control" required="true" value="<?php echo $Pincode?>">
                        </div>
                      </div>
                    </div>
                  
                    <button type="submit" class="btn btn-rose pull-right">Update Profile</button>
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