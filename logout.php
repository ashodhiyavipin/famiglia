<?php
session_start(); // Developed by www.freestudentprojects.com
if(isset($_SESSION[adminid]))
{
session_destroy();
header("Location: adminlogin.php");
}

if(isset($_SESSION[profileid]))
{
session_destroy();
header("Location: index.php");
}
?>