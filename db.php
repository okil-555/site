<?php
$host='localhost';
$db='products';
$user='root';
$pass='root';

$connection=mysqli_connect($host, $user, $pass,$db);

if (mysqli_connect_errno()) {
	die("Data Base connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
} else {
	# echo "Connection = success!\n" . mysqli_get_host_info($connection) . "<br />";
}
?>