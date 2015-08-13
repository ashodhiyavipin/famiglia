<?php
session_start();
?>
<script>
x=0;
$(document).ready(function(){
  $("tab-content").scroll(function(){
  });
});
</script>
<script>
//Coding to update image description 
function postupd(imgid,imgdescription)
{
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("imgdes").innerHTML=xmlhttp.responseText;
			}
		  }
	xmlhttp.open("GET","imgdescriptionupdate.php?imgid="+imgid+"&imgdescription="+imgdescription+"",true);
	xmlhttp.send();
}
//Coding to update image description ends here

//Coding to insert comment
function postcmt(imgid,imgcomment)
{
	//document.getElementById('txtcomment').value = "";
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("imgcomment").innerHTML=xmlhttp.responseText;
			}	
		  }
	xmlhttp.open("GET","imgcmtupdate.php?imgid="+imgid+"&imgcomment="+imgcomment+"",true);
	xmlhttp.send();
	postclearme()
}
//Coding to insert comment ends here

//Coding to clear textarea starts
function postclearme()
{
	document.imagecomment.txtcomment.value = "";
}
//Coding to clear textarea ends here
</script>
<?php
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$resultphoto = mysqli_query($con, "DELETE FROM  images WHERE imgid ='$_GET[delid]'");
	header("Location: wallpost.php");
}
	$resultphoto = mysqli_query($con, "SELECT * FROM  images WHERE images.imgid ='$_GET[imgid]'");
	$rsphoto = mysqli_fetch_array($resultphoto);
?>
<div style="max-width:1000px;">

	<h2>
	<?php
	if($rsphoto[albumid] == 0)
	{
		echo "Images from Wallpost";
	}
	else
	{
		$resultalbums = mysqli_query($con, "SELECT * FROM  images WHERE images.imgid ='$_GET[imgid]'");
		$rsalbums = mysqli_fetch_array($resultalbums);
		echo $rsalbums[albumname];
	}
	?>
    </h2>
    
	<p>
<?php
    $imagedata = getimagesize("uploads/".$rsphoto[imagepath]);
	$imgwidth = $imagedata[0];
	$imgheight =$imagedata[1];
?>
<table width="950" height="500">
<tr>
  <td width="550" align="center" style="vertical-align: middle;" bgcolor="#333333" >
    <?php
if($imgwidth>600)
{
?>
    <img src='uploads/<?php echo $rsphoto[imagepath]; ?>'  style="width:600px;"  />
    <?php
}
else if($imgheight>400)
{
?>
    <img src='uploads/<?php echo $rsphoto[imagepath]; ?>'  style="height:400px;"  />
    <?php
}
else
{
?>
    <img src='uploads/<?php echo $rsphoto[imagepath]; ?>' />
    <?php
}
?>
    </td>
  <td width="388" valign="top">
    <form method="post" action="" name="imagedescription">
      <input type="hidden" name="imgid" value="<?php echo $rsphoto[imgid]; ?>" />
      <strong>Upload date:</strong> <?php echo $rsphoto[createddate]; ?> <br />
      <div id="imgdes">
        <textarea name="imgdescription" rows="2" cols="55"  style="border: none"><?php echo $rsphoto[imagedescription]; ?></textarea>
        </div>
      <input type="button" name="submit"  value="Update Image Description"  onclick="postupd(imgid.value,imgdescription.value)" />
      </form><hr />

    <!-- Comment post form starts here  -->
    
    <form method="post" action="" name="imagecomment">
      <input type="hidden" name="imgid" value="<?php echo $rsphoto[imgid]; ?>" />
        <textarea name="txtcomment" rows="2" cols="55"  style="border: none" placeholder="Enter comment here"></textarea>
      <input type="button" name="submit"  value="Post Comment"  onclick="postcmt(imgid.value,txtcomment.value)" />
      </form>
      
    <hr /> <strong>Comments:</strong>
    <!-- Comment post form ends here  -->  
    <div  id="imgcomment" style="width:100%;height:50%;overflow:scroll;">
      <?php 
	  include("imgcmtupdate.php");
	  ?>
    </div>
    </td>
</tr>
<tr>
  <td height="10" align="center" style="vertical-align: middle;" bgcolor="#333333" >&nbsp;<a href='fancyimage.php?delid=<?php echo $rsphoto[imgid]; ?>'><strong>Delete</strong></a></td>
  <td></td>
</tr>
</table>

	</p>

</div>