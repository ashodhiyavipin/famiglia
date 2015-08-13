<?php
session_start();
include("dbconnection.php");
?>
<script type="application/javascript">
function validate()
{
	if(document.commntform.comment.value == "")
	{
		alert("Please enter comment name..");
		document.commntform.comment.focus();
		return false;
	}
	else if(document.commntform.dattime.value == "")
	{
		alert("Please enter dattime..");
		document.commntform.dattime.focus();
		return false;
	}
	
	else
	{
		return true;
	}
}
</script>
<?php
if($_POST[setid]==$_SESSION[setid])
{
	if (isset($_POST["submit"]))
	{
		
			
			$sql="INSERT INTO comments(comment,dattime,status)
		VALUES('$_POST[comment]','$_POST[dattime]','$_POST[status]')";
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
<form name="commntform" method="post" action="" onsubmit="return validate()">
  <table width="385" height="288" border="1">
    

    <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
    <tr>
  <td colspan="2" align="center"><b>Comments</b><br><?php echo $msg; ?></td>
  </tr>
    <tr>
      <td>Comment</td>
      <td><input name="comment" type=text size=30 value="<?php echo $rsrec[comment] ; ?>" /></td>
    </tr>
    <tr>
      <td>Datetime</td>
      <td><input type="date" name="dattime" value="<?php echo $rsrec[dattime] ; ?>" /></td>
    </tr>
    <tr>
      <td>status:</td>
      <td><?php
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
        </select></td>
    </tr>
    <tr>
      <td colspan="2" align=center><input type=submit name=submit value="submit "/></td>
    </tr>
  </table>
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