<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Flash message</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"></head>
<body style=" background: url(back.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
    <div class="container">
     <div class="row">
     <div class="col-md-5 mx-auto mt-5">
     <?php if(isset($_SESSION['message'])): ?>
     <div class="alert alert-success">
     <?php echo $_SESSION['message']; ?>
     </div>
<?php endif; ?>
<?php unset($_SESSION['message']); ?>
     </div>
     </div>
    </div>
    <script>
    
    setTimeout(function() {
        let alert = document.querySelector(".alert");
            alert.remove();
    }, 3000);
    
    </script>
</body>
</html>