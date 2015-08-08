<?php
include("dbconnection.php");
if(isset($_POST["submit"]))
{
	$sqllogin = mysqli_query($con,"SELECT * FROM profile where username='$_POST[username]' and password='$_POST[password]'");

	if( mysqli_num_rows($sqllogin) == 1)
	{
		$msg = "<br>Logged in successfully..";		
	}
	else
	{
		$msg =  "<br><font color='red'>Failed to login..</font>";
	}
}
?>
<form method="post" action="">
<br /><br /><br /><br /><br /><br /><br /><br />
<table width="370" height="145" border=2 align="center" >
<tr>
  <td colspan="2" align="center"><strong>User Login</strong>&nbsp;<?php echo $msg; ?></td>
  </tr>
<tr>
  <td width="112" height="39"><strong>User name</strong></td><td width="240"><input name=username type=text size="30" /></td></tr>
<tr>
  <td height="38"><strong>Password</strong></td><td><input name=password type=password size="30" /></td></tr>
<tr><td colspan="2" align="center">
<input type=submit value=" Login  " name="submit"/></td></tr>
</table>
</form>
