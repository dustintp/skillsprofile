<?php
session_start();
$error=''; 
if(isset($_POST['submit'])){
	if(empty($_POST['username']) || empty($_POST['password'])){
		$error = "Username or Password is Invalid";
	}
	else
	{

		$Name=$_POST['username'];
		$Password=$_POST['password'];		

		$conn= mysql_connect("127.0.0.1", "root", "d1226605");
		
		$db= mysql_select_db('skills');
		
		$query= mysql_query("SELECT * FROM login WHERE password='$Password' AND empname='$Name'");
		$rows= mysql_num_rows($query);
		if($rows == 1){
			header("Location: test8.php");
		}
		else
		{
			$error = "Name or Passowrd is Invalid";
		}

		mysql_close($conn);
	}
}
$_SESSION["Name"]= $Name;
?>
