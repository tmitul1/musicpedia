<?php

    //connect to SQL Database
    $servername = 'localhost';
    $database = 'musicpedia';
    $username = 'root';  
    $password = ''; 

    /*
    * Create connection
    */
    $conn = mysqli_connect($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }