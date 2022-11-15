<?php 
require 'header.php'; 
include_once 'connect.php';
?>

    <?php
/*
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p class='displayError'>Fill in ALL fields</p>";
        } elseif ($_GET["error"] == "invalidemail") {
            echo "<p class='displayError'>Invalid email address</p>";
        } elseif ($_GET["error"] == "usernametaken") {
            echo "<p class='displayError'>Username is already taken</p>";
        } elseif ($_GET["error"] == "stmtfailed") {
            echo "<p class='displayError'>Something went wrong</p>";
        } elseif ($_GET["error"] == "none") {
            echo "<p class='displayError'>You are signed up</p>";
        }
    }
*/
    ?>

<div class="form-container">
			<form action="index.php" method="post"  id="form" class="login-form">
			<img src="images/login_icon.png" alt="Login Icon" />	
			<h1>Sign-Up</h1>
			<div class="form-input">
				<input type="text" name="username" id="username" placeholder="   Username" class="form-data" required />
			</div>
			<div class="form-input">
				<input type="password" name="password" id="password" placeholder="   Password" class="form-data" required />
			</div>
            <div class="form-input">
            <input type="text" class="signup-form-data" name="email" placeholder="   Email Address">
			</div>			
            
            <input type="submit" class="btn" value="Submit"></input>
			</form>
		</div>
    <!-- <div class="signup-form-container">
    <form action="index.php" method="post" class="signup-form">
        <h1> Please Register here</h1>
        <div class="form-input">
            <input type="text" class="signup-form-data" name="name" placeholder="Name">
            <input type="text" class="signup-form-data" name="email" placeholder="Email Address">
            <input type="password" class="signup-form-data" name="pwd" placeholder="Password">
        </div>
        <button class="signupButton" type="submit" name="signUp-submit">Sign Up</button>
    </form>
</div> -->
</body>
</html>