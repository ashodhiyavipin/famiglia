<!doctype html>
<head>
	<link href="layout/styles/fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
	<style>
	* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
}

body {
  font-family: 'Quicksand';
  color: #7f8c8d;
  font-size: 14px;
  background-color: #ededed; }

.bubble {
  width: 100%;
  padding: .5em 1em;
  line-height: 1.4em;
  padding: 20px;
  background-color: #ecf0f1;
  position: relative;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  -ms-border-radius: 8px;
  -o-border-radius: 8px;
  border-radius: 8px;
  text-align: left;
  display: inline-block; }
  .bubble:hover > .over-bubble {
    opacity: 1; }

.bubble-container {
  width: 75%;
  display: block;
  position: relative;
  padding-left: 20px;
  vertical-align: top;
  display: inline-block; }

.arrow {
  content: '';
  display: block;
  position: absolute;
  left: 12px;
  bottom: 25%;
  height: 0;
  width: 0;
  border-top: 20px solid transparent;
  border-bottom: 20px solid transparent;
  border-right: 20px solid #ecf0f1; }

.timeline {
  width: 560px;
  display: block;
  margin: auto;
  background-color: #dde1e2;
  padding-bottom: 2em;
  -webkit-box-shadow: #bdc3c7 0 5px 5px;
  -moz-box-shadow: #bdc3c7 0 5px 5px;
  box-shadow: #bdc3c7 0 5px 5px;
  -moz-border-radius-bottomleft: 8px;
  -webkit-border-bottom-left-radius: 8px;
  border-bottom-left-radius: 8px;
  -moz-border-radius-bottomright: 8px;
  -webkit-border-bottom-right-radius: 8px;
  border-bottom-right-radius: 8px;
  margin-bottom: 2em; }
  .timeline li {
    padding: 1em 0; }
  .timeline li:nth-child(even) {
    background-color: #d3d7d8; }

.avatar {
  width: 18%;
  display: inline-block;
  vertical-align: top;
  position: relative;
  overflow: hidden;
  margin-left: 2%; }
  .avatar img {
    width: 100%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid #ecf0f1;
    position: relative; }
  .avatar:hover > .hover {
    cursor: pointer;
    opacity: 1; }

.hover {
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: #3498db;
  top: 0;
  font-size: 1.8em;
  border: 5px solid #5cc0ff;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  -o-border-radius: 50%;
  border-radius: 50%;
  text-align: center;
  color: white;
  padding-top: 24%;
  opacity: 0;
  font-family: 'FontAwesome';
  font-weight: 300;
  -webkit-transition-property: all;
  -moz-transition-property: all;
  -o-transition-property: all;
  transition-property: all;
  -webkit-transition-duration: 0.5s;
  -moz-transition-duration: 0.5s;
  -o-transition-duration: 0.5s;
  transition-duration: 0.5s;
  -webkit-transition-timing-function: ease;
  -moz-transition-timing-function: ease;
  -o-transition-timing-function: ease;
  transition-timing-function: ease; }

.first {
  width: 560px;
  display: block;
  margin: auto;
  background-color: #3498db;
  text-shadow: #2084c7 1px 1px 0;
  padding: 1em 0 !important;
  color: white;
  text-align: center;
  margin-top: 1em;
  font-family: "Lato";
  font-size: 1.6em;
  -moz-border-radius-topleft: 8px;
  -webkit-border-top-left-radius: 8px;
  border-top-left-radius: 8px;
  -moz-border-radius-topright: 8px;
  -webkit-border-top-right-radius: 8px;
  border-top-right-radius: 8px;
  position: relative; }

.icon-twitter {
  font-size: 1.5em; }

.new {
  position: absolute;
  right: 5%; }

.over-bubble {
  line-height: 1.4em;
  padding-top: 10%;
  background-color: rgba(236, 240, 241, 0.8);
  position: relative;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  -ms-border-radius: 8px;
  -o-border-radius: 8px;
  border-radius: 8px;
  text-align: center;
  display: inline-block;
  position: absolute !important;
  height: 100%;
  width: 100%;
  opacity: 0;
  top: 0;
  left: 0;
  z-index: 999;
  -webkit-transition-property: all;
  -moz-transition-property: all;
  -o-transition-property: all;
  transition-property: all;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-timing-function: ease-in;
  -moz-transition-timing-function: ease-in;
  -o-transition-timing-function: ease-in;
  transition-timing-function: ease-in;
  font-size: 2.8em;
  text-shadow: white 1px 1px 0; }

.action {
  margin-right: .3em;
  -webkit-transition-property: all;
  -moz-transition-property: all;
  -o-transition-property: all;
  transition-property: all;
  -webkit-transition-duration: 0.2s;
  -moz-transition-duration: 0.2s;
  -o-transition-duration: 0.2s;
  transition-duration: 0.2s;
  -webkit-transition-timing-function: ease-in;
  -moz-transition-timing-function: ease-in;
  -o-transition-timing-function: ease-in;
  transition-timing-function: ease-in; }

.icon-star {
  -webkit-transition-property: all;
  -moz-transition-property: all;
  -o-transition-property: all;
  transition-property: all;
  -webkit-transition-duration: 0.2s;
  -moz-transition-duration: 0.2s;
  -o-transition-duration: 0.2s;
  transition-duration: 0.2s;
  -webkit-transition-timing-function: ease;
  -moz-transition-timing-function: ease;
  -o-transition-timing-function: ease;
  transition-timing-function: ease; }
  .icon-star:hover {
    cursor: pointer;
    color: #f39c12; }

.icon-retweet {
  -webkit-transition-property: all;
  -moz-transition-property: all;
  -o-transition-property: all;
  transition-property: all;
  -webkit-transition-duration: 0.2s;
  -moz-transition-duration: 0.2s;
  -o-transition-duration: 0.2s;
  transition-duration: 0.2s;
  -webkit-transition-timing-function: ease;
  -moz-transition-timing-function: ease;
  -o-transition-timing-function: ease;
  transition-timing-function: ease; }
  .icon-retweet:hover {
    cursor: pointer;
    color: #16a085; }

.icon-mail-reply {
  -webkit-transition-property: all;
  -moz-transition-property: all;
  -o-transition-property: all;
  transition-property: all;
  -webkit-transition-duration: 0.2s;
  -moz-transition-duration: 0.2s;
  -o-transition-duration: 0.2s;
  transition-duration: 0.2s;
  -webkit-transition-timing-function: ease;
  -moz-transition-timing-function: ease;
  -o-transition-timing-function: ease;
  transition-timing-function: ease; }
  .icon-mail-reply:hover {
    cursor: pointer;
    color: #3498db; }

h3 {
  font-size: 1.2em;
  font-weight: bold;
  font-family: 'Lato';
  display: inline-block;
  margin-bottom: .2em;
  color: #95a5a6; }

.retweet {
  position: absolute;
  opacity: 1;
  top: 0;
  right: 1em;
  display: block;
  background-color: #16a085;
  padding: 4px;
  -moz-border-radius-bottomleft: 5px;
  -webkit-border-bottom-left-radius: 5px;
  border-bottom-left-radius: 5px;
  -moz-border-radius-bottomright: 5px;
  -webkit-border-bottom-right-radius: 5px;
  border-bottom-right-radius: 5px; }
  .retweet .icon-retweet {
    color: white;
    margin: auto;
    width: 100%;
    display: block;
    font-size: 1.2em; }


	</style>
</head>
<?php
session_start();
include("fancybox.php");
include("wallpostcodings.php");
?>
<!-- content -->
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
          <ul class="tab-nav clear">
            <li><a href="#tab-1">Wall</a></li>
            <li><a href="#tab-2">Photos</a></li>
            <li><a href="#tab-3">Videos</a></li>
          </ul>
          <div class="tab-container">
            		<!-- Upload message -->
            		<div id="tab-1" class="tab-content clear">
            		        <form class="rnd5" action="" method="post" onsubmit="return validate()" name="messageform">
                            <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
                          	
                            <div class="form-message">
            				<textarea name="message" id="message" cols="25" rows="3"></textarea>
          					</div>
          					<p>
            				<input type="submit" value="Submit" name="submitwall">
            				&nbsp;
          					</p>
       						</form>
            		</div>
                    <!-- Upload Photo -->
                    <div id="tab-2" class="tab-content clear">
                            <form id="myUploadForm" name="myUploadForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validate1()">
                            <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">                            
                              <div class="form-message">
                              <div id="uploadajax">
                              <input type="file" name="uploadphotos[]" id="uploadphotos[]" multiple="multiple"  accept="image/*"/>
                              	<ul id="filelist">
                                
								</ul>
                              </div>
                             <textarea name="message" id="message" cols="25" rows="2"></textarea>
                              </div>
                              <p>
                                <input type="submit" value="Submit" name="submitphotos" id="submitphotos">
                                &nbsp;
                              </p>
                            </form>
            		</div>
                    
                    <!-- Upload video -->
                    <div id="tab-3" class="tab-content clear">
                            <form class="rnd5" name="uploadvideos" action="" method="post" enctype="multipart/form-data"  onsubmit="return validate2()">
                    		<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
                              <div class="form-message">
                               <input name="uploadvideo" id="uploadvideo" type="file"  accept="video/mp4" />
                                <textarea name="message" id="message" cols="25" rows="2"></textarea>
                              </div>
                              <p>
                                <input type="submit" value="Submit" name="submitvideos">
                                &nbsp;
                              </p>
                            </form>
                            
            		</div>
            		<!-- / Tab Content -->
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
		}
echo " </li> </ul>";
?>
<!-- Comment post with toggle box starts here  -->
<div class='comments info' >
		      <form class="rnd5" action="" method="post">
                  	<input type="hidden" name="comsession" value="<?php echo $_SESSION[setcommentid]; ?>" />
                  	<input type="hidden" name="publishid" value="<?php echo $rs[0]; ?>" />             
                  	<textarea name="commentmessage" id="commentmessage" cols="25" rows="2"></textarea>
                    <input type="submit" value="Submit" name="submitcomment">
				</form>
</div>
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