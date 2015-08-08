<?php
session_start(); // Developed by www.freestudentprojects.com
include("dbconnection.php");
include("header.php");

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
				
				if(mysqli_num_rows($qmsg3) == 1)
				{
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
<div class="wrapper row2">
  <div id="footer" class="clear">
    <div class="one_quarter first">
      <h2 class="footer_title">Footer Navigation</h2>
      <nav class="footer_nav">
        <ul class="nospace">
          <li><a href="#">Home Page</a></li>
          <li><a href="#">Our Services</a></li>
          <li><a href="#">Meet the Team</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Gallery</a></li>
          <li><a href="#">Portfolio</a></li>
          <li><a href="#">Online Shop</a></li>
        </ul>
      </nav>
    </div>
    <div class="one_quarter">
      <h2 class="footer_title">Latest Gallery</h2>
      <ul id="ft_gallery" class="nospace spacing clear">
        <li class="one_third first"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third first"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third first"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
      </ul>
    </div>
    <div class="one_quarter">
      <h2 class="footer_title">From Twitter</h2>
      <div class="tweet-container">
        <ul class="list none">
          <li><strong>@<a href="#">name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
          <li><strong>@<a href="#">name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
          <li><strong>@<a href="#">name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
          <li><strong>@<a href="#">name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
        </ul>
      </div>
    </div>
    <div class="one_quarter">
      <h2 class="footer_title">Contact Us</h2>
      <form class="rnd5" action="#" method="post">
        <div class="form-input clear">
          <label for="ft_author">Name <span class="required">*</span><br>
            <input type="text" name="ft_author" id="ft_author" value="" size="22">
          </label>
          <label for="ft_email">Email <span class="required">*</span><br>
            <input type="text" name="ft_email" id="ft_email" value="" size="22">
          </label>
        </div>
        <div class="form-message">
          <textarea name="ft_message" id="ft_message" cols="25" rows="10"></textarea>
        </div>
        <p>
          <input type="submit" value="Submit" class="button small orange">
          &nbsp;
          <input type="reset" value="Reset" class="button small grey">
        </p>
      </form>
    </div>
  </div>
</div>
<div class="wrapper row4">
  <div id="copyright" class="clear">
    <p class="fl_left">Copyright &copy; 2013 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </div>
</div>
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
