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



//$user = array(176, 168, 1074, 1072, 863, 928, 848, 10, 25, 36, 7, 16, 23, 160, 856, 862, 874, 886, 902, 918, 870, 876, 885, 873, 882, 890, 894, 903, 921, 930, 949, 962, 964, 967, 951, 957, 963, 968, 971, 975, 999, 1006, 1016, 1046, 1069, 1070, 1068, 1007, 1013, 1017, 1023, 1030); 
// $randIndex = array_rand($user);
// $userids = $user[$randIndex];
//bot users to be active every 1 mins.
//$t=time();
//$conn->query("UPDATE users set laston='$t' WHERE userid=$userids");

//end


$conn->query("UPDATE users_freeze set hospital=hospital-1 WHERE hospital>0");
$conn->query("UPDATE `users_freeze` SET jail=jail-1 WHERE `jail` > 0");
$hc1=$conn->query("SELECT * FROM users_freeze WHERE hospital > 0");
$hc = mysqli_num_rows($hc1);
$jc1=$conn->query("SELECT * FROM users_freeze WHERE jail > 0");
$jc = mysqli_num_rows($jc1);
$conn->query("UPDATE settings SET conf_value='$hc' WHERE conf_name='hospital_count'");
$conn->query("UPDATE settings SET conf_value='$jc' WHERE conf_name='jail_count'");


?>
