<script src="jquery-1.11.0.js"></script>
<script>
  $(document).ready(function() {
     $('#btn_click').on('click', function() {
							
	var name = $("#name").val();
  	var surname = $("#surname").val();

		if(name=='')
		{
		   $("#msg").show().fadeOut(5000);
		   $("#msg").text("Please enter name");
		   $("#msg").css('color','#F00');
		}
		else if(surname=='')
		{
		   $("#msg").show().fadeOut(5000);
		   $("#msg").text("Please enter surname");
		   $("#msg").css('color','#C09');	
		}
		else
		{
			$.ajax({
				url:'toAction.php',
				data:$(this).serialize(),
				type:'POST',
				success:function(data){
					console.log(data);
						$("#msg").show().fadeOut(5000);
						$("#msg").text("Success with fun");
						$("#msg").css('color','#093');
						
						//----------Clear text box------------//
						$('#name').val("");
						$('#surname').val("");
						//----------Clear text box Ends here------------//
						
						 //----------Reload without Refresh------------//
						 var url = 'mainform.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
						 $('#div1-wrapper').load(url + ' #div1-wrapper'); //note: the space before #div1 is very important
						 //----------Reload without Refresh Ends here------------//
										
				},
				error:function(data){
						$("#msg").show().fadeOut(5000);
						$("#msg").text("Not valid");
						$("#msg").css('color','#F00');			
				}
				});
		}
		
e.preventDefault();
});
});
  </script>
<div id="div1-wrapper">
          <div id="div1">    
                <?php   echo  rand ( 10 , 100 );  ?>         
          </div>  
</div>  
<form class="form2" action="" method="POST" name="myForm" id="myForm">
Your Name:   <input type="text" name="name" id="name" placeholder="Enter name" /><br />
Your Surname: <input type="text" name="surname" id="surname" /><br />
Your Email: <input type="text" name="email" id="email" /><br />
About: <textarea class="textarea" name="about" id="about"></textarea>
<button type="button" id="btn_click" /> click me!</button>
</form>

<div class="buttons">
      <span id="msg" style="display:none; color:#F00">Some Error!Please Fill form Properly </span>
</div>