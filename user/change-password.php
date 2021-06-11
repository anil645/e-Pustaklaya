<?php
session_start();
$db = mysqli_connect("localhost","root","","lms_db");

include('includes/connection1.php');
if (!isLoggedIn())
 	{
  		$_SESSION['msg'] = "You must log in first";
  		header('location:../index.php');
	}
else
{ 
	if(isset($_POST['change']))
	{
	$password=md5($_POST['password']);
	$newpassword=md5($_POST['newpassword']);
	//$email=$_SESSION['isLoggedIn'];
  	$sql ="SELECT Password FROM accounts WHERE email=:email and password=:password";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':password', $password, PDO::PARAM_STR);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
 	if($query -> rowCount() > 0)
		{
			$con="update accounts set password=:newpassword where email=:email";
			$chngpwd1 = $dbh->prepare($con);
			$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
			$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
			$chngpwd1->execute();
			$msg="Your Password succesfully changed";
		}
		else
		{
			$error="Your current password is wrong";  
		}
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user']))
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <style>
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
    </style>
</head>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>

<body style=" background: url(back.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
    <!------MENU SECTION START-->
<?php include('includes/header1.php');?>
<form method="post" style="top: 20px; bottom: 20px; text-align: center; border:2px solid #ccc; width:500px; height: 500px; margin: 0 auto; background-color: lightblue;">

<div class="container1">
    <h1>Change Password</h1>
    <hr>

    <div class="form-group">
<label>Current Password</label>
<input class="form-control" type="password" name="password" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="newpassword" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Confirm Password </label>
<input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
</div>

 <button type="submit" name="change" class="btn btn-info">Change </button> 
      <hr>
    </div>
  </div>
</form>            
             
 
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
 <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>


