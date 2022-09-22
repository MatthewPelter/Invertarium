

<form class="form col-md-12 center-block" action="components/registration.php" method="post" autocomplete="off">
	<div class="marshall">
		<div class="container">
		  <h1 class="h1-style center">Register</h1>
			<input type="text" name="user_firstname" class="first" placeholder="First Name" required>
			<br/>
			<input type="text" name="user_lastname" class="last" placeholder="Last Name" required>
			<br/>
			<input type="email" name="user_email" class="email" placeholder="email" required>
			<br/>
			<input type="text" name="user_username" class="username" placeholder="Username" required>
			<br/>
			<input type="password" name="user_password" class="pwd" placeholder="Password" required>
		  
		  <!--<a href="#" class="link">
			forgot your password ?
		  </a>-->
		  <br/>
		  <button type="submit"  id="SubmitButton" value="Upload" style="float:left;" name="signup_button" class="signin">
			<span>Register</span>
		  </button>

		  <h3>your registration is complete !</h3>
		  <div class="reg"></div>
		  <div class="sig"></div>

		</div>
	</div>
</form>