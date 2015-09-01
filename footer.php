<?php
session_start();
$basename = basename($_SERVER['REQUEST_URI']);
include("dbconnection.php");
?>
<!-- Refresh chatbox code  -->
<script type="text/javascript">
$(document).ready(function() {
$('.View1').load('chatbox1.php');
var auto_refresh = setInterval(
    function ()
    {
        $('.View1').load('chatbox1.php').fadeIn("slow");
    }, 1000); // refresh every 15000 milliseconds
        $.ajaxSetup({ cache: true });
    });

$(document).ready(function() {
$('.View2').load('chatbox2.php');
var auto_refresh = setInterval(
    function ()
    {
        $('.View2').load('chatbox2.php').fadeIn("slow");
    }, 1000); // refresh every 15000 milliseconds
        $.ajaxSetup({ cache: true });
    });

$(document).ready(function() {
$('.View3').load('chatbox3.php');
var auto_refresh = setInterval(
    function ()
    {
        $('.View3').load('chatbox3.php').fadeIn("slow");
    }, 1000); // refresh every 15000 milliseconds
        $.ajaxSetup({ cache: true });
    });

$(document).ready(function() {
$('.View4').load('chatbox4.php');
var auto_refresh = setInterval(
    function ()
    {
        $('.View4').load('chatbox4.php').fadeIn("slow");
    }, 1000); // refresh every 15000 milliseconds
        $.ajaxSetup({ cache: true });
    });
</script>
<!-- Refresh chatbox code ends here  -->

<script>
x=0;
$(document).ready(function(){
  $("tab-content").scroll(function(){
  });
});
</script>
<?php
if(isset($_GET[getvar4]))
{
	$_SESSION[chat4] = $_GET[getvar4];
}
else
{
	 $getvar= "getvar4";
}
if(isset($_GET[getvar3]))
{
	$_SESSION[chat3] = $_GET[getvar3];
}
else
{
	 $getvar= "getvar3";
}
if(isset($_GET[getvar2]))
{
	 $_SESSION[chat2] = $_GET[getvar2];
}
else
{
	 $getvar= "getvar2";
}
if(isset($_GET[getvar1]))
{
	$_SESSION[chat1] = $_GET[getvar1];
}
else
{
	 $getvar= "getvar1";
}
?>
<?php
if(isset($_SESSION[profileid]))
{
?>

<style type="text/css">

div#bottomdiv {
	position:fixed;
	bottom:0px;
	right:0px;
	width:200px;
	color:#CCC;
	background:#FFC;
	padding:8px;
}
</style>

<div id="bottomdiv">
			<!-- Chat code starts here -->
            <div class="accordion-wrapper"><a href="javascript:void(0)" class="accordion-title red">
            	<span>Chat Box</span></a>
                  <div class="accordion-content">
                        <p>
                             <?php
            $friend= mysqli_query($con, "SELECT * from friends where (profileid1='$_SESSION[profileid]' or profileid2='$_SESSION[profileid]') and requeststatus='accepted'");
			?>
            <?php
while($rs = mysqli_fetch_array($friend))
{
	$r=mysqli_query($con, "SELECT * from profile where (profileid='$rs[profileid2]' or profileid='$rs[profileid1]') and profileid!='$_SESSION[profileid]'");
	$show= mysqli_fetch_array($r);
	$img=mysqli_query($con, "SELECT * from images where imgid='$show[imgid]'");
    $pic= mysqli_fetch_array($img);
	if($pic[imagepath] == "")
	{
    $profileimage="images/profiledefault.jpg";
	}
	else
	{
    $profileimage="uploads/".$pic[imagepath];
	}
		echo "<li class='one_sixth'><img src='$profileimage' class='icon-desktop icon-6x'></li>";
		if($_SERVER['QUERY_STRING'] == "")
		{
		echo "<a href='$basename?$getvar=$show[profileid]'>".$show[firstname]."&nbsp;$show[lastname]</a>";
		}
		else
		{
		echo "<a href='$basename&$getvar=$show[profileid]'>".$show[firstname]."&nbsp;$show[lastname]</a>";
		}
		echo "<hr>";
}
?>
                        </p>
                  </div>
       		</div>
            <!-- Chat code ends here -->
</div>
<?php
if(isset($_SESSION[chat1]))
{
?>
<!-- Chat 1 box code -->
<style type="text/css">

div#bottomdiv1 {
	position:fixed;
	bottom:0px;
	right:220px;
	width:300px;
	color:#CCC;
	background:#FFF;
	padding:8px;
}
</style>

<div id="bottomdiv1">
<?php
$qchatuser=mysqli_query($con,"select * from profile where profileid='$_SESSION[chat1]'");
$rschatuser=mysqli_fetch_array($qchatuser);
?>
			<!-- Chat code starts here -->
            <div class="accordion-wrapper"><a href="javascript:void(0)" class="accordion-title red">
            	<span><?php echo $rschatuser[firstname]. " ". $rschatuser[lastname];
				?></span></a>
                  <div class="accordion-content" >
						<div  style="width:100%;height:250px;overflow:scroll;">
                            <div class="View1">
                            <?php
							include("chatbox1.php");
                            ?>
                            </div>
                        </div>
<form name="msgchat1" action="" method="post">
    <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
    <input type="hidden" name="sendto" value="<?php echo $_SESSION[chat1]; ?>" />
    <textarea name="msg1" cols="50" autocomplete="off" type="text" id="msg1"  onkeypress="return runScript1(event)"></textarea>
</form>
                  </div>
       		</div>
            <!-- Chat code ends here -->
</div>
<?php
}
if(isset($_SESSION[chat2]))
{
?>
<!-- Chat 2 box code -->
<style type="text/css">

div#bottomdiv2 {
	position:fixed;
	bottom:0px;
	right:540px;
	width:300px;
	color:#CCC;
	background:#FFF;
	padding:8px;
}
</style>

<div id="bottomdiv2">
<?php
$qchatuser=mysqli_query($con,"select * from profile where profileid='$_SESSION[chat2]'");
$rschatuser=mysqli_fetch_array($qchatuser);
?>
			<!-- Chat code starts here -->
            <div class="accordion-wrapper"><a href="javascript:void(0)" class="accordion-title red">
            	<span><?php echo $rschatuser[firstname]. " ". $rschatuser[lastname];
				?></span></a>
                  <div class="accordion-content">
<div  style="width:100%;height:250px;overflow:scroll;">
                            <div class="View2">
                            <?php
                            include("chatbox2.php");
                            ?>
                            </div>
                        </div>
<form name="msgchat2" action="" method="post">
    <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
    <input type="hidden" name="sendto" value="<?php echo $_SESSION[chat2]; ?>" />
    <textarea name="msg1" cols="50" autocomplete="off" type="text" id="msg1"  onkeypress="return runScript2(event)"></textarea>
</form>
                  </div>
       		</div>
            <!-- Chat code ends here -->
</div>
<?php
}
if(isset($_SESSION[chat3]))
{
?>
<!-- Chat 3 box code -->
<style type="text/css">

div#bottomdiv3 {
	position:fixed;
	bottom:0px;
	right:820px;
	width:300px;
	color:#CCC;
	background:#FFF;
	padding:8px;
}
</style>

<div id="bottomdiv3">
<?php
$qchatuser=mysqli_query($con,"select * from profile where profileid='$_SESSION[chat3]'");
$rschatuser=mysqli_fetch_array($qchatuser);
?>
			<!-- Chat code starts here -->
            <div class="accordion-wrapper"><a href="javascript:void(0)" class="accordion-title red">
            	<span><?php echo $rschatuser[firstname]. " ". $rschatuser[lastname]; ?></span></a>
                  <div class="accordion-content">
<div  style="width:100%;height:250px;overflow:scroll;">
                            <div class="View3">
                            <?php
                            include("chatbox3.php");
                            ?>
                            </div>
                        </div>
<form name="msgchat3" action="" method="post">
    <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
    <input type="hidden" name="sendto" value="<?php echo $_SESSION[chat3]; ?>" />
    <textarea name="msg1" cols="50" autocomplete="off" type="text" id="msg1"  onkeypress="return runScript3(event)"></textarea>
</form>
                        </p>
                  </div>
       		</div>
            <!-- Chat code ends here -->
</div>
<?php
}
if(isset($_SESSION[chat4]))
{
?>
<!-- Chat 4 box code -->
<style type="text/css">

div#bottomdiv4 {
	position:fixed;
	bottom:0px;
	right:1080px;
	width:300px;
	color:#CCC;
	background:#FFF;
	padding:8px;
}
</style>

<div id="bottomdiv4">
<?php
$qchatuser=mysqli_query($con,"select * from profile where profileid='$_SESSION[chat4]'");
$rschatuser=mysqli_fetch_array($qchatuser);
?>
			<!-- Chat code starts here -->
            <div class="accordion-wrapper"><a href="javascript:void(0)" class="accordion-title red">
            	<span><?php echo $rschatuser[firstname]. " ". $rschatuser[lastname]; ?></span></a>
                  <div class="accordion-content">
<div  style="width:100%;height:250px;overflow:scroll;">
                            <div class="View4">
                            <?php
                            include("chatbox4.php");
                            ?>
                            </div>
                        </div>
                        <form name="msgchat4" action="" method="post">
                            <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
                            <input type="hidden" name="sendto" value="<?php echo $_SESSION[chat4]; ?>" />
                            <textarea name="msg1" cols="50" autocomplete="off" type="text" id="msg1"  onkeypress="return runScript4(event)"></textarea>
                        </form>
       		</div>
            <!-- Chat code ends here -->
</div>
<?php
}
?>

<!-- Chat box ends here -->
<?php
}
?>
<!-- Footer -->
<br>
<div class="wrapper row4">
  <div id="copyright" class="clear">
    <p class="fl_left">Copyright &copy; 2015 - All Rights Reserved - <a href="index.php">Famiglia</a> </p>
    <p class="fl_right">Developer Vipin Ashodhiya
</p>
  </div>
</div>
<!-- Scripts -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="layout/scripts/jquery-latest.min.js"><\/script>\
<script src="layout/scripts/jquery-ui.min.js"><\/script>')</script>
<script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
<script src="layout/scripts/jquery-mobilemenu.min.js"></script>
<script src="layout/scripts/custom.js"></script>
</body>
</html>
