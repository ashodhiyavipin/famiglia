<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
session_start();
include("dbconnection.php");
?>
<script type="application/javascript">
function validate()
{
	if(document.albumform.albumname.value == "")
	{
		alert("Please enter Album name..");
		document.albumform.albumname.focus();
		return false;
	}
	else if(document.albumform.albumdescription.value == "")
	{
		alert("Please enter Description..");
		document.albumform.albumdescription.focus();
		return false;
	}
	else if(document.albumform.date.value == "")
	{
		alert("Please enter Date..");
		document.albumform.date.focus();
		return false;
	}
	
	else
	{
		return true;
	}
}
</script>
<?php
if($_POST[set] == $_SESSION[set] )
{
	
	//Code for update records
	if(isset($_POST[submit]))
	{		
			if(isset($_GET[albumid]))
				{
						$updrec = mysqli_query($con, "UPDATE albums SET albums ='$_POST[albumname]',albumdescription='$_POST[albumdescription]',date='$_POST[date]',status='$_POST[status]' where  albumid='$_POST[albumid]'");	
						if(!$updrec)
						{
							?>
							<script type="text/javascript">
							alert("Failed to update!");
							</script>
							<?php
						}
						else
						{
							?>
							 <script type="text/javascript">
							alert("Album Information updated successfully.");
							</script>
							<?php
						}
				}
				else
				{
						$result=mysqli_query($con,"INSERT INTO albums(profileid,albumname,albumdescription,date,status) values('$_SESSION[profileid]','$_POST[albumname]','$_POST[albumdescription]','$_POST[date]','$_POST[status]')");
						$uploadimg = mysqli_insert_id($con);						
							if(!$result)
							{
							?>
								<script type="text/javascript">
									alert("Failed to insert record");
								</script>
							<?php
							}
							else
							{
							?>
								 <script type="text/javascript">
									alert("Album Information inserted successfully.");
								</script>                              
							<?php
							header("Location: uploadphotos.php?albumid=$uploadimg");
							}
				}
	}
}
                    $_SESSION['set'] = rand();

$selrec = mysqli_query($con,"select * from albums where albumid='$_GET[albumid]'");
$rc = mysqli_fetch_array($selrec);
include("header.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
<?php echo include("leftsidebar.php"); ?>
    </div>
    <!-- ################################################################################################ -->
    <div id="gallery" class="one_half">
    
      <section>
        <figure>
          <h2>Albums</h2>
      
      <div class="ALBUMS">
          <div class="accordion-wrapper"><a href="javascript:void(0)" class="accordion-title orange"><span>Create Album Here</span></a>
          <div class="accordion-content">
            <p>
            <form name="albumform" method="post" action=""  onsubmit="return validate()">
			<input type="hidden" name="albumid" value="<?php echo $_GET[albumid]; ?>" />
			<input type="hidden" name="set" value="<?php echo $_SESSION['set']; ?>" />
			<p>&nbsp;</p>
			<table width="485" align="center">
			<tr>
				<th width="144" height="39">Album Name&nbsp;</th>
				<td width="325"><input type="text" name="albumname" size=30 value="<?php echo $rc[albumname]; ?>" /></td>
			</tr> 
			<tr>
				<th height="51">Description  </th>
				<td>  <textarea name="albumdescription" cols="s30" rows=""><?php echo $rc[albumdescription]; ?></textarea>
			</tr>
			<tr>
				<th height="40">Date&nbsp;</th>
				<td><input type="date" name="date" value="<?php echo $rc[date]; ?>"  /></td>
			</tr>
			<tr>
				<th height="37">Status&nbsp;</th>
				<td>&nbsp;
				<?php
				$starray = array("Enabled", "Disabled");
				?>
				<select name="status" id="status">
				<?php
				foreach($starray as $value)
				{
				if($rc[status] == $value)
				{
				echo "<option value='$value' selected>$value</option>";
				}
				else
				{
				echo "<option value='$value'>$value</option>";			  
				}
				}
				?>
				</select></td>
			</tr>
			<tr >
				<th height="34" colspan=2>
				<br />&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="Submit" class="small button orange"/></th>
			</tr>
			</table>
			</form>
	</p>

          </div>
        </div>
        </div>
        <br>
          <ul class="clear">
            <li class="one_half first">
            
            <strong>Default</strong><br>
            <?php
			
            $sql1 = "SELECT * FROM images where profileid='$_SESSION[profileid]' AND albumid='0' order by rand() LIMIT 0 , 1";
			$sqlquery1 = mysqli_query($con,$sql1);
			
					if(mysqli_num_rows($sqlquery1) == 0 )
					{
            		echo "<a href='uploadphotos.php?albumid=0'><img src='images/noimginalbum.jpg' width='570' height='396' ></a></li>";
					}
					else
					{
						$sqlfetch1 = mysqli_fetch_array($sqlquery1) ;
						echo "<a href='uploadphotos.php?albumid=0'><img src='uploads/$sqlfetch1[imagepath]' width='570' height='396' ></a></li>";
						
					}


			$sql2 = "SELECT * FROM albums where profileid='$_SESSION[profileid]'";
			$sqlquery2 = mysqli_query($con,$sql2);
			while($sqlfetch2 = mysqli_fetch_array($sqlquery2))	
				{ 
					if($i==1)
					{
						echo "<li class='one_half first'>";
						$i=0;
					}
					else
					{
						echo "<li class='one_half'>";
						$i=1;
					}
             	echo "<strong>".$sqlfetch2[albumname]."</strong><br>";   
				
				$sql3 = "SELECT * FROM images where profileid='$_SESSION[profileid]' AND albumid='$sqlfetch2[albumid]' order by rand() LIMIT 0 , 1";
					$sqlquery3 = mysqli_query($con,$sql3);
					if(mysqli_num_rows($sqlquery3) == 0 )
					{
            		echo "<a href='uploadphotos.php?albumid=$sqlfetch2[albumid]'><img src='images/noimginalbum.jpg' width='570' height='396' ></a></li>";
					}
					else
					{
						while($sqlfetch3 = mysqli_fetch_array($sqlquery3))	
						{          
						echo "<a href='uploadphotos.php?albumid=$sqlfetch2[albumid]'><img src='uploads/$sqlfetch3[imagepath]'></a>";
						}
					}
                echo "</li>";
				}
			?>
          </ul>
        </figure>
      </section>

    </div>
    <!-- ################################################################################################ -->
    <div id="sidebar_2" class="sidebar one_quarter">
    <?php
	include("rightsidebar.php");
	?>
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>
</body>
</html>
