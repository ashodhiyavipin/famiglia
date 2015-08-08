<?php
        $resuser=mysqli_query($con,"SELECT events.*,profile.* from events INNER JOIN profile ON events.profileid=profile.profileid ORDER BY events.eventid desc");
		while($wallrs = mysqli_fetch_array($resuser))
		{
			if($wallrs[1] == $_SESSION[profileid])
			{
				$checkwp = 1;
			}
			else
			{
				$result1 = mysqli_query($con,"SELECT * from friends where (profileid1='$wallrs[profileid]' AND profileid2='$_SESSION[profileid]' and requeststatus='accepted') OR (profileid1='$_SESSION[profileid]' AND profileid2='$wallrs[profileid]' and requeststatus='accepted')");
				$checkwp = mysqli_num_rows($result1);
			}
				if($checkwp == 1)
				{
			?>
				<div class="three_quarter">
				<p><strong><?php echo $wallrs[firstname]; ?> <?php echo $wallrs[lastname]; ?> </strong></p>    
				<p><?php echo $wallrs[eventsubject]; ?> </p>
				<p><?php echo $wallrs[eventdescription]; ?> </p>
				<?php
                        if($wallrs[eventimage] != "")
                        {
				?>
                        		<figure class="imgl boxholder">
						<img src="uploads/<?php echo $wallrs[eventimage]; ?>" width="100" height="100"  >
						</figure>
				<?php
                        }
				?>
            
                      </div>
			<?php
				}
		}
		?>
