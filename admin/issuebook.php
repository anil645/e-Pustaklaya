<?php
session_start();
include('includes/connection1.php');

function isLoggedIn()
{
  if (isset($_SESSION['user'])) {
    return true;
  }else{
    return false;
  }
}
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location:../index.php');
}

else{ 

        if(isset($_POST['issue']))
        {
                $studentid=strtoupper($_POST['studentid']);
                $bookid=$_POST['bookdetails']; 
                $sql="INSERT INTO  tblissuedbookdetails (StudentID ,BookId) VALUES(:studentid,:bookid)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
                $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
                $query->execute();
                $lastInsertId = $dbh->lastInsertId();
                  if($lastInsertId)
                  {
                  $_SESSION['msg']="Book issued successfully";
                  header('location:manageissuedbooks.php');
                  }
                    else 
                    {
                    $_SESSION['error']="Something went wrong. Please try again";
                    header('location:manageissuedbooks.php');
                    }

        }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issue a new Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get student name
function getstudent() {
      $("#loaderIcon").show();
      jQuery.ajax({
      url: "getstudents.php",
      data:'studentid='+$("#studentid").val(),
      type: "POST",
      success:function(data){
      $("#get_student_name").html(data);
      $("#loaderIcon").hide();
      },
      error:function (){}
      });
}

//function for book details
    function getbook() {
    $("#loaderIcon").show();
    jQuery.ajax({
    url: "getbooks.php",
    data:'bookid='+$("#bookid").val(),
    type: "POST",
    success:function(data){
    $("#get_book_name").html(data);
    $("#loaderIcon").hide();
    },
    error:function (){}
    });
    }

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
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
<form   role="form" method="post" style="top: 20px; bottom: 20px; text-align: center; border:2px solid #ccc; width:600px; height: 700px auto; margin: 0 auto; background-color: lightblue;">
  <div class="container1">
    <h1>Add Books Info</h1>
    <hr>
   <!-- <label for="Book"><b>Books</b></label>  -->
  
    <div class="clearfix1">
      <div class="form-group">
              <label style="font-weight: bold;float: left; margin-left: 15px;">Student ID<span style="color:red;">*</span></label>
              <input class="form-control" type="text" name="studentid" id="studentid" onBlur= "getstudent()" autocomplete="off"  required />  
              </div>
               <div class="form-group">
                <span id="get_student_name" style="font-size:16px;"></span> 
              </div>

   		<label style="font-weight: bold;float: left; margin-left: 15px;"> ISBN Number or Book Title <span style="color:red;font-weight: bold; ">*</span></label>
       <input class="form-control" style="height:5px;" type="text" placeholder="ISBN Must be unique" name="bookid" id="bookid" onBlur="getbook()"  required="required" />

       <div class="form-group">
       <select  class="form-control" name="bookdetails" id="get_book_name" readonly>
       </select>
       </div>
 		   <button type="button" class="cancelbtn1">Cancel</button>
     	 <button type="submit" name ="issue"  class="signupbtn1">Issue Book</button>
      <hr>
    </div>
  </div>
</form>
<?php include('includes/footer.php');?>
</body>
</html>
<?php } ?>