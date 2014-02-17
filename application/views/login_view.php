<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 
  'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>

<head>    
		<title>Welcome to Muchos Besos</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/scripts/jquery.bpopup.min.js" type="text/javascript"></script>
		<link href="<?php echo base_url(); ?>assets/style/master.css" rel="stylesheet" type="text/css" />
</head>
<body>
		<div class="bodyContainer">
		</div>
		<div class="bodyContent">
			Hello, <font color="Red"><?php echo $name ?></font><br/>
			<a href="#" onclick="setProcess(1)">Begin process</a>

		    <div id='login_form'>
		        <form action='<?php echo base_url();?>index.php/login/process' method='post' name='process'>
		            <h2>User Login</h2>
		            <br />            
		            <?php if(! is_null($msg)) echo $msg;?>
		            <label for='username'>Username</label>
		            <input type='text' name='username' id='username' size='25' /><br />
		        
		            <label for='password'>Password</label>
		            <input type='password' name='password' id='password' size='25' /><br />                            
		        
		            <input type='Submit' value='Login' />            
		        </form>
		    </div>			
		</div>
	<input id="current_step_index" type="hidden"/>
	<div class="signupStep hide" id="current_step"></div>
</body>
	<script type="text/javascript">
		var isReverse = false;
		function loadStep(index){
			$.get('<?php echo base_url(); ?>index.php/steps/index/' + index, function(data){
				$('#current_step_index').val(index);
				$('#current_step').html(data);
				$('#current_step').addClass('showing');
			});	
		}
		function setProcess(index){
			$('#current_step').bPopup(popupOptions(index));
		}
		function popupOptions(stepIndex, reverse){
			return {
            speed: 450,
            transition: reverse ? 'slideIn' : 'slideBack',
            transitionClose: reverse ? 'slideBack' : 'slideIn',
            modal: false,
            onOpen: function() { 
				loadStep(stepIndex);
            }
			};
		}
		$(document).ready(function(){
			$('.stepEndProcess').live('click', function(){
				$('#current_step').bPopup().close('fadeIn');
			});
			$('.nextStep').live('click', function(){
				if(isReverse){
					$('#current_step').bPopup().close(true);
					isReverse = false;
				}
				else					
					$('#current_step').bPopup().close();
				var currStep = parseInt($('#current_step_index').val()) + 1;
				$('#current_step_index').val(currStep);
				setTimeout(function(){ 
					loadStep(currStep);
					$('#current_step').bPopup(popupOptions(currStep)); }, 500);
			});
			$('.prevStep').live('click', function(){
				if(isReverse)
					$('#current_step').bPopup().close();
				else{
					isReverse = true;
					$('#current_step').bPopup().close(true);
				}
				var currStep = parseInt($('#current_step_index').val()) - 1;
				$('#current_step_index').val(currStep);
				setTimeout(function(){ 
					loadStep(currStep);
					$('#current_step').bPopup(popupOptions(currStep, true)); }, 500);
			});
		});
	</script>
</html>