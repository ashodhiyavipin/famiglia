<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="jquery/jquery-ui.css">
  <script src="jquery/jquery.min.js"></script>
  <script src="jquery/jquery-ui.js"></script>
</head>
<body>
<?php
session_start();
include("header.php");
include("dbconnection.php");
$datetime  = date("Y-m-d h:i:s");
?>
<script type="application/javascript">
function validate()
{
	if(document.eventform.eventdate.value == "")
	{
		alert("Please enter eventdate..");
		document.eventform.eventdate.focus();
		return false;
	}
	else if(document.eventform.subject.value == "")
	{
		alert("Please enter subject..");
		document.eventform.subject.focus();
		return false;
	}
	else if(document.eventform.file.value == "")
	{
		alert("Please enter image..");
		document.eventform.file.focus();
		return false;
	}
	else if(document.eventform.description.value == "")
	{
		alert("Please enter description..");
		document.eventform.description.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
</script>
<?php
if($_POST[setid]==$_SESSION[setid])
{
	if (isset($_POST["submit"]))
	{
		
if($_FILES[file][size]!= 0)
{
$imagename = rand().$_FILES[file][name];
move_uploaded_file($_FILES[file][tmp_name],"uploads/". $imagename);
}
else
{
$imagename = "";	
}


$sql="INSERT INTO events (eventdate,profileid,eventsubject,eventimage,eventdescription,status)
VALUES
('$_POST[eventdate]','$_SESSION[profileid]','$_POST[subject]','$imagename','$_POST[description]','Enabled')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  else
	{
$msg = "Events Published successfully..";
	}
}
}
$_SESSION[setid]  = rand();
?>
<!-- content -->

<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
		<?php echo include("leftsidebar.php"); ?>
    </div>
    <!-- ################################################################################################ -->
    <div class="one_half">
      <div id="respond">
        
        <div class="wallpost">
          <div class="accordion-wrapper"><a href="javascript:void(0)" class="accordion-title orange"><span> Post Events Here</span></a>
          <div class="accordion-content">
            <p>
			<form name="eventform" action="" method=post onsubmit="return validate()" enctype="multipart/form-data">
		<!--	<table width="491" border=1>
			<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
			<tr>
			  <td colspan="2" align="center">&nbsp;<?php echo $msg; ?></td>
			  </tr>
			<tr><td>Event date</td><td>
			<input type="date" name="eventdate" />
			</td></tr>
			<tr><td>Subject</td><td><input type=text name=subject /></td></tr>
			<tr><td>Image</td><td>

			<input type="file" name="file" /> 
			</td></tr>

			<tr><td>description</td><td><textarea name=description rows=3 cols=15></textarea></td></tr>
			<tr><td colspan="2" align="center"><input type=submit name=submit value=submit /></td></tr>
			</table> -->
				<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
				<div class="form-group">
				<label for="inputDate">When is the Event Happening?</label>
				<input type="text" class="form-control" id="datepicker" placeholder="Date" name="eventdate" />
				</div>
				<div class="form-group">
				<label for="inputSubject">What is the Event?</label>
				<input type="text" class="form-control" id="inputText" placeholder="Name of the Event." name="subject" />
				</div>
				<div class="form-group">
				<label for="inputEventImage">You can upload a cover image for the event.</label>
				<input type="file" class="form-control" id="uploadImage" placeholder="Click here to upload Image" name="file" />
				</div>
				<div class="form-group">
				<label for="inputDescription">Describe the event.</label>
				<input type="textarea" class="form-control" id="inputText" placeholder="Describe the event here." name="description" cows=3 cols=15>
				</div>
				<br />
				<button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
			</form>
			</p>
		</div>
	</div>
</div>
        
              <!-- WALL POST Message ################################3 -->     <div class="push50">
<p></p>
        <!-- ################################################################################################ -->
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
//				echo $wallrs[1]. " " .$_SESSION[profileid];
				if($checkwp == 1)
				{
			?>
                    <div class="testimonial push50 clear">
                      <div class="one_quarter first">
							  <?php
                                if($wallrs[imgid] != "")
                              {   
                            $resuser1=mysqli_query($con,"SELECT * FROM  images WHERE imgid='$wallrs[imgid]'");
                            $wallrs1 = mysqli_fetch_array($resuser1);
                    
                              echo "<img src='uploads/$wallrs1[imagepath]'>";
                              }
                              else
                              {
                              echo "<img src='images/profilepic.jpg'>";
                              }
                              ?>
                      </div>
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
                    </div>
			<?php
				}
		}
		?>
        <!-- ################################################################################################ -->
      </div>

      </div>
      
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
