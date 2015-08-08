<?php
	include("dbconnection.php");
	$sql = "UPDATE images SET imagedescription='$_GET[imgdescription]' where imgid='$_GET[imgid]'";
		if(!mysqli_query($con,$sql))
		{
			die('Error:'.mysqli_error($con));
		}
		else
		{
			echo $msg1="<strong><font color='green'><br>Image description updated successfully,.</font></strong>";
		}

$resultphoto = mysqli_query($con, "SELECT * FROM  images WHERE images.imgid ='$_GET[imgid]'");
$rsphoto = mysqli_fetch_array($resultphoto);
?>
<textarea name="imgdescription" rows="3" cols="55"  style="border: none"><?php echo $rsphoto[imagedescription]; ?></textarea>