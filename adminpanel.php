<?php
session_start();
if(!isset($_SESSION[adminid]))
{
	header("Location: adminlogin.php");
}
include("header.php");
include("dbconnection.php");
$sql1 = mysqli_query($con,"SELECT * FROM profile");
$rsrec1 = mysqli_fetch_array($sql1);

$sql2 = mysqli_query($con,"SELECT * FROM admin");
$rsrec2 = mysqli_fetch_array($sql2);

$sql3 = mysqli_query($con,"SELECT * FROM advertisements");
$rsrec3 = mysqli_fetch_array($sql3);


$sql4 = mysqli_query($con,"SELECT * FROM albums");
$rsrec4 = mysqli_fetch_array($sql4);

$sql5 = mysqli_query($con,"SELECT * FROM comments");
$rsrec5 = mysqli_fetch_array($sql5);

$sql6 = mysqli_query($con,"SELECT * FROM events");
$rsrec6 = mysqli_fetch_array($sql6);

$sql7 = mysqli_query($con,"SELECT * FROM friends");
$rsrec7 = mysqli_fetch_array($sql7);

$sql8 = mysqli_query($con,"SELECT * FROM groupmembers");
$rsrec8 = mysqli_fetch_array($sql8);


$sql9 = mysqli_query($con,"SELECT * FROM groups");
$rsrec9 = mysqli_fetch_array($sql9);

$sql10 = mysqli_query($con,"SELECT * FROM images");
$rsrec10 = mysqli_fetch_array($sql10);

$sql11 = mysqli_query($con,"SELECT * FROM likes");
$rsrec11 = mysqli_fetch_array($sql11);

$sql12 = mysqli_query($con,"SELECT * FROM messages");
$rsrec12 = mysqli_fetch_array($sql12);

$sql13 = mysqli_query($con,"SELECT * FROM videos");
$rsrec13 = mysqli_fetch_array($sql13);

$sql14 = mysqli_query($con,"SELECT * FROM wallpost");
$rsrec14 = mysqli_fetch_array($sql14);



?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <h1>Admin Panel </h1>
      <p>
      <div class="alert-msg info"><strong>Last Login Date and Time:</strong> <?php echo $_SESSION[lastlogin] ; ?></div>
      <div class="alert-msg info">No. of profile registered: <?php echo mysqli_num_rows($sql1); ?></div>
      <div class="alert-msg info">No. of admin registered:<?php echo mysqli_num_rows($sql2); ?></div>
      <div class="alert-msg info">No. of advertisements registered:<?php echo mysqli_num_rows($sql3); ?></div>
      <div class="alert-msg info">No. of albums registered:<?php echo mysqli_num_rows($sql4); ?></div>
      <div class="alert-msg info">No. of comments registered:<?php echo mysqli_num_rows($sql5); ?></div>
      <div class="alert-msg info">No. of events registered:<?php echo mysqli_num_rows($sql6); ?></div>
      <div class="alert-msg info">No. of friends registered:<?php echo mysqli_num_rows($sql7); ?></div>
      <div class="alert-msg info">No. of groupmembers registered:<?php echo mysqli_num_rows($sql8); ?></div>
      <div class="alert-msg info">No. of groups registered:<?php echo mysqli_num_rows($sql9); ?></div>
      <div class="alert-msg info">No. of images registered:<?php echo mysqli_num_rows($sql10); ?></div>
      <div class="alert-msg info">No. of likes registered:<?php echo mysqli_num_rows($sql11); ?></div>
      <div class="alert-msg info">No. of messages registered:<?php echo mysqli_num_rows($sql12); ?></div>
      <div class="alert-msg info">No. of videos registered:<?php echo mysqli_num_rows($sql13); ?></div>
      <div class="alert-msg info">No. of wallpost registered:<?php echo mysqli_num_rows($sql14); ?></div>
      
      </p>
</section>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>
