<?php 
require 'header.php'; 
include_once 'connect.php';
?>
        <form method=post id="form">
        	Username: <input type="text" placeholder="username or email" name="username"><br>
           	Password: <input type="password" placeholder="password" name="password"><br>
        	<input type="submit" value="Submit"> 
        </form>
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