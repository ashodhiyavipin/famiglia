<?php
session_start(); // Developed by www.freestudentprojects.com
include("dbconnection.php");
$sqlsel = mysqli_query($con,"SELECT * FROM profile where profileid='$_GET[friend]'");
$rsrec = mysqli_fetch_array($sqlsel);

$_SESSION[setid]  = rand();

include("header.php");
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
</tr><tr><td>First name</td><td><?php echo $rsrec[firstname] ; ?></td></tr>
<tr><td>Last name</td><td><?php echo $rsrec[lastname] ; ?></td></tr>
<tr><td>Email id</td><td><?php echo $rsrec[emailid] ; ?></td></tr>
<tr><td>Contact number</td><td><?php echo $rsrec[contactno] ; ?></td>
</tr>
<tr><td>dob</td><td><?php echo $rsrec[dob] ; ?></td></tr>
<tr><td>gender</td><td>
<?php echo $rsrec[gender];
?>
</td></tr>


<tr><td>city</td><td><?php echo $rsrec[city] ; ?></td></tr>

</table>
</form>
      </div>
      <div class="one_third">
        <div class="calltoaction opt1">
          <div class="push20">
            <h1></h1>
          <p><?php
			
			if(isset($_GET[friend]))
			{
			 echo "<b>".$rsrec[firstname]. " ". $rsrec[lastname] ."</b><hr>";
			}
			else
			{
			 echo "<b>Welcome ".$fnamesession. " ". $lnamesession ."</b><hr>";
			}
			
	$img=mysqli_query($con, "SELECT * from images where imgid='$rsrec[imgid]'");
    $pic= mysqli_fetch_array($img);
	  
            if($pic[imagepath] == "")
			{	   
				echo "<img src='images/profilepic.jpg' style='height=570px; width:570px;'>";
			}
			else
			{
				echo "<img src='uploads/$pic[imagepath]' style='height=570px; width:570px;' >";
			}
       ?>

       </div>
        
      
   </p>
        </div>
      </div>
      
    </section>

<?php
if(isset($_GET[friend]))
{
$fri = mysqli_query($con,"SELECT * FROM friends where ((profileid1='$_GET[friend]' or profileid2='$_GET[friend]') and requeststatus='accepted') OR ((profileid2='$_GET[friend]' or profileid1='$_GET[friend]') and requeststatus='accepted')");
}
else
{
$fri = mysqli_query($con,"SELECT * FROM friends where ((profileid1='$_SESSION[profileid]' or profileid2='$_SESSION[profileid]') and requeststatus='accepted') OR ((profileid2='$_SESSION[profileid]' or profileid1='$_SESSION[profileid]') and requeststatus='accepted')");
}
?>    
    <!-- ################################################################################################ -->
    <section>
      <h2><?php echo $rsrec[firstname] . " " .$rsrec[lastname]; ?>'s Friends - (<?php echo mysqli_num_rows($fri); ?> friends)</h2>
      
<?php
if(isset($_GET[friend]))
{
$friend= mysqli_query($con, "SELECT * FROM friends where ((profileid1='$_GET[friend]' or profileid2='$_GET[friend]') and requeststatus='accepted') OR ((profileid2='$_GET[friend]' or profileid1='$_GET[friend]') and requeststatus='accepted')");	
}
else
{
$friend= mysqli_query($con, "SELECT * from friends where ((profileid1='$_SESSION[profileid]' or profileid2='$_SESSION[profileid]') and requeststatus='accepted') OR ((profileid2='$_SESSION[profileid]' or profileid1='$_SESSION[profileid]') and requeststatus='accepted') ");
}
?>
      <ul class="nospace clear">
<?php
$i=0;
while($rs = mysqli_fetch_array($friend))
{
	if($rs[profileid1] == $_SESSION[profileid])
	{
		$friendsprofileid = $rs[profileid2];
	}
	else
	{
		$friendsprofileid = $rs[profileid1];
	}
	
	if($rs[profileid1] == $_GET[friend])
	{
		$friendsprofileid = $rs[profileid2];
	}
	else
	{
		$friendsprofileid = $rs[profileid1];
	}
	$r=mysqli_query($con, "SELECT * from profile where profileid='$friendsprofileid'");
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
        <li class="one_quarter first">
        <?php
		}
		else
		{
		?>
        <li class="one_quarter">
        <?php
		}
		?>
          <figure class="team-member">
          <?php echo "<a href='viewprofile.php?friend=$friendsprofileid'>"; ?>
          <img src='<?php echo $profileimage; ?>' style="height=570px; width:570px;">
          <?php echo "</a>"; ?>
          	<figcaption>
              <p class="team-name"><?php echo "<a href='viewprofile.php?friend=$friendsprofileid'>".$show[firstname]."&nbsp;". $show[lastname]. "</a>"; ?></p>
              <p class="team-title"><strong><?php	
              echo "No. of friends - " .$rsnofriends[0] . " "; 
			  ?></strong>
              </p>
 
            </figcaption>
          </figure>
        </li>
        <?php
			if($i==3)
			{
			?>
			</ul>
			<?php
            $i=0;
			}
			else
			{
            $i++;
			}
            ?>
<?php
}
?>
      </ul>
    </section>

    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>