<?php
include("dbconnection.php");
if(isset($_POST[submit]))
{
	$sqlupd = mysqli_query($con,"UPDATE profile set password='$_POST[npassword]' where username='$_POST[username]' AND password='$_POST[opassword]'");
	if( mysqli_affected_rows($con) == 1)
	{
		$msg = "<br>Password updated successfully..";		
	}
	else
	{
		$msg =  "<br>Failed to update record";
	}
}

?>
<?php
include("header.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <h1>&nbsp;</h1>
      <p>
<form name=f3 action="" method=post>
<table width="422" border="1">
<tr>
  <td colspan="2" align="center"><strong>Change password</strong><?php echo $msg; ?></td>
  </tr>
<tr><td>user name:</td><td><input type=text name=username /></td></tr><br />
<tr><td>old password:</td><td><input type=password name=opassword /></td></tr>
<tr><td>new password</td><td><input type=password name=npassword /></td></tr>
<tr><td>confirm password:</td><td><input type=password name=cpassword /></td></tr>
<tr>
  <td colspan="2" align="center"><input type=submit value="Changed password" name="submit" /></td>
</tr>
</table>
</form>&nbsp;</p>
</section>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>&
<!-- Footer -->
<?php
include("footer.php");
?>

