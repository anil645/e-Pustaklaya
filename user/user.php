<?php
include('../connection.php');
if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location:../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>User page</title>
	<link rel="stylesheet" href="style.css">
</head>
<body style=" background: url(back.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
	
	<h1 align = "center">Welcome Users !!!</h1>
	<ul>
		<li><a href = "searchbook.html" >Search Books</a></li> |
	<li> <a href = "reserved.html">Reserved Books</a></li> |
	<li><a href = "issuedbook.html" >issued Books</a></li> |
    <li> <a href = "returnbook.html">Return Books</a></li> |
    <li><a href = "logout.html">Logout</a></li> |

</ul>
</body>
</html>