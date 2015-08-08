<?php
session_start(); // Developed by www.freestudentprojects.com

$datetime  = date("Y-m-d h:i:s");
if(!isset($_SESSION[profileid]))
{
	header("Location: index.php");
}
//include("header.php");
include("fancybox.php");
include("dbconnection.php");
?>
<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure?");
		if (result==true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>
<?php
// Delete function to all posts
function deleteid($delid)
{
	echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a class='close' href='$pagename?wallpostsinglepostid=$_GET[wallpostsinglepostid]&delwallpostid=$delid' onclick='return ConfirmDelete()'  style='float: right;vertical-align:top'>X</a>";
}
//Delete function to all posts ends here

//Delete Wall post query
if(isset($_GET[delwallpostid]))
{
	$delrec=mysqli_query($con,"DELETE FROM wallpost WHERE postid='$_GET[delwallpostid]'");
	$delrec=mysqli_query($con,"DELETE FROM images WHERE postid='$_GET[delwallpostid]'");
	$delrec=mysqli_query($con,"DELETE FROM videos WHERE postid='$_GET[delwallpostid]'");
}
//End delete query

//Delete Comment query
if(isset($_GET[delcmntid]))
{
	$delrec=mysqli_query($con,"DELETE FROM comments WHERE comentid='$_GET[delcmntid]'");
}
//End delete Comment query

// Function to calculate Years, Monts,Days, hours, minutes, seconds
function secondsToWords($seconds)
{
    $ret = "";
    /*** get the months ***/
    $years = intval(intval($seconds) / (365*60*60*24));
	    /*** get the months ***/
    $months = intval(intval($seconds) / (30*60*60*24));
    /*** get the days ***/
    $days = intval(intval($seconds) / (3600*24));
    /*** get the hours ***/
    $hours = (intval($seconds) / 3600) % 24;	
    /*** get the minutes ***/
    $minutes = (intval($seconds) / 60) % 60;
    /*** get the seconds ***/
    $seconds = intval($seconds) % 60;
	
	if($years> 0)
    {
        $ret = "$years years ago";
    }
	else if($months> 0)
    {
        $ret = "$months months ago";
    }
    else if($days> 0)
    {
        $ret = "$days days ago";
    }
    else if($hours > 0)
    {
        $ret = "$hours hours ago";
    }
    else if($minutes > 0)
    {
        $ret = "$minutes minutes ago";
    }
    else if ($seconds > 0) {
        $ret = "$seconds seconds ago";
    }
    else
	{
        $ret = "2 seconds ago";
    }
    return $ret;
}
// End Function to calculate Years, Monts,Days, hours, minutes, seconds



//Coding to insert WALLPOST
if($_POST[setid]==$_SESSION[setid])
{
	if (isset($_POST["submitwall"]))
	{
		$sql="INSERT INTO wallpost(profileid,message,posttype,datetime,status)
	  VALUES('$_SESSION[profileid]','$_POST[message]','Wall','$datetime','Enabled')";		
	  
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

//Coding to insert PHOTOS
if($_POST[setid]==$_SESSION[setid])
{
	if (isset($_POST["submitphotos"]))
	{
		$sql="INSERT INTO wallpost(profileid,message,posttype,datetime,status)
	  VALUES('$_SESSION[profileid]','$_POST[message]','Photo','$datetime','Enabled')";			  		
	  		if (!mysqli_query($con,$sql))
	 	 	{
	  		die('Error image wallpost: ' . mysqli_error($con));
	  		}
			$insid =  mysqli_insert_id($con);
			for($i=0;$i<count($_FILES['uploadphotos']['name']); $i++)
			{				
				$imgname = rand().$_FILES['uploadphotos']['name'][$i];
				move_uploaded_file($_FILES['uploadphotos']['tmp_name'][$i],"uploads/". $imgname);
				
				$sql="INSERT INTO images(profileid,albumid,postid,imagepath,imagedescription,datecreated,status)
	  VALUES('$_SESSION[profileid]','0','$insid','$imgname','$datetime','$datetime','Enabled')";			  		
				if (!mysqli_query($con,$sql))
				{
				die('Error photo upload: ' . mysqli_error($con));
				}
			}			

	}
}

//Coding to insert VIDEOS
if($_POST[setid]==$_SESSION[setid])
{
	if (isset($_POST["submitvideos"]))
	{
		$sql="INSERT INTO wallpost(profileid,message,posttype,datetime,status)
	  VALUES('$_SESSION[profileid]','$_POST[message]','Video','$datetime','Enabled')";			  		
	  		if (!mysqli_query($con,$sql))
	 	 	{
	  		die('Error image wallpost: ' . mysqli_error($con));
	  		}
			$insvid =  mysqli_insert_id($con);
			for($i=0;$i<count($_FILES['uploadvideo']['name']); $i++)
			{				
				$videoname = rand().$_FILES['uploadvideo']['name'];
				move_uploaded_file($_FILES['uploadvideo']['tmp_name'],"videos/". $videoname);
				
				$sql="INSERT INTO videos(profileid,postid,videopath,videodescription,datecreated,status)
	  VALUES('$_SESSION[profileid]','$insvid','$videoname','$_POST[message]','$datetime','Enabled')";			  		
				if (!mysqli_query($con,$sql))
				{
				die('Error video upload: ' . mysqli_error($con));
				}
			}			

	}
}


//Coding to insert comments
if($_POST[comsession]==$_SESSION[setcommentid])
{
	if (isset($_POST["submitcomment"]))
	{
		$sql="INSERT INTO comments(publishid,profileid,commenttype,comment,dattime,status)
	  VALUES('$_POST[publishid]','$_SESSION[profileid]','Wallpost','$_POST[commentmessage]','$datetime','Enabled')";		
	  
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

//Coding to insert likes

	if (isset($_GET["walllikeid"]) || isset($_GET["cmtlikeid"]))
	{
	
		if($_SESSION[setid]==$_GET["sessionid"])
		{
				if(isset($_GET["walllikeid"]))
				{
					$likeid = $_GET["walllikeid"];
					$cmttype="Wallpost";
				}
				else if(isset($_GET["cmtlikeid"]))
				{
					$likeid = $_GET["cmtlikeid"];
					$cmttype="WallComment";					
				}

			if(isset($_GET["walllikeid"]) || isset($_GET["cmtlikeid"]) )
			{				

					$sql="INSERT INTO likes(profileid,publishid,type,dattime,status)
				  VALUES('$_SESSION[profileid]','$likeid','$cmttype','$datetime','Enabled')";		
				  
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
	
// Coding to Unlike wallpost and comment
	
if ($_SESSION[setid]==$_GET["sessionid"] )
	{
				if(isset($_GET["wallunlikeid"]))
				{
					$likeid = $_GET["wallunlikeid"];
				}
				else if(isset($_GET["cmtunlikeid"]))
				{
					$likeid = $_GET["cmtunlikeid"];				
				}

		if(isset($_GET["wallunlikeid"]) || isset($_GET["cmtunlikeid"]) )
		{
			$sql="DELETE FROM likes where likeid='$likeid'";		
	  
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

$_SESSION[setid]  = rand();
$_SESSION[setcommentid]  = rand();
?>