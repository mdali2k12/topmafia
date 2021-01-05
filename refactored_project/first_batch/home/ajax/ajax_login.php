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
 $usern = $conn->real_escape_string($_POST['username']);
 $passn = $conn->real_escape_string($_POST['password']);
$uq=$conn->query("SELECT userid, login_name, username, userpass FROM users_data WHERE username='{$usern}' AND `userpass`=md5('{$passn}')");
if(mysqli_num_rows($uq) == 0) {
    $data['error'] = "Invalid username or password!";
    echo json_encode($data);
} else {
    // This creates a session which is stored in browser, usually is the ID of the insert to db, if it exists and a player logs in again it will only update the timeout with new login time.
    $_SESSION['loggedin'] = 1;
    $mem = $uq->fetch_assoc();
    $_SESSION['userid'] = abs((int) $mem['userid']);
   $userids = abs((int) $mem['userid']);
		$sessco = $conn->real_escape_string($r['sesscode']);
    $IP = htmlspecialchars($_SERVER['REMOTE_ADDR']);
    $conn->query("UPDATE users_data SET lastip_login='$IP',last_login=unix_timestamp() WHERE userid={$userids}");
    $time = time();
    $newtime = $time;
    $newtime = abs((int) $newtime);
    
    
    $ki = $conn->query("SELECT * FROM users_session WHERE userid={$userids}");

   if (mysqli_num_rows($ki) == 0) { 
       $_SESSION['userid'] = abs((int) $mem['userid']);
   $userids = abs((int) $mem['userid']);
		$sessco = $conn->real_escape_string($r['sesscode']);
        $code = sha1(mt_rand(1, 90000) . 'SALT');

        $conn->query("INSERT INTO users_session (userid, timeout, sesscode) VALUES ('{$userids}', unix_timestamp(), '$code');");
         $conn->query("INSERT INTO users_activitylogs (userid, timein, sesscode, ip)  VALUES ('{$userids}', unix_timestamp(), '$code', '$IP');");
        $_SESSION['session'] = $code;
    }

    if (mysqli_num_rows($ki) == 1) {
        
        $r = $ki->fetch_assoc();
        	$_SESSION['userid'] = abs((int) $mem['userid']);
   $userids = abs((int) $mem['userid']);
		$sessco = $conn->real_escape_string($r['sesscode']);
        if ($_SESSION['session'] != $sessco) {
        $code = sha1(mt_rand(1, 90000) . 'SALT');

            $conn->query("DELETE FROM users_session WHERE userid={$userids}");
            $conn->query("INSERT INTO users_session (userid, timeout, sesscode)  VALUES ('{$userids}', unix_timestamp(), '$code');");
         $conn->query("INSERT INTO users_activitylogs (userid, timein, sesscode, ip)  VALUES ('{$userids}', unix_timestamp(), '$code', '$IP');");
        $_SESSION['session'] = $code;
            
        }
        if ($_SESSION['session'] == $sessco) {
            $conn->query("UPDATE users_session SET timeout=unix_timestamp() WHERE session=$sessco");
        } 

    } 
    
    
    
    
    
    //Session token is created on each login from any device, it is random and if the token does not match it would log out from other devices.
    
 $usern = $conn->real_escape_string($_POST['username']);
 $passn = $conn->real_escape_string($_POST['password']);
//Generate a random string.
$token1 = openssl_random_pseudo_bytes(16);
 
//Convert the binary data into hexadecimal representation.
$gentoken = bin2hex($token1);
    $_SESSION['token'] = htmlspecialchars($gentoken);
    $token = $_SESSION['token'];
    $uqq = $conn->query("SELECT userid, username, login_name, userpass FROM users_data WHERE username='{$usern}' AND `userpass`=md5('{$passn}')");
    $mems = $uqq->fetch_assoc();
    
    $conn->query("UPDATE users_data SET sessiontoken='$token' WHERE userid={$mem['userid']}");
    
    
    ///feed_add(1, "<a href='viewuser.php?u={$mems['userid']}'><b>{$mems['username']}</b></a> is now active.", $c);


    if ($set['validate_period'] == "login" && $set['validate_on']) {
        $conn->query("UPDATE users_data SET verified=0 WHERE userid={$mem['userid']}"); 
    }
 
        $data['success'] = "You are being logged in..";

    echo json_encode($data);
}
?>