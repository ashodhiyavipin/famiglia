<?php
include("header.php");
include("dbconnection.php")
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
    <h2>Pending Friend Request</h2>
     <?php
            $friend= mysqli_query($con, "SELECT * from friends where profileid1='$_SESSION[profileid]' and requeststatus='pending'");
			
while($rs = mysqli_fetch_array($friend))
{
	$r=mysqli_query($con, "SELECT * from profile where profileid='$rs[profileid2]'");
	$show= mysqli_fetch_array($r);
	$img=mysqli_query($con, "SELECT * from images where imgid='$show[imgid]'");
    $pic= mysqli_fetch_array($img);
    $profileimage="uploads/".$pic[imagepath];
	echo "<section class='calltoaction opt5 clear'>";
	echo "<li class='one_sixth'><img src='$profileimage' class='icon-desktop icon-6x'></li>";
	echo "<br>&nbsp;&nbsp;&nbsp;<strong>$show[firstname] $show[lastname]</strong>";	
	echo "</section>";
	echo "<hr>";
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
