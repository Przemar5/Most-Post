<?php
	
	session_start();
	
	require_once 'if_logged.php';
	include_once 'display.error.php';
	
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  
<div class="container">

	<form class="needs-validation" action="register.php" method="post" novalidate>
		
		<?php
			displayError('error_fields');
		?>
		
		<div class="form-group">
			<label>
				<span class="input-label-text">Nick: </span><br>
				<input class="form-control mr-lg-2" type="text" name="login" placeholder="Enter your nick" required>
				<small class="text-muted" style="font: italic;">It could be your name or full name</small>
			</label>
		</div>
		
		<?php
			displayError('error_login');
		?>
		
		<div class="form-group">
			<label>
				<span class="input-label-text">Password: </span><br>
				<input class="form-control mr-lg-2" type="password" name="pass1" placeholder="Enter password" required>
			</label>
		</div>
		
		<?php
			displayError('error_pass1');
		?>
		
		<div class="form-group">
			<label>
				<span class="input-label-text">Repeat password: </span><br>
				<input class="form-control mr-lg-2" type="password" name="pass2" placeholder="" required>
			</label>
		</div>
		
		<?php
			displayError('error_pass2');
		?>
		
		<div class="form-group">
			<label>
				<span class="input-label-text">E-mail: </span><br>
				<input class="form-control mr-lg-2" type="email" name="email" placeholder="Enter E-mail" required>
			</label>
		</div>
		
		<?php
			displayError('error_email');
		?>
		
		<select name="question" class="custom-select">
			<option value="select" selected>Select a question to answer if you'll forget your password</option>
			<option value="1">What is your favorite movie?</option>
			<option value="2">What is the name of your primary school?</option>
			<option value="3">What is your favorite band?</option>
			<option value="4">What is yours pet name?</option>
		</select>
		
		<?php
			displayError('error_question');
		?>
		
		<div class="form-group">
			<label>
				<span class="input-label-text">Your answer: </span>
				<input class="form-control mr-lg-2" type="text" name="answer" placeholder="Answer" required>
			</label>
		</div>
		
		<?php
			displayError('error_answer');
		?>
		
		<div class="custom-control custom-checkbox mb-3">
			<input type="checkbox" class="custom-control-input" id="regulations" name="regulations">
			<label class="custom-control-label" for="regulations">Obviously, I accept everything!</label>
		</div>
		
		<?php
			displayError('error_regulations');
		?>
		
		<div><button type="submit" class="btn btn-primary mb-4" name="submit">Register</button></div>
		
		<p class="mb-1">Have an account?</p>
		
		<p class="mb-5"><a class="btn btn-outline-primary" href="login.form.php">Login</a></p>
		
		<div><a href="main.php">Return to the main page</a></div>
		
	</form>
	
</div>


<script>
// Disable form submissions if there are invalid fields
/*
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
*/
</script>