<?php
include("header.php");
include("dbconnection.php");
$ch="$_GET[search]";
$s= mysqli_query($con,"SELECT * from profile where username like '%$ch%' or firstname like '%$ch%' or lastname like '%$ch%'");
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
    <h2>Your friends</h2>
     <?php
            
 while($rs=mysqli_fetch_array($s))
    {
	
		$img=mysqli_query($con, "SELECT * from images where imgid='$rs[imgid]'");
    	$pic= mysqli_fetch_array($img);
    	$profileimage="uploads/".$pic[imagepath];
		echo "<section class='calltoaction opt4 clear'>";
		echo "<li class='one_sixth'><img src='$profileimage' class='icon-desktop icon-6x'></li>";
		echo $rs[username]."&nbsp;&nbsp;&nbsp;".$rs[firstname]."&nbsp;&nbsp;&nbsp;".$rs[lastname];
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