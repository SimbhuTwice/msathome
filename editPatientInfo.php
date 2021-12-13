<?php include 'header.php';
include 'config.php';?>
<?php 
$id=$_GET['id'];
if(!empty($_POST)){


	$email     = $_POST['Email'];
	$ContactNo = $_POST['CNO'];
	$Age     = $_POST['Age'];
	$FirstName = $_POST['FNAME'];
	$LastName     = $_POST['LNAME'];
	$Address = $_POST['Address'];
	$City     = $_POST['City'];
	$Adhaar = $_POST['Adhaar'];
	$PinCode     = $_POST['PinCode'];
	$Comorbidities=$_POST['Comorbidities'];
	$Sex=$_POST['exampleRadios'];
	
$query= mysqli_query($conn,"update PatientInfo set FirstName='".$FirstName."',LastName='".$LastName."',City='".$City."',Pincode='".$PinCode."',age='".$Age."',sex='".$Sex."',Contact_Number='".$ContactNo."',Comorbidities='".$Comorbidities."',Email_Id='".$email."',Address='".$Address."',Aadhaar='".$Adhaar."' where id='".$id."'");	
	  
	
	header("location:ViewPatientInfo.php");
	
}
//echo "select ID,PatientId,FirstName,LastName,City,Pincode,age,sex,Contact_Number,Comorbidities,Email_Id,Address,Aadhaar from patientinfo where ID='$id'";exit;
$result_query = mysqli_query($conn,"select ID,PatientId,FirstName,LastName,City,Pincode,age,sex,Contact_Number,Comorbidities,Email_Id,Address,Aadhaar from patientinfo where ID='$id'");
	if($result_query === FALSE) { 
}
else{
while($result = mysqli_fetch_array($result_query))
{
$email     = $result['Email_Id'];
	$ContactNo = $result['Contact_Number'];
	$Age     = $result['age'];
	$FirstName = $result['FirstName'];
	$LastName     = $result['LastName'];
	$Address = $result['Address'];
	$City     = $result['City'];
	$Adhaar = $result['Aadhaar'];
	$PinCode     = $result['Pincode'];
	$Comorbidities=$result['Comorbidities'];
	$Sex=$result['sex'];
	$PatientId=$result['PatientId'];
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
                  <h4 class="card-title">Edit Patient Info
                    
                  </h4>
                </div>
                <div class="card-body">
                 <form id="RegisterValidation" action="" method="post" enctype="multipart/form-data">
                    
                    <div class="row">
					<div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Patient Id (disabled)</label>
                          <input type="text" name="PID" Id="PID" class="form-control" disabled value="<?php echo $PatientId?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">

                          <label class="bmd-label-floating">Fist Name *</label>
                          <input type="text" id="FNAME" name="FNAME" class="form-control" required="true" value="<?php echo $FirstName?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" id="LNAME" name="LNAME" class="form-control" value="<?php echo $LastName?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Adress</label>
                          <input type="text"  id="Address" name="Address" class="form-control" value="<?php echo $Address?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">City *</label>
                          <input type="text" id="City" name="City" class="form-control" required="true" value="<?php echo $City?>">
                        </div>
                      </div>
                     
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Pin Code *</label>
                          <input type="text" id="PinCode" name="PinCode" class="form-control" required="true" value="<?php echo $PinCode?>">
                        </div>
                      </div>
					  <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Aadhaar </label>
                          <input type="text" id="Adhaar" name="Adhaar"  class="form-control" value="<?php echo $Adhaar?>">
                        </div>
                      </div>
                    </div>
					 <div class="row">
					 <div class="col-md-3">Sex</div>
					 <div class="col-md-5">
					  <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="exampleRadios" value="Male" <?php echo ($Sex== 'Male') ?  "checked" : "" ;  ?>> Male
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="exampleRadios" value="Female" <?php echo ($Sex== 'Female') ?  "checked" : "" ;  ?>> Female
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
						</div>
						 <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Age *</label>
                          <input type="text" id="Age" name="Age" class="form-control" required="true" value="<?php echo $Age?>">
                        </div>
                      </div>
						
					</div>
					
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address </label>
                          <input type="text"  id="Email" name="Email" class="form-control" value="<?php echo $email?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Contact Number *</label>
                          <input type="text" id="CNO" name="CNO" class="form-control" required="true" value="<?php echo $ContactNo?>">
                        </div>
                      </div>
                      
                    </div>
					<div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Comorbidities</label>
                          <div class="form-group">
                            
                            <textarea class="form-control" id="Comorbidities" name="Comorbidities" rows="3"><?php echo $Comorbidities?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
					 <div class="category form-category">* Required fields</div>
                    <button type="submit" class="btn btn-rose pull-right">Update Info</button>
                    <div class="clearfix"></div>
                  
                </div>
              </div>
            </div>
           
          </div>
		  </form>
		  
		  
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