<?php
session_start();
include ("dbconnection.php");
if ($_POST[setid] == $_SESSION[setid]) {
	if (isset($_POST["updprofile"])) {

		$sql = "UPDATE profile SET username='$_POST[username]',firstname='$_POST[fname]',lastname='$_POST[lname]',emailid='$_POST[emailid]',contactno='$_POST[cnumber]',dob='$_POST[dob]',gender='$_POST[gender]',status='Enabled',city='$_POST[city]' where profileid='$_SESSION[profileid]'";
		if (!mysqli_query($con, $sql)) {
			die('Error:' . mysqli_error($con));
		} else {
			$msg = "<strong><font color='green'><br>Profile Updated successfully,.</font></strong>";
		}

	}
}

if ($_POST[setid] == $_SESSION[setid]) {
	if (isset($_POST["submitimg"])) {
		$imagename = $_FILES['profilepic']['name'];
		$imgname = rand() . $_FILES['profilepic']['name'];
		move_uploaded_file($_FILES['profilepic']['tmp_name'], "uploads/" . $imgname);

		//upload profile image code
		$sql = "INSERT INTO images(profileid,imagepath,status)
	  VALUES('$_SESSION[profileid]','$imgname','Enabled')";
		if (!mysqli_query($con, $sql)) {
			die('Error:' . mysqli_error($con));
		} else {
			$msg1 = "<strong><font color='green'><br>Profile Updated successfully,.</font></strong>";
		}
		$imgid = mysqli_insert_id($con);
		//update profile image code
		$sql = "UPDATE profile SET imgid='$imgid' where profileid='$_SESSION[profileid]'";
		if (!mysqli_query($con, $sql)) {
			die('Error:' . mysqli_error($con));
		} else {
			$msg1 = "<strong><font color='green'><br>Profile Image successfully,.</font></strong>";
		}

	}
}

$sqlsel = mysqli_query($con, "SELECT * FROM profile where profileid='$_SESSION[profileid]'");
$rsrec = mysqli_fetch_array($sqlsel);

$_SESSION[setid] = rand();

include ("header.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <h1>Profile</h1>
      <div class="two_third first">
        <form name=f5 action="" method=post>
<table width="510" height="389" border="1">
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
<tr>
  <td colspan="2" align="center"><strong>Profile</strong><?php echo $msg; ?></td>
  </tr>

<tr><td>User name</td><td><input name=username type=text size="30" value="<?php echo $rsrec[username]; ?>"> </td></tr>

</tr><tr><td>First name</td><td><input name=fname type=text size="30" value="<?php echo $rsrec[firstname]; ?>" /></td></tr>
<tr><td>Last name</td><td><input name=lname type=text size="30" value="<?php echo $rsrec[lastname]; ?>" /></td></tr>
<tr><td>Email id</td><td><input name=emailid type=text size="30"  value="<?php echo $rsrec[emailid]; ?>"   /></td></tr>
<tr><td>Contact number</td><td><input name=cnumber type=text size="30"value="<?php echo $rsrec[contactno]; ?>"   /></td>
</tr>
<tr><td>dob</td><td><input type="date" name="dob" value="<?php echo $rsrec[dob]; ?>"   /></td></tr>
<tr><td>gender</td><td>
<select name="gender">
<option value="" >select</option>
<option value="Male"
<?php
if ($rsrec[gender] == "Male") {
	echo "selected";
}
?>
>Male</option>
<option value="Female"
<?php
if ($rsrec[gender] == "Female") {
	echo "selected";
}
?>>Female</option>
</select>
</td></tr>


<tr><td>city</td><td><input name=city type=text size="30" value="<?php echo $rsrec[city]; ?>" /></td></tr>
<tr>
  <td colspan="2" align="center"><input type="submit" name="updprofile" id="updprofile" value="Update profile"></td>
  </tr>



</table>
</form>
      </div>
      <div class="one_third">
        <div class="calltoaction opt1">
          <div class="push20">
            <h1></h1>
          <p><?php
		echo "<b>Welcome " . $fnamesession . " " . $lnamesession . "</b><hr>";
		if ($imgpathsession == "") {
			echo "<img src='images/profilepic.jpg' class='img-thumbnail'>";
		} else {
			echo "<img src='uploads/$imgpathsession' class='img-thumbnail'>";
		}
       ?>
<hr>
<form method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
<input type="file" name="profilepic" >
<input type="submit" name="submitimg" value="Change profile pic">
</form>
</div>
</p>
</div>
</div>
</section>
<?php
$fri = mysqli_query($con, "SELECT * FROM friends where (profileid1='$_SESSION[profileid]' or profileid2='$_SESSION[profileid]') and requeststatus='accepted'");
?>
    <!-- ################################################################################################ -->
<div>
<h2><?php echo $rsrec[firstname] . " " . $rsrec[lastname]; ?>'s Friends - (<?php echo mysqli_num_rows($fri); ?> friends)</h2>

<?php
$friend = mysqli_query($con, "SELECT * from friends where (profileid1='$_SESSION[profileid]' or profileid2='$_SESSION[profileid]') and requeststatus='accepted'");
?>
<ul class="list-group clear">
<?php
$i=0;
while($rs = mysqli_fetch_array($friend))
{
	$r=mysqli_query($con, "SELECT * from profile where profileid='$rs[profileid2]'");
	$show= mysqli_fetch_array($r);
	$img=mysqli_query($con, "SELECT * from images where imgid='$show[imgid]'");
    $pic= mysqli_fetch_array($img);
	if($pic[imagepath] != "")
	{
    $profileimage="uploads/".$pic[imagepath];
	}
	else
	{
    $profileimage="images/profilepic.jpg";
	}
	//Count Number of friends in their profile
	$sqlnofriends= mysqli_query($con,"SELECT COUNT(*) FROM  friends where (profileid1='$show[profileid]' OR profileid2='$show[profileid]') AND requeststatus='accepted'");
	$rsnofriends = mysqli_fetch_array($sqlnofriends);
?>
        <?php
        if($i == 0)
		{
		?>
        <li class="list-group-item">
        <?php
		}
		else
		{
		?>
        <li class="list-group-item">
        <?php
		}
		?>
          <figure class="team-member"><a href='viewprofile.php?friend=<?php echo $rs[profileid2]; ?>'><img src='<?php echo $profileimage; ?>'></a>
          	<figcaption>
              <p class="team-name"><?php echo "<a href='viewprofile.php?friend=$rs[profileid2]'>" . $show[firstname] . "&nbsp;" . $show[lastname] . "</a>"; ?></p>
              <p class="team-title">
              <strong>
			  <?php
			echo "No. of friends - " . $rsnofriends[0] . " ";
			  ?>
              </strong>
              </p>
              <p><a href='viewprofile.php?friend=<?php echo $rs[profileid2]; ?>'><input type=button value="View Profile" class='button orange gradient'></a></p>
            </figcaption>
          </figure>
        </li>
<?php
}
?>
      </ul>
    </div>

    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include ("footer.php");
?>