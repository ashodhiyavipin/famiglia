<?php
session_start();
include("dbconnection.php");
	
$result= mysqli_query($con,"select * from advertisements where status='Enabled' ORDER BY rand() limit 0,3");
$resuser = mysqli_query( $con , "SELECT events.*,profile.* from events INNER JOIN profile ON events.profileid=profile.profileid ORDER BY events.eventid desc");
$wallrs = mysqli_fetch_array($resuser);
?>



  <aside class="clear">
        <!-- ########################################################################################## -->
        
        <h2>Upcoming Events in your Family</h2>
        <section class="clear">
          <ul class="nospace">
          <p><?php echo $wallrs[firstname]; ?> <?php echo $wallrs[lastname]; ?></p>
          <p>has an event on <?php echo $wallrs[eventdate];?> </p>
          <p>called&nbsp;<?php echo $wallrs[eventsubject]; ?> </p>
          
          
          
          <?php
           while($rs=mysqli_fetch_array($result))
{
	echo"<li>
	<strong>$rs[advtname]</strong><br>
	<a href='$rs[link]' target='_blank'><img src='files/$rs[imagename]' width='200' height='175'/ ></a><hr></li>";
}
?>
          
          </ul>
        </section>
        <!-- /section -->
        <!-- ########################################################################################## -->
      </aside>
