<?php 
//Using MySQLi to connect
$conn = mysqli_connect('localhost','root','root','local');

//Check it works
if (!$conn) {
echo 'Problem connecting to the database:' . mysqli_connect_error();
}

?>