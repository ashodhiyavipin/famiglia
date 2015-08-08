<?php
session_start();
if(!isset($_SESSION[adminid]))
{
	header("Location: adminlogin.php");
}
include("header.php");
include("dbconnection.php");
$sql1 = mysqli_query($con,"SELECT * FROM wallpost WHERE posttype='wall'");
$rsrec1 = mysqli_fetch_array($sql1);

if (!result) die ("Database access failed - " . mysql_error());
$rows = mysql_num_rows($sql1);

?>

<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <h1>Wallposts by Users</h1>
      <p>
      <div class="alert-msg info">No. of wallposts registered:<?php echo mysqli_num_rows($sql1); ?></div>
      	<table border="1">
		<tr>
			<th> PostID</th>
			<th> ProfileID</th>
			<th> Message</th>
			</tr>
		<?php
		while($rs = mysqli_fetch_array($sql1))
			{
			echo "<tr>
			<td> $rs[postid] </td>
			<td> $rs[profileid] </td>
			<td> $rs[message]  </td>
			</tr>";
			}

?>
		</table>
		&nbsp;</p>
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
