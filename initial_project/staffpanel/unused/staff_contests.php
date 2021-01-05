<?php
include "sglobals.php";
if($ir['user_level'] > 3)
{
die("403");
}
//This contains punishment stuffs
switch($_GET['action'])
{ 
case 'massevent': massevent(); break;
default: print "Error: This script requires an action."; break;
}
function massevent()
{
global $db,$ir,$c,$h,$userid;
$q=$db->query("SELECT * FROM users WHERE user_level > 0");
     while($r=$db->fetch_row($q))
{
  event_add($r['userid'],"Contest created by <b>{$ir['username']}</a></b>. More information can be found <a href='forums.php?viewforum=10'>here</a>.",$c);
print "Mass contest event sending complete!";

stafflog_add("Contest created by staff.");
}
}

$h->endpage();
?>