<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="layout/styles/wallpost.css">
</head>
<!-- content -->
<?php
session_start();
include("fancybox.php");
include("wallpostcodings.php");
?>
<body>
  <div class="container-fluid">
    <!-- ################################################################################################ -->
    <div class="row">
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
		<?php echo include("leftsidebar.php"); ?>
    </div>
    <!-- ################################################################################################ -->
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7">
      <h2>Wallpost</h2>
        <div class="tab-wrapper clear">
          <ul class="nav nav-pills clear">
            <li><a href="#tab-1">Wall</a></li>
            <li><a href="#tab-2">Photos</a></li>
            <li><a href="#tab-3">Videos</a></li>
          </ul>
          <div>
            <!-- Upload message -->
            <div id="tab-1" class="tab-content clear">
              <form class="rnd5" action="" method="post" onsubmit="return validate()" name="messageform">
                <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
                <div class="form-message">
                  <textarea name="message" id="message" cols="25" rows="3" placeholder="Your status update goes here..."></textarea>
                </div>
                <p><input type="submit" value="Submit" name="submitwall">&nbsp;</p>
              </form>
            </div>
            <!-- Upload Photo -->
            <div id="tab-2" class="tab-content clear">
            <form id="myUploadForm" name="myUploadForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validate1()">
              <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
                <div class="form-message">
                  <div id="uploadajax">
                  <input type="file" name="uploadphotos[]" id="uploadphotos[]" multiple="multiple"  accept="image/*"/>
                  <ul id="filelist"></ul>
                  </div>
                  <textarea name="message" id="message" cols="25" rows="2" placeholder="Your status update goes here..."></textarea>
                </div>
                <p><input type="submit" value="Submit" name="submitphotos" id="submitphotos">&nbsp;</p>
            </form>
            </div>
            <!-- Upload video -->
            <div id="tab-3" class="tab-content clear">
              <form class="rnd5" name="uploadvideos" action="" method="post" enctype="multipart/form-data"  onsubmit="return validate2()">
                <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
                  <div class="form-message">
                    <input name="uploadvideo" id="uploadvideo" type="file"  accept="video/mp4" />
                    <textarea name="message" id="message" cols="25" rows="2" placeholder="Your status update goes here..."></textarea>
                  </div>
                  <p><input type="submit" value="Submit" name="submitvideos">&nbsp;</p>
              </form>
            </div>
          </div>
      </div>
<br />
<!-- WALL POST Message ################################3 -->
<?php
$result = mysqli_query($con,"SELECT   wallpost.*, profile.* FROM wallpost LEFT JOIN profile ON wallpost.profileid = profile.profileid where wallpost.groupid='0'
ORDER BY wallpost.postid DESC");

while($rs = mysqli_fetch_array($result))
{
				if($rs[1] == $_SESSION[profileid])
			{
				$checkwp = 1;
			}
			else
			{
				$result1 = mysqli_query($con,"SELECT * from friends where (profileid1='$rs[1]' AND profileid2='$_SESSION[profileid]' and requeststatus='accepted') OR (profileid1='$_SESSION[profileid]' AND profileid2='$rs[1]' and requeststatus='accepted')");
				$checkwp = mysqli_num_rows($result1);
			}
//				echo $wallrs[1]. " " .$_SESSION[profileid];
				if($checkwp == 1)
				{

//Times ago wallpost: Coding to compare the date
$date1 = $rs[datetime];
$date2 = date("Y-m-d h:i:s");
$ts1 = strtotime($date1);
$ts2 = strtotime($date2);
$seconds_diff = $ts2 - $ts1;
$timesago = floor($seconds_diff/3600/24);
$hdmago =secondsToWords($seconds_diff);
//Times ago wallpost: Coding to compare date ends here

//Likes wallpost code starts here
$resultwplikes = mysqli_query($con, "SELECT * FROM likes WHERE publishid ='$rs[0]' AND type='Wallpost' ");
$wplikestotal  = mysqli_num_rows($resultwplikes);
$resultwplikestotal = mysqli_query($con, "SELECT * FROM likes WHERE publishid ='$rs[0]' AND profileid='$_SESSION[profileid]' AND type='Wallpost' ");
$wplikesstatus  = mysqli_num_rows($resultwplikestotal);
$fetchwplikesstatus = mysqli_fetch_array($resultwplikestotal);
//Likes wallpost code ends here

	echo "<ul class='timeline' style='list-style-type:none'> <li>";

	//Code for profile image
	$resultprofileimg = mysqli_query($con, "SELECT * FROM images WHERE imgid ='$rs[20]' ");
		$rsprofileimg  = mysqli_fetch_array($resultprofileimg);	
		echo $profileimgid;
		if(mysqli_num_rows($resultprofileimg) == 0)
		{	   
			echo "<div class='avatar'><img src='images/profilepic.jpg'></div>";
		}
		else
		{
			echo "<div class='avatar'><img src='uploads/$rsprofileimg[imagepath]'></div>";
		}
	//Code for profile image ends here

	   
	echo "<div class='bubble-container'> <div class='bubble'>";
	if($rs[posttype] == "Video")
	{	
		echo "<h3><a href='#'>$rs[firstname] $rs[lastname]</a></h3> Shared video  ";
	}
	else if($rs[posttype] == "Photo")
	{
		echo "<h3><a href='#'>$rs[firstname] $rs[lastname]</a></h3> Shared photos ";
	}
	else if($rs[posttype] == "Wall")
	{
		echo "<h3><a href='#'>$rs[firstname] $rs[lastname]</a></h3> wrote ";
	}
			echo "<p>$rs[message]</p>";
	echo"</div>";

if($rs[posttype] == "Video")
{			
	$resultvideos = mysqli_query($con, "SELECT * FROM videos WHERE postid ='$rs[0]'");
	$rsvideos = mysqli_fetch_array($resultvideos);
	echo '
	<video width="350" height="260" controls>
	  <source src="videos/'.$rsvideos[videopath].'" type="video/mp4">
	  <source src="movie.ogg" type="video/ogg">
	  <source src="movie.webm" type="video/webm">
	  <object data="videos/'.$rsvideos[videopath].'" width="320" height="240">
		<embed src="movie.swf" width="320" height="240">
	  </object> 
	</video>
	';
	
}

if($rs[posttype] == "Photo")
{	
		$resultphoto = mysqli_query($con, "SELECT * FROM  images WHERE postid ='$rs[0]'");
		if(mysqli_num_rows($resultphoto)==1)
		{
			while($rsphoto = mysqli_fetch_array($resultphoto))
			{
				echo '<a class="fancybox fancybox.ajax" href="fancyimage.php?imgid=' . $rsphoto[imgid] . '"><img src="uploads/' . $rsphoto[imagepath]. '"></a>';
			}
		}
		else if(mysqli_num_rows($resultphoto)==2 || mysqli_num_rows($resultphoto)==4)
		{
				echo '<ul class="clear">';
			$i=1;
			while($rsphoto = mysqli_fetch_array($resultphoto))
			{
				if($i==1)
				{
					echo '<li class="one_half first">&nbsp;<a class="fancybox fancybox.ajax" href="fancyimage.php?imgid=' . $rsphoto[imgid] . '"><img src="uploads/' . $rsphoto[imagepath]. '" alt=""></a></li>';
					$i=2;
				}
				else
				{					
					echo '<li class="one_half">&nbsp;<a class="fancybox fancybox.ajax" href="fancyimage.php?imgid=' . $rsphoto[imgid] . '"><img src="uploads/' . $rsphoto[imagepath]. '" alt=""></a></li>';
					$i=1;
				}
			}
				echo '</ul>';
		}

		else if(mysqli_num_rows($resultphoto)==5)
		{
			$i=1;
			while($rsphoto = mysqli_fetch_array($resultphoto))
			{
				if($i==1)
				{
				echo '<ul class="clear">';
				echo '<li class="one_half first">&nbsp;<a class="fancybox fancybox.ajax" href="fancyimage.php?imgid=' . $rsphoto[imgid] . '"><img src="uploads/' . $rsphoto[imagepath]. '" alt=""></a></li>';
				$i=2;
				}
				else if($i==2)
				{
				echo '<li class="one_half">&nbsp;<a class="fancybox fancybox.ajax" href="fancyimage.php?imgid=' . $rsphoto[imgid] . '"><img src="uploads/' . $rsphoto[imagepath]. '" alt=""></a></li>';
				echo '</ul>';
				$i=3;
				}
				else if($i==3)
				{
				echo '<ul class="clear">';
				echo '<li class="one_third first">&nbsp;<a class="fancybox fancybox.ajax" href="fancyimage.php?imgid=' . $rsphoto[imgid] . '"><img src="uploads/' . $rsphoto[imagepath]. '" alt=""></a></li>';
				$i=4;
				}
				else if($i==4)
				{				
				echo '<li class="one_third">&nbsp;<a class="fancybox fancybox.ajax" href="fancyimage.php?imgid=' . $rsphoto[imgid] . '"><img src="uploads/' . $rsphoto[imagepath]. '" alt=""></a></li>';
				$i= 5;
				}
				else
				{
				echo '<li class="one_third">&nbsp;<a class="fancybox fancybox.ajax" href="fancyimage.php?imgid=' . $rsphoto[imgid] . '"><img src="uploads/' . $rsphoto[imagepath]. '" alt=""></a></li>';  
				$i=1;
				echo '</ul>';
				}
			}

		}
		elseif(mysqli_num_rows($resultphoto)>=6 || mysqli_num_rows($resultphoto)==3 || mysqli_num_rows($resultphoto)==5)
		{
			echo '<ul class="clear">';
			$i=1;
			while($rsphoto = mysqli_fetch_array($resultphoto))
			{
				if($i==1)
				{
				echo '<li class="one_third first">&nbsp;<a class="fancybox fancybox.ajax" href="fancyimage.php?imgid=' . $rsphoto[imgid] . '"><img src="uploads/' . $rsphoto[imagepath]. '" alt=""></a></li>';
				$i=2;
				}
				else if($i==2)
				{
				echo '<li class="one_third">&nbsp;<a class="fancybox fancybox.ajax" href="fancyimage.php?imgid=' . $rsphoto[imgid] . '"><img src="uploads/' . $rsphoto[imagepath]. '" alt=""></a></li>';
				$i=3;			
				}
				else
				{
				echo '<li class="one_third">&nbsp;<a class="fancybox fancybox.ajax" href="fancyimage.php?imgid=' . $rsphoto[imgid] . '"><img src="uploads/' . $rsphoto[imagepath]. '" alt=""></a></li>';
				$i=1;
				}
			}
			echo '</ul>';
		}
}

//Wallpost like and Unlike links
		echo "<p>";
		if($wplikesstatus == 1)
		{
			echo "$hdmago <a href='wallpost.php?wallunlikeid=$fetchwplikesstatus[likeid]&sessionid=$_SESSION[setid]'>Unlike</a>";
		}
		else
		{
			echo "$hdmago <a href='wallpost.php?walllikeid=$rs[0]&sessionid=$_SESSION[setid]'>Like</a>";
		}
		echo " <a href='#'>$wplikestotal Likes</a></p>";
		deleteid($rs[0]);
		echo "</li>";
//Wallpost like and Unlike link ends here		

//Comments code starts here...
$sql = "SELECT comments.*, profile.*, wallpost.*";
$sql =  $sql . " FROM comments LEFT OUTER JOIN";
$sql =  $sql . "   profile ON comments.profileid = profile.profileid LEFT OUTER JOIN";
$sql =  $sql . "   wallpost ON comments.publishid = wallpost.postid";
$sql =  $sql . " WHERE     (comments.publishid = $rs[0]) AND (comments.commenttype = 'Wallpost') ORDER BY  comments.comentid DESC";
$result1 = mysqli_query($con, $sql);

//Query to count comments
$sqlcountonlycomments = "SELECT     comments.*, profile.*, wallpost.*";
$sqlcountonlycomments =  $sqlcountonlycomments . " FROM         comments LEFT OUTER JOIN";
$sqlcountonlycomments =  $sqlcountonlycomments . "   profile ON comments.profileid = profile.profileid LEFT OUTER JOIN";
$sqlcountonlycomments =  $sqlcountonlycomments . "   wallpost ON comments.publishid = wallpost.postid";
$sqlcountonlycomments =  $sqlcountonlycomments . " WHERE     (comments.publishid = $rs[0]) AND (comments.commenttype = 'Wallpost')";
$resultcountonlycomments = mysqli_query($con, $sqlcountonlycomments);
$countcomments = mysqli_num_rows($resultcountonlycomments);
//ommnents code ends here


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

			echo "<li><div class='avatar'>";


//Code for comment profile image starts here
	$resultprofileimg = mysqli_query($con, "SELECT * FROM images WHERE imgid ='$rs1[20]' ");
		$rsprofileimg  = mysqli_fetch_array($resultprofileimg);	
		echo $profileimgid;
		if(mysqli_num_rows($resultprofileimg) == 0)
		{	   
			echo "<img src='images/profilepic.jpg'>";
		}
		else
		{
			echo "<img src='uploads/$rsprofileimg[imagepath]'> </div>";
		}
//Code for comment profile image ends here
	
			echo "<div class='bubble-container'>
				<div class='bubble'><h4>$rs1[firstname] $rs1[lastname]</h4> commented <br /> $rs1[comment] <br /> </div>";
			
//Likes Comments code starts here
$resultcmtlikes = mysqli_query($con, "SELECT * FROM likes WHERE publishid ='$rs1[0]' AND type='WallComment' ");
$wplikescmttotal  = mysqli_num_rows($resultcmtlikes);
$resultcmtlikestotal = mysqli_query($con, "SELECT * FROM likes WHERE publishid ='$rs1[0]' AND profileid='$_SESSION[profileid]' AND type='WallComment'");
$cmtlikesstatus  = mysqli_num_rows($resultcmtlikestotal);
$fetchcmtlikesstatus = mysqli_fetch_array($resultcmtlikestotal);	

if($cmtlikesstatus == 1)
{
	echo "<p> $hdmago - <a href='wallpost.php?cmtunlikeid=$fetchcmtlikesstatus[likeid]&sessionid=$_SESSION[setid]'>Unlike</a>";
}
else
{
	echo "<br>$hdmago - <a href='wallpost.php?cmtlikeid=$rs1[0]&sessionid=$_SESSION[setid]'>Like</a>";
}
echo " - <a href='#'>$wplikescmttotal Likes</a> ";
echo "<a href='wallpost.php?delcmntid=$rs1[0]'><strong>Delete</strong></a> </p>";
$cmtlikesstatus=0;
//Likes Comments code ends here		
echo "</div>";
		} ?>

<div class='comment-container' >
          <form class="rnd5" action="" method="post">
                    <input type="hidden" name="comsession" value="<?php echo $_SESSION[setcommentid]; ?>" />
                    <input type="hidden" name="publishid" value="<?php echo $rs[0]; ?>" />             
                    <textarea name="commentmessage" id="commentmessage" cols="25" rows="4" placeholder="Type your comments here..."></textarea>
                    <input type="submit" value="Submit" name="submitcomment">
        </form>
</div>

<?php 
echo " </li> </ul>";
?>
<!-- Comment post with toggle box starts here  -->
<!-- <div class='comments info' >
		      <form class="rnd5" action="" method="post">
                  	<input type="hidden" name="comsession" value="<?php echo $_SESSION[setcommentid]; ?>" />
                  	<input type="hidden" name="publishid" value="<?php echo $rs[0]; ?>" />             
                  	<textarea name="commentmessage" id="commentmessage" cols="25" rows="2"></textarea>
                    <input type="submit" value="Submit" name="submitcomment">
				</form>
</div> -->
<!-- Comment post with toggle box ends here  -->  
<?php
	}
}
?>
</div>
    <!-- ################################################################################################ -->
    <div class="hidden-xs hidden-sm hidden-md col-lg-2">
    <?php
	include("rightsidebar.php");
	?>
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>
</body>
</html>