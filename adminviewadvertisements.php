<?php
//Databaase connection
// Function which connects to mysql database
include("dbconnection.php");
$delres = mysqli_query($con, "DELETE FROM advertisements where advtid='$_GET[delid]'");
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
<table width="1162" border="1">
<tr>
<th width="101">image</th>
<th width="265">advertisement title</th>
<th width="212">Date</th>

<th width="213">Website name</th>
<th width="108">Advertisement position</th>
<th width="103">status</th>
<th width="114">Action</th>
</tr>
<?php
// Queries to mysql database and selects records from advertisements table..
$result=mysqli_query($con,"select * from advertisements");

// all the array records stores in variable rs.
//While loop used to loop and display multiple rows from advertisements table
while($rs=mysqli_fetch_array($result))
{
	// $rs[advtname],$rs[started],$rs[ended],$rs[imagename],$rs[link],$rs[advtposition]$rs[status] are the fiels of advertisements table.
	echo"<tr>
	<td><img src='files/$rs[imagename]' width='200' height='175' ></td>
	<td>$rs[advtname]</td>
	<td>
	Start date: $rs[started] <br>
	End date: $rs[ended]</td>
	<td><a href='$rs[link]' target='blank'>$rs[link]</a></td>
	<td>$rs[advtposition]</td>
	<td>$rs[status]</td>
	<td> <a href='advertisement.php?updateid=$rs[advtid]'>Update</a>  | <a href='adminviewadvertisements.php?delid=$rs[advtid]'>delete</a></td>	
	</tr>";
}
?>
</table>
&nbsp;</p>
</section>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>&
<!-- Footer -->
<?php
include("footer.php");
?>
