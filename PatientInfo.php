<?php include 'header.php';
include 'config.php';?>
<?php 
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
		//echo "hai";exit;
	if($_GET['id'] == ''){
			
	$PID=0;
	$result_query = mysqli_query($conn,"select ISNULL(max(PID)) as PID from patientinfo");
	
while($result = mysqli_fetch_array($result_query))
{
	$PID 	=$result['PID'];
}
$PatientId=$PinCode."-".sprintf("%06d", $PID);
	//echo	$PatientId;exit;
		//$_POST['image_upload']= $newfile1;
		$created_at  =date('Y-m-d H:i:s');

		 $query=mysqli_query($conn,"insert into PatientInfo(PID,PatientId,FirstName,LastName,Address,City,Pincode,Aadhaar,Age,Sex,Email_Id,Contact_Number,Comorbidities,created_at,IsActive) values 
		 ('".$PID."','".$PatientId."','".$FirstName."','".$LastName."','".$Address."','".$City."','".$PinCode."','".$Adhaar."','".$Age."','".$Sex."','".$email."','".$ContactNo."','".$Comorbidities."','".$created_at."','Y')");
	}else{
	
	
			$query= mysqli_query($conn,"update PatientInfo set hotel_name='".$_POST['hotel_name']."',hotel_description='".$_POST['description']."',status='".$_POST['status']."' where id='".$_GET[id]."'");	
	  
	}
	header("location:ViewPatientInfo.php");
	
}
?>

<body class="" style="background-color:red">
  
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
                  <h4 class="card-title">Add Patient Info
                    
                  </h4>
                </div>
                <div class="card-body">
                 <form id="RegisterValidation" action="" method="post" enctype="multipart/form-data">
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fist Name *</label>
                          <input type="text" id="FNAME" name="FNAME" class="form-control" required="true">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" id="LNAME" name="LNAME" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Adress</label>
                          <input type="text"  id="Address" name="Address" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">City *</label>
                          <input type="text" id="City" name="City" class="form-control" required="true">
                        </div>
                      </div>
                     
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Pin Code *</label>
                          <input type="text" id="PinCode" name="PinCode" class="form-control" required="true">
                        </div>
                      </div>
					  <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Aadhaar </label>
                          <input type="text" id="Adhaar" name="Adhaar"  class="form-control">
                        </div>
                      </div>
                    </div>
					 <div class="row">
					 <div class="col-md-3">Sex</div>
					 <div class="col-md-5">
					  <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="exampleRadios" value="Male" checked> Male
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="exampleRadios" value="Female"> Female
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
						</div>
						 <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Age *</label>
                          <input type="text" id="Age" name="Age" class="form-control" required="true">
                        </div>
                      </div>
						
					</div>
					
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address </label>
                          <input type="text"  id="Email" name="Email" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Contact Number *</label>
                          <input type="text" id="CNO" name="CNO" class="form-control" required="true">
                        </div>
                      </div>
                      
                    </div>
					<div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Comorbidities</label>
                          <div class="form-group">
                            
                            <textarea class="form-control" id="Comorbidities" name="Comorbidities" rows="3"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
					 <div class="category form-category">* Required fields</div>
                    <button type="submit" class="btn btn-rose pull-right">Add Info</button>
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