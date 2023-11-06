<?php
$servername = "localhost";
$username = "gustavo";
$password = "123";
$dbname = "reviews";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
