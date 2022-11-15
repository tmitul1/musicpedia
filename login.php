<?php 
require 'header.php'; 
include_once 'connect.php';
?>
		<div class="form-container">
			<form method="post"  id="form" class="login-form">
			<img src="images/login_icon.png" alt="Login Icon" />	
			<h1>Login</h1>
			<div class="form-input">
				<input type="text" name="username" id="username" placeholder="   Username" class="form-data" required />
			</div>
			<div class="form-input-material">
				<input type="password" name="password" id="password" placeholder="   Password" class="form-data" required />
			</div>
			<input type="submit" class="btn" value="Submit"></input>
			<label>Don't have an account? <a href="">Sign up here</a> </label>
			</form>
		</div>

        	<?php

	        // Check if username and password aren't null
	       	if(isset($_POST['username']) && isset($_POST['password'])){

	       		$user = $_POST['username'];
	       		$pass = $_POST['password'];

	       		// Check if user and pass are empty
	       		if(empty($user)){
	       			echo "Please enter a username<br>";
	       			setcookie("userid", "", time() - 99999999, "/");
	       		} else if(empty($pass)){
	       			echo "Please enter a password<br>";
	       			setcookie("userid", "", time() - 99999999, "/");
	       		} else {
	       			$sql = "SELECT user_id FROM users WHERE (user_name='".$user."' OR email='".$user."') AND password='".$pass."'";
	       			$query = $conn->query($sql);

	       			echo $sql."<br>";

	       			// If username/email and password are valid
	       			if($query && $query->num_rows > 0){
	       				$id = $query->fetch_row();
	       				setcookie("user_id", $id[0], time() + 86400, "/");
	       				header("Location: admin.php");
	       			} else {
	       				echo "Invalid username or password";
	       				setcookie("userid", "", time() - 99999999, "/");
	       			}
	       		}
	       	} 

        	?>
	</body>
</html>