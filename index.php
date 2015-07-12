<?php
session_start();
if (isset($_SESSION[profileid])) {
	header("Location:wallpost.php");
}
include ("dbconnection.php");
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
<script type="application/javascript">alert("This Email ID already exist in our database..");</script>
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
$msglogin =  "<p class='alert alert-danger'>Please check Username/Email or Password.</p>";
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
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
		<script src="includes/jquery/jquery-1.11.0.js"></script>
		<script src="includes/bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="includes/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="includes/css/style3.css" />
		<link rel="stylesheet" type="text/css" href="includes/css/animate-custom.css" />
	</head>
	<body>
		<script type="application/javascript">
			function validate() {
				var letters = /^[A-Za-z ]+$/;
				if (document.indexform.firstname.value == "") {
					alert("Please enter firstname..");
					document.indexform.firstname.focus();
					return false;
				} else if (!(document.indexform.firstname.value.match(letters))) {
					alert("Name must contain only letters");
					document.indexform.firstname.focus();
					return false;
				} else if (document.indexform.lastname.value == "") {
					alert("Please enter lastname..");
					document.indexform.lastname.focus();
					return false;
				} else if (!(document.indexform.lastname.value.match(letters))) {
					alert("Name must contain only letters");
					document.indexform.lastname.focus();
					return false;
				} else if (document.indexform.emailid.value == "") {
					alert("Email ID should not be empty");
					document.indexform.emailid.focus();
					return false;
				} else if (document.indexform.password.value == "") {
					alert("Password should not be empty");
					document.indexform.password.focus();
					return false;
				} else if (document.indexform.password.value.length < 6) {
					alert("Entered password should be more than 6 charachers");
					document.indexform.password.value = "";
					document.indexform.confirmpassword.value = "";
					document.indexform.password.focus();
					return false;
				} else if (document.indexform.password.value.length > 15) {
					alert("Entered password should be less than 15 character.");
					document.indexform.password.value = "";
					document.indexform.confirmpassword.value = "";
					document.indexform.password.focus();
					return false;
				} else if (document.indexform.password.value != document.indexform.confirmpassword.value) {
					alert("Password not matching..");
					document.indexform.password.value = "";
					document.indexform.confirmpassword.value = "";
					document.indexform.password.focus();
					return false;
				} else if (document.indexform.dob.value == "") {
					alert("Please enter date of birth..");
					document.indexform.dob.focus();
					return false;
				} else if ((indexform.gender[0].checked == false ) && (indexform.gender[1].checked == false )) {
					alert("Please enter gender..");
					return false;

				} else {
					return true;
				}
			}
		</script>
		<script type="application/javascript">
			function validate1() {

				if (document.submitform.username.value == "") {
					alert("Please enter username..");
					document.submitform.username.focus();
					return false;
				} else if (document.submitform.password.value == "") {
					alert("Password should not be empty");
					document.submitform.password.focus();
					return false;
				} else {
					return true;
				}
			}
		</script>

		<script type="application/javascript">
			//Coding to Reset password
			function validate2() {
				if (document.recoverform.emailidcondition.value == 1) {

					if (document.recoverform.emailids.value == "") {
						alert("Please enter Emailid..");
						document.recoverform.emailids.focus();
						return false;
					}
				} else if (document.recoverform.emailidcondition.value == 2) {
					if (document.recoverform.emailidss.value == "") {
						alert("Please enter Emailid..");
						document.recoverform.emailids.focus();
						return false;
					} else if (document.recoverform.newpass.value == "") {
						alert("Password should not be empty");
						document.recoverform.newpass.focus();
						return false;
					} else if (document.recoverform.newpass.value.length < 6) {
						alert("Entered password should be more than 6 charachers");
						document.recoverform.newpass.value = "";
						document.recoverform.confpass.value = "";
						document.recoverform.newpass.focus();
						return false;
					} else if (document.recoverform.newpass.value.length > 15) {
						alert("Entered password should be less than 15 character.");
						document.recoverform.newpass.value = "";
						document.recoverform.confpass.value = "";
						document.recoverform.newpass.focus();
						return false;
					} else if (document.recoverform.newpass.value != document.recoverform.confpass.value) {
						alert("Password not matching..");
						document.recoverform.newpass.value = "";
						document.recoverform.confpass.value = "";
						document.recoverform.newpass.focus();
						return false;
					} else {
						return true;
					}
				}

			}
		</script>
		<div class="container">
			<section>
				<div id="container_demo" >
					<a class="hiddenanchor" id="toregister"></a>
					<a class="hiddenanchor" id="tologin"></a>
					<div id="wrapper">
						<div id="login" class="animate form">
							<form method="post" action=""  name="submitform" onsubmit="return validate1()">
								<h1>Log in</h1>
								<p>
									<label for="username" class="uname"><img src="includes/glyphicons/glyphicons-4-user.png" />&nbsp;Your email or username </label>
									<input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
								</p>
								<p>
									<label for="password" class="youpasswd"><img src="includes/glyphicons/glyphicons-45-keys.png" />&nbsp;Your password </label>
									<input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" />
								</p>
								<!-- <p class="keeplogin">
								<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" />
								<label for="loginkeeping">Keep me logged in</label>
								</p> -->
								<?php
								if (isset($msglogin)) {
									echo "$msglogin";
								}
								?>
								<p class="login button">
									<input type="submit" value="Login" name="submitlogin"/>
								</p>
								<p class="change_link">
									Not a member yet ?
									<a href="#toregister" class="to_register">Join us</a>
								</p>
							</form>
						</div>

						<div id="register" class="animate form">
							<form name="indexform" method="post" action="" onsubmit="return validate()"  >
								<h1> Sign up </h1>
								<p>
									<label for="usernamesignup" class="uname" data-icon="u"> First Name</label>
									<input id="usernamesignup" name="firstname" required="required" type="text" placeholder="eg. 'John'" />
								</p>
								<p>
									<label for="usernamesignup" class="uname"data-icon="u"> Last Name</label>
									<input id="emailsignup" name="lastname" required="required" type="text" placeholder="eg. 'Doe'"/>
								</p>
								<p>
									<label for="passwordsignup" class="youpasswd" data-icon="p"> Email Address</label>
									<input id="passwordsignup" name="emailid" required="required" type="email" placeholder="eg. 'mymail@mail.com"/>
								</p>
								<p>
									<label for="passwordsignup" class="youpasswd" data-icon="p"> Your Password</label>
									<input id="passwordsignup" name="password" required="required" type="password" placeholder="eg. X8df!90EO"/>
								</p>
								<p>
									<label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
									<input id="passwordsignup_confirm" name="confirmpassword" required="required" type="password" placeholder="eg. X8df!90EO"/>
								</p>
								<?php
								$tomorrow = mktime(0, 0, 0, date("m"), date("d"), date("Y") - 12);
								?>
								<p>
									<label for="passwordsignup_confirm" class="youpasswd"> Date of birth </label>
									<input id="passwordsignup_confirm" name="confirmpassword" required="required" type="date"/>
								</p>

								<p class="signin button">
									<input type="submit" value="Sign up" name="signup"/>
								</p>
								<p class="change_link">
									Already a member ?
									<a href="#tologin" class="to_register"> Go and log in </a>
								</p>
							</form>
						</div>

					</div>
				</div>
			</section>
		</div>
		<?php
		include ("footer.php");
		?>
	</body>
</html>

