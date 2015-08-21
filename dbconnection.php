<?php
// Mysql_connect function to connect database
// localhost is server name(host name) , root is username, technology is password and social networking is datbase name
$con=mysqli_connect("localhost","root","123-qwer","socialnetworking");
	// Check connection is connected or not
	if (mysqli_connect_errno())
	  {
		  //This statement executes if any error in connection 
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
  ?>
