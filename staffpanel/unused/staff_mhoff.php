<?php
include "sglobals.php";
if($ir['user_level'] > 3) 
{
die("403");
}
//This contains punishment stuffs
switch($_GET['action'])
{ 
case 'off': off(); break;
default: print "Error: This script requires an action."; break;
}
function off()
{
global $db,$ir,$c,$h,$userid;
$q=$db->query("SELECT * FROM users WHERE user_level > 0");
     while($r=$db->fetch_row($q))
{
  event_add($r['userid'],"Mafia God has left your town, see you soon!",$c);
} 
$db->query("UPDATE users SET special='0', mafiagod='0'");
stafflog_add("Mafia God deactivated by staff.");
print "Mafia God deactivated!";
}

$h->endpage();
?>