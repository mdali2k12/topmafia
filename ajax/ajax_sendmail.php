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
global $conn,$ir,$c,$userid,$h;
$_SESSION['userid'] = $conn->real_escape_string($_SESSION['userid']);
$user=$conn->real_escape_string($_SESSION['userid']);
$userid = abs ((int) $user);

$_POST['message'] = $conn->real_escape_string($_POST['message']);
$msg = $conn->real_escape_string($_POST['message']);

$_POST['user1'] =  $conn->real_escape_string($_POST['user1']);
$_POST['user2'] =  $conn->real_escape_string($_POST['user2']);

$user1 = $conn->real_escape_string($_POST['user1']);
$user2 = $conn->real_escape_string($_POST['user2']);
if($_POST['user1'] && $_POST['user2'])
{   
    $data['status'] = 'error';
    $data['data'] = "Please do not select a contact AND enter a username, only do one.";
   die(json_encode($data));
}
if(!$user1 && !$user2)
{   
    $data['status'] = 'error';
    $data['data'] = "You must select a contact or enter a username.";
   die(json_encode($data));

}
$sendto=($user1) ? $user1 : $user2;
$q=$conn->query("SELECT userid FROM users_data WHERE username='".$conn->real_escape_string($sendto)."'");
if(mysqli_num_rows($q)==0)
{
    $data['status'] = 'error';
    $data['data'] = "You cannot send mail to nonexistant users.";
   die(json_encode($data));
 
}
$to=$q->fetch_assoc();
$ig=$conn->query("SELECT ig_ADDER FROM ignorelist WHERE ig_ADDED=".abs(@intval($_SESSION['userid']))." AND ig_ADDER='".abs(@intval($to['userid']))."'")or die(mysqli_error());
$r=$ig->fetch_assoc();

if($r['ig_ADDER'])
{
    
    $data['status'] = 'error';
    $data['data'] = "This user has blocked you from sending mails!";
   die(json_encode($data));
 
}
$conn->query("INSERT INTO mail (mail_read, mail_from, mail_to, mail_time, mail_text) VALUES (0,$userid,'".$conn->real_escape_string($to['userid'])."',unix_timestamp(),'$msg')");
$conn->query("UPDATE users_data SET new_mail=new_mail+1 WHERE userid=".abs(@intval($to['userid']))."");

     $data['status'] = 'success';
    $data['data'] = "Message sent successfully to ".$conn->real_escape_string($sendto)." ";
   die(json_encode($data));
 

?>
