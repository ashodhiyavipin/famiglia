<?php
include("header.php");
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
      <section class="clear">
        <h1>&lt;h1&gt; to &lt;h6&gt; - Headline Colour and Size Are All The Same</h1>
        <p>
        
        <video width="350" height="260" controls>
	  <source src="videos/Richard Clayderman - Flowers Flowers Flowers.mp4" type="video/mp4">
	  <source src="movie.ogg" type="video/ogg">
	  <source src="movie.webm" type="video/webm">
	  <object data="videos/Richard Clayderman - Flowers Flowers Flowers.mp4" width="320" height="240">
		<embed src="movie.swf" width="320" height="240">
	  </object> 
	</video>
       </p>
      </section>
      
      

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
<?php
include("footer.php");
?>