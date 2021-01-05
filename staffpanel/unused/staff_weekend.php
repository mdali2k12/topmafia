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
  event_add($r['userid'],"Triple XP has been activated by the admin, enjoy!",$c);
} 
$db->query("UPDATE users SET tripleweek='1'");
stafflog_add("Triple XP activated by staff.");
print "Triple XP activated!";
}

$h->endpage();
?>