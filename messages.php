<?php
session_start(); // Developed by www.freestudentprojects.com
include("dbconnection.php");

if($_POST[setid]==$_SESSION[setid])
{
	if (isset($_POST["submit"]))
	{
		
			
			$sql="INSERT INTO messages(senderid,reciverid,message,conversationdate,status)
		VALUES('$_POST[senderid]','$_POST[reciverid]','$_POST[message]','$_POST[conversationdate]','$_POST[status]')";
			if(!mysqli_query($con,$sql))
			{
				die('Error:'.mysqli_error($con));
			}
			else
			{
				$msg="1 record added";
			}
		}
	}
$_SESSION[setid]=rand();

?>
<?php
include("header.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <h1>&nbsp;</h1>
      <p>

<form name=commnt method=post action="">
  

    <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
   
<u> <h1><center> Messages<br><?php echo $msg; ?></center></h1></u><br>
    
     
 Senderid
      <input name="senderid" type=text size=30 value="<?php echo $rsrec[senderid] ; ?>" />
     <br> Reciverid
      <input type="text" name="reciverid" value="<?php echo $rsrec[reciverid] ; ?>" />
    
     <br> Message
      <input type="text" name="message" value="<?php echo $rsrec[message] ; ?>" />
     
    <br>Conversationdate<input type="date" name="conversationdate" value="<?php echo $rsrec[conversationdate] ; ?>" >
     
    <br> status:
     <?php
$arrcommentstatus = array("Enabled", "Disabled");
?>
        <select name="status">
          <?php
foreach($arrcommentstatus as $arr)
{
	if($arr == $rsrec[status])
	{
	echo "<option value='$arr' selected>$arr</option>";
	}
	else
	{
	echo "<option value='$arr'>$arr</option>";
	}
}
?>
        </select>
   <br> <input type=submit name=submit value="submit "/>
    
</form>
&nbsp;</p>
</section>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>
