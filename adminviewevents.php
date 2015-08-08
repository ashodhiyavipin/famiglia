<?php
include("dbconnection.php");
$delres = mysqli_query($con, "DELETE FROM events where eventid='$_GET[delid]'");
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
<th>&nbsp;Event Date&nbsp;</th>
<th>&nbsp;Event Subject&nbsp;</th>
<th>&nbsp;Event Image&nbsp;</th>
<th>&nbsp;Event Description&nbsp;</th>
<th>&nbsp;Status&nbsp;</th>
<th>&nbsp;Action&nbsp;</th>
</tr>
<?php
$result = mysqli_query($con, "SELECT * FROM events");

while($rs = mysqli_fetch_array($result))
{
echo "<tr>

<td> $rs[eventdate] </td>
<td> $rs[eventsubject] </td><td>
<img src='uploads/$rs[eventimage]' width='200' height='175' ></td>
<td>$rs[eventdescription]</td>
<td> $rs[status]  </td>

<td>
<a href='adminviewevents.php?delid=$rs[eventid]'>Delete</a></td>
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
