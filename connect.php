<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DBNAME = 'block1a';


$conn = new mysqli($HOSTNAME, $USERNAME, $PASSWORD, $DBNAME);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
