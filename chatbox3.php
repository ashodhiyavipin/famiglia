<?php
session_start(); // Developed by www.freestudentprojects.com
include("dbconnection.php");
//$sqlmsgloop = "SELECT * FROM  messages where ((senderid='12' and reciverid='21') OR (senderid='21' and reciverid='12')) ";
$sqlmsgloop = "SELECT * FROM  messages where (senderid='$_SESSION[chat3]' and reciverid='$_SESSION[profileid]') OR (senderid='$_SESSION[profileid]' and reciverid='$_SESSION[chat3]')";
$qmsgloop = mysqli_query($con,$sqlmsgloop);
while($rsmsgloop = mysqli_fetch_array($qmsgloop))
{

?>
<div>
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
		<strong><font color='red'>$rssender[firstname] $rssender[lastname]</font></strong><br>
		<font color='black'>$rsmsgloop[message]</font> <hr>";
		 ?>
</div>
<?php
}
?>

  