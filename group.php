<?php
session_start();
include("header.php");
include("dbconnection.php");
$datetime  = date("Y-m-d h:i:s");
if($_POST[sett]==$_SESSION[sett])
{
	if (isset($_POST["submit"]))
	{ 
		$sql="INSERT INTO groups(profileid,groupname,groupdescription,status)
	  VALUES('$_SESSION[profileid]','$_POST[groupname]','$_POST[groupdescription]','Enabled')";		
	  
	  if (!mysqli_query($con,$sql))
	  {
	  die('Error: ' . mysqli_error($con));
	  }
	  else
	  {
		$msg ="<br> Group created successfully..";
		$msgi = 1;
	  }
	}
}

$_SESSION[sett]  = rand();

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
<div id="respond">
          <h2>Create New Group</h2>
          <form class="rnd5" action="#" method="post">
          <input type="hidden" name="sett" value="<?php echo $_SESSION[sett]; ?>">
            <div class="form-input clear">
              <label class="one_half first" for="author">Group Name <span class="required">*</span><br>
                <input type="text" name="groupname" id="groupname" value="" size="22">
              </label>
              
            </div>
            <div class="form-message">
            Group Description <span class="required">*</span><br>
              <textarea name="groupdescription" id="groupdescription" cols="25" rows="10"></textarea>
            </div>
            <p>
              <input type="submit" value="Submit" name="submit">
              &nbsp;</p>
          </form>
          
          <b><?php echo $msg; ?></b>
        </div>
        
    


        </div>
      
   
        
              <!-- WALL POST Message ################################3 -->     <div class="push50">
<p></p>
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