<?php
session_start();
ob_start();
if(get_magic_quotes_gpc() == 0){
  foreach($_POST as $k => $v){
    $_POST[$k]=addslashes($v);
  }
  foreach($_GET as $k => $v){
    $_GET[$k]=addslashes($v);
  }
}
require_once "global_func.php";
if($_SESSION['loggedin']==0) { header("Location: /home");exit; }

if(stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")){ // if mobile browser
require_once "header/mheader.php";
}
else { // desktop browser
require_once "header/header.php";
}
include_once "config.php";
global $_CONFIG;
define("MONO_ON", 1);
require_once "class/class_db_{$_CONFIG['driver']}.php";
$conn = mysqli_connect($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database']);
$c=$conn->connection_id; 
$set = array();
$settq = $conn->query("SELECT * FROM settings");
while ($r = $settq->fetch_assoc()) {
    $set[$r['conf_name']] = $r['conf_value'];
}
$_SESSION['userid'] = $conn->real_escape_string($_SESSION['userid']);
$userid=$conn->real_escape_string($_SESSION['userid']);
  $_SERVER['HTTP_HOST'] = $conn->real_escape_string($_SERVER['HTTP_HOST']);
$domain=$conn->real_escape_string($_SERVER['HTTP_HOST']);
global $jobquery, $housequery;
if($jobquery){
	$is=$conn->query("SELECT u.*,us.*,j.*,jr.*, f.*, vi.*, a.* FROM users_data u
	INNER JOIN users_stats us ON u.userid=us.userid
	INNER JOIN jobs j ON j.jID=u.job
	INNER JOIN jobranks jr ON jr.jrID=u.jobrank
	INNER JOIN users_finance f ON f.userid=u.userid
	INNER JOIN users_vitals vi ON vi.userid=u.userid
	INNER JOIN users_avatars a ON a.userid=u.userid
	WHERE u.userid=$userid");
}else if($housequery){
	$is=$conn->query("SELECT u.*,us.*,h.*, f.*, vi.*, a.* FROM users_data u 
	INNER JOIN users_stats us ON u.userid=us.userid 
	INNER JOIN users_vitals vi ON vi.userid=u.userid
	INNER JOIN houses h ON h.hWILL=vi.maxwill
	INNER JOIN users_finance f ON f.userid=u.userid
	INNER JOIN users_avatars a ON a.userid=u.userid
	WHERE u.userid=$userid");
}else{
	$is=$conn->query("SELECT u.*,us.*, f.*, vi.*, a.* FROM users_data u 
	INNER JOIN users_stats us ON u.userid=us.userid 
	INNER JOIN users_finance f ON f.userid=u.userid
	INNER JOIN users_vitals vi ON vi.userid=u.userid
	INNER JOIN users_avatars a ON a.userid=u.userid
	WHERE u.userid=$userid");
}

$ir=$is->fetch_assoc();
if($ir['display_pic'] == NULL)
{
    $displaypic = "<img src='https://topmafia.net/header/images/displayimage/noavatar.png' style='width:50px;height:50px;border:1px solid #fff;'>";
}
else {
    $displaypic = "
<img src='{$ir['display_pic']}' style='width:50px;height:50px;border:1px solid #fff;'>";
}
if($ir['force_logout']){
	$conn->query("UPDATE users_data SET force_logout=0 WHERE userid=$userid");
	session_unset();
	session_destroy();
$_SESSION = array();
	header("Location: /home");
	exit;
}
 $ir['sessiontoken'] = $conn->real_escape_string($ir['sessiontoken']);
 $sessiontoken = $conn->real_escape_string($ir['sessiontoken']);
if ($_SESSION['token'] != $sessiontoken){
    session_unset();
$_SESSION = array();
	session_destroy();
	    echo "<script type='text/javascript'>window.location.href = 'logout.php';</script>";
}

    $k = $conn->query("SELECT * FROM users_session WHERE userid={$ir['userid']}");
    $sess = $k->fetch_assoc();
    
 $sess['sesscode'] = $conn->real_escape_string($sess['sesscode']);
 $sessioncode = $conn->real_escape_string($sess['sesscode']);
    if ($_SESSION['session'] != $sessioncode){
    session_unset();
$_SESSION = array();
	session_destroy();
	    echo "<script type='text/javascript'>window.location.href = 'logout.php';</script>";
}


global $macropage;
if($macropage && !$ir['verified'] && $set['validate_on']==1) {
	header("Location: macro1.php?refer=$macropage");
	exit;
} 
check_level();
$h = new headers;
$h->startheaders();
$fm=money_formatter($ir['money']);
$cm=money_formatter($ir['crystals'],'');
$lv=date('F j, Y, g:i a',$ir['laston']);
global $atkpage;
if($atkpage){
	$h->userdata($ir,$lv,$fm,$cm,$displaypic,0);
}else{
	$h->userdata($ir,$lv,$fm,$cm,$displaypic);
}
global $menuhide; 
if(!$menuhide){
	$h->menuarea();
}
?>