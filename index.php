<head>
	<style>
        .form-control1 {
            width: 105%;
            margin-left: -15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
	</style>
</head>
<?php
session_start();
if (isset($_SESSION[profileid])) {
	header("Location: wallpost.php");
}
include ("dbconnection.php");
?>

<?php
if($_POST[setid]==$_SESSION[setid])
{
	if (isset($_POST["signup"]))
	{
		$sqllogin = mysqli_query($con,"SELECT * FROM profile where emailid='$_POST[emailid]' ");
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
<script type="application/javascript">alert("This Email ID or username already exist in our database..");</script>
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
	<div id="container-fluid">

		<!-- ################################################################################################ -->
		<?php
if(strlen($msg) == 31)
{
echo "<h2>Registered successfully...</h2>";
}
else
{
		?>
		<div class="col-xs-6">
			<form name="indexform" method="post" action="" onsubmit="return validate()">
				<div class="row">
					<div class="col-xs-12">
						<h3>Register with us!</h3>
						<br>
					</div>
					<div class="col-xs-12">
						<label class="lead">Your name</label>
						<input type="text" class="form-control" name="firstname" placeholder="Your first name e.g. John"/>
					</div>
					<div class="col-xs-12">
						<label class="lead">Your family name</label>
						<input type="text" class="form-control" name="lastname" placeholder="Your family name or last name e.g. Doe" />
					</div>
					<div class="col-xs-12">
						<label class="lead">Your Email</label>
						<input type="email" class="form-control" name="emailid" placeholder="Your email e.g. johndoe@example.com" />
					</div>
					<div class="col-xs-12">
						<label class="lead">Choose your password</label>
						<input type="password" class="form-control" name="password" placeholder="Choose a password" />
					</div>
					<div class="col-xs-12">
						<label class="lead">Please confirm password</label>
						<input type="password" class="form-control" name="confirmpassword" placeholder="Confirm your password" />
						<?php $tomorrow = mktime(0, 0, 0, date("m"), date("d"), date("Y") - 18); ?>
						<div class="col-xs-12">
							<label class="lead">Your birthdate</label>
							<input type="date" class="form-control1" name="dob" />
						</div>
						<div class="col-xs-4">
							<label class="lead">Gender</label>
						</div>
						<div class="btn-group col-xs-8" data-toggle="buttons">

							<label class="btn btn-primary">
								<input type="radio" name="gender" value="Male" id="option1"/>
								Male </label>
							<label class="btn btn-primary">
								<input type="radio" name="gender" value="Female" id="option2"/>
								Female </label>

						</div>
						<div class="col-xs-12">
							<input type="submit" value="Signup!" name="signup" class="btn btn-primary btn-lg btn-block"/>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	}
	?>

	<div class="col-xs-6">
		<form method="post" action="" name="submitform" onsubmit="return validate1()">
			<?php
			if (isset($msglogin)) {
				echo "<strong>$msglogin</strong>";
			}
			?>
			<div class="row">
				<h3>Login</h3>
				<div class="col-xs-12">
					<label>Username/Email address</label>
					<input type="text" name=username size="30" class="form-control"/>
				</div>
				<div class="col-xs-12">
					<label>Password</label>
					<input type="password" name="password" size="30" class="form-control"/>
				</div>
				<div class="col-xs-12">
					<input type="submit" value="Login" name="submitlogin" class="btn btn-primary btn-lg btn-block" />
				</div>
			</div>
		</form>
	</div>
	<div>
		&nbsp;
	</div>
	<div class="one_third">
		<div class="tab-wrapper clear">
			<ul class="tab-nav clear">
				<li>
					<a href="#tab-2">Password Recovery</a>
				</li>
			</ul>
			<div class="tab-container">
				<div id="tab-2" class="tab-content clear">
					<form method="post" action="" onsubmit="return validate2()" name="recoverform">
						<?php
						echo $msgupdpass;
						if(isset($_POST[submitforgetpwd]))
						{
						?>
						<ul class="list arrow">
							<input type="hidden" name="emailidcondition" value="2" />
							<li>
								<strong>Email ID</strong>
								<input name=emailidss type=text size="30" value="<?php echo $_POST[emailids]; ?>" readonly />
							</li>
							<li>
								<strong>New Password</strong>
								<input name=newpass type=password size="30" />
							</li>
							<li>
								<strong>Confirm Password</strong>
								<input name=confpass type=password size="30" />
							</li>
						</ul>
						<input type="submit" value="Reset Password" name="btnresetpassword" size="30" class="button small gradient red" />
						<?php
						}
						else
						{
						?>
						<ul class="list arrow">
							<li>
								<strong>Enter Email ID</strong>
								<input type="hidden" name="emailidcondition" value="1" />
								<input name=emailids type=text size="30" />
							</li>
						</ul>
						<input type=submit value=" Recover Password  " name="submitforgetpwd" class="button small gradient red"/>
						<?php
						}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
<?php
include ("footer.php");
?>
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
