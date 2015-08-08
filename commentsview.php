<?php
include("dbconnection.php");
$delres = mysqli_query($con, "DELETE FROM comments where comentid='$_GET[delid]'");
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
<table border="1">
<tr>
<th>Comment</th>
<th>Datetime</th>
<th>Status</th>

<th> action </th>
</tr>
<?php
$result = mysqli_query($con, "SELECT * FROM comments");

while($rs = mysqli_fetch_array($result))
{
echo "<tr>
<td> $rs[comment] </td>
<td> $rs[dattime] </td>
<td> $rs[status]  </td>
<td>
<a href='commentsview.php?delid=$rs[comentid]'>Delete</a></td>
</tr>";
}

?>
</table>
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
