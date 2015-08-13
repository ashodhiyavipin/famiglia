<?php
session_start();
include("header.php");
include("dbconnection.php");
$f=mysqli_query($con,"SELECT * FROM profile where profileid='$_GET[fm]'");
$res= mysqli_fetch_array($f);
if(isset($_POST[submit]))
{
	$result = mysqli_query($con,"INSERT INTO messages (senderid,reciverid,message,status) values('$_SESSION[profileid]','$res[profileid]','$_POST[msg]','unread')");
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
    <h2>Messages</h2>
     TO:<strong><?php echo $res[firstname]?> <strong><br>
     <form name="msg" action="" method="post">
     <textarea name="msg" cols="50"></textarea>
     <input type="submit" value="Send" name="submit">
     </form>
    <!-- ################################################################################################ -->
  </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
    <!-- Footer -->
<?php
include("footer.php");
?>
