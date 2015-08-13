<?php
session_start();
include("dbconnection.php");
?>
<script type="application/javascript">
function validate()
{
	if(document.changform.username.value == "")
	{
		alert("Please enter value for username..");
		document.changform.username.focus();
		return false;
	}
	else if(document.changform.opassword.value=="")
	{
		alert("Password should not be empty");
		document.changform.opassword.focus();
		return false;
	}
	else if(document.changform.npassword.value=="")
	{
		alert("Password should not be empty");
		document.changform.npassword.focus();
		return false;
	}
	else if(document.changform.npassword.value.length <6 )
	{
		alert("Entered password should be more than 6 charachers");
		document.changform.npassword.value="";
		document.changform.cpassword.value="";
		document.changform.npassword.focus();
		return false;
	}
	else if( document.changform.npassword.value.length > 15)
	{
		alert("Entered password should be less than 15 character.");
		document.changform.npassword.value="";
		document.changform.cpassword.value="";
		document.changform.npassword.focus();
		return false;
	}
	else if(document.changform.npassword.value != document.changform.cpassword.value)
	{
		alert("Password not matching..");
		document.changform.npassword.value="";
		document.changform.cpassword.value="";
		document.changform.npassword.focus();
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
	$sqlupd = mysqli_query($con,"UPDATE admin set password='$_POST[npassword]' where username='$_POST[username]' AND password='$_POST[opassword]'");
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
<form name="changform" action="" method=post onsubmit="return validate()">
      <table width="422" border="1">
        <tr>
          <td colspan="2" align="center"><strong>Change password</strong><?php echo $msg; ?></td>
        </tr>
        <tr>
          <td>User name:</td>
          <td><input type=text name=username /></td>
        </tr>
        <br />
        <tr>
          <td>Old password:</td>
          <td><input type=password name=opassword /></td>
        </tr>
        <tr>
          <td>New password</td>
          <td><input type=password name=npassword /></td>
        </tr>
        <tr>
          <td>Confirm password:</td>
          <td><input type=password name=cpassword /></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type=submit value="Changed password" name="submit" /></td>
        </tr>
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