<?php
include "sglobals.php";
if($ir['user_level'] != 2)
{
die("403");
}
//This contains punishment stuffs
$_GET['action'] = $conn->real_escape_string($_GET['action']);
switch($_GET['action'])
{
case 'stafflist': staff_list(); return;
case 'userlevel': userlevel(); return;
case 'massmailer': massmailer(); return;
case 'massmailerform': massmailerform(); return;
default: print "Error: This script requires an action."; return;
}

function staff_list()
{
global $conn,$ir,$c,$h,$userid;

print "<h3>Staff Management</h3>

<div class='infostaff'>Below listed is the staff members in the game, you can alter their user level using the options available.</div>
		<br />
		<br />
		
		";
print "<b>Admins</b><br />
<table width=80% class=table><tr style='background:gray'> <th>User</th> <th>Online?</th> <th>Links</th> </tr>";
$q=$conn->query("SELECT userid, user_level, username FROM users WHERE user_level=2 ORDER BY userid ASC");
while($r=$q->fetch_assoc())
{
if($r['laston'] >= time()-15*60) { $on="<font color=green><b>Online</b></font>"; } else { $on="<font color=red><b>Offline</b></font>"; }
print "\n<tr> <td><a href='viewuser.php?u={$r['userid']}'>{$r['username']}</a> [{$r['userid']}]</td> <td>$on</td>
<td><a href='staff_special.php?action=userlevel&amp;level=3&amp;ID={$r['userid']}' >Moderator</a>  
&middot; <a href='staff_special.php?action=userlevel&amp;level=1&amp;ID={$r['userid']}' >Member</a></td></tr>";
}
print "</table><br />";
print "<b>Moderators</b><br />
<table width=80% class=table><tr style='background:gray'> <th>User</th> <th>Online?</th> <th>Links</th> </tr>";
$q=$conn->query("SELECT userid, username, user_level FROM users WHERE user_level=3 ORDER BY userid ASC");
while($r=$q->fetch_assoc())
{
if($r['laston'] >= time()-15*60) { $on="<font color=green><b>Online</b></font>"; } else { $on="<font color=red><b>Offline</b></font>"; }
print "\n<tr> <td><a href='viewuser.php?u={$r['userid']}'>{$r['username']}</a> [{$r['userid']}]</td> <td>$on</td> <td><a href='staff_special.php?action=userlevel&amp;level=2&amp;ID={$r['userid']}' >Admin</a>  &middot; <a href='staff_special.php?action=userlevel&amp;level=1&amp;ID={$r['userid']}' >Member</a> </td></tr>";

}

print "</table><br />";

print "<h3>User Level Adjust</h3>
<div class='infostaff'>You can adjust a user level here I.E. Give them staff access or make them a regular account.</div>
		<br />
		<br />
<form action='staff_special.php' method='get'>
<input type='hidden' name='action' value='userlevel'>
User: ".user_dropdown($c,'ID')."<br />
User Level:<br />
<input type='radio' name='level' value='1' /> Member<br />
<input type='radio' name='level' value='2' /> Admin<br />
<input type='radio' name='level' value='3' /> Moderator<br />
<input type='submit' value='Adjust' /></form>";
}
function userlevel()
{
global $conn,$ir,$c,$h,$userid;
$_GET['action'] = $conn->real_escape_string($_GET['action']);
$_GET['level'] = $conn->real_escape_string($_GET['level']);
$_GET['ID'] = $conn->real_escape_string($_GET['ID']);
$_GET['level']=abs((int) $_GET['level']);
$_GET['ID']=abs((int) $_GET['ID']);
$qqq=$conn->query("SELECT userid FROM users WHERE userid = {$_GET['ID']}");
if(!mysqli_num_rows($qqq))
{
$_GET['ID'] = 0;
print"<div class='error-msg'>ID doesn't exist!</div>";
staff_list();
}
else {
$conn->query("UPDATE users SET user_level={$_GET['level']} WHERE userid={$_GET['ID']}");
print "<div class='success-msg'>User's level adjusted</div>";
stafflog_add("Adjusted user ID {$_GET['ID']}'s staff status.");
staff_list();
}
}

function massmailer()
{
global $conn,$ir,$c,$userid;

$_GET['text'] = $conn->real_escape_string($_GET['text']);
if(empty($_POST['text']))
{
   print"<div class='error-msg'>You need to enter a message to mass mail!</div>";
   massmailerform();
}
if($_POST['text'])
{
$_POST['text']=nl2br(strip_tags($_POST['text']));
$subj="This is a mass mail from the administration";
if($_POST['cat']==1)
$q=$conn->query("SELECT userid, user_level FROM users WHERE user_level=1");
else if($_POST['cat']==2)
$q=$conn->query("SELECT userid, user_level FROM users WHERE user_level=2");
else if($_POST['cat']==3)
$q=$conn->query("SELECT userid, user_level FROM users WHERE user_level=3");
else 
$q=$conn->query("SELECT userid, user_level FROM users WHERE user_level={$_POST['level']}");
while($r=$q->fetch_assoc())
{
$_GET['text'] = $conn->real_escape_string($_GET['text']);
$conn->query("INSERT INTO mail (mail_read, mail_from, mail_to, mail_time, mail_subject, mail_text) VALUES(0, 0, {$r['userid']}, unix_timestamp(),'$subj','{$_POST['text']}')");
}
print "<div class='success-msg'>Mass mail sending complete!</div>";
stafflog_add("Sent out a mass mail");
massmailerform();
}
}

function massmailerform()
{
print "<b>Mass Mailer</b><br />
<form action='staff_special.php?action=massmailer' method='post'> Text: <br />
<textarea name='text' rows='7' cols='40'></textarea><br />
<input type='radio' name='cat' value='1' /> Send to all members <input type='radio' name='cat' value='2' /> Send to admins <input type='radio' name='cat' value='3' /> Send to staff only<br />
<input type='submit' value='Send' /></form>";
}


$h->endpage();
?>