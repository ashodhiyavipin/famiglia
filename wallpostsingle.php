<?php
session_start();
include("wallpostcodings.php");
?>

<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
		<?php echo include("leftsidebar.php"); ?>
    </div>
    <!-- ################################################################################################ -->
    
    <div class="one_half">
      <div id="respond">
      
<!-- WALL POST Message ################################3 -->
<?php
$result = mysqli_query($con,"SELECT   wallpost.*, profile.* FROM wallpost LEFT JOIN profile ON wallpost.profileid = profile.profileid where wallpost.postid='$_GET[wallpostsinglepostid]'");

while($rs = mysqli_fetch_array($result))
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

	echo "<section class='calltoaction opt1 clear'>";
	
	//Code for profile image
	$resultprofileimg = mysqli_query($con, "SELECT * FROM images WHERE imgid ='$rs[20]' ");
		$rsprofileimg  = mysqli_fetch_array($resultprofileimg);	
		echo $profileimgid;
		if(mysqli_num_rows($resultprofileimg) == 0)
		{	   
			echo "<div class='one_fifth'><img src='images/profilepic.jpg' width=10 height=10  class='icon-desktop icon-3x' ></div>";
		}
		else
		{
			echo "<div class='one_fifth'><img src='uploads/$rsprofileimg[imagepath]' width=10 height=10  class='icon-desktop icon-3x' ></div>";
		}
	//Code for profile image ends here

	   
	echo "<div class='three_quarter '>";
	if($rs[posttype] == "Video")
	{	
		echo "<b><strong><a href='#'>$rs[firstname] $rs[lastname]</a> </strong>Shared video  ";
		deleteid($rs[0]);	
		echo "<br></b>";
	}
	else if($rs[posttype] == "Photo")
	{
		echo "<b><strong><a href='#'>$rs[firstname] $rs[lastname]</a> </strong>Shared photos ";
		deleteid($rs[0]);	
		echo "<br></b>";
	}
	else if($rs[posttype] == "Wall")
	{
		echo "<b><strong><a href='#'>$rs[firstname] $rs[lastname]</a> </strong>wrote ";
		deleteid($rs[0]);	
		echo "<br></b>";
	}
			echo "<p>$rs[message]</p>";

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
			echo "<hr>$hdmago - <a href='$pagename?wallpostsinglepostid=$_GET[wallpostsinglepostid]&wallunlikeid=$fetchwplikesstatus[likeid]&sessionid=$_SESSION[setid]'>Unlike</a>";
		}
		else
		{
			echo "<hr>$hdmago - <a href='$pagename?wallpostsinglepostid=$_GET[wallpostsinglepostid]&walllikeid=$rs[0]&sessionid=$_SESSION[setid]'>Like</a>";
		}
		echo " - <a href='#'>$wplikestotal Likes</a></p>";
		
		echo "</div></section>";
//Wallpost like and Unlike link ends here		

//Comments code starts here...
$sql = "SELECT     comments.*, profile.*, wallpost.*";
$sql =  $sql . " FROM         comments LEFT OUTER JOIN";
$sql =  $sql . "   profile ON comments.profileid = profile.profileid LEFT OUTER JOIN";
$sql =  $sql . "   wallpost ON comments.publishid = wallpost.postid";
$sql =  $sql . " WHERE     (comments.publishid = $rs[0]) AND (comments.commenttype = 'Wallpost') ORDER BY  comments.comentid";
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

			echo "<div class='comments info' ><li class='one_fifth'>";


//Code for comment profile image starts here
	$resultprofileimg = mysqli_query($con, "SELECT * FROM images WHERE imgid ='$rs1[20]' ");
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
			<strong>$rs1[firstname] $rs1[lastname] </strong>wrote <a style='float: right;vertical-align:top' href='$pagename?wallpostsinglepostid=$_GET[wallpostsinglepostid]&delcmntid=$rs1[0]'><strong>X</strong></a><br>
			$rs1[comment] <br>";
			
//Likes Comments code starts here
$resultcmtlikes = mysqli_query($con, "SELECT * FROM likes WHERE publishid ='$rs1[0]' AND type='WallComment' ");
$wplikescmttotal  = mysqli_num_rows($resultcmtlikes);
$resultcmtlikestotal = mysqli_query($con, "SELECT * FROM likes WHERE publishid ='$rs1[0]' AND profileid='$_SESSION[profileid]' AND type='WallComment'");
$cmtlikesstatus  = mysqli_num_rows($resultcmtlikestotal);
$fetchcmtlikesstatus = mysqli_fetch_array($resultcmtlikestotal);	

if($cmtlikesstatus == 1)
{
	echo "$hdmago - <a href='$pagename?wallpostsinglepostid=$_GET[wallpostsinglepostid]&cmtunlikeid=$fetchcmtlikesstatus[likeid]&sessionid=$_SESSION[setid]'>Unlike</a>";
}
else
{
	echo "<br>$hdmago - <a href='$pagename?wallpostsinglepostid=$_GET[wallpostsinglepostid]&cmtlikeid=$rs1[0]&sessionid=$_SESSION[setid]'>Like</a>";
}
echo " - <a href='#'>$wplikescmttotal Likes</a>";
$cmtlikesstatus=0;
//Likes Comments code ends here		
echo "</div>";
		}
?>

<!-- Comment post with toggle box starts here  -->
<div class='comments info' >
		      <form class="rnd5" action="" method="post">
              <input type="hidden" name="comsession" value="<?php echo $_SESSION[setcommentid]; ?>" />
              <input type="hidden" name="publishid" value="<?php echo $rs[0]; ?>" />             
               <div class="form-message">
               <textarea name="commentmessage" id="commentmessage" cols="25" rows="2"></textarea>
               </div>
               <p>
				<input type="submit" value="Submit" name="submitcomment">
				&nbsp;
			  </p>
			</form>
</div>
<!-- Comment bost with toggle box ends here  -->  
<?php
}
?>     

      </div>
    </div>
    <!-- ################################################################################################ -->
    <div id="sidebar_2" class="sidebar one_quarter">
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