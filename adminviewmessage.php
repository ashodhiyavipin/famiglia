<?php
include("dbconnection.php");
$delres = mysqli_query($con, "DELETE FROM messages where msgid='$_GET[delid]'");
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
<th>Senderid</th>
<th> Reciverid</th>
<th>Message</th>
<th>Conversationdate</th>
<th>Status</th>
<th> action </th>
</tr>
<?php
$result = mysqli_query($con, "SELECT * FROM messages");

while($rs = mysqli_fetch_array($result))
{
echo "<tr>
<td> $rs[senderid] </td>
<td> $rs[reciverid] </td>
<td> $rs[message]  </td>
<td> $rs[conversationdate]  </td>
<td> $rs[status]  </td>
<td>
<a href='viewmessage.php?delid=$rs[msgid]'>Delete</a></td>
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
