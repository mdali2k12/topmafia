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
}
$_SESSION['userid'] = $conn->real_escape_string($_SESSION['userid']);
$user=$conn->real_escape_string($_SESSION['userid']);
$userid = abs ((int) $user);
$_GET['action'] = $conn->real_escape_string($_GET['action']);
$action = $conn->real_escape_string($_GET['action']);
$_POST['newpic'] = $conn->real_escape_string($_POST['newpic']);
$newpic = $conn->real_escape_string($_POST['newpic']);
function checkRemoteFile($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);
    curl_close($ch);
    if($result !== FALSE)
    {
        return true;
    }
    else
    {
        return false;
    }
}
try {
$user=$conn->real_escape_string($_SESSION['userid']);
$userid = abs ((int) $user);
$_GET['action'] = $conn->real_escape_string($_GET['action']);
$action = $conn->real_escape_string($_GET['action']);
$_POST['newpic'] = $conn->real_escape_string($_POST['newpic']);
$newpic = $conn->real_escape_string($_POST['newpic']);
  if (checkRemoteFile($newpic) && is_array (@getimagesize ($newpic)))
{
    
$conn->query("UPDATE users_avatars SET display_pic='$newpic' WHERE userid=$userid",$c);

        $data['success'] = "You have updated your display image successfully";

    echo json_encode($data);
}
else {

        $data['error'] = "Invalid image url";

    echo json_encode($data);
}
}
catch (\Exception $e) { return ''; }
?>