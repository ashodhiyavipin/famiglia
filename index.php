<?php
session_start();
if(isset($_SESSION[profileid]))
{
	header("Location: wallpost.php");
}
include("dbconnection.php");
?>

<?php
if($_POST[setid]==$_SESSION[setid])
{
	if (isset($_POST["signup"]))
	{
		$sqllogin = mysqli_query($con,"SELECT * FROM profile where  emailid='$_POST[emailid]' ");
		if(mysqli_num_rows($sqllogin) == 0)
		{
			$sql="INSERT INTO profile(firstname,lastname,emailid,password,dob,gender)
			  VALUES('$_POST[firstname]','$_POST[lastname]','$_POST[emailid]','$_POST[password]','$_POST[dob]','$_POST[gender]')";		
			  if (!mysqli_query($con,$sql))
			  {
			  die('Error: ' . mysqli_error($con));
			  }
			  else
			  {
			$msg ="<br> Registered successfully...";
			  }
		}
		else
		{
?>
		<script type="application/javascript">
			alert("This Email ID already exist in our database..");
		</script>
<?php
		}
	}
}

if(isset($_POST["submitlogin"]))
{
	$sqllogin = mysqli_query($con,"SELECT * FROM profile where  (username='$_POST[username]' or emailid='$_POST[username]') and password='$_POST[password]'");
	if(mysqli_num_rows($sqllogin) == 1)
	{
		$dt = date("Y-m-d h:i:s");
		$rs = mysqli_fetch_array($sqllogin);	
		$update=  mysqli_query($con,"UPDATE  profile SET lastlogin='$dt' WHERE  (username='$_POST[username]' or emailid='$_POST[username]')");

	$_SESSION[profileid] = $rs[profileid];
	header("Location: wallpost.php");	
	}
	else
	{
		$msglogin =  "<br><font color='red'>Failed to login..</font>";
	}
}

if(isset($_POST["btnresetpassword"]))
{

	$sqllogin = mysqli_query($con,"UPDATE profile SET password='$_POST[newpass]' where emailid='$_POST[emailidss]' ");
	if(!$sqllogin)
	{
				$msgupdpass =  "<br><font color='red'>Failed to login..</font>";
		
	}
	else
	{
$msgupdpass = "<br>Password Updated successfully..";		
	}
}
include("header.php");
$_SESSION[setid] = rand();		
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="homepage" class="clear">
      <div class="two_third first">
        <div class="push30"><img src="images/snal/six_figure_mentors_mission.jpg" alt="" width="1200" height="400"></div>
        <!-- #### -->
        <div class="divider2"></div>
        <!-- #### -->
        <div class="two_third first">
          <article class="push30 clear">
            <h2 class="nospace font-medium">Registration</h2>
            <p>
<?php
if(strlen($msg) == 31)
{
	echo "<h2>Registered successfully...</h2>";
}
else
{
?>

            <form name="indexform" method="post" action="" class="rnd5"  onsubmit="return validate()"  >
            <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>">
                  <label class="one_third first" for="author">Firstname:</label> <input name=firstname type=text />
               <label class="one_third first" for="author">Lastname:</label> <input type=text name=lastname />
               <label class="one_third first" for="author">email id: </label><input type=text name=emailid />
               <label class="one_third first" for="author">password:</label> <input type=password name="password" />
               <label class="one_third first" for="author">re-enter password:</label> <input type=password name=confirmpassword />
<?php
               $tomorrow = mktime(0,0,0,date("m"),date("d"),date("Y")-18);
?>
               <label class="one_third first" for="author">DOB: <input type="date" name="dob"  /></label>
               <br>
     <table >
     <tr><td>gender:</td>
     <td>    female</td>  <td>  <input type=radio name=gender value="Female" />  </td>
      <td> male</td>  <td><input type=radio name=gender value="Male" /></td>
     </tr>
     </table>
     
    <label class="one_third first" for="author"><input name=signup type=submit value="Register"  class="button small gradient red" /></label>

  </form>   

<?php
}
?>
            </p>
          
          </article>
        </div>
        <!-- #### -->
        <div class="clear"></div>
      </div>
      <!-- #### -->
      <div class="one_third">
        <div class="tab-wrapper clear">
          <ul class="tab-nav clear">
            <li><a href="#tab-1">Sign In</a></li>
          </ul>
          		<div class="tab-container">
            		<!-- Tab Content -->
            		<div id="tab-1" class="tab-content clear">
            		<form method="post" action=""  name="submitform" onsubmit="return validate1()">
            		<?php
			 		if(isset($msglogin))
			 		{
             		 echo "<strong>$msglogin</strong>";
			 		}
			 		?>
              		<ul class="list arrow">
               		<li><strong>Username / Email ID</strong><input name=username type=text size="30" /></li>
                	<li><strong>Password &nbsp;&nbsp;</strong><input name=password type=password size="30" /></li>
                	<li></li>
              		</ul><input type=submit value=" Login  " name="submitlogin" class="button small gradient red"/>
            		</form>
            		</div>
            		<!-- / Tab Content -->
          		</div>
        </div>
      </div>
      <div>&nbsp;</div>
      <div class="one_third">
        <div class="tab-wrapper clear">
          <ul class="tab-nav clear">
            <li><a href="#tab-1">Forgot your Password</a></li>
          </ul>
          <div class="tab-container">
            <!-- Tab Content -->
            <div id="tab-1" class="tab-content clear">
             <form method="post" action="" onsubmit="return validate2()" name="recoverform">
           
             <?php
			 echo $msgupdpass;
             if(isset($_POST[submitforgetpwd]))
			 {
			 ?>
             <ul class="list arrow">
                <input type="hidden" name="emailidcondition" value="2" />             
                <li><strong>Email ID</strong><input name=emailidss type=text size="30" value="<?php echo $_POST[emailids] ;?>" readonly /></li>
                <li><strong>New Password</strong><input name=newpass type=password size="30" /></li>
                <li><strong>Confirm Password</strong><input name=confpass type=password size="30" /></li>
              </ul>
              <input type="submit" value="Reset Password" name="btnresetpassword" size="30" class="button small gradient red" />
              <?php
			 	}
			 	else
			 	{
			  ?>
             <ul class="list arrow">
                <li><strong>Enter Email ID</strong>
                <input type="hidden" name="emailidcondition" value="1" />
                <input name=emailids type=text size="30" /></li>
                <li></li>
              </ul><input type=submit value=" Recover Password  " name="submitforgetpwd" class="button small gradient red"/>
              <?php
			 	}
			 ?>
              </form>
            </div>
            <!-- / Tab Content -->
          </div>
        </div>
      </div>
      
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
</div>
<?php
include("footer.php");
?>
<script type="application/javascript">
function validate()
{
	var letters = /^[A-Za-z ]+$/;
    if(document.indexform.firstname.value == "")
	{
		alert("Please enter firstname..");
		document.indexform.firstname.focus();
		return false;
	}
	else if(!(document.indexform.firstname.value.match(letters)))
{
alert("Name must contain only letters");
document.indexform.firstname.focus();
return false;
}
	else if(document.indexform.lastname.value == "")
	{
		alert("Please enter lastname..");
		document.indexform.lastname.focus();
		return false;
	}
	else if(!(document.indexform.lastname.value.match(letters)))
{
alert("Name must contain only letters");
document.indexform.lastname.focus();
return false;
}
	else if(document.indexform.emailid.value=="")
	{
		alert("Email ID should not be empty");
		document.indexform.emailid.focus();
		return false;
	}
	else if(document.indexform.password.value=="")
	{
		alert("Password should not be empty");
		document.indexform.password.focus();
		return false;
	}
	else if(document.indexform.password.value.length <6 )
	{
		alert("Entered password should be more than 6 charachers");
		document.indexform.password.value="";
		document.indexform.confirmpassword.value="";
		document.indexform.password.focus();
		return false;
	}
	else if( document.indexform.password.value.length > 15)
	{
		alert("Entered password should be less than 15 character.");
		document.indexform.password.value="";
		document.indexform.confirmpassword.value="";
		document.indexform.password.focus();
		return false;
	}
	else if(document.indexform.password.value != document.indexform.confirmpassword.value)
	{
		alert("Password not matching..");
		document.indexform.password.value="";
		document.indexform.confirmpassword.value="";
		document.indexform.password.focus();
		return false;
	}
	else if(document.indexform.dob.value == "")
	{
		alert("Please enter date of birth..");
		document.indexform.dob.focus();
		return false;
	}
	else if ( ( indexform.gender[0].checked == false ) && ( indexform.gender[1].checked == false ) ) 
	{
		alert("Please enter gender..");
		return false;
		
	
	}
	else
	{
		return true;
	}
	}
</script>
<script type="application/javascript">
function validate1()
{
	
    if(document.submitform.username.value == "")
	{
		alert("Please enter username..");
		document.submitform.username.focus();
		return false;
	}
	else if(document.submitform.password.value=="")
	{
		alert("Password should not be empty");
		document.submitform.password.focus();
		return false;
	}
	
	else
	{
		return true;
	}
	}
</script>

<script type="application/javascript">
//Coding to Reset password
function validate2()
{
	  if(document.recoverform.emailidcondition.value == 1)
	{
		
		if(document.recoverform.emailids.value == "")
		{
			alert("Please enter Emailid..");
			document.recoverform.emailids.focus();
			return false;
		}
	}
	else if(document.recoverform.emailidcondition.value == 2)
	{
			if(document.recoverform.emailidss.value == "")
			{
				alert("Please enter Emailid..");
				document.recoverform.emailids.focus();
				return false;
			}
			else if(document.recoverform.newpass.value=="")
			{
				alert("Password should not be empty");
				document.recoverform.newpass.focus();
				return false;
			}
			else if(document.recoverform.newpass.value.length <6 )
			{
				alert("Entered password should be more than 6 charachers");
				document.recoverform.newpass.value="";
				document.recoverform.confpass.value="";
				document.recoverform.newpass.focus();
				return false;
			}
			else if( document.recoverform.newpass.value.length > 15)
			{
				alert("Entered password should be less than 15 character.");
				document.recoverform.newpass.value="";
				document.recoverform.confpass.value="";
				document.recoverform.newpass.focus();
				return false;
			}
			else if(document.recoverform.newpass.value != document.recoverform.confpass.value)
			{
				alert("Password not matching..");
				document.recoverform.newpass.value="";
				document.recoverform.confpass.value="";
				document.recoverform.newpass.focus();
				return false;
			}
			else
			{
				return true;
			}
	}
	
	}
</script>
