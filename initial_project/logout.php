<?php
session_start();
include "config.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_{$_CONFIG['driver']}.php";
$db=new database;
$db->configure($_CONFIG['hostname'],
 $_CONFIG['username'],
 $_CONFIG['password'],
 $_CONFIG['database'],
 $_CONFIG['persistent']);
$db->connect();
$c=$db->connection_id;

if($_SESSION['attacking'])
{
$sessid = abs((int) $_SESSION['userid']);
$sesscode =  $_SESSION['session'];
print "You ran away from a fight. You Lost!<br />";
$db->query("UPDATE users_data SET hospital=60, hospreason='Ran away from a fight',attacking=0 WHERE userid={$sessid}");

    $time = time();
    $newtime = $time;
    $newtime = abs((int) $newtime);

$db->query("UPDATE users_activitylogs SET timeout=unix_timestamp() WHERE userid='{$sessid}' AND sesscode='{$sesscode}'");

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

$_SESSION = array();
die("<a href='login.php'>Continue to login...</a>");
}
else {
    $time = time();
    $newtime = $time;
    $newtime = abs((int) $newtime);
$sessid = abs((int) $_SESSION['userid']);
$sesscode =  $_SESSION['session'];
$db->query("UPDATE users_activitylogs SET timeout=unix_timestamp() WHERE userid='{$sessid}' AND sesscode='{$sesscode}'");

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

$_SESSION = array();

header("Location: /home/index.html");
}
?>