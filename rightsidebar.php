<?php
        $resuser=mysqli_query($con,"SELECT events.*,profile.* from events INNER JOIN profile ON events.profileid=profile.profileid ORDER BY events.eventid desc");
		echo "<ul class='list-group'>";
		echo "<li class='list-group-item'>Your upcoming events</li>";
		while($wallrs = mysqli_fetch_array($resuser))
		{
			if($wallrs[1] == $_SESSION[profileid])
			{
				$checkwp = 1;
			}
			else
			{
				$result1 = mysqli_query($con,"SELECT * from friends where (profileid1='$wallrs[profileid]' AND profileid2='$_SESSION[profileid]' and requeststatus='accepted') OR (profileid1='$_SESSION[profileid]' AND profileid2='$wallrs[profileid]' AND requeststatus='accepted')");
				$checkwp = mysqli_num_rows($result1);
			}
				if($checkwp == 1)
				{
			?>
				<li class="list-group-item">
				<p><strong><?php echo $wallrs[firstname]; ?> <?php echo $wallrs[lastname]; ?> </strong></p>
				<p><?php echo $wallrs[eventsubject]; ?> </p>
				<p><?php echo $wallrs[eventdescription]; ?> </p>
				</li>
			<?php
				}

		}
		echo "</ul>";
		?>
