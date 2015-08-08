<?php
session_start(); // Developed by www.freestudentprojects.com
include("dbconnection.php");
$dttime = date("Y-m-d h:i:s");

$result = mysqli_query($con,"INSERT INTO messages (senderid,reciverid,message,conversationdate,status) values('$_SESSION[profileid]','$_GET[sendto]','$_GET[msg]','$dttime','Enabled')") ;
if(!$result)
{
	echo mysqli_error($con);
}
?>
