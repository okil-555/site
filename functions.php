<?php
require_once "db.php";

function get_by_id($id){
global $connection;
$query="SELECT * FROM shourma WHERE id=" . $id;
$req=mysqli_query($connection, $query);
$resp=mysqli_fetch_assoc($req);
return $resp;
}
 

?>