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
$_GET['ID'] = $conn->real_escape_string($_GET['id']);
$id = abs ((int) $_GET['ID']);
$_GET['change'] = $conn->real_escape_string($_GET['change']);
$change = $conn->real_escape_string($_GET['change']);
if($change == 'up')
{
    
if($id == $userid)
{

        $data['error'] = "You cannot rate yourself mate!";

    echo json_encode($data);
}
elseif($id)
{
$bumbums=$conn->query("SELECT * FROM rating WHERE rateD={$id} AND rateR=$userid",$c);
$bumbum=$bumbums->fetch_assoc();
if($bumbum)
{

        $data['error'] = "You can only rate the same user once a day";

    echo json_encode($data);

}
elseif(!$bumbum) {
$conn->query("UPDATE users_data SET rating=rating+1 WHERE userid={$id}",$c);

$username=$conn->query("SELECT * FROM users_data WHERE userid={$id}");
if(is_resource($username) and mysql_num_rows($username)>0){
    $row = mysql_fetch_array($username);
    }
    

event_add($id,"<a href='viewuser.php?u={$ir['userid']}'><b>{$ir['username']}</b></a> has given you a positive rating!",$c);


$conn->query("INSERT INTO rating (rateD, rateR) VALUES ('{$id}',$userid);",$c);
        $data['success'] = "You have rated this user positive +1 ";

    echo json_encode($data);
}
else {

        $data['error'] = "invalid id";

    echo json_encode($data);
}
}
}

if($change == 'down')
{
    
if($id == $userid)
{

        $data['error'] = "You cant rate yourself negative mate!";

    echo json_encode($data);
}
elseif($id)
{
$bumbums=$conn->query("SELECT * FROM rating WHERE rateD={$id} AND rateR=$userid",$c);
$bumbum=$bumbums->fetch_assoc();
if($bumbum)
{

       
        $data['error'] = "You can only rate the same user once a day";

    echo json_encode($data);

}
elseif(!$bumbum) {
$conn->query("UPDATE users_data SET rating=rating-1 WHERE userid={$id}",$c);

$username=$conn->query("SELECT * FROM users_data WHERE userid={$id}");
if(is_resource($username) and mysql_num_rows($username)>0){
    $row = mysql_fetch_array($username);
    }
    

event_add($id,"<a href='viewuser.php?u={$ir['userid']}'><b>{$ir['username']}</b></a> has given you a negative rating!",$c);


$conn->query("INSERT INTO rating (rateD, rateR) VALUES ('{$id}',$userid);",$c);
        $data['success'] = "You have rated this user negative -1";

    echo json_encode($data);
}
else {

        $data['error'] = "error id";

    echo json_encode($data);
}
}
}


?>