<?php
include "config.php";
require "global_func.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_{$_CONFIG['driver']}.php";
$conn = mysqli_connect($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database']);
$c=$conn->connection_id;
$set=array();
$settq = $conn->query("SELECT * FROM settings");  
while ($r = $settq->fetch_assoc()) {
$set[$r['conf_name']]=$r['conf_value'];
}

//brave update
$query1="UPDATE users SET brave=maxbrave WHERE mvp>0";
$query2="UPDATE users SET hp=maxhp WHERE mvp>0";
$conn->query($query1);
$conn->query($query2);
//enerwill update
$query3="UPDATE users SET energy=maxenergy WHERE mvp>0";
$query4="UPDATE users SET will=maxwill WHERE mvp>0";
$conn->query($query3);
$conn->query($query4);
?>
