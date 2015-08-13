<?php
session_start();
include("dbconnection.php");
?>
<script type="application/javascript">
function validate()
{
	if(document.adminform.adminname.value == "")
	{
		alert("Please enter admin name..");
		document.adminform.adminname.focus();
		return false;
	}
	else if(document.adminform.username.value=="")
	{
		alert("Please Enter value for user name");
		document.adminform.username.focus();
		return false;
	}
	else if(document.adminform.Password.value=="")
	{
		alert("Password should not be empty");
		document.adminform.Password.focus();
		return false;
	}
	else if(document.adminform.Password.value.length <6 )
	{
		alert("Entered password should be more than 6 charachers");
		document.adminform.Password.value="";
		document.adminform.confirmpassword.value="";
		document.adminform.Password.focus();
		return false;
	}
	else if( document.adminform.Password.value.length > 15)
	{
		alert("Entered password should be less than 15 character.");
		document.adminform.Password.value="";
		document.adminform.confirmpassword.value="";
		document.adminform.Password.focus();
		return false;
	}
	else if(document.adminform.Password.value != document.adminform.confirmpassword.value)
	{
		alert("Password not matching..");
		document.adminform.Password.value="";
		document.adminform.confirmpassword.value="";
		document.adminform.Password.focus();
		return false;
	}
	else if(document.adminform.email.value=="")
	{
		alert("Email ID should not be empty");
		document.adminform.email.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<?php
if($_POST[setid]==$_SESSION[setid])
{
	if (isset($_POST["submit"]))
	{
		if(isset($_GET[updateid]))
		{
			$sql = "UPDATE admin SET adminname='$_POST[adminname]',username='$_POST[username]',password='$_POST[Password]',adminemailid='$_POST[emailid]',status='$_POST[status]' where adminid='$_GET[updateid]'";
			if(!mysqli_query($con,$sql))
			{
				die('Error:'.mysqli_error($con));
			}
			else
			{
				$msg="1 record updated";
			}
		}
		else
		{

	  $sql="INSERT INTO admin(adminname,username,password,adminemailid,status)
	  values ('$_POST[adminname]','$_POST[username]','$_POST[Password]','$_POST[emailid]','$_POST[status]')";
	  if (!mysqli_query($con,$sql))
	  {
	  die('Error: ' . mysqli_error($con));
	  }
	  else
	  {
	$msg ="<br> 1 record added";
	  }
	}
}
}
$_SESSION[setid]  = rand();
$selectrec = mysqli_query($con,"SELECT * FROM admin where adminid='$_GET[updateid]'");
$rsrec = mysqli_fetch_array($selectrec);

include("header.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <h1>&nbsp;Add/Edit Administrator</h1>
      <p>
      
<form name="adminform" action="" method="post" onsubmit="return validate()" >
<table width="385" height="288" border="1">
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
<tr>
  <td colspan="2" align="center"><b>Add admin</b><?php echo $msg; ?></td>
  </tr>
<tr><td width="132">Admin name</td><td width="237"><input name=adminname type=text size="30" value="<?php echo $rsrec[adminname] ; ?>">   </td></tr>
<tr><td>User name</td><td><input name=username type=text size="30" value="<?php echo $rsrec[username] ; ?>"> </td></tr>
<tr><td>Password</td><td><input name=Password type=password size="30" value="<?php echo $rsrec[password] ; ?>">  </td></tr>
<tr><td>Confirm password</td><td><input name=confirmpassword type=password value="<?php echo $rsrec[password] ; ?>" size="30" /></td></tr>
<tr><td>Email id</td><td><input name=emailid type="email" size="30"value="<?php echo $rsrec[adminemailid] ; ?>">  </td></tr>
<tr><td>status:</td><td>
<?php
$arradminstatus = array("Enabled", "Disabled");
?>
<select name="status">
  <?php
foreach($arradminstatus as $arr)
{
	if($arr == $rsrec[status])
	{
	echo "<option value='$arr' selected>$arr</option>";
	}
	else
	{
	echo "<option value='$arr'>$arr</option>";
	}
}
?>
</select></td></tr>

<tr><td colspan="2" align="center"><input type=submit name=submit value=Submit /></td></tr>
</table>
</form>
</p>
</section>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>
