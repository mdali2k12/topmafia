<?php
/*---------------------------------
--   MCCodes 2.0
--   By Dabomstew
---------------------------------*/
session_start();
if(get_magic_quotes_gpc() == 0)
{
foreach($_POST as $k => $v)
{
  $_POST[$k]=addslashes($v);
}
foreach($_GET as $k => $v)
{
  $_GET[$k]=addslashes($v);
}
}

if($_SESSION['loggedin']==0) { header("Location: https://topmafia.net/home/");exit; }

$userid=$_SESSION['userid'];
require "header-s.php";
require "global_func.php";
include "config.php";
include "class/class.phpmailer-lite.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_{$_CONFIG['driver']}.php";
$conn = mysqli_connect($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database']);
$c=$conn->connection_id; 
$set = array();
$settq = $conn->query("SELECT * FROM settings");
while ($r = $settq->fetch_assoc()) {
    $set[$r['conf_name']] = $r['conf_value'];
}
$domain=$_SERVER['HTTP_HOST'];

global $jobquery, $housequery;
if($jobquery)
{
$is=$conn->query("SELECT u.*,us.*,j.*,jr.* FROM users u LEFT JOIN userstats us ON u.userid=us.userid LEFT JOIN jobs j ON j.jID=u.job LEFT JOIN jobranks jr ON jr.jrID=u.jobrank WHERE u.userid=$userid");
}
else if($housequery)
{
$is=$conn->query("SELECT u.*,us.*,h.* FROM users u LEFT JOIN userstats us ON u.userid=us.userid LEFT JOIN houses h ON h.hWILL=u.maxwill WHERE u.userid=$userid");
}
else
{
$is=$conn->query("SELECT u.*,us.* FROM users u LEFT JOIN userstats us ON u.userid=us.userid WHERE u.userid=$userid");
}
$ir=$is->fetch_assoc();
if($ir['force_logout'])
{
$conn->query("UPDATE users SET force_logout=0 WHERE userid=$userid");
session_unset();
session_destroy();
header("Location: https://topmafia.net/home/");
exit;
}
if($ir['user_level'] <= 1)
{
print("403: Access Denied");
exit;
}
global $macropage;
if($macropage && !$ir['verified'] && $set['validate_on']==1)
{
header("Location: ../macro1.php?refer=$macropage");
} 
check_level();
$h = new headers;
$h->startheaders();
$fm=money_formatter($ir['money']);
$cm=money_formatter($ir['crystals'],'');
$lv=date('F j, Y, g:i a',$ir['laston']);
global $atkpage;
$staffpage=1;
if($atkpage)
{
$h->userdata($ir,$lv,$fm,$cm,0);
}
else
{
$h->userdata($ir,$lv,$fm,$cm);
}

$h->smenuarea();

?>