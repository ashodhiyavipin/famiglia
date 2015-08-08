<?php
include("header.php");
include("dbconnection.php");

if(isset($_POST[submit]))
{
	$result = mysqli_query($con,"INSERT INTO messages (senderid,receiverid,message,status) values('$_GET[rec]','$_GET[sen]','$_POST[reply]','unread')");
}


?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
   <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
      <?php include("leftsidebar.php");?>
    </div>
      
    <div id="gallery" class="three_quarter">
 
<?php if(isset($_GET[rec]))
{	$q=0;
	$mes = mysqli_query($con, "Select * from messages where (senderid='$_GET[sen]' and receiverid='$_GET[rec]') or (senderid='$_GET[rec]' and receiverid='$_GET[sen]')");
	while($rs=mysqli_fetch_array($mes))
	{
		$pro = mysqli_query($con, "Select * from profile where profileid='$rs[senderid]'");
		$r=mysqli_fetch_array($pro);
		if($q!=$rs[senderid])
		{ 
		echo "<hr color='#E8C57B'>";
		echo "<b><div class='uppercase'> $r[firstname] </div></b>"."<br>";
		}
		if($rs[status]=='unread')
		{
		echo "<b><font color='#0000FF'>&nbsp;&nbsp;&nbsp;".$rs[message]."</font></b>"."<br>";
		}
		else
		{
			echo "&nbsp;&nbsp;&nbsp;$rs[message]<br>";
		}
		mysqli_query($con,"updte messages set status='read' where msgid='$rs[msgid]'");
		$q=$rs[senderid];
	}
} 
?>
</font>
<form name="reply" action="" method="post">
<textarea name="reply" cols="50"></textarea>
<input type="submit" name="submit" value=Reply>
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
