<?php
session_start(); // Developed by www.freestudentprojects.com
include("wallpostcodings.php");
include("dbconnection.php");

//Coding to insert comments
	if ($_GET[imgcomment] !="")
	{
		$sql="INSERT INTO comments(publishid,profileid,commenttype,comment,dattime,status)
	  VALUES('$_GET[imgid]','$_SESSION[profileid]','Image','$_GET[imgcomment]','$datetime','Enabled')";		
	  
	  if (!mysqli_query($con,$sql))
	  {
	  		die('Error: ' . mysqli_error($con));
	  }
	  else
	  {
			echo $msg ="<font color='#009900'> Comment published successfully..</font>";
	  }
	}

$resultphoto = mysqli_query($con, "SELECT * FROM  images WHERE images.imgid ='$_GET[imgid]'");
$rsphoto = mysqli_fetch_array($resultphoto);

//Comments code starts here...
$sql = "SELECT     comments.*, profile.*, wallpost.*";
$sql =  $sql . " FROM         comments LEFT OUTER JOIN";
$sql =  $sql . "   profile ON comments.profileid = profile.profileid LEFT OUTER JOIN";
$sql =  $sql . "   wallpost ON comments.publishid = wallpost.postid";
$sql =  $sql . " WHERE     (comments.publishid = '$rsphoto[imgid]') AND (comments.commenttype = 'Image') ORDER BY  comments.comentid DESC  LIMIT 0 , 3";
$result1 = mysqli_query($con, $sql);

//Query to count comments
$sqlcountonlycomments = "SELECT     comments.*, profile.*, wallpost.*";
$sqlcountonlycomments =  $sqlcountonlycomments . " FROM         comments LEFT OUTER JOIN";
$sqlcountonlycomments =  $sqlcountonlycomments . "   profile ON comments.profileid = profile.profileid LEFT OUTER JOIN";
$sqlcountonlycomments =  $sqlcountonlycomments . "   wallpost ON comments.publishid = wallpost.postid";
$sqlcountonlycomments =  $sqlcountonlycomments . " WHERE     (comments.publishid = '$rsphoto[imgid]') AND (comments.commenttype = 'Image')";
$resultcountonlycomments = mysqli_query($con, $sqlcountonlycomments);
$countcomments = mysqli_num_rows($resultcountonlycomments);
//ommnents code ends here

if($countcomments > 3)
{
echo "<hr><a href='wallpostsingle.php?wallpostsinglepostid=$rs[0]'  > <img src='images/Comments-icon.png'></img>  View all $countcomments Comments</a><hr>";
}

//$result1 = mysqli_query($con, "SELECT * FROM comments ");
while($rs1 = mysqli_fetch_array($result1))
{				
//Times ago Commentbox: Coding to compare the date
$date1 = $rs1[dattime];
$date2 = date("Y-m-d h:i:s");
$ts1 = strtotime($date1);
$ts2 = strtotime($date2);
$seconds_diff = $ts2 - $ts1;
$timesago = floor($seconds_diff/3600/24);
$hdmago =secondsToWords($seconds_diff);
//Times ago Commentbox: Coding to compare date ends here

			echo "<div class='comments info' ><li class='one_fifth'>";


//Code for comment profile image starts here
	$resultprofileimg = mysqli_query($con, "SELECT * FROM images WHERE imgid ='$rs1[8]' ");
		$rsprofileimg  = mysqli_fetch_array($resultprofileimg);	
		echo $profileimgid;
		if(mysqli_num_rows($resultprofileimg) == 0)
		{	   
			echo "<div class='one_fourth'><img src='images/profilepic.jpg' width=10 height=10  class='icon-desktop icon-3x' ></div>";
		}
		else
		{
			echo "<div class='one_fourth'><img src='uploads/$rsprofileimg[imagepath]' width=10 height=10  class='icon-desktop icon-3x' ></div>";
		}
//Code for comment profile image ends here
	
			echo "</li>
			<strong>$rs1[firstname] $rs1[lastname] </strong>wrote <a style='float: right;vertical-align:top' href='wallpost.php?delcmntid=$rs1[0]'><strong>X</strong></a><br>
			$rs1[comment] <br>";
			
//Likes Comments code starts here
$resultcmtlikes = mysqli_query($con, "SELECT * FROM likes WHERE publishid ='$rs1[0]' AND type='WallComment' ");
$wplikescmttotal  = mysqli_num_rows($resultcmtlikes);
$resultcmtlikestotal = mysqli_query($con, "SELECT * FROM likes WHERE publishid ='$rs1[0]' AND profileid='$_SESSION[profileid]' AND type='WallComment'");
$cmtlikesstatus  = mysqli_num_rows($resultcmtlikestotal);
$fetchcmtlikesstatus = mysqli_fetch_array($resultcmtlikestotal);	

if($cmtlikesstatus == 1)
{
	echo "$hdmago - <a href='wallpost.php?cmtunlikeid=$fetchcmtlikesstatus[likeid]&sessionid=$_SESSION[setid]'>Unlike</a>";
}
else
{
	echo "<br>$hdmago - <a href='wallpost.php?cmtlikeid=$rs1[0]&sessionid=$_SESSION[setid]'>Like</a>";
}
echo " - <a href='#'>$wplikescmttotal Likes</a>";
$cmtlikesstatus=0;
//Likes Comments code ends here		
echo "</div>

<hr>";
		}
?>