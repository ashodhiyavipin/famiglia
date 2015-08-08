<!DOCTYPE html>
<?php
session_start(); // Developed by www.freestudentprojects.com

include("dbconnection.php");
include("fancybox.php");
include("header.php");
?>
<script>
x=0;
$(document).ready(function(){
  $("tab-content").scroll(function(){
  });
});
</script>
<?php
if(isset($_GET[delmsgid]))
{
	$delrec=mysqli_query($con,"DELETE FROM messages WHERE msgid='$_GET[delmsgid]'");
}
if($_POST[setid]==$_SESSION[setid])
{

	if (isset($_POST["submit"]))
	{
			$result = mysqli_query($con,"INSERT INTO messages (senderid,reciverid,message,conversationdate,status) values('$_SESSION[profileid]','$_POST[sendto]','$_POST[msg]','$dttime','Enabled')");
			if(!$result)
			{
				echo mysqli_error($con);
			}
	}
}
$_SESSION[setid]  = rand();
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
<h2>Message box  <a href="fancycomposemessage.php" class="button small gradient black fancybox fancybox.ajax" style="float:right;">Compose Message</a></h2>
<!-- View Message tab starts here -->      
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->    
<div class="clear">
<div class="tab-wrapper clear tab-opt2" style="background-color:#8BC34A; border-style:groove">
<div class="one_quarter first">
<ul class="tab-nav clear">
<!--  ###################################### Tab Menu  ######################################-->
  		<?php

          $sql = "SELECT * FROM  profile where profileid !='$_SESSION[profileid]'";
		  $qmsg = mysqli_query($con,$sql);
          while($rsmsg = mysqli_fetch_array($qmsg))
			{
			  $sqlmessages = "SELECT * FROM  messages where (senderid='$rsmsg[profileid]' and reciverid='$_SESSION[profileid]') OR (senderid='$_SESSION[profileid]' and reciverid='$rsmsg[profileid]')";
			  $qmsgmessages = mysqli_query($con,$sqlmessages);
			  if(mysqli_num_rows($qmsgmessages) >= 1)
				{	
        ?>
            <li><a href='#tab-<?php echo $rsmsg[profileid]; ?>'><?php echo $rsmsg[firstname] . " " .  $rsmsg[lastname]; ?></a></li>
		<?php
				}
        	}
		?> 
<!--  ###################################### Tab Menu ends here  ######################################-->
</ul>
</div>
<div class="tab-container three_quarter" style="background-color:#FFF">
<?php
          $sql1 = "SELECT * FROM  profile where profileid !='$_SESSION[profileid]'";
		  $qmsg1 = mysqli_query($con,$sql1);
          while($rsmsg1 = mysqli_fetch_array($qmsg1))
			{
			  $sqlmessages1 = "SELECT * FROM  messages where (senderid='$rsmsg1[profileid]' and reciverid='$_SESSION[profileid]') OR (senderid='$_SESSION[profileid]' and reciverid='$rsmsg1[profileid]')";
			  $qmsgmessages1 = mysqli_query($con,$sqlmessages1);
			  if(mysqli_num_rows($qmsgmessages1) >= 1)
				{	
        ?>

<!--  ###################################### Tab Content  ######################################-->
<div id="tab-<?php echo $rsmsg1[profileid]; ?>" class="tab-content clear">
<h2>Conversation with <?php echo $rsmsg1[firstname] . " " .  $rsmsg1[lastname]; ?></h2>
 <!-- ############### View chat messages starts here ################################ -->
 <div  style="border:1px solid black;width:100%;height:100%;overflow:scroll;">
<?php
$sqlmsgloop = "SELECT * FROM  messages where (senderid='$rsmsg1[profileid]' and reciverid='$_SESSION[profileid]') OR (senderid='$_SESSION[profileid]' and reciverid='$rsmsg1[profileid]')";
$qmsgloop = mysqli_query($con,$sqlmsgloop);
while($rsmsgloop = mysqli_fetch_array($qmsgloop))
{
?>
<div class='alert-msg info' style="margin-left:2; margin-right:5">
<li class='one_fifth'>
<?php
//senderid
if($rsmsgloop[senderid] == $_SESSION[profileid])
{
	$senderid = $rsmsgloop[reciverid];
}
else
{
	$senderid = $rsmsgloop[senderid];
}
//senderid ends here

//Code to retrieve sender detail		
		$resultsender = mysqli_query($con, "SELECT * FROM profile WHERE profileid ='$rsmsgloop[senderid]' ");
		$rssender  = mysqli_fetch_array($resultsender);
//Code to rettrieve sender detail ends here

//Code to display profile image starts here
		$resultprofileimg = mysqli_query($con, "SELECT * FROM images WHERE imgid ='$rssender[imgid]' ");
		$rsprofileimg  = mysqli_fetch_array($resultprofileimg);
		
		if(mysqli_num_rows($resultprofileimg) == 0)
		{	   
			echo "<div class='one_fourth'><img src='images/profiledefault.jpg' width=10 height=10  class='icon-desktop icon-3x' ></div>";
		}
		else
		{
			echo "<div class='one_fourth'><img src='uploads/$rsprofileimg[imagepath]' width=10 height=10  class='icon-desktop icon-3x' ></div>";
		}
//Code to display profile image ends here
	
			echo "</li>
			<strong>$rssender[firstname] $rssender[lastname]</strong> wrote <a style='float: right;vertical-align:top' href='$pagename?delmsgid=$rsmsgloop[msgid]#tab-$rsmsg1[profileid]'><strong>X</strong></a><br>
			$rsmsgloop[message] ";
			 echo "<p style='float: right;vertical-align:top' >$rsmsgloop[datetime]</p>";
			 ?>
</div>
<?php
}
?>
</div>
<br />
<form name="msg" action="viewmessage.php?#tab-<?php echo $rsmsg1[profileid]; ?>" method="post">
                 <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
                 <input type="hidden" name="sendto" value="<?php echo $senderid; ?>" />
                 <textarea name="msg" cols="50"></textarea>
                 <input type="submit" value="Send Message" name="submit">
                 </form>                 
                 <br />
 <!-- ###########################View chat messages ends here############################ -->
</div>
<!--  ###################################### Tab Content ends here  ###################################### -->

		<?php
				}
					}
		?> 
</div>
</div></div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

    <!-- ################################################################################################ -->
  </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
    <!-- Footer -->
<?php
include("footer.php");
?>
