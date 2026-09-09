<?php
//connect the website to the database

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "operative_natuur_tracker";

//Create connection
$connection = mysqli_connect($host, $user, $password, $database);

//Check connection
if (!$connection) {
    die('Database connection failed: ' . mysqli_connect_error());
}
