<?php
session_start(); // Developed by www.freestudentprojects.com
include("dbconnection.php");
?>
<script type="application/javascript">
function validate()
{
	if(document.profileform.username.value == "")
	{
		alert("Please enter value for username..");
		document.profileform.username.focus();
		return false;
	}
	else if(document.profileform.Password.value=="")
	{
		alert("Password should not be empty");
		document.profileform.Password.focus();
		return false;
	}
	else if(document.profileform.Password.value.length <6 )
	{
		alert("Entered password should be more than 6 charachers");
		document.profileform.Password.value="";
		
		document.profileform.Password.focus();
		return false;
	}
	else if( document.profileform.Password.value.length > 15)
	{
		alert("Entered password should be less than 15 character.");
		document.profileform.Password.value="";
		
	document.profileform.Password.focus();
		return false;
	}
	
	else if(document.profileform.fname.value=="")
	{
		alert("Please enter value for firstname");
		document.profileform.fname.focus();
		return false;
	}
	else if(document.profileform.lname.value == "")
	{
		alert("Please enter value for lastname..");
		document.profileform.lname.focus();
		return false;
	}
	else if(document.profileform.emailid.value=="")
	{
		alert("Email ID should not be empty");
		document.profileform.emailid.focus();
		return false;
	}
	else if(document.profileform.cnumber.value==" ")
	{
		alert("Please enter contact number");
		document.profileform.cnumber.focus();
		return false;
	}
	else if(document.profileform.dob.value=="")
	{
		alert("Please enter date of birth");
		document.profileform.dob.focus();
		return false;
	}
	
	else if(document.profileform.gender.value=="")
	{
		alert("Please enter gender");
		document.profileform.gender.focus();
		return false;
	}
	else if(document.profileform.createdat.value=="")
	{
		alert("Please enter Create date");
		document.profileform.createdat.focus();
		return false;
	}
	else if(document.profileform.lastlogin.value=="")
	{
		alert("Please enter lastlogin");
		document.profileform.lastlogin.focus();
		return false;
	}
	else if(document.profileform.city.value==" ")
	{
		alert("Please enter city");
		document.profileform.city.focus();
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
			$sql = "UPDATE profile SET username='$_POST[username]',password='$_POST[Password]',firstname='$_POST[fname]',lastname='$_POST[lname]',emailid='$_POST[emailid]',dob='$_POST[dob]',gender='$_POST[gender]',status='$_POST[status]',createdat='$_POST[createdate]',lastlogin='$_POST[lastlogin]',city='$_POST[city]' where profileid='$_GET[updateid]'";
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
	
$sql="INSERT INTO profile(username,password,firstname,lastname,emailid,contactno,dob,gender,status,createdat,lastlogin,city)
	  VALUES('$_POST[username]','$_POST[Password]','$_POST[fname]','$_POST[lname]','$_POST[emailid]','$_POST[cnumber]','$_POST[dob]','$_POST[gender]','$_POST[status]','$_POST[createdat]','$_POST[lastlogin]','$_POST[city]')";		
	  
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

$sqlsel = mysqli_query($con,"SELECT * FROM profile where profileid='$_GET[updateid]'");
$rsrec = mysqli_fetch_array($sqlsel);

$_SESSION[setid]  = rand();

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

<form name="profileform" action="" method="post" enctype="multipart/form-data" onsubmit="return validate()">
<table width="385" height="389" border="1">
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
<tr>
  <td colspan="2" align="center"><strong>Profile</strong><?php echo $msg; ?></td>
  </tr>

<tr><td>User name</td><td><input name=username type=text size="30" value="<?php echo $rsrec[username] ; ?>"> </td></tr>
<tr><td>Password</td><td><input name=Password type=password size="30" value="<?php echo $rsrec[password] ; ?>" /></td>
</tr><tr><td>First name</td><td><input name=fname type=text size="30" value="<?php echo $rsrec[firstname] ; ?>" /></td></tr>
<tr><td>Last name</td><td><input name=lname type=text size="30" value="<?php echo $rsrec[lastname] ; ?>" /></td></tr>
<tr><td>Email id</td><td><input name=emailid type=text size="30"  value="<?php echo $rsrec[emailid] ; ?>"   /></td></tr>
<tr><td>Contact number</td><td><input name=cnumber type=text size="30"value="<?php echo $rsrec[contactno] ; ?>"   /></td>
</tr>
<tr><td>dob</td><td><input type="date" name="dob" value="<?php echo $rsrec[dob] ; ?>"   /></td></tr>
<tr><td>gender</td><td><input type="text" name="gender" value="<?php echo $rsrec[gender] ; ?>"   /></td></tr>
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
<tr><td>Create date</td><td><input type="datetime" name="createdat" value="<?php echo $rsrec[createdat] ; ?>" /></td></tr>
<tr><td>Last login</td><td><input type="datetime" name="lastlogin"  value="<?php echo $rsrec[lastlogin] ; ?>"/></td></tr>
<tr><td>city</td><td><input name=city type=text size="30" value="<?php echo $rsrec[city] ; ?>" /></td></tr>


<tr><td height="50" colspan="2" align="center"><input type=submit name=submit value="Submit"  /></td></tr>
</table>
</form>

&nbsp;</p>
</section>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>&
<!-- Footer -->
<?php
include("footer.php");
?>

