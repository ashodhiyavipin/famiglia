<?php
include("header.php");
include("dbconnection.php");
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
$fri = mysqli_query($con,"SELECT * FROM friends where (profileid1='$_SESSION[profileid]' or profileid2='$_SESSION[profileid]') and requeststatus='accepted'");?>
    <h2>Your friends(<?php echo mysqli_num_rows($fri)?>)</h2>
     <?php
            $friend= mysqli_query($con, "SELECT * from friends where (profileid1='$_SESSION[profileid]' or profileid2='$_SESSION[profileid]') and requeststatus='accepted'");
			?>
            <?php
while($rs = mysqli_fetch_array($friend))
{
	$r=mysqli_query($con, "SELECT * from profile where (profileid='$rs[profileid2]' or profileid='$rs[profileid1]') and profileid!='$_SESSION[profileid]'");
	$show= mysqli_fetch_array($r);
	$img=mysqli_query($con, "SELECT * from images where imgid='$show[imgid]'");
    $pic= mysqli_fetch_array($img);
    $profileimage="uploads/".$pic[imagepath];	
	echo "<section class='calltoaction opt4 clear'>";
		echo "<li class='one_sixth'><img src='$profileimage' class='icon-desktop icon-6x'></li>";
		echo "<a href='viewprofile.php?friend=$show[profileid]'>".$show[firstname]."&nbsp;$show[lastname]</a>";	
		echo "<a href='message.php?fm=$show[profileid]'><input type=button value=message class='button orange gradient'></a>";
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
