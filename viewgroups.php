<?php
session_start();
include("dbconnection.php");
include("header.php");


	$dt= date("Y-m-d");
	
	$sql1 = "SELECT * FROM  groupmembers where profileid='$_SESSION[profileid]' AND  groupid='$_GET[groupid]'";
 	$qmsg1 = mysqli_query($con,$sql1);
	if(mysqli_num_rows($qmsg1) == 0)
	{
			$sql="INSERT INTO groupmembers(groupid,profileid,joindate,status)
		  VALUES('$_GET[groupid]','$_SESSION[profileid]','$dt','Enabled')";		
		  
		  if (!mysqli_query($con,$sql))
		  {
		  die('Error: ' . mysqli_error($con));
		  }
		  else
		  {
			header("Location: groupwallpost.php?groupid=$_GET[groupid]");
		  }
	}
	


$_SESSION[sett]  = rand();
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div class="clear push80">
      <!-- #################################################################################################### --><!-- #################################################################################################### -->
      <!-- #################################################################################################### --><!-- #################################################################################################### -->
      <!-- #################################################################################################### --><!-- #################################################################################################### -->
      <!-- #################################################################################################### --><!-- #################################################################################################### -->
    <span class="emphasise">View Groups</span></div>
    <!-- #################################################################################################### -->
    <!-- #################################################################################################### -->
    <!-- #################################################################################################### -->
    <!-- #################################################################################################### -->
    <div class="clear push80">
      <!-- #################################################################################################### -->
  <?php
	$sql = "SELECT * FROM  groups ORDER BY RAND() ";
  $qmsg = mysqli_query($con,$sql);
  $i=0;
  while($rsmsg = mysqli_fetch_array($qmsg))
	{   
				$sql1 = "SELECT * FROM  profile where profileid='$rsmsg[profileid]' ";
 				$qmsg1 = mysqli_query($con,$sql1);
  				$rsmsg1 = mysqli_fetch_array($qmsg1);

				$sql2 = "SELECT * FROM  groupmembers where groupid='$rsmsg[groupid]' ";
 				$qmsg2 = mysqli_query($con,$sql2);
  				$rsmsg2 = mysqli_fetch_array($qmsg2);	
				
				$sql3 = "SELECT * FROM  groupmembers where groupid='$rsmsg[groupid]' and  profileid='$_SESSION[profileid]'";
 				$qmsg3 = mysqli_query($con,$sql3);
  				$rsmsg3 = mysqli_fetch_array($qmsg3);				
	?>
				<div class="one_third 
                <?php
				if($i==0)
				{
                echo " first";
				$i++;
				}
				else if($i == 1)
				{
					$i++;
				}
				else if($i == 2)
				{
					$i = 0;
				}
                ?>
				">
			  
				<div class="pricingtable-wrapper">
				  <div class="pricingtable">
					<div class="pricingtable-title">
					  <h2><?php echo $rsmsg[groupname]; ?></h2>
					</div>
					<div class="pricingtable-list">
					  <ul>
                     	 <li><strong>Group Admin : <?php echo $rsmsg1[firstname]. " " . $rsmsg1[lastname]; ?></strong></li>
						<li><?php echo $rsmsg[groupdescription]; ?></li>
						
					  </ul>
					</div>
					<div class="pricingtable-price"><?php echo mysqli_num_rows($qmsg2); ?> <span>No. of Members</span></div>
                    
					<div class="pricingtable-signup">
                    <?php
					
					if(mysqli_num_rows($qmsg3) == 0)
					{
					?>
                    <a class="button large gradient orange" href="viewgroups.php?groupid=<?php echo $rsmsg[groupid]; ?>">Join this Group!</a>
                    <?php
					}
					else
					{
					?>
                    <a class="button large gradient orange" href="groupwallpost.php?groupid=<?php echo $rsmsg[groupid]; ?>">View this Group!</a>
                    <?php
					}
					?>
                    </div>
                    
				  </div>
				</div>
			  </div>

	<?php
				if($i == 2)
				{
					echo "<br>";
				}
    }
    ?>
      <!-- #################################################################################################### -->
    </div>
    <!-- #################################################################################################### -->
    <!-- #################################################################################################### -->
    <!-- #################################################################################################### -->
    <!-- #################################################################################################### --><!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>
<!-- Scripts -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="../layout/scripts/jquery-latest.min.js"><\/script>\
<script src="../layout/scripts/jquery-ui.min.js"><\/script>')</script>
<script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
<script src="layout/scripts/jquery-mobilemenu.min.js"></script>
<script src="layout/scripts/custom.js"></script>
</body>
</html>
