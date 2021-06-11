<?php
session_start();

$db = mysqli_connect("localhost","root","","lms_db");

include('includes/connection1.php');
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location:../index.php');
}
else{ 
	if(isset($_POST['create']))
	{
	$category=$_POST['category'];
	$sql= "INSERT INTO tblcategory(CategoryName) VALUES(:category)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':category',$category,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
    $_SESSION['msg']="Category Listed successfully";
    header('location:managecategory.php');
    }
    else 
    {
    $_SESSION['error']="Something went wrong. Please try again";
    header('location:managecategory.php');
    }

    }
}

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}
?>  
<!DOCTYPE html>
<html>
<style>

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 2px solid;
  margin-bottom: 25px;
  color: orange;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn1 {
  padding: 14px 20px;
  background-color: #f44336;
}


.cancelbtn1, .signupbtn1 {
  float: left;
  width: 50%;
}


.container1 {
  padding: 16px;
}

/* Clear floats */
.clearfix1::after {
  content: "";
  clear: both;
  display: table;
}


@media screen and (max-width: 300px) {
  .cancelbtn1, .signupbtn1 {
     width: 100%;
  }
}
</style>
<body style=" background: url(back.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
<?php include('includes/header1.php');?>
<form method="post" style="top: 20px; bottom: 20px; text-align: center; border:2px solid #ccc; width:500px; height: 500px; margin: 0 auto; background-color: lightblue;">
  <div class="container1">
    <h1>Add Category</h1>
    <hr>

    <label for="Category"><b>Category</b></label>
    <input type="text" placeholder="Enter the Category Name " name="category" required style="width: 400px ;">

    <div class="clearfix1">
      <button type="button" class="cancelbtn1">Cancel</button>
      <button  name ="create" type="submit" class="signupbtn1">Create</button>
      

      <hr>
    </div>
  </div>
</form>

<?php include('includes/footer.php');?>
</body>
</html>
