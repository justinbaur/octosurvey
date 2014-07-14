<?php session_start(); ?>
<div id="memberDisplay">
	<p>Become A Member!</p>
	<form class="memberAdd" method="post"  name="memberAdd" action="index.php">		
		<input type="text" id="firstname" name="firstname" placeholder="First Name" />
		<input type="text" id="lastname" name="lastname"  placeholder="Last Name" />
		<input type="text" id="phone" name="phone"  placeholder="Phone Number" />
		<br/><br/>
		<input type="text" id="country" name="country"  placeholder="Country" />
		<input type="submit" id="memberSignUp" name="memberSignUp" value="Sign Up" />
	</form>
</div>
