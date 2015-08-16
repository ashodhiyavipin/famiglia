<?php
session_start();
include ("dbconnection.php");
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<?php
			if ($imgpathsession == "") {
				echo "<img src='images/profilepic.jpg' class='img-thumbnail'>";
			} else {
				echo "<img src='uploads/$imgpathsession' class='img-thumbnail'>";
			}
			echo "<h2>" . $fnamesession . " " . $lnamesession . "</h2><hr>";
			?>
		</div>
		<div class="col-xs-12 col-sm-12">
			<?php
			$fri = mysqli_query($con, "SELECT * FROM friends where ((profileid1='$_SESSION[profileid]' or profileid2='$_SESSION[profileid]') and requeststatus='accepted') OR ((profileid2='$_SESSION[profileid]' or profileid1='$_SESSION[profileid]') and requeststatus='accepted')");
			?>
			    
				<h3>You have <?php echo mysqli_num_rows($fri); ?> friends</h3>
				<?php
				$friend = mysqli_query($con, "SELECT * from friends where ((profileid1='$_SESSION[profileid]' or profileid2='$_SESSION[profileid]') and requeststatus='accepted') OR ((profileid2='$_SESSION[profileid]' or profileid1='$_SESSION[profileid]') and requeststatus='accepted') ");
			
				while ($rs = mysqli_fetch_array($friend)) {
					if ($rs[profileid1] == $_SESSION[profileid]) {
						$friendsprofileid = $rs[profileid2];
					} else {
						$friendsprofileid = $rs[profileid1];
					}
					$r = mysqli_query($con, "SELECT * from profile where profileid='$friendsprofileid'");
					$show = mysqli_fetch_array($r);
					$img = mysqli_query($con, "SELECT * from images where imgid='$show[imgid]'");
					$pic = mysqli_fetch_array($img);
					$profileimage = "uploads/" . $pic[imagepath];
					if ($pic[imagepath] == "") {
						$profileimage = "images/profilepic.jpg";
					} else {
						$profileimage = "uploads/" . $pic[imagepath];
					}
					echo "<a href='viewprofile.php?friend=$friendsprofileid' '><img src='$profileimage' class='profileimg img-thumbnail'></a> &nbsp; <a href='viewprofile.php?friend=$friendsprofileid'>" . $show[firstname] . "&nbsp;" . $show[lastname] . "</a><hr></p>";
			
				}
			?>
      	</div>
      
      	<div class="col-xs-12">
        <h2>Groups</h2>
        <nav>
			<?php
			$sql = "SELECT * FROM  groups ORDER BY RAND() ";
			$qmsg = mysqli_query($con,$sql);
			$i=0;
			while($rsmsg = mysqli_fetch_array($qmsg))
				{   
							$sql1 = "SELECT * FROM  profile where profileid='$rsmsg[profileid]' ";
			 				$qmsg1 = mysqli_query($con,$sql1);
			  				$rsmsg1 = mysqli_fetch_array($qmsg1);
			
							$sql2 = "SELECT * FROM  groupmembers where groupid='$rsmsg[groupid]' ";
			 				$qmsg2 = mysqli_query($con,$sql2);
			  				$rsmsg2 = mysqli_fetch_array($qmsg2);	
							
							$sql3 = "SELECT * FROM  groupmembers where groupid='$rsmsg[groupid]' and  profileid='$_SESSION[profileid]'";
			 				$qmsg3 = mysqli_query($con,$sql3);
			  				$rsmsg3 = mysqli_fetch_array($qmsg3);
							
							if(mysqli_num_rows($qmsg3) == 1)
							{
				?>
								  <p><a href='groupwallpost.php?groupid=<?php echo $rsmsg[groupid] ?>'><strong><?php echo $rsmsg[groupname]; ?></strong></a></p>
						
			
				<?php
				}
				}
			    ?>
        </nav>
      	</div>
     </div>
   </div>
</html>