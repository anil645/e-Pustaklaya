
<div class="header">
  <link rel="stylesheet" type="text/css" href="styleadmin.css">
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
              <img src="user.png" width="50" height="40"  style=" align-content: center; padding-left: 20px; height: auto;">

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
        <button class="dropbtna">Category
          <i class="fa fa-caret-down"></i>
        </button>
    <div class="dropdowna-content">
      <a href = "addcategory.php">Add Category</a>
      <a href = "managecategory.php">Manage Category</a>
    </div>
   </div> 

     <div class="dropdowna">
        <button class="dropbtna">Books
          <i class="fa fa-caret-down"></i>
        </button>
       <div class="dropdowna-content">
      <a href = "addbook.php">Add Books</a>  
      <a href = "managebooks.php">Manage Books</a>
      </div>
      </div> 

     <div class="dropdowna">
        <button class="dropbtna">Publisher
          <i class="fa fa-caret-down"></i>
        </button>
    <div class="dropdowna-content">
      <a href = "addpublisher.php">Add Publisher</a>
      <a href = "managepublishers.php">Manage Publisher</a>
    </div>
      </div> 

     <div class="dropdowna">
        <button class="dropbtna">Issue Book
          <i class="fa fa-caret-down"></i>
        </button>
    <div class="dropdowna-content">
      <a href = "issuebook.php">Issue New Books</a>
      <a href = "manageissuedbooks.php">Manage Issue Books</a>
    </div>
      </div> 
      <a href="regstudents.php">Reg Students</a>
    
  </div>