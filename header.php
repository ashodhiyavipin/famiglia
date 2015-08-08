<?php
session_start();
include("dbconnection.php");

?>
<script src="layout/scripts/jquery-latest.min.js"></script>
<script src="layout/bootstrap/js/bootstrap.min.js"></script>
<script src="layout/scripts/jquery-ui.min.js"></script> 

<script type="text/javascript">

function runScript1(e) {
    if (e.keyCode == 13) {
		insertmessage(msgchat1.sendto.value,msgchat1.msg1.value);
		msgchat1.msg1.value="";
    }
}

function runScript2(e) {
    if (e.keyCode == 13) {
		insertmessage(msgchat2.sendto.value,msgchat2.msg1.value);
		msgchat2.msg1.value="";
    }
}

function runScript3(e) {
    if (e.keyCode == 13) {
		insertmessage(msgchat3.sendto.value,msgchat3.msg1.value);
		msgchat3.msg1.value="";
    }
}

function runScript4(e) {
    if (e.keyCode == 13) {
		insertmessage(msgchat4.sendto.value,msgchat4.msg1.value);
		msgchat4.msg1.value="";
    }
}

function insertmessage(sendto,msg)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajaxchatinsert.php?sendto="+sendto+"&msg="+msg,true);
xmlhttp.send();
}
</script>
<?php
$chaturl = basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];;

if(isset($_SESSION[profileid]))
{
	$sqllogin = mysqli_query($con,"SELECT * FROM profile LEFT JOIN images ON profile.imgid=images.imgid where  profile.profileid='$_SESSION[profileid]'");
	if(mysqli_num_rows($sqllogin) == 1)
	{
		$rs = mysqli_fetch_array($sqllogin);
		$fnamesession = $rs[firstname];	
		$lnamesession = $rs[lastname];	
		$imgpathsession = $rs[imagepath];
	}
	
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Famiglia</title>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="layout/styles/main.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/styles/mediaqueries.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
</head>
<body class="container-fluid">
		<div class="jumbotron">
			<div class="row">
			<div class="col-sm-6">
			<a href="index.php"><h1>Famiglia</h1></a>
			<p>
				A way for family to connect online securely!
			</p>
			</div>
			<div class="col-sm-6" style="text-align: right">
				<?php
				if(isset($_SESSION[profileid]))
				{
				?>
				<h2>Welcome!&nbsp;
				<?php echo $fnamesession . " " . $lnamesession; ?>
				</h2>
				<?php
				}
				?>
			</div>
		</div>
	</div>
<!-- ################################################################################################ -->
<?php
if(isset($_SESSION[profileid]))
{
?>
<div class="container-fluid">
  <nav role="navigation" class="navbar navbar-inverse">
  	<div class="navbar-header">
  	<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
  	<span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
     </button>
     <a href="index.php" class="navbar-brand">Home</a>
     </div>
     <div id="navbarCollapse" class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="dropdown"><a data-toggle="dropdown" href="#" title="Pages" class="dropdown-toggle">Profile <b class="caret"></b></a>
           <ul role="menu" class="dropdown-menu">
            <li><a href="profile.php" title="Homepage">Profile</a></li>   
            <li><a href="changpwd.php" title="Homepage">Change password</a></li>                  
          </ul>
      </li>
      <li><a href="wallpostsingleuser.php" title="Elements">My Wallpost</a></li>
      <li class="dropdown"><a data-toggle="dropdown" href="" title="Elements" class="dropdown-toggle">Friends <b class="caret"></b></a>
      	<ul role="menu" class="dropdown-menu">
        	<li><a href="friendslist.php" title="Friends list">Friends list</a></li>
          <li><a href="friendrequest.php" title="Search friends">Search friends</a></li>
          <li><a href="pending.php" title="View Friend request">View Friend request</a></li>           
         	</ul>
      </li>
      <li><a href="viewmessage.php" title="Portfolio Layouts">Message</a></li>
      <li><a href="album.php" title="Gallery Layouts">Gallery</a></li>
      <li><a href="wallpostvideos.php" title="Gallery Layouts">Video</a></li>
      <li class="dropdown"><a data-toggle="dropdown" href="#" title="Gallery Layouts" class="dropdown-toggle">Groups <b class="caret"></b></a>
      	<ul role="menu" class="dropdown-menu">
        	<li><a href="group.php" title="Friends list">Create New Group</a></li>
          <li><a href="viewgroups.php" title="Search friends">View Groups</a></li>          
         	</ul>      
      </li>
      <li><a href="events.php" title="Create and publish events here">Events</a></li>
      <!-- <li class="last-child"><a href="logout.php" title="Logout">Logout</a></li> -->
    </ul>
    <form role="search" class="navbar-form navbar-left" name="search">
    	<div class="form-group">
     	<input type="text" placeholder="Search" class="form-control input-lg" id="usr">
     </div>
    </form>
    <ul class="nav navbar-nav navbar-right">
    	<li class="last-child"><a href="logout.php" title="Logout">Logout</a></li>
    </ul>
    </div>
  </nav>
 </div>
<?php
}
?>

<?php
//Menu for administrator
if(isset($_SESSION[adminid]))
{
?>
<div class="wrapper row2">
  <nav id="topnav">
    <ul class="clear">
      <li class="active"><a href="adminpanel.php" title="Homepage">Admin Home</a></li>
       <li><a href="adminpanel.php" title="Homepage" class="drop">Admin</a>
      		<ul>
        	<li><a href="adminadd.php" title="Homepage">Add Admin</a></li>
            <li><a href="adminsview.php" title="Homepage">View Admin</a></li>
          </ul>
      </li>
       

      <li><a href="adminpanel.php" title="Homepage" class="drop">Advertisement</a>
      		<ul>
        	<li><a href="advertisement.php" title="Homepage">Post Advertisement</a></li>
            <li><a href="adminviewadvertisements.php" title="Homepage">View Advertisements</a></li>
          </ul>
      </li>
      
     <li><a href="adminpanel.php" title="Homepage" class="drop">Post</a>
      	<ul>
      	<!-- To be implemented -->
            <li><a href="adminviewwallpost.php" title="Homepage">Wallpost</a></li>
            <li><a href="adminviewphotos.php" title="Homepage">Photos</a></li>
            <li><a href="adminviewvideos.php" title="Homepage">Videos</a></li>
            <li><a href="adminviewevents.php" title="Homepage">Events</a></li>
          </ul>
          <!-- To be implemented -->
      </li>
      
      <li><a href="adminviewprofile.php" title="Homepage">Profile</a> </li>

    	<li><a href="adminviewgroups.php" title="Homepage">Groups</a></li>

        	<li><a href="adminviewmessage.php" title="Homepage">Messages</a></li>

        	<li><a href="logout.php" title="Homepage">Logout</a></li>
     </ul>
  </nav>
</div>
<?php
}
?>
</body>
</html>
