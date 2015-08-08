<html>
	<head>
		<title>Quick Simple Light Box</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<style type="text/css">
 
		body
		{
			font-family: Helvetica, Arial;
		}
 
		.backdrop
		{
			position:absolute;
			top:0px;
			left:0px;
			width:100%;
			height:100%;
			background:#000;
			opacity: .0;
			filter:alpha(opacity=0);
			z-index:50;
			display:none;
		}
 
		.box
		{
			position:absolute;
			top:10%;
			left:20%;
			width:800px;
			height:400px;
			background:#ffffff;
			z-index:51;
			padding:10px;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			-moz-box-shadow:0px 0px 5px #444444;
			-webkit-box-shadow:0px 0px 5px #444444;
			box-shadow:0px 0px 5px #444444;
			display:none;
		}	
		
		.previous
		{
			float:left;
			margin-left:6px;
			cursor:pointer;
		}
		
		.next
		{
			float:right;
			margin-right:6px;
			cursor:pointer;
		}	
 
		.close
		{
			float:right;
			margin-right:6px;
			cursor:pointer;
		}

		.forimage
		{
			float:left;			
			margin-right:6px;
			cursor:pointer;
			width:400px;
		}
		
		.forcomment
		{
			float:right;
			margin-right:6px;
			cursor:pointer;
			width:350px;
		}
 
		</style>
 
		<script type="text/javascript">
 
			$(document).ready(function(){
 
				$('.lightbox').click(function(){
					$('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
					$('.box').animate({'opacity':'1.00'}, 300, 'linear');
					$('.backdrop, .box').css('display', 'block');
				});
 
				$('.close').click(function(){
					close_box();
				});
 
				$('.backdrop').click(function(){
					close_box();
				});
 
			});
 
			function close_box()
			{
				$('.backdrop, .box').animate({'opacity':'0'}, 300, 'linear', function(){
					$('.backdrop, .box').css('display', 'none');
				});
			}
 
		</script>
 
	</head>
	<body>
 
	<h1>This is my webpage...</h1>
	<a href="xhr_response.html?ajax=true&amp;width=400&amp;height=160" class="lightbox">Open Lightbox</a>
 
	<div class="backdrop"></div>
	<div class="box">
    	<div class="close"> x </div>
        <div class="previous"> < </div>
        <div class="next"> > </div>
    
    <div class="forimage">
    Image Name <hr>
    <img src="" width="" height="">
    </div>
    <div class="forcomment">Comment box</div>
    
    </div>
 
	</body>
</html>