<?php
include("dbconnection.php");
$delres = mysqli_query($con, "DELETE FROM admin where adminid='$_GET[delid]'");
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
<th> Admin name</th>
<th> User name</th>
<th> E-Mail ID</th>
<th> Last login </th>
<th> Status </th>
<th> action </th>
</tr>
<?php
$result = mysqli_query($con, "SELECT * FROM admin");

while($rs = mysqli_fetch_array($result))
{
echo "<tr>
<td> $rs[adminname] </td>
<td> $rs[username] </td>
<td> $rs[adminemailid]  </td>
<td> $rs[lastlogin] </td>
<td> $rs[status] </td>
<td><a href='adminadd.php?updateid=$rs[adminid]'>update</a>|
<a href='adminsview.php?delid=$rs[adminid]'>Delete</a></td>
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
