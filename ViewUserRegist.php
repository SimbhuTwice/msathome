<?php include 'header.php';?>
<?php include 'config.php';  ?>
<?php include 'config.php';
if(isset($_GET['act'])){
if($_GET['act'] == 'del' ){
	mysqli_query($conn,"update user_register set IsActive='N' WHERE id = '$_GET[id]' ");
	header("location:ViewUserRegist.php");
}
}
?>
<body class="">
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
  <div class="wrapper ">
  <?php include 'menu.php';?>
 
    <div class="main-panel">
     <?php include 'topPanel.php';?>
      <div class="content">
        <div class="container-fluid">
		 
         
		  
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
				  <a href="UserRegist.php" class="pull-right"><i class="material-icons">add_box</i> Add User Profile</a>
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
						<th>Email Id</th>
                          <th>Name</th>
                          <th>City</th>
						  <th>Pin Code</th>
						  <th>Contact Number</th>
                         <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                         <th>Email Id</th>
                          <th>Name</th>
                          <th>City</th>
						  <th>Pin Code</th>
						  <th>Contact Number</th>
                          <th class="text-right">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>
					  <?php $result_query = mysqli_query($conn,"select ID,Email_Id,FirstName,LastName,City,Pincode,Contact_Number,Country,Address from user_register where IsActive='Y'");
					  	if($result_query === FALSE) { 
    //echo"error";exit;
}
else{
while($result = mysqli_fetch_array($result_query))
{
					  ?>
                        <tr>
                          <td><?php echo $result['Email_Id'];?></td>
                          <td><?php echo $result['FirstName'];?></td>
						  <td><?php echo $result['City'];?></td>
                          <td><?php echo $result['Pincode'];?></td>
						  <td><?php echo $result['Contact_Number'];?></td>
						 
						  
                          <td class="text-right">
                          <a href="UserProfile.php?id=<?php echo $result['ID'];?>" class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">create</i></a>
                            <a href="javascript:void(0)" onclick="delete_row(<?php echo $result['ID'];?>)" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>
							
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
function delete_row(id){
	message = 'Do You Want To Delete This Records?';
	jQuery('body').append('<div class="alert"></div>');
	$alert = jQuery('.alert');
	$alert.slideDown(400);
	$alert.html(message).append('<br /><br /><br /><input type="button" value="Yes" class="button small grey rnd8" onclick="conf_delete(1,'+id+')" ><input type="button" value="No" class="button small grey rnd8"  onclick="conf_delete(0,'+id+')" ><br /><br /><br />');
}
function conf_delete(val,id){
	if(val == 1 )
		window.location.href='ViewUserRegist.php?id='+id+'&act=del';
	else
		$alert.slideUp(400);
}
  </script>
</body>

</html>