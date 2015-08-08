<?php
session_start(); // Developed by www.freestudentprojects.com
if(isset($_POST['name']))
{
	//print_r($_POST);
	$_SESSION[profileid]=$_POST['name'];
	
	/*$name	=	$_POST['name'];
	$surname=	$_POST['surname'];
	$email	=	$_POST['email'];
	$about	=	$_POST['about'];
	
	$query	=	"INSERT INTO tableName(`name`,`surname`,`email`,`about`) VALUES ('$name','$surname','$email','$about')";
	
	mysql_query($query);
	*/
	
	//============You can do whatver you want to do with your form================
	
}
?>