<?php
	
	session_start();
	
	require_once 'if_logged.php';
	include_once 'display.error.php';
	include_once 'display.success.php';
	
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  
<div class="container">
	
	<?php
		displaySuccess('success_registration');
	?>
	
	<form class="needs-validation" action="login.php" method="post" novalidate>
			
		<div class="form-group">
			<label>
				<span class="input-label-text">Nick: </span><br>
				<input class="form-control mr-lg-2" type="text" name="login" id="login" placeholder="Enter your nick" required>
			</label>
		</div>
		
		<?php
			displayError('error_login');
		?>
		
		<div class="form-group">
			<label>
				<span class="input-label-text">Password: </span><br>
				<input class="form-control mr-lg-2" type="password" name="password" placeholder="Enter password" required>
			</label>
		</div>
		
		<?php
			displayError('error_pass');
		?>
		
		<div class="custom-control custom-checkbox mb-3">
			<input type="checkbox" class="custom-control-input" id="remember" name="remember">
			<label class="custom-control-label" for="remember">Remember me</label>
		</div>
		
		
		<div class="mb-2"><button type="submit" id="submit" name="submit" class="btn btn-primary">Login!</button></div>
		
		<p class="mb-3"><a href="forgot_password.form.php">Forgot your password?</a></p>
		
		<p class="mb-1">Don't have an account?</p>
		
		<div class="mb-5"><a class="btn btn-outline-primary" href="register.form.php">Register</a></div>
		
		<div><a href="main.php">Return to the main page</a></div>
		
	</form>
	
</div>
<!--
<script>

	(function() {
		$('#submit').click(function() {
			var login = $('#login').html();
		});	
	});

</script>

<script>
// Disable form submissions if there are invalid fields
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
</script>