<?php include 'header.php';
include 'config.php';?>
<?php 
$id=$_GET['id'];
$result_query = mysqli_query($conn,"select ID,PatientId,FirstName,LastName from patientinfo where ID='$id'");
	if($result_query === FALSE) { 
}
else{
while($result = mysqli_fetch_array($result_query))
{
	$PName = $result['FirstName']." ".$result['LastName'];
	$PatientId=$result['PatientId'];
}
}
if(!empty($_POST)){
	$file_dir_1 = "Uploads/";
		if (trim($_FILES['image_upload']['name'])!=""){
 			$extn = explode(".",$_FILES['image_upload']['name']);
 			$rand_string = rand(10000,99999);
			$file11=$extn[0].$rand_string.".".$extn[1];
 			$type=$_FILES['image_upload']['type'];
			$name=$_FILES['image_upload']['name'];
 			//if($type=="image/gif" ||$type=="image/jpeg" || $type=="image/pjpeg" || $type=="image/png" ||$type=="image/jpg "){  
  				$newfile1 = $file_dir_1.$file11;
  				move_uploaded_file($_FILES['image_upload']['tmp_name'],$newfile1);
 			//}
			
	}
	$Rtype=$_POST['RType'];
	 $query=mysqli_query($conn,"insert into patientreports(PatientId,ReportType,ReportName,UploadPath) values 
		 ('".$id."','".$Rtype."','".$name."','".$newfile1."')");
	?>
	<script>alert("Reports Uploaded Successfully !");</script>
	<?php
}
if(isset($_GET['act'])){
if($_GET['act'] == 'del' ){
	mysqli_query($conn,"delete  from patientreports WHERE id  = '$_GET[pid]' ");
	header("location:UploadReports.php?id=".$id);
}
}
?>
<style>
	div.alert{
	background-color: #fff;
	border: 2px solid #ffac69;
	border-radius: 15px 15px 15px 15px;
	color: #000;
	font: 12px/20px Open Sans,Helvetica,Arial,sans-serif;
	left: 50%;
	margin-left: -220px;
	padding: 50px 40px 0 40px;
	position: fixed;
	text-align: center;
	top: 230px;
	width: 300px;
	z-index: 10030;
}
	</style>
<body class="">
  
  <div class="wrapper ">
  <?php include 'menu.php';?>
 
    <div class="main-panel">
     <?php include 'topPanel.php';?>
      <div class="content">
        <div class="container-fluid">
		  <div class="row">
            <div class="col-md-3">Patient Id</div>
			<div class="col-md-3"><span style='color: #F47A27;'><?php echo $PatientId;?></span></div>
			<div class="col-md-3">Patient Name</div>
			<div class="col-md-3"><span style='color: #F47A27;'><?php echo $PName;?></span></div>
			</div>
			<form id="RegisterValidation" action="" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">upload</i>
                  </div>
                  <h4 class="card-title">Upload Reports</h4>
                </div>
                <div class="card-body ">
                 
                    <div class="row">
                      <label class="col-md-3 col-form-label">Report type</label>
                      <div class="col-md-9">
                        <div class="form-group has-default">
                          <input type="text" name="RType" Id="RType" class="form-control" required="true">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-4">
                     
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="assets/img/image_placeholder.jpg" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Browse</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="image_upload" id="image_upload" required="true" />
                          </span>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                      </div>
                    </div>
                    </div>
                    
                 
                </div>
                <div class="card-footer ">
                  <div class="row">
                    <div class="col-md-9">
                      <button type="submit" class="btn btn-fill btn-rose">Upload</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			 <div class="col-md-3"></div>
          </div>
		   </form>
		  <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">View</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
						<th>Patient Id</th>
                          <th>Report Type</th>
                          <th>Name</th>
                         <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                     
                      <tbody>
					  
					  <?php $result_query = mysqli_query($conn,"select ReportType,ReportName,ID,PatientId,UploadPath from patientreports where PatientId='$id'");
					  	if($result_query === FALSE) { 
    //echo"error";exit;
}
else{
while($result = mysqli_fetch_array($result_query))
{
					  ?>
					  
                        <tr>
                          <td><?php echo $PatientId;?></td>
                          <td><?php echo $result['ReportType'];?></td>
                          <td><?php echo $result['ReportName'];?></td>
                          <td class="text-right">
						  
                          <a href="<?php echo $result['UploadPath'];?>" target='_blank' class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">dvr</i></a>
                             <a href="javascript:void(0)" onclick="delete_row(<?php echo $result['ID'];?>,<?php echo $result['PatientId'];?>)" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>
                          </td>
                        </tr>
					<?php } } ?>	
						
                     
                                              </tbody>
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
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
  <script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "INPUT",
          searchPlaceholder: "Search records",
        }
      });

      var table = $('#datatables').DataTable();
    });
var $alert = '';
function delete_row(id,Pid){
	message = 'Do You Want To Delete This Records?';
	jQuery('body').append('<div class="alert"></div>');
	$alert = jQuery('.alert');
	$alert.slideDown(400);
	$alert.html(message).append('<br /><br /><br /><input type="button" value="Yes" class="button small grey rnd8" onclick="conf_delete(1,'+id+','+Pid+')" ><input type="button" value="No" class="button small grey rnd8"  onclick="conf_delete(0,'+id+','+Pid+')" ><br /><br /><br />');
}
function conf_delete(val,id,pid){
	if(val == 1 )
		window.location.href='UploadReports.php?id='+pid+'&pid='+id+'&act=del';
	else
		$alert.slideUp(400);
}
  </script>
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