<?php
include "sglobals.php";
if($ir['user_level'] != 2)
{
die("403");
}
//This contains battletent stuffs
$_GET['action'] = $conn->real_escape_string($_GET['action']);
switch($_GET['action'])
{
case "createbotform": createbotform(); return;
case "newbotsub": newbotsub(); return;
case "addbot": addbot(); return;
case "addbotform": addbotform(); return;
case "editbot": editbot(); return;
case "editbotconfirm": editbotconfirm(); return;
case "editbotform": editbotform(); return;
case "delbot": delbot(); return;
case "delbotform": delbotform(); return;
default: print "Error: This script requires an action."; return;
}
function addbot()
{
global $conn,$ir,$c,$h,$userid;
$_POST['userid']=abs((int) $_POST['userid']);
$_POST['money']=abs((int) $_POST['money']);
$_POST['userid']=$conn->real_escape_string($_POST['userid']);
$_POST['money']=$conn->real_escape_string($_POST['money']);
$q=$conn->query("SELECT user_level, username, userid FROM users WHERE userid={$_POST['userid']}");
$r=$q->fetch_assoc();
if($r['user_level'] != 0)
{
print "<div class='error-msg'>Challenge bots must be NPCs</div>";
addbotform();
}
elseif(empty($_POST['money']))
{
print "<div class='error-msg'>You need to enter a bounty!</div>";
addbotform();
}
else {
$_POST['userid']=abs((int) $_POST['userid']);
$_POST['money']=abs((int) $_POST['money']);
$_POST['userid']=$conn->real_escape_string($_POST['userid']);
$_POST['money']=$conn->real_escape_string($_POST['money']);
$q2=$conn->query("SELECT cb_npcid FROM challengebots WHERE cb_npcid={$r['userid']}");
if(mysqli_num_rows($q2))
{
print "<div class='error-msg'>This user is already a Challenge Bot. If you wish to change the payout, edit the Challenge Bot</div>";
$h->endpage();
exit;
}
$conn->query("INSERT INTO challengebots (cb_npcid, cb_money) VALUES('{$r['userid']}', '{$_POST['money']}')");
print "<div class='success-msg'>Challenge Bot {$r['username']} added</div>";
stafflog_add("Added Challenge Bot {$r['username']}.");
addbotform();
}
}
function addbotform()
{
global $conn, $ir, $c, $h, $userid;
print "<h3>Adding a Battle Tent Challenge Bot</h3>
<div class='infostaff'>You can add the bot and make it availabe for attacking with a bounty reward.</div>
		<br />
		<br />
<form action='staff_battletent.php?action=addbot' method='post'>
Bot: ".bot_dropdown($c, 'userid')."<br />
Bounty for Beating: <input type='number' name='money' /><br />
<input type='submit' value='Add Challenge Bot' /></form>";
}


function newbotsub()
{
global $conn,$ir,$c, $h, $userid;
if($ir['user_level'] != 2)
{
die("403");
}
  $u=$conn->query("SELECT userid, username FROM users WHERE username='{$_POST['username']}'");
if(mysqli_num_rows($u) != 0)
{
print "<div class='error-msg'>That name is in use, choose another.</div>";
createbotform();
}
elseif(empty($_POST['username']) || empty($_POST['level']))
{
print "<div class='error-msg'>You missed one or more of the required fields</div>";
createbotform();
}

else {
$user=$conn->real_escape_string($_POST['username']);
$gender=$conn->real_escape_string($_POST['gender']);
$level=abs((int) $_POST['level']);
$strength=abs((int) $_POST['strength']);
$agility=abs((int) $_POST['agility']);
$guard=abs((int) $_POST['guard']);
$labour=abs((int) $_POST['labour']);
$location=abs((int) $_POST['location']);
$iq=abs((int) $_POST['iq']);
$energy=10+$level*2;
$brave=3+$level*2;
$hp=50+$level*50;
$conn->query("INSERT INTO users (username, login_name, userpass, level, money, crystals, vip, user_level, energy, maxenergy, will, maxwill, brave, maxbrave, hp, maxhp, location, gender, signedup, email, bankmoney) VALUES( '$user', '$user', 'botaccount', $level, 100, 0, 0, 0, $energy, $energy, 100, 100, $brave, $brave, $hp, $hp, $location, '$gender', unix_timestamp(), 'BOT', '-1')");
$i=$conn->insert_id;
$conn->query("INSERT INTO userstats VALUES($i, $strength, $agility, $guard, $labour, $iq, 0)");
print "<div class='success-msg'>Bot has been created successfully!</div>";
createbotform();
stafflog_add("Created bot {$_POST['username']} [$i]");
} 
}

function createbotform()
{
global $conn,$ir, $c;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Create New Bot</h3>
<div class='infostaff'>This will create a bot but will not make it availble for attacking unless you add it with a bounty.</div>
		<br />
		<br />
<form action='staff_battletent.php?action=newbotsub' method='post'>
Name: <input type='text' name='username' /><br />
Level: <input type='number' name='level' value='1' /><br />
Gender: <select name='gender' type='dropdown'><option>Male</option><option>Female</option></select><br />
Location: ".location_dropdown($c, "location", $_POST['location'])."<br />
<br />
<b>Stats</b><br />
Strength: <input type='number' name='strength' value='10' /><br />
Agility: <input type='number' name='agility' value='10' /><br />
Guard: <input type='number' name='guard' value='10' /><br />
Labour: <input type='number' name='labour' value='10' /><br />
IQ: <input type='number' name='iq' value='10' /><br />
<br />
<input type='submit' value='Create Bot' /></form>";
}




function editbot()
{
global $conn,$ir,$c,$h,$userid;
$_POST['userid']=$conn->real_escape_string($_POST['userid']);
$_POST['money']=$conn->real_escape_string($_POST['money']);
$_POST['userid']=abs((int) $_POST['userid']);
$_POST['money']=abs((int) $_POST['money']);
$q2=$conn->query("SELECT cb_npcid FROM challengebots WHERE cb_npcid={$_POST['userid']}");
if(!mysqli_num_rows($q2))
{
print "<div class='error-msg'>This user is not a Challenge Bot.</div>";
editbotform();
}
elseif(empty($_POST['userid']))
{
print "<div class='error-msg'>Non-existant bot.</div>";
editbotform();
}
else{
$_POST['userid']=$conn->real_escape_string($_POST['userid']);
$_POST['money']=$conn->real_escape_string($_POST['money']);
$_POST['userid']=abs((int) $_POST['userid']);
$_POST['money']=abs((int) $_POST['money']);
$q=$conn->query("SELECT userid, username FROM users WHERE userid={$_POST['userid']}");
$r=$q->fetch_assoc();
$conn->query("UPDATE challengebots SET cb_money={$_POST['money']} WHERE cb_npcid={$r['userid']}");
print "<div class='success-msg'>Challenge Bot {$r['username']} was updated</div>";
stafflog_add("Edited Challenge Bot {$r['username']}.");
editbotform();
}
}

function editbotconfirm() {
global $conn,$ir,$c,$h,$userid;
$_POST['userid']=$conn->real_escape_string($_POST['userid']);
$_POST['userid']=abs((int) $_POST['userid']);
$q2=$conn->query("SELECT cb_npcid FROM challengebots WHERE cb_npcid={$_POST['userid']}");
if(!mysqli_num_rows($q2))
{
print "<div class='error-msg'>This user is not a Challenge Bot.</div>";
editbotform();
}
elseif(empty($_POST['userid']))
{
print "<div class='error-msg'>Non-existant bot.</div>";
editbotform();
}
else{
$_POST['userid']=abs((int) $_POST['userid']);
$q=$conn->query("SELECT userid, username FROM users WHERE userid={$_POST['userid']}");
$r=$q->fetch_assoc();
$q2=$conn->query("SELECT cb_npcid, cb_money FROM challengebots WHERE cb_npcid={$_POST['userid']}");
$r2=$q2->fetch_assoc();
print "<h3>Edit Challenge Bot</h3>
You are editing the challenge bot: <b>{$r['username']}</b><form action='staff_battletent.php?action=editbot' method='post'>
Bounty for Beating: <input type='number' name='money' value='{$r2['cb_money']}' /><br />
<input type='hidden' name='userid' value='{$r['userid']}' />
<input type='submit' value='Edit Challenge Bot' /></form>";
}
}
function editbotform() {
global $conn,$ir,$c,$h,$userid;
print "<h3>Edit Challenge Bot</h3>
<div class='infostaff'>You can edit every aspect of the bot here.</div>
		<br />
		<br />
<form action='staff_battletent.php?action=editbotconfirm' method='post'>
Bot: ".challengebot_dropdown($c, 'userid')."<br />
<input type='submit' value='Edit Challenge Bot' /></form>";
return;
}



function delbot()
{
global $conn,$ir,$c,$h,$userid;
$_POST['userid']=abs((int) $_POST['userid']);
$_POST['delcb']=abs((int) $_POST['delcb']);
$_POST['userid']=$conn->real_escape_string($_POST['userid']);
$_POST['delcb']=$conn->real_escape_string($_POST['delcb']);
$q2=$conn->query("SELECT cb_npcid FROM challengebots WHERE cb_npcid={$_POST['userid']}");
if(!mysqli_num_rows($q2))
{
print "<div class='error-msg'>This user is not a Challenge Bot.</div>";
delbotform();
}
elseif(empty($_POST['userid']))
{
print "<div class='error-msg'>Non-existant bot.</div>";
delbotform();
}
else {
$_POST['delcb']=abs((int) $_POST['delcb']);
$_POST['userid']=abs((int) $_POST['userid']);
$_POST['userid']=$conn->real_escape_string($_POST['userid']);
$_POST['delcb']=$conn->real_escape_string($_POST['delcb']);
$q=$conn->query("SELECT userid, username FROM users WHERE userid={$_POST['userid']}");
$r=$q->fetch_assoc();
$conn->query("DELETE FROM challengebots WHERE cb_npcid={$r['userid']}");
if($_POST['delcb'])
{
$conn->query("DELETE FROM challengesbeaten WHERE npcid={$r['userid']}");
}
print "<div class='success-msg'>Challenge Bot {$r['username']} removed.</div>";
stafflog_add("Removed Challenge Bot {$r['username']}");
delbotform();
}
}

function delbotform()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Remove Challenge Bot</h3>
<div class='infostaff'><b>NB:</b> This will not delete the user from the game, only remove their entry as a Battle Tent Challenge Bot.</div>
		<br />
		<br /><form action='staff_battletent.php?action=delbot' method='post'>
Bot: ".challengebot_dropdown($c, "userid")."<br />
Delete challengesbeaten entries for this bot? <input type='radio' name='delcb' value='1' checked='checked' /> Yes <input type='radio' name='delcb' value='0' /> No<br />
<input type='submit' value='Remove Bot' /></form>";
}

$h->endpage();
?>