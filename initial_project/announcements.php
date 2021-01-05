<?php
include "globals.php";
$ac=$ir['new_announcements'];
$q=$db->query("SELECT * FROM announcements ORDER BY a_time DESC");
print "<div class='mail4'>";
while($r=$db->fetch_row($q))
{
if($ac > 0)
{
$ac--;
$new="<b style='color:#ff9900; font-weight:bold;'>New!</b>";
}
else
{
$new="";
}
print "<span class='sent'>".date('F j Y, g:i:s a', $r['a_time']).$new."</span><br/><p style='color:#cecece;'>{$r['a_text']} <br /><span class='sent' style='float:right;'>By <a href='viewuser.php?u=1'>Admin [1]</a> </p> <br />
";
}
print "</div>";
if($ir['new_announcements'])
{
$db->query("UPDATE users SET new_announcements=0 WHERE userid={$userid}");
}
$h->endpage();
?>
