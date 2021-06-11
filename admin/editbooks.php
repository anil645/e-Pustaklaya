<?php
session_start();
error_reporting(2);
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
if(isset($_POST['update']))
            {
            $bookname=$_POST['bookname'];
            $category=$_POST['category'];
            $author=$_POST['author'];
            $isbn=$_POST['isbn'];
            $price=$_POST['price'];
            $bookid=intval($_GET['bookid']);
            $sql="update  tblbooks set BookName=:bookname,CatId=:category,AuthorId=:author,ISBNNumber=:isbn,BookPrice=:price where id=:bookid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
            $query->bindParam(':category',$category,PDO::PARAM_STR);
            $query->bindParam(':author',$author,PDO::PARAM_STR);
            $query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
            $query->bindParam(':price',$price,PDO::PARAM_STR);
            $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
            $query->execute();
            $_SESSION['msg']="Book info updated successfully";
            header('location:managebooks.php');


            }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> Edit Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body style=" background: url(back.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
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


      <!------MENU SECTION START-->
<?php include('includes/header1.php');?>

<form method="post" style=" padding-bottom: 50px; text-align: center; border:2px solid #ccc; width:600px; height: 600px auto; padding-top:20px; margin: 0 auto; background-color: lightblue;">

<div class="container1">
    <h2>Add Books Info</h2>
    <hr>

               <?php 
            $bookid=intval($_GET['bookid']);
            $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblcategory.id as cid,tblauthors.AuthorName,tblauthors.id as athrid,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId where tblbooks.id=:bookid";
            $query = $dbh -> prepare($sql);
            $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
            foreach($results as $result)
            {               ?>  

            <div class="form-group">
            <label style="font-weight: bold;float: left; margin-left: 15px;">Book Name<span style="color:red;">*</span></label>
            <input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->BookName);?>" required />
            </div>


            <div class="form-group">
            <label style="font-weight: bold;float: left; margin-left: 15px; margin-top: -20px;"> Category<span style="color:red;">*</span></label>
            <select class="form-control" name="category" required="required">
            <option value="<?php echo htmlentities($result->cid);?>"> <?php echo htmlentities($catname=$result->CategoryName);?></option>
            <?php 
            $status=1;
            $sql1 = "SELECT * from  tblcategory ";
            $query1 = $dbh -> prepare($sql1);

            $query1->execute();
            $resultss=$query1->fetchAll(PDO::FETCH_OBJ);
            if($query1->rowCount() > 0)
            {
            foreach($resultss as $row)
            {           
            if($catname==$row->CategoryName)
            {
            continue;
            }
            else
            {
                ?>  
            <option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->CategoryName);?></option>
             <?php }}} ?> 
            </select>
            </div>


            <div class="form-group">
            <label style="font-weight: bold;float: left; margin-left: 15px;"> Author<span style="color:red;">*</span></label>
            <select class="form-control" name="author" required="required">
            <option value="<?php echo htmlentities($result->athrid);?>"> <?php echo htmlentities($athrname=$result->AuthorName);?></option>
            <?php 

            $sql2 = "SELECT * from  tblauthors ";
            $query2 = $dbh -> prepare($sql2);
            $query2->execute();
            $result2=$query2->fetchAll(PDO::FETCH_OBJ);
            if($query2->rowCount() > 0)
            {
            foreach($result2 as $ret)
            {           
            if($athrname==$ret->AuthorName)
            {
            continue;
            } else{

                ?>  
            <option value="<?php echo htmlentities($ret->id);?>"><?php echo htmlentities($ret->AuthorName);?></option>
             <?php }}} ?> 
            </select>
            </div>

            <div class="form-group">
            <label style="font-weight: bold;float: left; margin-left: 15px;">ISBN Number<span style="color:red;">*</span></label>
            <input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISBNNumber);?>"  required="required" />
            <p class="help-block" style="margin-top: -15px; float: left; margin-left: 15px;">An ISBN is an International Standard Book Number. ISBN Must be unique</p>
            </div>

             <div class="form-group">
             <label style="font-weight: bold;float: left; margin-left: 15px;">Price in NPR<span style="color:red;">*</span></label>
             <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->BookPrice);?>"   required="required" />
             </div>
             <?php }} ?>
            <div style="margin-top:-15px;">

                 <button type="button" class="cancelbtn1">Cancel</button>
                     <button  name ="update" type="submit" class="signupbtn1">Update</button>
                     
            </div>
        </div>
</form>




<!-- MENU SECTION END-->
   
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>

 
</body>
</html>
<?php }?>
