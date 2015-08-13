<?php
session_start();
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