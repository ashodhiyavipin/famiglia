<?php
include("dbconnection.php");
$delres = mysqli_query($con, "DELETE FROM profile where profileid='$_GET[delid]'");
?>
<?php
include("header.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <div class="alert-msg info">
<form method="post" action="">

     <div class="form-input clear">
              <label class="one_half first" for="author">
              Search profile: <br>
             <input type="text" name="profilehint" id="profilehint" />
              </label>
              <label class="one_half" for="email">
              &nbsp; <br>
                 <select name="searchtype" id="searchtype">
    <option>Select	</option>
    <option value="Username">Username</option>
    <option value="Name">Name</option>
    <option value="Emailid">Email ID</option>
  </select>
  <input type="submit" name="Searchprofile" id="Search profile" value="Submit" />
              </label>
            </div>

</form>
</div>
<table border="1">
<tr>
<th>&nbsp;Username&nbsp;</th>
<th>&nbsp;Password&nbsp;</th>
<th>&nbsp;First Name&nbsp;</th>
<th>&nbsp;Last Name&nbsp;</th>
<th>&nbsp;Emai Id&nbsp;</th>
<th>&nbsp;Contact Number&nbsp;</th>
<th>&nbsp;DOB&nbsp;</th>
<th>&nbsp;Status&nbsp;</th>
<th>&nbsp;Sign Up Date&nbsp;</th>
<th>&nbsp;Last login&nbsp;</th>
<th>&nbsp;City&nbsp;</th>
<th>&nbsp;Action&nbsp;</th>
</tr>
<?php
if($_POST[searchtype] == "Username" )
{
	$result = mysqli_query($con, "SELECT * FROM profile where username='$_POST[profilehint]'");
}
else if($_POST[searchtype] == "Name" )
{
	$result = mysqli_query($con, "SELECT * FROM profile where (firstname LIKE '$_POST[profilehint]%' OR lastname LIKE '$_POST[profilehint]%')");
}
else if($_POST[searchtype] == "Emailid" )
{
	$result = mysqli_query($con, "SELECT * FROM profile where emailid='$_POST[profilehint]'");
}

else 
{
	$result = mysqli_query($con, "SELECT * FROM profile");	
}

while($rs = mysqli_fetch_array($result))
{
echo "<tr>
<td> $rs[username] </td>
<td> $rs[password] </td>
<td> $rs[firstname]  </td>
<td> $rs[lastname]  </td>
<td> $rs[emailid]  </td>
<td> $rs[contactno]  </td>
<td> $rs[dob]  </td>
<td> $rs[status]  </td>
<td> $rs[createdat]  </td>
<td> $rs[lastlogin]  </td>
<td> $rs[city]  </td>
<td><a href='adminuserprofile.php?updateid=$rs[profileid]'>Update</a>|
<a href='adminviewprofile.php?delid=$rs[profileid]'>Delete</a></td>
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
