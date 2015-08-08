<?php
session_start();
if(!isset($_SESSION[adminid]))
{
	header("Location: adminlogin.php");
}
include("header.php");
include("dbconnection.php");
$sql1 = mysqli_query($con,"SELECT * FROM videos");
$rsrec1 = mysqli_fetch_array($sql1);

?>

<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <h1>Wallposts by Users</h1>
      <p>
      <div class="alert-msg info">No. of videos registered:<?php echo mysqli_num_rows($sql1); ?></div>
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
