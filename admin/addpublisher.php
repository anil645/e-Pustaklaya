<?php
session_start();

$db = mysqli_connect("localhost","root","","lms_db");

include('includes/connection1.php');



  function isLoggedIn()
  {
    if (isset($_SESSION['user'])) {
      return true;
    }else{
      return false;
    }
  }
  if (!isLoggedIn()) 
  {
    $_SESSION['msg'] = "You must log in first";
   
    header('location:../index.php');
  }
  else{ 

  if(isset($_POST['create']))
  {
  $author=$_POST['Author'];
  $sql="INSERT INTO  tblauthors(AuthorName) VALUES(:author)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':author',$author,PDO::PARAM_STR);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();
      if($lastInsertId)
      {
      $_SESSION['msg']="Author Listed successfully";
      header('location:managepublishers.php');
      }
      else 
      {
      $_SESSION['error']="Something went wrong. Please try again";
      header('location:managepublishers.php');
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

  /* Float cancel and signup buttons and add an equal width */
  .cancelbtn1, .signupbtn1 {
    align-content: center;
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
  <form method="post" style="top: 20px; bottom: 20px; text-align: center; border:2px solid #ccc; width:600px ; height: 600px auto; margin: 0 auto; background-color: lightblue;">
    <div class="container1">
      <h1>Add Author Info </h1>
      <hr>

     <!-- <label for="Book"><b>Books</b></label>  -->
    
      <div class="clearfix1">
        <label style="float: left;margin-left: 10px; margin-bottom: 20px; font-weight: bold;">Author</label>
         <input style="height:5px;" type="text" placeholder="Author Name" name="Author"  required >

   		 
       	 <button  name ="create" type="submit" class="signupbtn1">Add Book</button>
        <hr>
      </div>
    </div>
  </form>

  <?php include('includes/footer.php');?>
  </body>
  </html>
  <?php } ?>