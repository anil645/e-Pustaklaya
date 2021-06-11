<?php
session_start();
error_reporting(1);
$db = mysqli_connect("localhost","root","","lms_db");
/*
if(!$db)
{
    die("Connection failed: ".mysqli_connect_error());
}

if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location:../index.php');
  }
  else{
    if(isset($_POST['create']))
    {   
        $category = $_POST['category'];

        $insert = mysqli_query($db,"INSERT INTO tblcategory(CategoryName) VALUES ($category)");

        if(!$insert)
      {
      $msg = "You left one or more of the required fields.";
      header("Location:addcategory.php");
      }
        else
        {
            echo "Records added successfully.";
             header('location:editcategory.php');
        }
    }
}

mysqli_close($db); // Close connection


*/
include('includes/connection1.php');
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location:../index.php');
}
else{ 
  if(isset($_POST['create']))
  {
      $bookname=$_POST['Book'];
      $category=$_POST['Category'];
      $author=$_POST['Author'];
      $isbn=$_POST['ISBN'];
      $price=$_POST['Price'];
      $sql="INSERT INTO  tblbooks(BookName,CatId,AuthorId,ISBNNumber,BookPrice) VALUES(:bookname,:category,:author,:isbn,:price)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
      $query->bindParam(':category',$category,PDO::PARAM_STR);
      $query->bindParam(':author',$author,PDO::PARAM_STR);
      $query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
      $query->bindParam(':price',$price,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
      if($lastInsertId)
          {
          $_SESSION['msg']="Book Listed successfully";
          header('location:managebooks.php');
          }
      else 
          {
          $_SESSION['error']="Something went wrong. Please try again";
          header('location:managebooks.php');
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
<link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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

/* Float cancel and signup buttons and add an equal width */
.cancelbtn1, .signupbtn1 {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container1 {
  padding: 16px;
}
.clearfix1{
	width:540px;
}
/* Clear floats */
.clearfix1::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
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
<form method="post" style="top: 20px; bottom: 20px; text-align: center; border:2px solid #ccc; width:600px; height: 600px auto; margin: 0 auto; background-color: lightblue;">
  <div class="container1">
    <h1>Add Books Info</h1>
    <hr>

   <!-- <label for="Book"><b>Books</b></label>  -->
  
<div class="form-group" >
<label style="margin-top: -20px; float: left; margin-left: 15px; margin-bottom: -5px;">Book Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="Book" autocomplete="off"  required />
</div>

<div class="form-group">
<label style="margin-top: -20px; float: left; margin-left: 15px;"> Category<span style="color:red;">*</span></label>
<select class="form-control" name="Category" required="required">
<option value=""> Select Category</option>
<?php 
$status=1;
$sql = "SELECT * from  tblcategory";
$query = $dbh -> prepare($sql);

$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
    {               ?>  
    <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->CategoryName);?></option>
     <?php 
    }
} ?> 
</select>
</div>

      

       <div class="form-group"  >
              <label style="font-weight: bold;float: left; margin-left: 15px;"> Author<span style="color:red;">*</span></label>
              <select class="form-control" name="Author" required="required">
              <option value=""> Select Author</option>
                      <?php 
                      $sql = "SELECT * from  tblauthors ";
                      $query = $dbh -> prepare($sql);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query->rowCount() > 0)
                      {
                      foreach($results as $result)
                      {               ?>  
                      <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->AuthorName);?></option>
                       <?php }} ?> 
              </select>
              </div>
   
   		<label style="font-weight: bold;float: left; margin-left: 15px;"> ISBN Number <span style="color:red;font-weight: bold; ">*</span></label>
       <input style="height:5px;" type="text" placeholder="ISBN Must be unique" name="ISBN"  required >

       <label style="font-weight: bold;float: left; margin-left: 15px;"> Price <span style="color:red;font-weight: bold; ">*</span></label>
       <input style="height:5px;" type="text" placeholder="Price of Book" name="Price"  required >

 		 <button type="button" class="cancelbtn1">Cancel</button>
     	 <button  name ="create" type="submit" class="signupbtn1">Add Book</button>
      <hr>
    </div>
  </div>
</form>
<?php include('includes/footer.php');?>
</body>
</html>
