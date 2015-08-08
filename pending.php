<?php
include("header.php");
include("dbconnection.php");
if(isset($_GET[friend]))
			{
			$ch=$_GET[friend];
				$updrec = mysqli_query($con, "UPDATE friends SET requeststatus='accepted' where friendid='$ch'");	
						if(!$updrec)
						{
							?>
							<script type="text/javascript">
							alert("Failed to update record");
							</script>
							<?php
						}
						else
						{
							?>
							 <script type="text/javascript">
							alert("Friend Request Accepted");
							</script>
							<?php
						}
			}

?>

<!-- content -->
<div class="wrapper row3">
  <div id="container">
   <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
      <?php include("leftsidebar.php");
	  ?>
    </div>
    <div id="gallery" class="three_quarter">
    <?php
			$friend= mysqli_query($con, "SELECT * from friends where profileid2='$_SESSION[profileid]' and requeststatus='pending'");
			if(mysqli_num_rows($friend) ==0)
			{
			echo "<h2>No Pending Friend Request</h2>";
			}
			else
			{
while($rs = mysqli_fetch_array($friend))
{
	$r=mysqli_query($con, "SELECT * from profile where profileid='$rs[profileid1]'");
	$show= mysqli_fetch_array($r);

	$img=mysqli_query($con, "SELECT * from images where imgid='$show[imgid]'");
    $pic= mysqli_fetch_array($img);
    
	if($pic[imagepath] == "")
	{
		$profileimage="images/profilepic.jpg";		
	}
	else
	{
		$profileimage="uploads/".$pic[imagepath];
	}
			  $sqlnofriends= mysqli_query($con,"SELECT COUNT(*) FROM  friends where (profileid1='$show[profileid]' OR profileid2='$show[profileid]') AND requeststatus='accepted'");
		  $rsnofriends = mysqli_fetch_array($sqlnofriends);
		  
echo "<section class='calltoaction opt4 clear'>";
		echo "<li class='one_sixth'><img src='$profileimage' class='icon-desktop icon-6x'></li>";
		echo "<a href='viewprofile.php?friend=$rs[profileid2]'>&nbsp; ".$show[firstname]."&nbsp;". $show[lastname] ."</a><br>";
		if($show[city]!="")
		{
			echo "<font size='3'> &nbsp;&nbsp; <strong>CITY :</strong> ".$show[city]."</font><br>";			
		}
		else
		{
			echo "<br>";
		}
		echo "<p class='team-title'> &nbsp; No. of friends - " .$rsnofriends[0] . " </p>";
		echo "&nbsp;<a href='pending.php?friend=$rs[friendid]'><input type=button value='ACCEPT FRIEND REQUEST' class='button orange gradient'></a>";
		echo "</section>";
		echo "<hr>";
	
}
}
?>

    <!-- ################################################################################################ -->
  </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
    <!-- Footer -->
<?php
include("footer.php");
?>
