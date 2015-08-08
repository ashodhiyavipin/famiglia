<?php 
session_start(); // Developed by www.freestudentprojects.com
include("header.php");
include("dbconnection.php");
if($_SESSION[setid] == $_GET[setid])
{
	if(isset($_GET[profilereqid]))
	{
		$insresult =  mysqli_query($con,"INSERT INTO friends (profileid1,profileid2,requeststatus) values('$_SESSION[profileid]','$_GET[profilereqid]','pending')");
							
									if(!$insresult)
									{
										echo mysqli_error($con);
									}
									else
									{
									?>
										<script type="text/javascript">
										alert("Friend request sent successfully..");
										</script>
									<?php
                                    }
	}
	
	if(isset($_GET[profilecanid]))
	{
		$insresult =  mysqli_query($con,"DELETE FROM friends  where friendid='$_GET[profilecanid]'");
							
									if(!$insresult)
									{
										echo mysqli_error($con);
									}
									else
									{
									?>
										<script type="text/javascript">
										alert("Friend request cancelled successfully..");
										</script>
									<?php
                                    }
	}
}
$_SESSION[setid] = rand();

if(isset($_GET[search]))
{
$ch=$_GET[search];
$sqlprofiles= mysqli_query($con,"SELECT * from profile where profileid!='$_SESSION[profileid]' AND (username like '%$ch%' or firstname like '%$ch%' or lastname like '%$ch%')");
}
else
{
$sqlprofiles = mysqli_query($con,"SELECT * FROM profile where profileid!='$_SESSION[profileid]'");
}


?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">

        <h1>
        <form name=form action="searchfriends.php" method="get">
        Search friends here:<input name="search" type="text" class="active" placeholder=" Search for friends here" size="25">  
    <input type="hidden" name="check" class='button blue gradient' value="Search friends">
    </form></h1>

    </section>
    <!-- ################################################################################################ -->
    <section>
      <h4> <?php echo mysqli_num_rows($sqlprofiles); ?> Records found</h4>
      
      <?php
	  while($rspro = mysqli_fetch_array($sqlprofiles))
	  {
		  $sqlprofileimage= mysqli_query($con,"SELECT * FROM  images where imgid='$rspro[imgid]'");
		  $rsprofileimage = mysqli_fetch_array($sqlprofileimage);
		  
		  $sqlnofriends= mysqli_query($con,"SELECT COUNT(*) FROM  friends where (profileid1='$rspro[profileid]' OR profileid2='$rspro[profileid]') AND requeststatus='accepted'");
		  $rsnofriends = mysqli_fetch_array($sqlnofriends);
		  
		  //Query to check friend request 
		  $sqlfrndreqstatus = mysqli_query($con,"SELECT * FROM  friends where (profileid1='$_SESSION[profileid]' AND profileid2='$rspro[profileid]') OR (profileid1='$rspro[profileid]' AND profileid2='$_SESSION[profileid]')");
		  $rsfrndreqstatus = mysqli_fetch_array($sqlfrndreqstatus);
		  	if($i == 0)
		  	{
	   		?>
       		<ul class="nospace clear">
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
            <?php
			if(mysqli_num_rows($sqlprofileimage) == 0)
			{
			?>
          		<img src="images/profilepic.jpg" style="width:250px;height:300px">
            <?php
			}
			else
			{
			?>
            	<img src="uploads/<?php echo $rsprofileimage[imagepath]; ?>" alt="" style="width:600px;height:300px" >
            <?php
			}
			?>
            <figcaption>
              <p class="team-name"><?php echo $rspro[firstname]; ?> <?php echo $rspro[lastname]; ?></p>
              <p class="team-title"><?php echo $rsnofriends[0]; ?> friends</p>
              <p class="read-more">
	            <?php
				if(mysqli_num_rows($sqlfrndreqstatus) == 1)
				{

					  if($rsfrndreqstatus[requeststatus] =='accepted')
					  {
						 echo "<strong>$rsfrndreqstatus[friendtype]</strong>"; 
					  }
					  else if($rsfrndreqstatus[requeststatus] =='pending')
					  {
	echo "<strong>
	<a href='searchfriends.php?search=".$_GET[search]."&check=".$_GET[check]."&profilecanid=".$rsfrndreqstatus[0]."&setid=".$_SESSION[setid]."'>Cancel friend request</strong></a>";
					  }
				}
				else
				{
				echo "<strong><a href='searchfriends.php?search=".$_GET[search]."&check=".$_GET[check]."&profilereqid=$rspro[profileid]&setid=$_SESSION[setid]'>Send Friend Request &raquo;</a></strong>";
				}             
				?>
              </p>
              <p class="team-description">&nbsp;</p>
              
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
    </section>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php 
include("footer.php");
?>