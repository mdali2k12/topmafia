<?php
session_start(); 
include "config.php";
include "global_func.php"; 
global $_CONFIG; 
define("MONO_ON", 1); 
require "class/class_db_{$_CONFIG['driver']}.php";
$conn = mysqli_connect($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database']);
$c=$conn->connection_id;
$set=array();
$settq = $conn->query("SELECT * FROM settings");
while ($r = $settq->fetch_assoc()) {
$set[$r['conf_name']]=$r['conf_value'];
}$_SESSION['userid'] = $conn->real_escape_string($_SESSION['userid']);
$user=$conn->real_escape_string($_SESSION['userid']);
$userid = abs ((int) $user);
$_GET['ID'] = $conn->real_escape_string($_GET['id']);
$id = abs ((int) $_GET['ID']);
$_GET['action'] = $conn->real_escape_string($_GET['action']);
$action = $conn->real_escape_string($_GET['action']);

if($action == "delete")
{
global $conn,$ir,$c,$userid,$h;
$conn->query("DELETE FROM mail WHERE mail_id={$id} AND mail_to=$userid");
        $data['success'] = "Message deleted!";

    echo json_encode($data);
}

if($action == "delall")
{
global $conn,$ir,$c,$userid,$h;
$q=$conn->query("SELECT * FROM mail WHERE mail_to=$userid");
if(mysqli_num_rows($q)==0)
{
    $data['error'] = "Your inbox is already empty!";

    echo json_encode($data);
}
else {
$conn->query("DELETE FROM mail WHERE mail_to=$userid");
        $data['success'] = "All messages deleted successfully";

    echo json_encode($data);
}}
?>