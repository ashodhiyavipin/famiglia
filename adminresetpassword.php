<?php
include("dbconnection.php");
?>
<script type="application/javascript">
function validate()
{
 if(document.resetform.username.value=="")
	{
		alert("Please Enter value for user name");
		document.resetform.username.focus();
		return false;
	}
	else if(document.resetform.npassword.value=="")
	{
		alert("Password should not be empty");
		document.resetform.npassword.focus();
		return false;
	}
	else if(document.resetform.npassword.value.length <6 )
	{
		alert("Entered password should be more than 6 charachers");
		document.resetform.npassword.value="";
		document.resetform.cpassword.value="";
		document.resetform.npassword.focus();
		return false;
	}
	else if( document.resetform.npassword.value.length > 15)
	{
		alert("Entered password should be less than 15 character.");
		document.resetform.npassword.value="";
		document.resetform.cpassword.value="";
		document.resetform.npassword.focus();
		return false;
	}
	else if(document.resetform.npassword.value != document.resetform.cpassword.value)
	{
		alert("Password not matching..");
		document.resetform.npassword.value="";
		document.resetform.cpassword.value="";
		document.resetform.npassword.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<?php
if(isset($_POST[submit]))
{
	$sqlupd = mysqli_query($con,"UPDATE admin set password='$_POST[npassword]' where username='$_POST[username]'");
	
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
<form name="resetform" action="" method=post onsubmit="return validate()">
	

<table width="422" border="1">
<td colspan="2" align="center"><b>Reset password</b><?php echo $msg; ?></td>
<tr><td>Username</td><td><input type=text name=username /></td></tr>
<tr><td>New password</td><td><input type=password name=npassword /></td></tr>
<tr><td>Confirm password</td><td><input type=password name=cpassword /></td></tr>
<tr><td colspan="2" align="center"><center><input type="submit" name="submit" value="Reset password" /></center></td></tr>
</table>
</form>
&nbsp;</p>
</section>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>

