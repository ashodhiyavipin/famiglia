<?php
include("dbconnection.php");
$delres = mysqli_query($con, "DELETE FROM groups where groupid='$_GET[delid]'");
?>
<?php
include("header.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <h1>Groups</h1>
      <p>

<table border="1">
<tr>
<th> Group name</th>
<th> Group description</th>
<th> Status </th>
<th> Action </th>
</tr>
<?php
$result = mysqli_query($con, "SELECT * FROM groups");

while($rs = mysqli_fetch_array($result))
{
echo "<tr>
<td> $rs[groupname] </td>
<td> $rs[groupdescription] </td>
<td> $rs[status]  </td>
<td><a href='groups.php?updateid=$rs[groupid]'>update</a>|
<a href='adminviewgroups.php?delid=$rs[groupid]'>Delete</a></td>
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
