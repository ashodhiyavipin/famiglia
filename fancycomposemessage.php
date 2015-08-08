<?php
session_start();
include ("dbconnection.php");
include ("autosuggestion.php");
$_SESSION[setid] = rand();
?>
<!--
<link href="layout/styles/main.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/styles/mediaqueries.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/scripts/responsiveslides/responsiveslides.css" rel="stylesheet" type="text/css" media="all"> -->
<style>
    #forms {
        height: 300px;
        width: 600px;
        position: fixed;
        margin-left: 300px;
    }
    #display {
        margin-left: -800px;
    }

</style>
<link href="layout/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
<center>
	<div id="respond" class="container">
		<div class="row">
			<h2>Compose Message</h2>
		</div>
		<div class="row">
			<form class="rnd5" action="viewmessage.php" method="post">
				<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
				<div class="form-input clear">
					<label class="one_half first" for="author">Send to </label>
					<br>
					<br>
					<div id="txtHint" class="col-sm-12">
						<input type="text" class="search input-lg" id="searchbox" />
					</div>
					<center>
					<div id="display" class="col-sm-12"></div>
					</center>
				</div>
		</div>
		<div class="form-message row">
			<textarea name="msg" id="msg" cols="45" rows="10" class="input-lg"></textarea>
		</div>
		<p class="row">
			<br />

			<input type="submit" value="Submit" name="submit" class="btn-lg">
			&nbsp;
			<input type="reset" value="Reset" class="btn-lg">
		</p>
		</form>
	</div>
</center>
<script>
	function showUser(str) {
		if (str == "") {
			document.getElementById("txtHint").innerHTML = "";
			return;
		}
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "fancycomposemessageajax.php?q=" + str, true);
		xmlhttp.send();
	}
</script>
