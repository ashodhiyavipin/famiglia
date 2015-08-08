<?php
session_start(); // Developed by www.freestudentprojects.com
include("dbconnection.php");
?>
<script type="application/javascript">
function validate()
{
	
	if(document.loginform.username.value=="")
	{
		alert("Please Enter value for user name");
		document.loginform.username.focus();
		return false;
	}
	else if(document.loginform.password.value=="")
	{
		alert("Password should not be empty");
		document.loginform.password.focus();
		return false;
	}
	
	else
	{
		return true;
	}
}
</script>
<?php
if(isset($_SESSION[adminid]))
{
	header("Location: adminpanel.php");
}

if(isset($_POST["submit"]))
{
	$sqllogin = mysqli_query($con,"SELECT * FROM admin where username='$_POST[username]' and password='$_POST[password]'");

	if( mysqli_num_rows($sqllogin) == 1)
	{
		$rsfetch = mysqli_fetch_array($sqllogin);
		$dt= date("Y-m-d h:i:s");
		$_SESSION[lastlogin] =  $rsfetch[lastlogin];
		mysqli_query($con, "UPDATE admin SET lastlogin='$dt' WHERE adminid='$rsfetch[adminid]'");

		$_SESSION[adminid] = $rsfetch[adminid];
		header("Location: adminpanel.php");	
	}
	else
	{
		$msg =  "<br><font color='red'><strong>Failed to login..</strong></font>";
	}
}
?>
<html>
<body bgcolor="#999999">
<form name="loginform" method="post" action=""  onsubmit="return validate()" >
<br /><br /><br /><br /><br /><br /><br /><br />
<table width="399" height="195" border=1 align="center" bgcolor="#FFFFFF" >
<tr>
  <td colspan="2" align="center"><strong>&nbsp; Administrator Login</strong>&nbsp;<?php echo $msg; ?></td>
  </tr>
<tr>
  <td width="112" height="39"><strong>&nbsp; User name</strong></td><td width="240"><input name=username type=text size="30" /></td></tr>
<tr>
  <td height="38"><strong>&nbsp; Password</strong></td><td><input name=password type=password size="30" /></td></tr>
<tr><td colspan="2" align="center">
<input type=submit value=" Login  " name="submit"/></td></tr>
</table>
</form>
</body>
</html>