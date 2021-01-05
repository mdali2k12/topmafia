<?php
include "sglobals.php";
if($ir['user_level'] < 2)
{
die("403");
}
//This contains punishment stuffs
$_GET['action'] = $conn->real_escape_string($_GET['action']);
switch($_GET['action'])
{
case 'banform': banform(); return;
case 'bansub': bansub(); return;
case 'fedform': fed_user_form(); return;
case 'fedsub': fed_user_submit(); return;
case 'fedeform': fed_edit_form(); return;
case 'fedsubconfirm': fed_edit_confirm(); return;
case 'fedesub': fed_edit_submit(); return;
case 'unfedform': unfed_user_form(); return;
case 'unfedsub': unfed_user_submit(); return;

case 'ipbanform': ip_ban_form(); return;
case 'ipbansub': ip_ban_submit(); return;
case 'ipform': ip_search_form(); return;
case 'ipsub': ip_search_submit(); return;
case 'massjailip': mass_jail(); return;
default: print "Error: This script requires an action."; return;
}

function banform()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Fed User</h3>

		<div class='infostaff'>Use this to ban or restrict a user from using a feature or playing the game.</div>
		<br />
		<br />
<form action='staff_punit.php?action=bansub' method='post'>
User: ".user_dropdown($c,'user')."<br />
Days: <input type='number' name='days' /><br />
Reason: <input type='text' name='reason' /><br />
Type:
  <select name='type'>
  <option>Mail</option>
   <option>Federal</option>
   <option>Chat</option>
   <option>Forum</option>
</select><br />
<input type='submit' value='Jail User' /></form>";
}
function bansub()
{
global $conn,$ir,$c,$h,$userid;
$_POST['reason'] = $conn->real_escape_string($_POST['reason']);
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['days'] = $conn->real_escape_string($_POST['days']);
$_POST['type'] = $conn->real_escape_string($_POST['type']);

		$q = $conn->query("SELECT * FROM fedjail WHERE fed_userid='{$_POST['user']}'");
		$r = $q->fetch_assoc();
		
if(empty($_POST['user']))
{
    print"<div class='error-msg'>You need to select a user to ban!</div>";
    banform();
}
elseif(empty($_POST['reason'] || $_POST['type']))
{
    print"<div class='error-msg'>You need to enter a reason or select type to ban user!</div>";
    banform();
    
}
elseif($_POST['user'] == $r['fed_userid'])
		{
		    print"<div class='error-msg'>This user has already been banned, edit or remove their sentence.</div>";
		    banform();
		}
else{
$_POST['reason'] = $conn->real_escape_string($_POST['reason']);
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['days'] = $conn->real_escape_string($_POST['days']);
$_POST['type'] = $conn->real_escape_string($_POST['type']);

$conn->query("INSERT INTO fedjail (fed_userid, fed_days, fed_jailedby, fed_reason, fed_type) VALUES({$_POST['user']},{$_POST['days']},$userid,'".
$_POST['reason']."', '{$_POST['type']}')");
print "<div class='success-msg'>User jailed</div>";
stafflog_add("{$_POST['type']} banned ID {$_POST['user']} for {$_POST['days']} days");
banform();
}
}

function fed_edit_form()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Editing Fedjail</h3>
		<div class='infostaff'>Select a user below to edit their ban sentence.</div>
		<br />
		<br />
<form action='staff_punit.php?action=fedsubconfirm' method='post'>
User: ".fed_user_dropdown($c,'user')."<br />
<input type='submit' value='Edit Jail User' /></form>";
}

function fed_edit_confirm()
{
global $conn,$ir,$c,$h,$userid;
$_POST['user'] = $conn->real_escape_string($_POST['user']);

if(empty($_POST['user']))
{
    print"<div class='error-msg'>You need to select a user to edit ban!</div>";
    fed_edit_form();
}
else{$q=$conn->query("SELECT userid, username, fed_userid, fed_days, fed_reason, fed_type FROM users LEFT JOIN fedjail ON userid={$_POST['user']} WHERE userid={$_POST['user']}");
$r=$q->fetch_assoc();
print "<h3>Editing <b>{$r['username']}</b> Sentence</h3>
		<div class='infostaff'>You can edit this users jail sentence by updating the information below.</div>
		<br />
		<br />
<form action='staff_punit.php?action=fedesub' method='post'>
<input type='hidden' name='user' value='{$_POST['user']}'>
USERID: {$_POST['user']} <br />
Days: <input type='number' value='{$r['fed_days']}' name='days' /><br />
Reason: <input type='text' value='{$r['fed_reason']}' name='reason' /><br />
Current Type of Ban: <b>{$r['fed_type']}</b>
<br />
Edit Type:
  <select name='type'>
  <option>Mail</option>
   <option>Federal</option>
   <option>Chat</option>
   <option>Forum</option>
</select><br />
<input type='submit' value='Edit Sentence' /></form>";
}
}

function fed_edit_submit()
{
global $conn,$ir,$c,$h,$userid;
$_POST['reason'] = $conn->real_escape_string($_POST['reason']);
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['days'] = $conn->real_escape_string($_POST['days']);
$_POST['type'] = $conn->real_escape_string($_POST['type']);
	$q = $conn->query("SELECT * FROM fedjail WHERE fed_userid='{$_POST['user']}'");
if(empty($_POST['user']))
{
    print"<div class='error-msg'>You need to select a user to edit ban!</div>";
    fed_edit_form();
}
elseif(empty($_POST['reason']))
{
    print"<div class='error-msg'>You need to enter a reason to ban!</div>";
    fed_edit_form();
    
}	
elseif(!mysqli_num_rows($q))
{
print"<div class='error-msg'>This user is not in fed jail!</div>";
}
else{
$_POST['type'] = $conn->real_escape_string($_POST['type']);
$_POST['reason'] = $conn->real_escape_string($_POST['reason']);
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['days'] = $conn->real_escape_string($_POST['days']);
$conn->query("DELETE FROM fedjail WHERE fed_userid={$_POST['user']}");
$conn->query("INSERT INTO fedjail (fed_userid, fed_days, fed_jailedby, fed_reason, fed_type) VALUES({$_POST['user']},{$_POST['days']},$userid,'".
$_POST['reason']."', '{$_POST['type']}')");
print "<div class='success-msg'>User's sentence edited</div>";
stafflog_add("Edited user ID {$_POST['user']}'s fedjail sentence");
fed_edit_form();
}
}

function unfed_user_form()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Unjailing User</h3>
		<div class='infostaff'>This will release and free the player from being banned in the game.</div>
		<br />
		<br />
<form action='staff_punit.php?action=unfedsub' method='post'>
User: ".fed_user_dropdown($c,'user')."<br />
<input type='submit' value='Unjail User' /></form>";
}
function unfed_user_submit()
{
global $conn,$ir,$c,$h,$userid;
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$q = $conn->query("SELECT * FROM fedjail WHERE fed_userid='{$_POST['user']}'");
if(empty($_POST['user']))
{
    print"<div class='error-msg'>You need to select a user to unban!</div>";
    unfed_user_form();
}
elseif(!mysqli_num_rows($q))
{
print"<div class='error-msg'>This user is not in fed jail!</div>";
}
else{
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$conn->query("DELETE FROM fedjail WHERE fed_userid={$_POST['user']}");
print "<div class='success-msg'>User unjailed</div>";
stafflog_add("Unfedded user ID {$_POST['user']}");
unfed_user_form();
}
}



function ip_ban_form()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Permanent IP Ban</h3>
		<div class='infostaff'>This will permanently ban the user from accessing the site.</div>
		<br />
		<br />
<form action='staff_punit.php?action=ipbansub' method='post'>
IP: <input type='text' name='ip' value='' /><br />
<input type='submit' value='IP ban' /></form>";
}
function ip_ban_submit() 
{
global $conn,$ir,$c,$h,$userid;
$_POST['ip'] = $conn->real_escape_string($_POST['ip']);
$q = $conn->query("SELECT lastip FROM users WHERE lastip='{$_POST['ip']}'");
$w = $conn->query("SELECT lastip, ipban FROM users WHERE lastip='{$_POST['ip']}' AND ipban > 0"); 

if (mysqli_num_rows($q) == 0) {
        
    print"<div class='error-msg'>No IP data found in database!</div>";
    ip_ban_form();
    }
  elseif (mysqli_num_rows($w) == 1) {
    print"<div class='error-msg'>This IP is already banned and exists in the folder!</div>";
    ip_ban_form();
    }
elseif(empty($_POST['ip']))
{
    print"<div class='error-msg'>You need to enter a ip to ban!</div>";
    ip_ban_form();
}
else{
$_POST['ip'] = $conn->real_escape_string($_POST['ip']);

error_reporting(E_ALL);
$conn->query("UPDATE users SET ipban='1' WHERE lastip='{$_POST['ip']}'");
$pagename = $_POST['ip'];
$newFileName = $_SERVER['DOCUMENT_ROOT']. '/ipbans/'.$pagename.'.txt';
$newFileContent = '';

if (file_put_contents($newFileName, $newFileContent) !== false) {
    echo "File created (" . basename($newFileName) . ")";
chmod($newFileName, 0644);
} else {
    echo "Cannot create file (" . basename($newFileName) . ")";
}

print "<div class='success-msg'>Success!</div>";
stafflog_add("IP Banned:{$_POST['ip']}");
ip_ban_form();
}
}



function ip_search_form()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>IP Search</h3>
		<div class='infostaff'>You can use IP search to look up players to identify multi accounts.</div>
		<br />
		<br />
<form action='staff_punit.php?action=ipsub' method='post'>
IP: <input type='text' name='ip' value='' /><br />
<input type='submit' value='Search' /></form>";
}
function ip_search_submit()
{
global $conn,$ir,$c,$h,$userid, $domain;
$_POST['ip'] = $conn->real_escape_string($_POST['ip']);
if(empty($_POST['ip']))
{
    print"<div class='error-msg'>You need to enter a IP to search!</div>";
    ip_search_form();
}
$nadia=$conn->query("SELECT userid, username, money, level, lastip FROM users WHERE lastip='{$_POST['ip']}'");
if (mysqli_num_rows($nadia) == 0) {
        
    print"<div class='error-msg'>No IP data found in database!</div>";
    ip_search_form();
    }

else {
$_POST['ip'] = $conn->real_escape_string($_POST['ip']);
print "Searching for users with the IP: <b>{$_POST['ip']}</b><br />
<table width=75% class=table><tr style='background:gray'> <th>User</th> <th>Level</th> <th>Money</th> </tr>";
$q=$conn->query("SELECT userid, username, money, level, lastip FROM users WHERE lastip='{$_POST['ip']}'");
$ids=array();
while($r=$q->fetch_assoc())
{
$ids[]=$r['userid'];
print "\n<tr> <td> <a href='viewuser.php?u={$r['userid']}'>{$r['username']}</a></td> <td> {$r['level']}</td> <td>".money_formatter($r['money'])."</td> </tr>";
}
print "</table><br />
<b>Mass Jail</b><br />
<form action='staff_punit.php?action=massjailip' method='post'>
<input type='hidden' name='ids' value='".implode(",",$ids)."' /> Days: <input type='number' name='days' value='5' /> <br />
Reason: <input type='text' name='reason' value='Same IP users, against the rules! Mail webmail@{$domain} with your case.' /><br />
<input type='submit' value='Mass Jail' /></form>";
}
}


function mass_jail()
{
global $conn,$ir,$c,$h,$userid;
$_POST['ids'] = $conn->real_escape_string($_POST['ids']);
$_POST['days'] = $conn->real_escape_string($_POST['days']);
$_POST['reason'] = $conn->real_escape_string($_POST['reason']);
if(empty($_POST['ids']))
{
    print"<div class='error-msg'>No ids selected to jail!</div>";
    ip_search_form();
}
else {
$_POST['ids'] = $conn->real_escape_string($_POST['ids']);
$_POST['days'] = $conn->real_escape_string($_POST['days']);
$_POST['reason'] = $conn->real_escape_string($_POST['reason']);
$ids=explode(",",$_POST['ids']);
foreach($ids as $id)
{
$s = $conn->affected_rows;

$conn->query("INSERT INTO fedjail (fed_userid, fed_days, fed_jailedby, fed_reason, fed_type) VALUES({$id},{$_POST['days']},$userid,'".
$conn->real_escape_string($_POST['reason'])."','Federal')");
print "<div class='success-msg'>User jailed : $id.</div>";
}
stafflog_add("Mass jailed IDs {$_POST['ids']}");
ip_search_form();
}
}
$h->endpage();
?>