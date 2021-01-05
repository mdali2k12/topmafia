<?php
include "sglobals.php";
if($ir['user_level'] > 3)
{
die("403");
}
//This contains punishment stuffs
switch($_GET['action'])
{ 
case 'tripleexp': tripleexp(); break;
default: print "Error: This script requires an action."; break;
}
function tripleexp()
{
global $db,$ir,$c,$h,$userid;
$q=$db->query("SELECT * FROM users WHERE user_level > 0");
     while($r=$db->fetch_row($q))
{
  event_add($r['userid'],"Mafia God [977] is in your town! Attack him now for some rare item drops. <a href='viewuser.php?u=977'>[attack]</a>",$c);
} 
$db->query("UPDATE users SET special='1'");
stafflog_add("Mafia God activated by staff.");
print "Mafia God activated!";
}

$h->endpage();
?>