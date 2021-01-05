<?php
include "sglobals.php";
//This contains general thingies

$_GET['action'] = $conn->real_escape_string($_GET['action']);
if(!empty($_GET['action'])){
	switch($_GET['action']) {
		case 'basicset': basicsettings(); return;
		case 'announce': announcements(); return;
		case 'announceform': announcementsform(); return;
		case 'update': update(); return;
		case 'updateform': updateform(); return;
		case 'announcementdelete': announcementdelete(); return;
		case 'updatedelete': updatedelete(); return;
		default: index(); return;
	}
}else{
	index();
}

function basicsettings(){
	global $conn,$ir,$c,$h,$userid,$set;
	if($ir['user_level'] != 2){
		die("403");
	}
$_POST['submit'] = $conn->real_escape_string($_POST['submit']);
	if(!empty($_POST['submit'])){
	unset($_POST['submit']);
	foreach($_POST as $k => $v)	{
		if($k == 'sale_off_dates'){
			$v = serialize(explode(',', $v));
		}
		$conn->query("UPDATE `settings` SET conf_value='$v' WHERE conf_name='$k'");
	}
		print "<div class='success-msg'>
  Settings have been updated!</div>";
		stafflog_add("Updated the basic game settings");
		basicsettings();
	}else{
		print "<h3>Basic Settings</h3>
		<div class='infostaff'>Configure the basic settings of the game here I.E. Game Name or Payment Email.</div>
		<br />
		<br />
		<form action='staff.php?action=basicset' method='post'>
		<input type='hidden' name='submit' value='1' />
		Game Name: <input type='text' name='game_name' value='{$set['game_name']}' /><br />
			Money per crystal: <input type='number' name='ct_moneypercrys' value='{$set['ct_moneypercrys']}' placeholder='0' /><br />
	";
		print"
	
		Gym/Crimes Validation: <select name='validate_on' type='dropdown'>";
			
		$opt = array(
		"1" => "On",
		"0" => "Off"
		);
		
		foreach($opt as $k => $v){
			if($k == $set['validate_on']){
				print "<option value='{$k}' selected='selected'>{$v}</option>";
			}else{
				print "<option value='{$k}'>{$v}</option>";
			}
		}
		
		print "</select><br />
		Validation Period: <select name='validate_period' type='dropdown'>";
		
		$opt=array(
		"5" => "Every 5 Minutes",
		"15" => "Every 15 Minutes",
		"60" => "Every Hour",
		"login" => "Every Login"
		);
		
		foreach($opt as $k => $v){
			if($k == $set['validate_period']){
				print "<option value='{$k}' selected='selected'>{$v}</option>";
			}else{
				print "<option value='{$k}'>{$v}</option>";
			}
		}
		
		print "</select><br />
		Registration CAPTCHA: <select name='regcap_on' type='dropdown'>";
		
		$opt=array(
		"1" => "On",
		"0" => "Off"
		);
		
		foreach($opt as $k => $v){
			if($k == $set['regcap_on']){
				print "<option value='{$k}' selected='selected'>{$v}</option>";
			}else{
				print "<option value='{$k}'>{$v}</option>";
			}
		}
		
		print "</select><br />
		Send Crystals: <select name='sendcrys_on' type='dropdown'>";
		
		$opt=array(
		"1" => "On",
		"0" => "Off"
		);
		
		foreach($opt as $k => $v){
			if($k == $set['sendcrys_on']){
				print "<option value='{$k}' selected='selected'>{$v}</option>";
			}else{
				print "<option value='{$k}'>{$v}</option>";
			}
		}
		
		print "</select><br />
		Bank Xfers: <select name='sendbank_on' type='dropdown'>";
		
		$opt=array(
		"1" => "On",
		"0" => "Off"
		);
		
		foreach($opt as $k => $v){
			if($k == $set['sendbank_on']){
				print "<option value='{$k}' selected='selected'>{$v}</option>";
			}else{
				print "<option value='{$k}'>{$v}</option>";
			}
		}
		
		print "</select><br />
	";
		
		print '<h3>Donation Settings</h3>';
		print"	Paypal Address: <input type='email' name='paypal' value='{$set['paypal']}' /><br />";
		
			$js_dates = '';
		if(!empty($set['sale_off_dates'])){
			$dates = explode(',',$set['sale_off_dates']);
			foreach($dates as $date){
				$js_dates .= '\''.$date.'\',';
			}
	
			
		print 'Sale discount: <input type="number" value="'.$set['percent_off_sale'].'" name="percent_off_sale" id="percent_off_sale" />';
		$set['sale_off_dates'] = implode(',', unserialize($set['sale_off_dates']));
		print 'Sale Dates: <input type="text" id="sale_off_dates" name="sale_off_dates" value="'.$set['sale_off_dates'].'" /><br />';
		print 'Promo Text: <input type="text" value="'.$set['sale_text'].'" name="sale_text" id="sale_text" />';
	
		}
		print "<br /><input type='submit' value='Update Settings' />";
		print "</form>";
	
	}
}
function updateform(){ 
	
	global $conn,$ir,$c,$h,$userid,$set;
	if($ir['user_level'] != 2){
		die("403");
	}
		print "<h3>Add Update</h3>
		<div class='infostaff'>You can use this to log an update for almost anything in the game so users can see.</div>
		<br />
		<br />
	<form action='staff.php?action=update' method='post'>
		<label for='email'>Type</label><br />
		<select name='type' type='dropdown'>
	<option value='Bug'>Bug
	<option value='Feature'>Feature
	<option value='Server'>Server
	<option value='Donation'>Donation
	<option value='Request'>Player Request</select>
	<br />
		Update text:<br />
		<textarea name='text' rows='10'></textarea><br />
		<input type='submit' value='Add Update' /></form>";
			
		print "
		<h3>Last 25 Updates</h3>
		<table width='100%' cellspacing='1' class='table'>
		<tr>
		<th>Type</th>
		<th>Update</th>
		<th>Time</th>
		<th>...</th>
		</tr>";
			$q=$conn->query("SELECT * FROM updates ORDER BY a_time DESC LIMIT 25");
		while($r=$q->fetch_assoc()){
			print "<tr><td width='10%'><center><b>{$r['type']}</b></center></td><td width='60%'>{$r['a_text']}</td><td width='25%'>".date('F j Y g:i:s a', $r['a_time'])."</td><td width='5%'><a href='staff.php?action=updatedelete&ID={$r['a_id']}'>Delete</a></td></tr>";
		}
		print "</table>";
}
function update(){ 
	
	global $conn,$ir,$c,$h,$userid,$set;
	if($ir['user_level'] != 2){
		die("403");
	}
		if(empty($_POST['text'])){
	    print"<div class='error-msg'> You need to fill in the field!</div>";
	    updateform();
	}
	else{
	if(!empty($_POST['text'])){
$_POST['type']=filter_var($_POST['type'], FILTER_SANITIZE_STRING);
$_POST['type']=$conn->real_escape_string($_POST['type']);
$_POST['text']=$conn->real_escape_string($_POST['text']);
		$conn->query("INSERT INTO updates (a_text, a_time, type) VALUES('{$_POST['text']}', unix_timestamp(),'{$_POST['type']}')");
		$conn->query("UPDATE users SET new_update=new_update+1");
		print "<div class='success-msg'>Update has been added!</div>";
		stafflog_add("Added an update");
		updateform();
	}
	}
}
function announcementsform()
{
    global $conn,$ir, $userid,  $c;
if($ir['user_level'] != 2)
{
die("403");
}
	print "<h3>Add Announcement</h3>
		<div class='infostaff'>Please try to make sure the announcement is concise and covers everything you want it to.</div>
		<br />
		<br />
		<form action='staff.php?action=announce' method='post'>
		Announcement text:<br />
		<textarea name='text' rows='10'></textarea><br />
		<input type='submit' value='Add Announcement' /></form>";
		
		print "
		<h3>Last 25 Announcements</h3>
		<table width='100%' cellspacing='1' class='table'>
		<tr>
		<th>Announcement</th>
		<th>Time</th>
		<th>...</th>
		</tr>";
			$q=$conn->query("SELECT * FROM announcements ORDER BY a_time DESC LIMIT 25");
		while($r=$q->fetch_assoc()){
			print "<tr><td width='70%'>{$r['a_text']}</td><td width='20%'>".date('F j Y g:i:s a', $r['a_time'])."</td><td width='10%'><a href='staff.php?action=announcementdelete&ID={$r['a_id']}'>Delete</a></td></tr>";
		}
		print "</table>";
		
}
function updatedelete() {
    global $conn,$ir, $userid,  $c;
if($ir['user_level'] != 2)
{
die("403");
}
$_GET['ID'] = $conn->real_escape_string($_GET['ID']);
$q1=$conn->query("SELECT a_id FROM updates WHERE a_id={$_GET['ID']}");
if(!mysqli_num_rows($q1))
{
$_GET['ID']=0;
print"<div class='error-msg'>Update ID doesn't exist!</div>";
updateform();
}
else{
$_GET['ID'] = $conn->real_escape_string($_GET['ID']);
$oq=$conn->query("SELECT * FROM updates WHERE a_id='{$_GET['ID']}'");
$rm=$oq->fetch_assoc();
$conn->query("DELETE FROM updates WHERE a_id={$_GET['ID']}");
print "<div class='success-msg'>You have successfully deleted this update!</div>";
stafflog_add("Deleted an update");

updateform();
}
}
function announcementdelete() {
    global $conn,$ir, $userid,  $c;
if($ir['user_level'] != 2)
{
die("403");
}
$_GET['ID'] = $conn->real_escape_string($_GET['ID']);
$q1=$conn->query("SELECT a_id FROM announcements WHERE a_id={$_GET['ID']}");
if(!mysqli_num_rows($q1))
{
$_GET['ID']=0;
print"<div class='error-msg'>Announcement ID doesn't exist!</div>";
announcementsform();
}
else{
$_GET['ID'] = $conn->real_escape_string($_GET['ID']);
$oq=$conn->query("SELECT * FROM announcements WHERE a_id='{$_GET['ID']}'");
$rm=$oq->fetch_assoc();
$conn->query("DELETE FROM announcements WHERE a_id={$_GET['ID']}");
print "<div class='success-msg'>You have successfully deleted this announcement!</div>";
stafflog_add("Deleted an announcement");

announcementsform();
}
}
function announcements(){ 
	
	global $conn,$ir,$c,$h,$userid,$set;
	if($ir['user_level'] != 2){
		die("403");
	}
	if(empty($_POST['text'])){
	    print"<div class='error-msg'> You need to fill in the field!</div>";
	    announcementsform();
	}
	else{
	if(!empty($_POST['text'])){
$_POST['text']=$conn->real_escape_string($_POST['text']);
		$conn->query("INSERT INTO announcements (a_text, a_time) VALUES('{$_POST['text']}', unix_timestamp())");
		$conn->query("UPDATE users SET new_announcements=new_announcements+1");
		print "<div class='success-msg'>Announcement added!</div>";
		stafflog_add("Added an announcement");
		announcementsform();
	}
	}
}

function index(){
	global $conn,$ir,$c,$h,$userid,$set, $_CONFIG;
	$pv=phpversion();
	$mvv=$conn->query("SELECT VERSION()");
	$mv = $mvv->fetch_row();
	$dv=$_CONFIG['driver'];
	if($ir['user_level']>1){
		$versionno=20200;
		$version="2.0.2";
		print "<h3>System Info</h3>
		<div class='infostaff'>Here you can check basic server settings, staff logs and use a staff pad to keep notes.</div>
		<br />
		<br />
		<table width='50%' align='center' cellspacing='1' class='table'>
		<tr>
		<th>PHP Version:</th>
		<td>$pv</td>
		</tr>
		<tr>
		<th>MySQL Version:</th>
		<td>$mv[0]</td>
		</tr>
		<tr>
		<th>MySQL Driver:</th>
		<td>$dv</td>
		</tr>
		<tr>
		<th>Codes Version</th>
		<td>$version (Build: $versionno)</td>
		</tr>
		</table><br /><br />";
	
		print "
		<h3>Last 25 Staff Actions</h3>
		<table width='100%' cellspacing='1' class='table'>
		<tr>
		<th>Staff</th>
		<th>Action</th>
		<th>Time</th>
		<th>IP</th>
		</tr>";
		$q=$conn->query("SELECT s.*, u.* FROM stafflog AS s LEFT JOIN users AS u ON s.user=u.userid ORDER BY s.time DESC LIMIT 25");
		while($r=$q->fetch_assoc()){
			print "<tr><td>{$r['username']} [{$r['user']}]</td> <td>{$r['action']}</td> <td>".date('F j Y g:i:s a', $r['time'])."</td> <td>{$r['ip']}</td></tr>";
		}
		print "</table>";
	}
	print "<h3>Staff Notepad</h3>";
	if(!empty($_POST['pad'])){
		$set['staff_pad']=$conn->real_escape_string($_POST['pad']);
		$conn->query("UPDATE settings SET conf_value='{$_POST['pad']}' WHERE conf_name='staff_pad'");
		print "<div class='success-msg'>Staff Notepad Updated!</div>";
	}
	print "<form action='staff.php' method='post'>
	<textarea rows='10' name='pad'>".htmlspecialchars($set['staff_pad'])."</textarea><br />
	<input type='submit' value='Update Notepad' /></form>";
}
$h->endpage();
?>