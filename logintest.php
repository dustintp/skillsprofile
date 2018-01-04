<?php
session_start();
include("loginserv.php");
?>
<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="logintest.css" />
<title>Login</title>
</head>

<body>
 
<div class="login">
<form action="" method="post">
<input type="text" placeholder="username" id="username" name="username"> 
<input type="password" placeholder="password" id="password" name="password"> 
<input type="submit" value="LOGIN" name="submit"><br>
<a href="#" class="forgot">Register</a> |
<a href="#" class="Forgot">Forgot Password?</a>
<span><?php echo $error; ?></span>

</body>
</html>
