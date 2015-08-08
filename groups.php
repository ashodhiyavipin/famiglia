<?php
session_start(); // Developed by www.freestudentprojects.com
include("dbconnection.php");

  
if($_POST[setid] == $_SESSION[setid])
{
	if(isset($_POST["submit"])) 
	{
			if(isset($_GET[updateid]))
			{
				$sql = "UPDATE groups SET groupname='$_POST[groupname]',groupdescription='$_POST[description]',status='$_POST[status]' where groupid='$_GET[updateid]'";
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
			
		 $sql="INSERT INTO groups (groupname,groupdescription,status)
		 VALUES('$_POST[groupname]','$_POST[description]','$_POST[status]')";
		 
				  if (!mysqli_query($con,$sql))
				  {
					die('Error: ' . mysqli_error($con));
				  }
				  else
				  {
				$msg =  "<br>1 record added";
				  }
			}
	}
}
$_SESSION[setid]=rand();
$selectrec = mysqli_query($con,"SELECT * FROM groups where groupid='$_GET[updateid]'");
$rsrec = mysqli_fetch_array($selectrec);
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
<table width="297">
<form name=f2 action="" method=post>
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
<h1>Groups</h1>
<tr>
  <td colspan="2" align="center">&nbsp;<?php echo $msg; ?></td>
  </tr>
<tr><td>Group name</td><td><input type=text name=groupname value="<?php echo $rsrec[groupname] ; ?>" /></td></tr>
<tr><td>Description</td><td><textarea name=description rows=10 cols=15><?php echo $rsrec[groupdescription] ; ?></textarea></td></tr>
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

<tr><td colspan="2" align="center"><input type=submit name=submit value=submit /></td></tr>
</form>
</table>
</body>
</html>
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
