<?php
session_start();
include("dbconnection.php");


if(isset($_GET[delid]))
{
	$selrec = mysqli_query($con,"DELETE FROM images where imgid='$_GET[delid]'");
}

if (isset($_POST["submitphotos"]))
	{
			for($i=0;$i<count($_FILES['uploadphotos']['name']); $i++)
			{		
			$datetime = date("Y-m-d h:i:s");		
				$imagename = $_FILES['uploadphotos']['name'][$i];
				$imgname = rand().$_FILES['uploadphotos']['name'][$i];
				move_uploaded_file($_FILES['uploadphotos']['tmp_name'][$i],"uploads/". $imgname);
				
				$sql="INSERT INTO images(profileid,albumid,imagepath,imagedescription,createddate,status)
	  VALUES('$_SESSION[profileid]','$_POST[albumid]','$imgname','$imagename','$datetime','Enabled')";			  		
				if (!mysqli_query($con,$sql))
				{
				die('Error photo upload: ' . mysqli_error($con));
				}
			}			
				header("Location: uploadphotos.php?albumid=$_POST[albumid]");
	}

                    $_SESSION['set'] = rand();

$selrec = mysqli_query($con,"select * from albums where albumid='$_GET[albumid]' and  profileid='$_SESSION[profileid]'");
$rc = mysqli_fetch_array($selrec);
include("header.php");
include("fancybox.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
      <?php echo include("leftsidebar.php"); ?>
    </div>
    <!-- ################################################################################################ -->
    <div id="gallery" class="three_quarter">
      <section>
        <figure>
      <div id="respond">
           <div class="ALBUMS">
          <div class="accordion-wrapper"><a href="javascript:void(0)" class="accordion-title orange"><span>Upload images Here</span></a>
          <div class="accordion-content">
            <p>
             <form id="myUploadForm" name="myUploadForm" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="albumid" value="<?php echo $_GET[albumid]; ?>">                            
                              <div class="form-message">
                              <div id="uploadajax">
                              Upload images:
                              <input type="file" name="uploadphotos[]" id="uploadphotos[]" multiple="multiple" />
                              </div>
                              </div>
                              <p>                            
                                <input type="submit" value="Submit" name="submitphotos" id="submitphotos">
                                &nbsp;
                              </p>
                            </form>
  </p>

          </div>
        </div>
        </div>
        </div>
        
        <br>
        <?php
			$sql4 = "SELECT * FROM albums where albumid='$_GET[albumid]' and profileid='$_SESSION[profileid]' ";
			$sqlquery4 = mysqli_query($con,$sql4);
			$myalbumname = mysqli_fetch_array($sqlquery4);
		?>
        <h2>Images from <?php 
		if($myalbumname[albumname] == "")
		{
			echo "Default album";
		}
		else
		{
		echo $myalbumname[albumname]; 
		}
		?></h2>
       <ul class="clear">
            <?php
			$sql3 = "SELECT * FROM images where albumid='$_GET[albumid]' and profileid='$_SESSION[profileid]' order by imgid desc ";
			$sqlquery2 = mysqli_query($con,$sql3);
			$i=0;
			while($sqlfetch2 = mysqli_fetch_array($sqlquery2))	
				{ 
					if($i==0)
					{
						echo "<li class='one_third first'>";
						
					}
					else
					{
						echo "<li class='one_third'>";
					}
					
					if($i==2)
					{
						$i=0;
					}
					else
					{
						$i++;
					}
             	echo $sqlfetch2[albumname]."<br>";   
				
					$sqlquery3 = mysqli_query($con,$sql3);
					if(mysqli_num_rows($sqlquery3) == 0 )
					{
            		echo "No image found..</li>";
					}
					else
					{					        
						echo "<a class='fancybox fancybox.ajax' href='fancyimage.php?imgid=$sqlfetch2[imgid]'><img src='uploads/$sqlfetch2[imagepath]' class='primg' ></a>";
					}
                echo "</li>";
				}
			?>
          </ul>
          <?php
		  if($_GET[albumid] == 0)
		  {
			?>
          <figcaption>
            <p><strong>Default Album</strong> </p>
            <p> </p>
          </figcaption>
            <?php
		  }
		  else
		  {
		  ?>
          <figcaption>
            <p><strong>About Album:</strong> <?php echo $rc[albumdescription]; ?></p>
            <p><strong>Photos Taken:</strong> <?php echo $rc[date]; ?></p>
          </figcaption>
          <?php
		  }
		  ?>
        </figure>
      </section>

    </div>
      </section>
      <!-- ####################################################################################################### -->
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>