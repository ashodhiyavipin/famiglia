<?php
session_start(); // Developed by www.freestudentprojects.com
include("dbconnection.php");
  
if($_POST[setid] == $_SESSION[setid]) // condition to refresh browser
{
	if(isset($_POST["submit"])) // condition to submit button
	{
	$sql="INSERT INTO albums (albumname,albumdescription,date,status) VALUES('$_POST[albumname]','$_POST[description]','$_POST[createddate]','$_POST[status]')";
	
		if (!mysqli_query($con,$sql))
		{
		die('Error: ' . mysqli_error($con));
		}
		else
		{
		$msg  ="1 record added";
		}
	}
}
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
<form name=f3 action="" method=post>
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
<table width="447" >
<tr>
  <td colspan="2" align="center" >&nbsp;<b>Albums</b><?php echo $msg; ?></td>
  </tr>
<tr><td width="200" >Album name</td><td width="221" ><input typ=text name=albumname /></td></tr>
<tr><td>Description</td><td><textarea name=description rows=10 cols=15></textarea></td></tr>
<tr><td>Date</td><td>
<input type="date" name="createddate" />
 
</td></tr>
<tr><td>Status</td><td><select name=status>
<option>Enabled</option>
<option>Disabled</option>

</select></td></tr>
<tr><td><input type=submit name=submit value=submit /></td></tr>
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
