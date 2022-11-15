<?php 
require 'header.php'; 
include_once 'connect.php';
?>

<div class="results">
	<table class="results-table">
		<thead>
		<tr>
			<th class="name">Name</th>
			<th class="email">Email</th>
            <th class="bio">User Bio</th>
		</tr>	
		</thead>

<?php


    echo "<a class='back_btn' href=\"index.php\">back</a>";
    echo "<br><br>";
    // get users
    $user_query = $conn->query("SELECT user_name, email, user_bio FROM users ORDER BY user_name ASC");


    while($user_result = $user_query->fetch_assoc()){

        echo "<tr>";
            echo "<td>".$user_result['user_name']."</td>";
            echo "<td>".$user_result['email']."</td>";
            echo "<td>".$user_result['user_bio']."</td>";
        echo "</tr>";

    }
    echo "</table>";


?>

</body>
</html>