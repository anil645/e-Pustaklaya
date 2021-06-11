 <link rel="stylesheet" type="text/css" href="styleuser.css">


<div class="header">
 
    <img src="../img/pu_logo.png" alt="Avatar" width="80px" href="index.php" style=" max-width: 150px; margin-top: 5px;width: auto; margin-left: 650px; height: auto;">
    <div class="content">
            <!-- notification message -->
            <?php if (isset($_SESSION['success'])) : ?>
              <div class="error success" >
                <h3>
                  <?php 
                    echo $_SESSION['success']; 
                    unset($_SESSION['success']);
                  ?>
                </h3>
              </div>
            <?php endif ?>
            <!-- logged in user information -->
           
          </div>
        <div class="profile_info" style="top: 0; float: right; margin:-150px 10px; ">
              <img src="img/user.png" width="50" height="40"  style=" align-content: center; padding-left: 20px; height: auto;">

              <div>
                <?php  if (isset($_SESSION['user'])) : ?>
                  <strong style="color: black;"><?php echo $_SESSION['user']['username']; ?></strong>

                  <small>
                    <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
                    <br>
                   <button><a href="../index.php?logout='1'" style="border:1px solid black; align-content: center; background-color: red; color: white; font-size: 15px; ">LogMeOut</a></button> 
                  </small>

                <?php endif ?>
              </div>
            </div>
  </div>




   <div class="navbara">
      <a href="home.php">Dashboard</a>


       <div class="dropdowna">
        <button class="dropbtna">Accounts
          <i class="fa fa-caret-down"></i>
        </button>
       <div class="dropdown-contenta">
      <a href = "my-profile.php">My Profile</a>  
      <a href = "change-password.php">Change Password</a>
      </div>
      </div> 


		<a href="issuedbooks.php">Issued Books</a>
      	<a href="searchbook.php">Searchbooks</a>
  </div>