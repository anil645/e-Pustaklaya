<?php include('connection.php') ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		 eLibrary
	</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</style>

</head>
<body  >
  <p style="color:white;"><?php
    if(isset($_SESSION['success']))
    {
        echo $_SESSION['success'];
    }
  ?>
</p> 
	<div class="header" style="background: rgba(255,255,255,0.8); padding-bottom: 40px; margin-top: -12px;">
      <div class="logo">
      <img src="img/pu_logo.png" alt="Avatar" width="80px" href="index.php" style="width:120px; height: 120px;
       margin-left:auto;
       margin-right: auto;
       margin-top: -10px;
       margin-bottom: -80px; ">   
       </div>
  		<div class="header-right">
  		  <a class="admin" onclick="document.getElementById('id01').style.display='block'" style="width:auto;float: right;margin-top: -12px;" >Login</a>
        <a class ="admin" onclick="document.getElementById('id02').style.display='block'" style="width: auto;float: right;margin-top: -12px">Sign Up</a>
    	  <a href="#contact">Contact</a>
    	  <a href="#about">About</a>
  		</div>
	</div>


	<div class="navbar">
  		<a href="#home">Home</a>
  		<a href="#Contact">Contact</a>
 		<div class="dropdown">
        <button class="dropbtn">Past Question
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="#">Computer Engineering</a>
         <a href="#">Electrical Engineering</a>
         <a href="#">Software Engineering</a>
         </div>
  </div>
  <div class="dropdown">
        <button class="dropbtn">Ebook
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
         </div>
  </div>
</div>

<!-- Login button................................................................................. -->
<div id="id01" class="modal">
  	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

  <!-- Modal Content -->
  	<form class="modal-content animate"  method="post" action="index.php">
      <p ><?php echo display_error();?> </p>
  	  	<div class="imgcontainer">
     	     <img src="img/user.png" alt="Avatar" class="avatar">
     	      <h2>login</h2>
    	   </div>

    <div class="container">
      <label> Username</label>
      <input type="text" placeholder="Enter Username" name="user" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <button name="login_btn" class="login_btn" type="submit">Login</button>

      <label>
        <input class = "chgeck" type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
      
    </div>
  </form>
</div>




<!-- Signup button.hover................................................................................ -->

<!-- The Modal (contains the Sign Up form) -->
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content animate" method="post" action="index.php">
    
  	<div class="imgcontainer">
     	 <img src="img/user.png" alt="Avatar" class="avatar">
     	 <h2>Sign Up</h2>
     	 <p>Please fill in this form to create an account.</p>
    	</div>
    <div class="container">
      <hr>

          <label> FullName</label>
       <input style="height:5px;" type="text" placeholder="Enter Your FullName" name="FullName" value="<?php echo $FullName; ?>" required >

       <label> Username</label>
       <input style="height:5px;" type="text" placeholder="Enter Username" name="username" value="<?php echo $username; ?>" required >

       <label for="email"><b>Email</b></label>
       <input style="height:5px;"type="text" placeholder="Enter Email" name="email" value="<?php echo $email; ?>" required>

       <label for="MobileNumber"><b>PhoneNumber</b></label>
       <input style="height:5px;"type="text" placeholder="Enter PhoneNumber" name="MobileNumber" value="<?php echo $MobileNumber; ?>" required>

       <label for="psw"><b>Password</b></label>
       <input style="height:5px;" type="password" placeholder="Enter Password" name="password_1" required>

       <label for="psw-repeat"><b>Repeat Password</b></label>
       <input style="height:5px;" type="password" placeholder="Repeat Password" name="password_2" required>
      
        <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
       </label>

        <p>By creating an account you agree to our <a href="#" style="color: dodgerblue">Terms & Privacy</a>.</p>
      <div>
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        <button name="signup_btn" class="sign_btn" type="submit">SignUp</button>
        <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
         <p ><?php echo display_error();?> </p>
        </div>
      </div>
    </div>
  </form>
</div>
<!---  ............................................................................................... ....    -->


<!-- The App Section -->
<div class="container1" style="height: 500px;">
  <div class="row1">
    <div class="column-661">
      <h1 class="xlarge-font1"><b>E-Books</b></h1>
      <h1 class="large-font1" style="color:white;"><b>Read Any Books Any Time Online</b></h1>
      <p><span style="font-size:36px; background-color: white;">Study like a pro.</span> 
    </div>
    <div class="column-331">
        <img src="img/pu2.png" width="500" height="471" style="display: block; position: relative;float: right; margin-top:-150px;">
    </div>
  </div>
</div>

<!-- Clarity Section -->
<div class="container1" style="background-image: url(img/pokhara.jpg); height: 600px;">
  <div class="row1">
    <div class="column-661">
      <h1 class="xlarge-font1"><b>Pokhara University</b></h1>
      <h1 class="large-font1" style="color:red;"><b>e-library</b></h1>
      <p><span style="font-size:24px">A revolution in Study.</span> </p>
      <button class="button" style="background-color:red">Read More</button>
    </div>
  </div>
</div>

<!-- The App Section -->
<div class="container1" >
  <div class="row1">
    <div class="column-661">
      <h1 class="xlarge-font1" style="color: white"><b>Pokhara University only eLibrary</b></h1>
      <h1 class="large-font1" style="color:black;"><b>ePUstaklaya</b></h1>
      <p><span style="font-size:36px">By team PLAB</span> 
      <button class="button">Click Here</button>
    </div>
    <div class="column-331">
        <img src="img/pu3.png" width="500" height="471" >
    </div>
  </div>
</div>
   </div>
</div>

    <hr style="color: purple;">
<?php include('includes/footer.php');?>
</body>
</html>