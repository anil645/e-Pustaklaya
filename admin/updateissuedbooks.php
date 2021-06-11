<?php
session_start();
error_reporting(1);
//$db = mysqli_connect("localhost","root","","lms_db");

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

if(isset($_POST['return']))
{
$rid=intval($_GET['rid']);
$fine=$_POST['fine'];
$rstatus=1;
$sql="update tblissuedbookdetails set fine=:fine, ReturnStatus=:rstatus where id=:rid";
$query = $dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->bindParam(':fine',$fine,PDO::PARAM_STR);
$query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="Book Returned successfully";
header('location:manageissuedbooks.php');



}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issued Book Details</title>
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
url: "getbook.php",
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


</head>
<body style=" background: url(back.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
      <!------MENU SECTION START-->
<?php include('includes/header1.php');?>
<!-- MENU SECTION END-->
 
                              
                   
                <form   role="form" method="post" style="top: 20px; bottom: 20px; text-align: center; border:2px solid #ccc; width:600px; height: 720px ; margin: 0 auto; background-color: lightblue;">
                  <div class="container1">
                     <h1 style="font-weight: bold; background-color:lightgoldenrodyellow; height: 50px; margin-top: 5px;">Issued Book Details</h1>
                        <hr>
                    <?php 
                    $rid=intval($_GET['rid']);
                    $sql = "SELECT accounts.FullName,tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine,tblissuedbookdetails.ReturnStatus from  tblissuedbookdetails join accounts on accounts.id=tblissuedbookdetails.StudentID join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblissuedbookdetails.id=:rid";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':rid',$rid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $result)
                    {               ?>                                      
                                       




                    <div class="clearfix1">

                      
                <div class="form-group">
                <label >Student Name :</label>
                <?php echo htmlentities($result->FullName);?>
                </div>

                <div class="form-group">
                <label>Book Name :</label>
                <?php echo htmlentities($result->BookName);?>
                </div>


                <div class="form-group">
                <label>ISBN :</label>
                <?php echo htmlentities($result->ISBNNumber);?>
                </div>

                <div class="form-group">
                <label>Book Issued Date :</label>
                <?php echo htmlentities($result->IssuesDate);?>
                </div>


                <div class="form-group">
                <label>Book Returned Date :</label>



                      </div>
                              
                    
                    </div>
                  </div>
             

                <?php if($result->ReturnDate=="")
                                            {
                                                echo htmlentities("Not Return Yet");
                                            } else {


                                            echo htmlentities($result->ReturnDate);
}
                                            ?>
</div>
      
                
        <label>Fine (in USD) :</label>
        <?php 
        if($result->fine=="")
        {?>
        <input class="form-control" type="text" name="fine" id="fine"  required />

        <?php }else {
        echo htmlentities($result->fine);
        }
        ?>
        </div>
        <?php if($result->ReturnStatus==0){?>

        <button type="submit" name="return" id="submit" class="btn btn-info">Return Book </button>

         </div>
  <hr>
        <?php }}} ?>
                                    
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     </form>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
 
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
