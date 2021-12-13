<?php include 'config.php'; 
//echo $_POST;exit;
if(!empty($_POST)){
	$USER_NAME     = $_POST['email'];
	$USER_PASSWORD = $_POST['password'];
	echo $USER_PASSWORD;exit;
	$sql = "select * from user_register WHERE Email_Id = '$USER_NAME' AND Password = '$USER_PASSWORD' and Is_Active='Y'";
	$result=mysqli_query($conn,$sql);
	$result_rows=mysqli_fetch_array($result,MYSQLI_ASSOC);
	if (mysqli_num_rows($result) == 0){ ?>
		<script>alert("Invalid User Name/Password");window.location.href='index.php'</script>
<?php }else{
		if($_POST['checkbox'] == 1){
			setcookie("syn_username", $USER_NAME, time() + 3600); // Sets the cookie username
			setcookie("syn_password", $_POST['password'], time() + 3600); // Sets the cookie password
		}
			$_SESSION['user_id']    = $result_rows['Email_Id'];
			header("location:ChangePwd.php");

		}	
}
?>