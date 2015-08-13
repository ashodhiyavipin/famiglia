<?php
session_start();
include("dbconnection.php");
$sql="insert into profile(firstname,lastname,emailid,password,dob,gender)
values('$_POST[firstname]','$_POST[lastname]','$_POST[emailid]','$_POST[password]','$_POST[dob]','$_POST[gender]')";
 if (!mysqli_query($con,$sql))
	  {
	  die('Error: ' .mysqli_error($con));
	  }
	  else
	  {
	$msg ="<br> 1 record added";
	  }
include("header.php");
?>

<div id="wrapper">
	<!-- start page -->
	<div id="page">
		<div id="sidebar1" class="sidebar">
			<ul>
				<li>
					<h2>Recent Posts</h2>
				</li>
				<li>
				  </li>
			</ul>
		</div>
		<!-- start content -->
		<div id="content">
			<div class="flower"><img src="images/img06.jpg" alt="" width="510" height="250" /></div>
			<div class="post">
				<h1 class="title"><a href="#">Sign in!</a>				</h1><p class="byline"><small>please enter username and password </small></p>
				<div class="entry">
				  <table width="468">
<tr><td width="113">user name</td><td width="337"><input name=username type=text size="35" /></td></tr>
<tr><td>password</td><td><input name=password type=password size="35" /></td></tr>
<tr><td colspan="2" align="center"><input type=submit value=login name=submit/>  <input type=reset value=reset name=reset/></td>
</tr>
</table>
				</div>
			</div>
			<div class="post">
				<h2 class="title"><a href="#">Signup</a></h2>
			<p class="byline"><small>It’s free and always will be. </small></p>	
			  <div class="entry">
              <form name="f3" method="post" action="">
              <table width="427">
					<tr><td>firstname:</td><td><input type=text name=firstname /></td></tr>
               <tr><td>lastname:</td><td><input type=text name=lastname /></td></tr> 
               <tr><td>email id:</td><td><input type=text name=emailid /></td></tr> 
               <tr><td>password:</td><td><input type=password name="password" /></td></tr>  
               <tr><td>re-enter password:</td><td><input type=password name=confirmpassword /></td></tr> 
               <tr><td>DOB:</td>
               <td><input type="date" name="dob" />  </td></tr>
     <tr><td>gender:</td><td>
     female<input type=radio name=gender value="Female" />  
     male<input type=radio name=gender value="Male" /></td></tr>
     <tr><td colspan="2" align="center"><input name=signup type=submit value="Register" /></td></tr>
  <tr><td></td></tr>  
  </table>
  </form>        
               
				</div>
			</div>
			<div class="post"></div>
		</div>
		<!-- end content -->
		<!-- start sidebars -->
		<div id="sidebar2" class="sidebar">
			<ul>
				<li>
					<form id="searchform" method="get" action="#">
						<div>
							<h2>Site Search</h2>
						</div>
					</form>
				</li>
				<li>				  </li>
			</ul>
		</div>
		<!-- end sidebars -->
	  <div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end page -->
</div>
<?php
include("footer.php");
?>