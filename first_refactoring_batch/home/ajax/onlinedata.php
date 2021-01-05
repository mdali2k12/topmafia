<?php
session_start();
include "config.php";
require "global_func.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_{$_CONFIG['driver']}.php";
$conn  = mysqli_connect($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database']);
$c     = $conn->connection_id;
$set   = array();
$settq = $conn->query("SELECT * FROM settings");
while ($r = $settq->fetch_assoc()) {
    $set[$r['conf_name']] = $r['conf_value'];
}


$count1 = $conn->query("SELECT `userid` FROM `users_data` WHERE `user_level` = 1");

$registered = htmlspecialchars(mysqli_num_rows($count1));

$Count2 = $conn->query("SELECT `userid` FROM `users_data` WHERE `laston` > unix_timestamp()-15*60");

$onlinenow = htmlspecialchars(mysqli_num_rows($Count2));

echo json_encode(array(
    'users' => $registered,
    'onlinenow' => $onlinenow
));
?>