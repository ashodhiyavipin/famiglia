<?php
session_start(); // Developed by www.freestudentprojects.com
?>
<script type="application/javascript">
function validate()
{
	if(document.advertiseform.aname.value == "")
	{
		alert("Please enter advertisement title..");
		document.advertiseform.aname.focus();
		return false;
	}
	else if(document.advertiseform.createddate.value=="")
	{
		alert("Please Enter start date");
		document.advertiseform.createddate.focus();
		return false;
	}
	else if(document.advertiseform.enddate.value=="")
	{
		alert("Please Enter end date");
		document.advertiseform.enddate.focus();
		return false;
	}
	else if(document.advertiseform.file.value=="")
	{
		alert("Please select image");
		document.advertiseform.file.focus();
		return false;
	}
	else if(document.advertiseform.website.value=="")
	{
		alert("Please Enter website name");
		document.advertiseform.website.focus();
		return false;
	}
	
	else
	{
		return true;
	}
}
</script>
<?php
include("dbconnection.php");
if($_FILES[file][name] == "")
{
	$filename = $_POST[imagename];
}
else
{
	$filename = rand().$_FILES[file][name];
	move_uploaded_file($_FILES["file"]["tmp_name"],"files/".$filename);
}

if($_POST[setid]==$_SESSION[setid])
{
	if (isset($_POST["submit"]))
	{
		if(isset($_GET[updateid]))
		{
			$sql = "UPDATE advertisements SET advtname='$_POST[aname]',started='$_POST[createddate]',ended='$_POST[enddate]',imagename='$filename',link='$_POST[website]',advtposition='$_POST[select]',status='$_POST[status]' where advtid='$_GET[updateid]'";
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
			$sql="INSERT INTO advertisements(advtname,started,ended,imagename,link,advtposition,status)
		VALUES('$_POST[aname]','$_POST[createddate]','$_POST[enddate]','$filename','$_POST[website]','$_POST[select]','$_POST[status]')";
			if(!mysqli_query($con,$sql))
			{
				die('Error:'.mysqli_error($con));
			}
			else
			{
				$msg="1 record added";
			}
		}
	
	}
}
	
$_SESSION[setid]=rand();

$selectrec = mysqli_query($con,"SELECT * FROM advertisements where advtid='$_GET[updateid]'");
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
<h1>Advertisement</h1>
<form name="advertiseform" action="" method="post" enctype="multipart/form-data" onsubmit="return validate()">
<table>

<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
<input type="hidden" name="imagename" value="<?php echo $rsrec[imagename]; ?>">
<tr>
  <td colspan="2" align="center">&nbsp;<?php echo $msg; ?></td>
  </tr>

<tr><td>Advertisement title</td><td><input name="aname" type=text size=30 value="<?php echo $rsrec[advtname] ; ?>"></td></tr>
<tr><td>Start date</td><td><input type="date" name="createddate" value="<?php echo $rsrec[started] ; ?>" ></td></tr>
<tr><td>End date</td><td><input type="date" name="enddate" value="<?php echo $rsrec[ended] ; ?>" ></td></tr>
<tr><td>Image</td><td><input name="file" type=file />
<img src="files/<?php echo $rsrec[imagename]; ?>" width="150" height="150" />
</td>
</tr>
<tr>
<td>Website</td><td><input  name="website" type="text" size=30  value="<?php echo $rsrec[link] ; ?>"></td></tr>
<tr><td>Advertisement position</td>
<td>
<?php
$arradvtposition = array("TOP", "BOTTOM", "RIGHT", "LEFT");
?>
<select name="select">
<?php
foreach($arradvtposition as $arr)
{
	if($arr == $rsrec[advtposition])
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
<tr><td>status:</td><td>
<?php
$arradvtstatus = array("Enabled", "Disabled");
?>
<select name="status">
<?php
foreach($arradvtstatus as $arr)
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
<tr><td colspan="2" align=center><input type=submit name=submit value="submit "/></td></tr> 


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
