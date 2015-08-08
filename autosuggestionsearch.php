<?php
session_start(); // Developed by www.freestudentprojects.com
include("dbconnection.php");
if($_POST)
{

$q=$_POST['searchword'];

$sql_res=mysqli_query($con,"select * from profile where firstname like '%$q%' or lastname like '%$q%' order by profileid LIMIT 5");
while($row=mysqli_fetch_array($sql_res))
{
$profileid = $row[0];	
$fname=$row['firstname'];
$lname=$row['lastname'];
//$img=$row['img'];
	
	//Coding to retrieve images
	$resultprofileimg = mysqli_query($con, "SELECT * FROM images WHERE imgid ='$row[imgid]' ");
	$rsprofileimg  = mysqli_fetch_array($resultprofileimg);
	if(mysqli_num_rows($resultprofileimg) == 0)
	{	   
		$img = "images/profilepic.jpg";
	}
	else
	{
		$img = "uploads/$rsprofileimg[imagepath]";
	}
	//Retrieve image code ends here

$city=$row['city'];

$re_fname='<b>'.$q.'</b>';
$re_lname='<b>'.$q.'</b>';

$final_fname = str_ireplace($q, $re_fname, $fname);

$final_lname = str_ireplace($q, $re_lname, $lname);


?>
<div class="display_box" align="left" >
<a href="#"  onclick="showUser(<?php echo $profileid; ?>)">
<img src="<?php echo $img; ?>" style="width:25px; float:left; margin-right:6px" /><?php echo $final_fname; ?>&nbsp;<?php echo $final_lname; ?><br/>
<span style="font-size:9px; color:#999999"><?php echo $city; ?></span>
</a>
</div>



<?php
}

}
else
{

}


?>
