<?php
session_start();
error_reporting(E_ALL);
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
        $category=$_POST['category'];
       
        $catid=intval($_GET['catid']);
        $sql="update  tblcategory set CategoryName=:category where id=:catid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':category',$category,PDO::PARAM_STR);
        $query->bindParam(':catid',$catid,PDO::PARAM_STR);
        $query->execute();
        $_SESSION['updatemsg']="Category updated successfully";
        header('location:managecategory.php');


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>e-Pustaklaya| Edit Categories</title>
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



      <!------MENU SECTION START-->
<?php include('includes/header1.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Edit category</h4>
                
                            </div>

</div>



                               

<form  role = "form" method="post" style="top: 20px; bottom: 20px; text-align: center; border:2px solid #ccc; width:500px; height: 500px; margin: 0 auto; background-color: lightblue;">

     <?php 
                                $catid=intval($_GET['catid']);
                                $sql="SELECT * from tblcategory where id=:catid";
                                $query=$dbh->prepare($sql);
                                $query-> bindParam(':catid',$catid, PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount() > 0)
                                {
                                foreach($results as $result)
                                {               
                                  ?> 
  <div class="container1">
    <h1>Edit Category</h1>
    <hr>

    <label for="Category"><b>Category</b></label>
    <input class="form-control" type="text" name="category" value="<?php echo htmlentities($result->CategoryName);?>" required />

    <div class="clearfix1">
      <button type="button" class="cancelbtn1">Cancel</button>
      <button  name ="update" type="submit" class="signupbtn1">Update</button>
      
 <?php } ?>
      <hr>
    </div>
  </div>
</form>






                        </div>
                            </div>

        </div>
   
    </div>
    </div>


     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php }}?>
