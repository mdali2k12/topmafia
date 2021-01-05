<?php
include "sglobals.php";
//This contains user stuffs

$_GET['action'] = $conn->real_escape_string($_GET['action']);
switch($_GET['action'])
{
case 'viewuserprofile': viewuserprofile(); return;
case 'viewuserprofile2': viewuserprofile2(); return;
case 'newuser': new_user_form(); return;
case 'newusersub': new_user_submit(); return;
case 'edituser': edit_user_begin(); return;
case 'edituserform': edit_user_form(); return;
case 'editusersub': edit_user_sub(); return;
case 'invbeg': inv_user_begin(); return;
case 'invuser': inv_user_view(); return;
case 'deleinv': inv_delete(); return;
case 'creditform': credit_user_form(); return;
case 'creditsub': credit_user_submit(); return;
case 'masscredit': mcredit_user_form(); return;
case 'masscreditsub': mcredit_user_submit(); return;
case 'reportsview': reports_view(); return;
case 'repclear': report_clear(); return;
case 'deluser': deluser(); return;
case 'forcelogout': forcelogout(); return;
default: print "Error: This script requires an action."; return;
}
function htmlspcl($in)
{
return str_replace("'", "&#39;", htmlspecialchars($in));
}
function new_user_form()
{
global $conn,$ir, $c;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Add New User</h3>
<div class='infostaff'>You can create a user below using the form.</div>
		<br />
		<br />
<form action='staff_users.php?action=newusersub' method='post'>
Username: <input type='text' name='username' /><br />
Login Name: <input type='text' name='login_name' /><br />
Email: <input type='email' name='email' /><br />
Password: <input type='text' name='userpass' /><br />
Type: <input type='radio' name='user_level' value='0' />NPC <input type='radio' name='user_level' value='1' checked='checked' />Regular Member<br />
Level: <input type='number' name='level' value='1' /><br />
Money: <input type='number' name='money' value='100' /><br />
Bank Money: <input type='number' name='bankmoney' value='-1' /><br />
Crystals: <input type='number' name='crystals' value='10' /><br />
Crystal Bank: <input type='number' name='bankcrystal' value='10' /><br />
VIP Days: <input type='number' name='donatordays' value='10' /><br />
Gender: <select name='gender' type='dropdown'><option>Male</option><option>Female</option></select><br />
House: ".house2_dropdown($c, "maxwill", $_POST['maxwill'])."<br />
Location: ".location_dropdown($c, "location", $_POST['location'])."<br />
<br />
<b>Stats</b><br />
Strength: <input type='number' name='strength' value='10' /><br />
Agility: <input type='number' name='agility' value='10' /><br />
Guard: <input type='number' name='guard' value='10' /><br />
Labour: <input type='number' name='labour' value='10' /><br />
IQ: <input type='number' name='iq' value='10' /><br />
<br />
<input type='submit' value='Create User' /></form>";
}
function new_user_submit()
{
global $conn,$ir,$c, $h, $userid;
if($ir['user_level'] != 2)
{
die("403");
}
  $u=$conn->query("SELECT userid, username FROM users WHERE username='{$_POST['username']}'");
if(mysqli_num_rows($u) != 0)
{
print "<div class='error-msg'>That username is in use, choose another.</div>";
new_user_form();
}
elseif(empty($_POST['username']) || empty($_POST['login_name']) || empty($_POST['userpass']))
{
print "<div class='error-msg'>You missed one or more of the required fields</div>";
new_user_form();
}

else {
$user=$conn->real_escape_string($_POST['username']);
$_POST['email'] = $conn->real_escape_string($_POST['email']);
$_POST['bankmoney'] =abs((int) $_POST['bankmoney']);
$_POST['bankcrystal'] =abs((int) $_POST['bankcrystal']);
$userlogin=$conn->real_escape_string($_POST['login_name']);
$gender=$conn->real_escape_string($_POST['gender']);
$level=abs((int) $_POST['level']);
$money=abs((int) $_POST['money']);
$crystals=abs((int) $_POST['crystals']);
$donator=abs((int) $_POST['donatordays']);
$ulevel=abs((int) $_POST['user_level']);
$strength=abs((int) $_POST['strength']);
$agility=abs((int) $_POST['agility']);
$guard=abs((int) $_POST['guard']);
$labour=abs((int) $_POST['labour']);
$maxwill=abs((int) $_POST['maxwill']);
$location=abs((int) $_POST['location']);
$iq=abs((int) $_POST['iq']);
$energy=10+$level*2;
$brave=3+$level*2;
$hp=50+$level*50;
$conn->query("INSERT INTO users (username, login_name, userpass, level, money, crystals, vip, user_level, energy, maxenergy, will, maxwill, brave, maxbrave, hp, maxhp, location, gender, signedup, email, bankmoney, bankcrystal) VALUES( '$user', '$userlogin', md5('{$_POST['userpass']}'), $level, $money, $crystals, $donator, $ulevel, $energy, $energy, $maxwill, $maxwill, $brave, $brave, $hp, $hp, $location, '$gender', unix_timestamp(), '{$_POST['email']}', '{$_POST['bankmoney']}', '{$_POST['bankcrystal']}')");
$i=$conn->insert_id;
$conn->query("INSERT INTO userstats VALUES($i, $strength, $agility, $guard, $labour, $iq, 0)");
print "<div class='success-msg'>User has been created successfully!</div>";
new_user_form();
stafflog_add("Created user {$_POST['username']} [$i]");
} 
}
function edit_user_begin()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Editing User</h3>
<div class='infostaff'>You can edit any aspect of the selected user.</div>
		<br />
		<br />
<form action='staff_users.php?action=edituserform' method='post'>
User: ".user_dropdown($c,'user')."<br />
<input type='submit' value='Edit User' /></form>
OR enter a user ID to edit:
<form action='staff_users.php?action=edituserform' method='post'>
User: <input type='number' name='user' value='0' /><br />
<input type='submit' value='Edit User' /></form>";
}
function edit_user_form()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
 $u=$conn->query("SELECT userid, username FROM users WHERE userid='{$_POST['user']}'");
if(mysqli_num_rows($u) == 0)
{
print "<div class='error-msg'>User does not exist!</div>";
edit_user_begin();
}
elseif(empty($_POST['user']))
{
print "<div class='error-msg'>You need to select a user to edit</div>";
edit_user_begin();
}
else{
$d=$conn->query("SELECT u.*,us.* FROM users u LEFT JOIN userstats us on u.userid=us.userid WHERE u.userid={$_POST['user']}");
$itemi=$d->fetch_assoc();
$itemi['hospreason']=htmlspcl($itemi['hospreason']);
$itemi['jail_reason']=htmlspcl($itemi['jail_reason']);
print "<h3>Editing User</h3>
<form action='staff_users.php?action=editusersub' method='post'>
<input type='hidden' name='userid' value='{$_POST['user']}' />
Username: <input type='text' name='username' value='{$itemi['username']}' /><br />
Login Name: <input type='text' name='login_name' value='{$itemi['login_name']}' /><br />
Display Pic: <input type='text' name='display_pic' value='{$itemi['display_pic']}' /><br />
Email: <input type='email' name='email' value='{$itemi['email']}' /><br />
Level: <input type='number' name='level' value='{$itemi['level']}' /><br />
Money: \$<input type='number' name='money' value='{$itemi['money']}' /><br />
Bank: \$<input type='number' name='bankmoney' value='{$itemi['bankmoney']}' /><br />
Crystals: <input type='number' name='crystals' value='{$itemi['crystals']}' /><br />
Crystal Bank: <input type='number' name='bankcrystal' value='{$itemi['bankcrystal']}' /><br />
VIP Days: <input type='number' name='vip' value='{$itemi['vip']}' /><br />
Staff Notes: <input type='text' name='staffnotes' value='{$itemi['staffnotes']}' /><br />
Gender: <select name='gender' type='dropdown'><option>Male</option><option>Female</option></select><br />
House: ".house2_dropdown($c, "maxwill", $itemi['maxwill'])."<br />
Location: ".location_dropdown($c, "location", $itemi['location'])."<br /><br />

<h4>Stats</h4>
Strength: <input type='number' name='strength' value='{$itemi['strength']}' /><br />
Agility: <input type='number' name='agility' value='{$itemi['agility']}' /><br />
Guard: <input type='number' name='guard' value='{$itemi['guard']}' /><br />
Labour: <input type='number' name='labour' value='{$itemi['labour']}' /><br />
IQ: <input type='number' name='IQ' value='{$itemi['IQ']}' /><br />
<input type='submit' value='Edit User' /></form>";
}
}
function edit_user_sub()
{

global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['userid'] = $conn->real_escape_string($_POST['userid']);
$_POST['username'] = $conn->real_escape_string($_POST['username']);
$_POST['email'] = $conn->real_escape_string($_POST['email']);
$_POST['login_name'] = $conn->real_escape_string($_POST['login_name']);
$_POST['display_pic'] = $conn->real_escape_string($_POST['display_pic']);
$u=$conn->query("SELECT userid, username FROM users WHERE username='{$_POST['username']}' and userid != '{$_POST['userid']}'");
if(mysqli_num_rows($u) != 0)
{
print "<div class='error-msg'>That username is in use, choose another.</div>";
edit_user_begin();
}
elseif(empty($_POST['username']) || empty($_POST['login_name']))
{
print "<div class='error-msg'>You did not fully fill out the form. </div>";
edit_user_begin();
}
else
{
$_POST['userid'] = $conn->real_escape_string($_POST['userid']);
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['display_pic'] = $conn->real_escape_string($_POST['display_pic']);
$_POST['username'] = $conn->real_escape_string($_POST['username']);
$_POST['email'] = $conn->real_escape_string($_POST['email']);
$_POST['login_name'] = $conn->real_escape_string($_POST['login_name']);
$gender=$conn->real_escape_string($_POST['gender']);
$_POST['level']=(int) $_POST['level'];
$_POST['strength']=abs((int) $_POST['strength']);
$_POST['agility']=abs((int) $_POST['agility']);
$_POST['guard']=abs((int) $_POST['guard']);
$_POST['labour']=abs((int) $_POST['labour']);
$_POST['IQ']=abs((int) $_POST['IQ']);
$_POST['money']=(int) $_POST['money'];
$_POST['bankmoney']=(int) $_POST['bankmoney'];
$_POST['crystals']=(int) $_POST['crystals'];
$_POST['bankcrystal']=(int) $_POST['bankcrystal'];
$maxwill=abs((int) $_POST['maxwill']);
$location=abs((int) $_POST['location']);

//check for username usage
$oq=$conn->query("SELECT userid, will, maxwill, willmax FROM users WHERE userid={$_POST['userid']}");
$rm=$oq->fetch_assoc();
$will=($rm['will'] > $maxwill) ? $maxwill: $rm['will'];
$energy=100;
$nerve=3+$_POST['level']*2;
$hp=50+$_POST['level']*50;
$conn->query("UPDATE users SET username='{$_POST['username']}', level='{$_POST['level']}', money='{$_POST['money']}', gender='$gender', bankmoney='{$_POST['bankmoney']}', display_pic='{$_POST['display_pic']}', crystals='{$_POST['crystals']}', bankcrystal='{$_POST['bankcrystal']}', energy=$energy, brave=$nerve, maxbrave=$nerve, maxenergy=$energy, hp=$hp, maxhp=$hp, staffnotes='{$_POST['staffnotes']}', login_name='{$_POST['login_name']}', email='{$_POST['email']}', vip='{$_POST['vip']}', will=$will, location=$location, maxwill=$maxwill WHERE userid={$_POST['userid']}");
$conn->query("UPDATE userstats SET strength={$_POST['strength']}, agility={$_POST['agility']}, guard={$_POST['guard']}, labour={$_POST['labour']}, IQ={$_POST['IQ']} WHERE userid={$_POST['userid']}");
stafflog_add("Edited user {$_POST['username']} [{$_POST['userid']}]");
print "<div class='success-msg'>User edited successfully!</div>";
edit_user_begin();

}
}
function deluser()
{
global $ir,$c,$h,$userid,$conn;
if($ir['user_level'] != 2)
{
die("403");
}
$undeletable = array('1','2'); // add more IDs here, such as NPCs
switch ($_GET['step'])
{
   default:
      echo "<h3>Delete User</h3>
      <div class='infostaff'>This will remove the user completely from the database, all data will be lost.</div>
		<br />
		<br />
      <form action='staff_users.php?action=deluser&step=2' method='post'>
      User: ".user_dropdown($c,'user')."<br />
      <input type='submit' value='Delete User' /></form>
      OR enter a user ID to Delete:
      <form action='staff_users.php?action=deluser&step=2' method='post'>
      User: <input type='text' name='user' value='0' /><br />
      <input type='submit' value='Delete User' /></form>";
   return;
   case 2:
       $u=$conn->query("SELECT userid, username FROM users WHERE userid='{$_POST['user']}'");
if(mysqli_num_rows($u) == 0)
{
print "<div class='error-msg'>User does not exist!</div>";
}
elseif(empty($_POST['user']))
{
print "<div class='error-msg'>You need to select a user to delete!</div>";
}
else{
    
$target = $conn->real_escape_string($_POST['user']);
$target = abs((int) $_POST['user']);
      if (!is_numeric($target)) exit;
      if (in_array($target,$undeletable)) {
         die('<div class="error-msg">You cannot delete this person.</div>');
      }
      $d=$conn->query("SELECT username FROM users WHERE userid='$target'");
      $itemi=$d->fetch_assoc();
      print "<h3>Confirm</h3>
      Delete user ".$itemi["username"]."?
      <form action='staff_users.php?action=deluser&step=3' method='post'>
      <input type='hidden' name='userid' value='$target' />
      <input type='submit' name='yesorno' value='Yes' />
      <input type='submit' name='yesorno' value='No' onclick=\"window.location='staff_users.php?action=deluser';\" /></form>";
}
   return;
   case 3:
              $u=$conn->query("SELECT userid, username FROM users WHERE userid='{$_POST['userid']}'");
if(mysqli_num_rows($u) == 0)
{
print "<div class='error-msg'>User does not exist!</div>";
}
elseif(empty($_POST['userid']))
{
print "<div class='error-msg'>You need to select a user to delete</div>";
}
else{
    
$target = $conn->real_escape_string($_POST['user']);
$target = abs((int) $_POST['user']);
      if (!is_numeric($target)) exit;
      if (in_array($target,$undeletable)) {
         die('<div class="error-msg">You cannot delete this person.</div>');
      }
      
$_POST['yesorno'] = $conn->real_escape_string($_POST['yesorno']);
      if($_POST['yesorno']=='No')
      {
         die("<div class='error-msg'>User not deleted.</div>");
      }
      if ($_POST['yesorno'] != ("No" || "Yes")) die('Eh');
     $d=$conn->query("SELECT username FROM users WHERE userid='$target'");
      $itemi=$d->fetch_assoc();
      $conn->query("DELETE FROM users WHERE userid='$target'");
      $conn->query("DELETE FROM mail WHERE mail_from='$target'");
      $conn->query("DELETE FROM events WHERE evUSER='$target'");
      $conn->query("DELETE FROM userstats WHERE userid='$target'");
      $conn->query("DELETE FROM inventory WHERE inv_userid='$target'");
      $conn->query("DELETE FROM fedjail WHERE fed_userid='$target'");
      echo "<div class='success-msg'>User {$itemi['username']} Deleted.</div>";
stafflog_add("Deleted User {$itemi['username']} [{$_POST['userid']}]");     
   return;
}
}
} 
function inv_user_begin()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] !=2)
{
die("403");
}
print "<h3>Viewing User Inventory</h3>
<div class='infostaff'>You are able to view the selected users inventory.</div>
		<br />
		<br />
<form action='staff_users.php?action=invuser' method='post'>
User: ".user_dropdown($c,'user')."<br />
<input type='submit' value='View Inventory' /></form>";
}

function viewuserprofile()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] !=2)
{
die("403");
}
print "<h3>Viewing User Account</h3>
<div class='infostaff'>Here you can view a selected users account information.</div>
		<br />
		<br />
<form action='staff_users.php?action=viewuserprofile2' method='post'>
User: ".user_dropdown($c,'user')."<br />
<input type='submit' value='View Account' /></form>";
}






function viewuserprofile2()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] !=2)
{
die("403");
}

$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['user'] = abs((int) $_POST['user']);
             $u=$conn->query("SELECT userid, username FROM users WHERE userid='{$_POST['user']}'");
if(mysqli_num_rows($u) == 0)
{
print "<div class='error-msg'>User does not exist!</div>";
viewuserprofile();
}
elseif(empty($_POST['user']))
{
print "<div class='error-msg'>You need to select a user to view</div>";
viewuserprofile();
}
else{
    
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['user'] = abs((int) $_POST['user']);
$d=$conn->query("SELECT u.*,us.* FROM users u LEFT JOIN userstats us on u.userid=us.userid WHERE u.userid={$_POST['user']}");
      $un=$d->fetch_assoc();
      
      print"<h3>{$un['username']} Profile</h3>";
      
      $q11=$conn->query("SELECT location, cityid, cityname FROM users LEFT JOIN cities ON location=cityid WHERE userid={$_POST['user']}");
               $rr=$q11->fetch_assoc();
               
               
                 $q111=$conn->query("SELECT maxwill, hWILL, hNAME FROM users LEFT JOIN houses ON maxwill=hWILL WHERE userid={$_POST['user']}");
               $house=$q111->fetch_assoc();
               
      $q=$conn->query("SELECT * FROM users LEFT JOIN houses ON maxwill=hWILL LEFT JOIN gangs ON gangID=gang WHERE userid={$_POST['user']}");
if(mysqli_num_rows($q) == 0)
{
print "Sorry, we could not find a user with that ID, check your source.";
}
else
{
$r=$q->fetch_assoc();
if (!$r['married'])
{
$marital="<font color='red'>No</font>";
}
else
{
$k=$conn->query("SELECT username FROM users WHERE userid={$r['married']}", $c);
$marital="<a href='viewuser.php?u={$r['married']}' style='color:green;'>".@mysqli_result($k,0,0)."</a><br /><small>Will Max:</b> {$un['willmax']}</small>";
}
if($r['gang'])
{
$gang="<a href='gangs.php?action=view&ID={$r['gang']}'>{$r['gangNAME']}</a>";
}
else
{
$gang="<font color='red'>No Gang</font>";
}
}
$lon=($un['laston'] > 0) ?date('F j, Y g:i:s a',$un['laston']) : "Never";
$fm="".money_formatter($un['money'])."";
$bm="".money_formatter($un['bankmoney'])."";
$dm="".money_formatter($un['donatormoney'])."";
$cm="".number_format($un['bankcrystal'])."";
$ccm="".number_format($un['crystals'])."";
if ($un['user_level'] == 0)
{
    $userlevel ="Bot";
}
if ($un['user_level'] == 1)
{
    $userlevel ="Regular";
}
if ($un['user_level'] == 2)
{
    $userlevel ="Admin";
}
if ($un['user_level'] == 3)
{
    $userlevel ="Moderator";
}

if ($un['verified'] == 0)
{
    $verified ="<font color=red>NOT VERIFIED</font>";
}

if ($un['verified'] == 1)
{
    $verified ="<font color=green>VERIFIED</font>";
}
	$un['exp_needed']=(int) (($un['level']+2)*($un['level']+2)*($un['level']+2)*5);

  $ip=@gethostbyaddr($un['lastip']);
      print"
      
<table class='table' width='95%'>
<tr>
<td width='50%'><b>Name:</b> {$un['username']} [{$un['userid']}]</td>
<td width='50%'><b>HP:</b> {$un['hp']}/{$un['maxhp']}</td>
</tr>
<tr>
<td width='50%'><b>Level:</b> {$un['level']}</td>
<td width='50%'><b>XP:</b> {$un['exp']} / <b>{$un['exp_needed']}</b></td>
</tr>
<tr>
<td width='50%'><b>Location:</b> {$rr['cityname']} [{$rr['cityid']}]</td>
<td width='50%'><b>Days Old:</b> {$un['daysold']}</td>
</tr>
<tr>
<td width='50%'><b>Money:</b> $fm</td>
<td width='50%'><b>Bank Money:</b> $bm</td>
</tr>
<tr>
<td width='50%'><b>Crystals:</b> $ccm</td>
<td width='50%'><b>Crystal Bank:</b> $cm</td>
</tr>
<tr>
<td width='50%'><b>House:</b> {$house['hNAME']}</td>
<td width='50%'><b>Partner:</b> $marital </td>
</tr><tr>
<td width='50%'><b>Gang:</b> $gang </td>
<td width='50%'><b>Days in Gang:</b> {$un['daysingang']} </td>
</tr>
<tr>
<td width='50%'><b>VIP Days:</b> {$un['vip']}</td>
<td width='50%'><b>Donated:</b> <font color=green>".money_formatter($un['donated'])."</font> </td>
</tr>
<tr>
<td width='50%'><b>Gender:</b> {$un['gender']} </td>
<td width='50%'><b>Fedjail:</b> {$un['fedjail']} </td>
</tr>
<tr>
<td width='50%'><b>Email:</b> {$un['email']} </td>
<td width='50%'><b>Verified:</b> $verified </td>
</tr>
<tr>
<td width='50%'><b>User Level:</b> $userlevel </td>
<td width='50%'><b>Notes:</b> {$un['notes']} </td>
</tr>

<tr>
<td width='50%'><b>IP:</b> $ip</td>
<td width='50%'><b>Last On:</b> $lon </td>
</tr>
</table>
";

print"
<br /><br />
<table class='table' width='95%'>
<tr>
<td width='50%'><b>Energy:</b> {$un['energy']} </td>
<td width='50%'><b>Max Energy:</b> {$un['maxenergy']}</td>
</tr>
<tr>
<td width='50%'><b>Health: </b> {$un['hp']}</td>
<td width='50%'><b>Max Health:</b> {$un['maxhp']}</td>
</tr>
<tr>
<td width='50%'><b>Will:</b> {$un['will']}</td>
<td width='50%'><b>Max Will:</b> {$un['maxwill']} <br /> $marital2</td>
</tr>
<tr>
<td width='50%'><b>Brave: </b> {$un['brave']}</td>
<td width='50%'><b>Max Brave:</b> {$un['maxbrave']}</td>
</tr>
</table>
";

$ts=$un['strength']+$un['agility']+$un['guard']+$un['labour']+$un['IQ'];
$un['strank']=get_rank($un['strength'],'strength');
$un['agirank']=get_rank($un['agility'],'agility');
$un['guarank']=get_rank($un['guard'],'guard');
$un['labrank']=get_rank($un['labour'],'labour');
$un['IQrank']=get_rank($un['IQ'],'IQ');
$tsrank=get_rank($ts,'strength+agility+guard+labour+IQ');
$un['strength']=number_format($un['strength']);
$un['agility']=number_format($un['agility']);
$un['guard']=number_format($un['guard']);
$un['labour']=number_format($un['labour']);
$un['IQ']=number_format($un['IQ']);
$ts=number_format($ts);



print"
<br /><br />
<table class='table' width='95%'>
<tr>
<td width='50%'><b>Strength:</b> {$un['strength']} [Ranked: {$un['strank']}]</td>
<td width='50%'><b>Agility:</b> {$un['agility']} [Ranked: {$un['agirank']}]</td>
</tr>
<tr>
<td width='50%'><b>Guard:</b> {$un['guard']} [Ranked: {$un['guarank']}]</td>
<td width='50%'><b>Labour:</b> {$un['labour']} [Ranked: {$un['labrank']}]</td>
</tr>
<tr>
<td width='50%'><b>IQ: </b> {$un['IQ']} [Ranked: {$un['IQrank']}]</td>
<td width='50%'><b>Total stats:</b> {$ts} [Ranked: $tsrank]</td>
</tr>
</table>

";




stafflog_add("Viewed user {$un['username']} [{$_POST['user']}] account");
}
}


function inv_user_view()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] !=2)
{
die("403");
}

$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['user'] = abs((int) $_POST['user']);
             $u=$conn->query("SELECT userid, username FROM users WHERE userid='{$_POST['user']}'");
if(mysqli_num_rows($u) == 0)
{
print "<div class='error-msg'>User does not exist!</div>";
inv_user_begin();
}
elseif(empty($_POST['user']))
{
print "<div class='error-msg'>You need to select a user to view</div>";
inv_user_begin();
}
else{
    
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['user'] = abs((int) $_POST['user']);
$d=$conn->query("SELECT username FROM users WHERE userid='{$_POST['user']}'");
      $un=$d->fetch_assoc();
$inv=$conn->query("SELECT iv.*,i.*,it.* FROM inventory iv LEFT JOIN items i ON iv.inv_itemid=i.itmid LEFT JOIN itemtypes it ON i.itmtype=it.itmtypeid WHERE iv.inv_userid={$_POST['user']}");
if (mysqli_num_rows($inv) == 0)
{
print "<div class='error-msg'>This person has no items!</div>";
inv_user_begin();
}
else
{
print "<b>Their items are listed below.</b><br />
<table width=100% class=table><tr style='background-color:gray;'><th>Item</th><th>Sell Value</th><th>Total Sell Value</th><th>Links</th></tr>";
while($i=$inv->fetch_assoc())
{
print "<tr><td>{$i['itmname']}";
if ($i['inv_qty'] > 1)
{
print "&nbsp;x{$i['inv_qty']}";
}
print "</td><td>\${$i['itmsellprice']}</td><td>";
print "$".($i['itmsellprice']*$i['inv_qty']);
print "</td><td>[<a href='staff_users.php?action=deleinv&ID={$i['inv_id']}'>Delete</a>]";
print "</td></tr>";
}
print "</table>";
}
stafflog_add("Viewed user {$un['username']} [{$_POST['user']}] inventory");
}
}
function inv_delete()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] !=2)
{
die("403");
}
$_GET['ID'] = $conn->real_escape_string($_GET['ID']);
$_GET['ID'] = abs((int) $_GET['ID']);
             $u=$conn->query("SELECT inv_id FROM inventory WHERE inv_id='{$_GET['ID']}'");
if(mysqli_num_rows($u) == 0)
{
print "<div class='error-msg'>Inv ID does not exist!</div>";
inv_user_begin();
}
elseif(empty($_GET['ID']))
{
print "<div class='error-msg'>You need to select a item to delete!</div>";
inv_user_begin();
}
else{

$_GET['ID'] = $conn->real_escape_string($_GET['ID']);
$_GET['ID'] = abs((int) $_GET['ID']);
$r=$conn->query("SELECT iv.*,i.*,u.* FROM inventory iv LEFT JOIN items i ON iv.inv_itemid=i.itmid LEFT JOIN users u ON iv.inv_userid=u.userid WHERE iv.inv_id={$_GET['ID']}");
$i=$r->fetch_assoc();
$conn->query("DELETE FROM inventory WHERE inv_id={$_GET['ID']}");
print "<div class='success-msg'>Item deleted from inventory.</div>";
stafflog_add("Deleted {$i['itmname']} from {$i['username']} [{$i['userid']}] inventory");
inv_user_begin();
}
}
function credit_user_form()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] !=2)
{
die("403");
}
print "<h3>Crediting User</h3>
<div class='infostaff'>Credit cash, crytal or vip days to a chosen user.</div>
		<br />
		<br />
<form action='staff_users.php?action=creditsub' method='post'>
User: ".user_dropdown($c,'user')."<br />
Money: <input type='number' name='money' value='0' />
Crystals: <input type='number' name='crystals' value='0'/>
VIP Days: <input type='number' name='vip' value='0'/><br />
<input type='submit' value='Credit User' value='0' /></form>";
}
function credit_user_submit()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] !=2)
{
die("403");
}
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['user'] = abs((int) $_POST['user']);
if(empty($_POST['user'])){
  print "<div class='error-msg'>Select a user to credit! </div>";
credit_user_form();  
}
else
{
$_POST['user'] = $conn->real_escape_string($_POST['user']);
$_POST['user'] = abs((int) $_POST['user']);
$_POST['money'] = (int) $_POST['money'];
$_POST['vip'] = (int) $_POST['vip'];
$_POST['crystals'] = (int) $_POST['crystals'];
$conn->query("UPDATE users u SET money=money+{$_POST['money']}, vip=vip+{$_POST['vip']}, crystals=crystals+{$_POST['crystals']} WHERE u.userid={$_POST['user']}");
print "<div class='success-msg'>User credited.</div>";
$d=$conn->query("SELECT username FROM users WHERE userid='{$_POST['user']}'");
      $un=$d->fetch_assoc();
stafflog_add("Credited {$un['username']} [{$_POST['user']}] ".money_formatter($_POST['money']).", ".cash_format($_POST['crystals'])." crystals and/or ".number_format($_POST['vip'])." vip days.");
credit_user_form();
}
}
function mcredit_user_form()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Mass Payment</h3>
<div class='infostaff'>You can credit all active users in the gave with cash, crystals and vip.</div>
		<br />
		<br />
<form action='staff_users.php?action=masscreditsub' method='post'>
Money: <input type='number' name='money' value='0'/> 
Crystals: <input type='number' name='crystals' value='0'/>
VIP Days: <input type='number' name='vip' value='0'/>
<br />
<input type='submit' value='Credit User' /></form>";
}
function mcredit_user_submit()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}

if(empty($_POST['money']))
{
print "<div class='error-msg'>Set money higher than 0 to mass credit</div>";
mcredit_user_form();
} 
else
{
$_POST['money'] = (int) $_POST['money'];
$_POST['crystals'] = (int) $_POST['crystals'];
$_POST['vip'] = (int) $_POST['vip'];
$conn->query("UPDATE users u SET vip=vip+{$_POST['vip']}, money=money+{$_POST['money']}, crystals=crystals+{$_POST['crystals']}");
print "<div class='success-msg'>All Users credited. Click <a href='staff.php?action=announce'>here to add an announcement</a> or <a href='staff_special.php?action=massmailer'>here to send a mass mail</a> explaining why.</div>";
stafflog_add("Credited all users ".money_formatter($_POST['money']).", ".cash_format($_POST['crystals'])." crystals and/or ".number_format($_POST['vip'])." vip days.");
mcredit_user_form();
}
}
function reports_view()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] > 3)
{
die("403");
}
print "<h3>Player Reports</h3>
<div class='infostaff'>You can view a record of all report users below.</div>
		<br />
		<br />
<table width=100%><tr style='background:gray'><th>Reporter</th> <th>Offender</th> <th>What they did</th> <th>&nbsp;</th> </tr>";
$q=$conn->query("SELECT pr.*,u1.username as reporter, u2.username as offender FROM preports pr LEFT JOIN users u1 ON u1.userid=pr.prREPORTER LEFT JOIN users u2 ON u2.userid=pr.prREPORTED ORDER BY pr.prID DESC");
while($r=$q->fetch_assoc())
{
print "\n<tr> <td><a href='viewuser.php?u={$r['prREPORTER']}'>{$r['reporter']}</a> [{$r['prREPORTER']}]</td> <td><a href='viewuser.php?u={$r['prREPORTED']}'>{$r['offender']}</a> [{$r['prREPORTED']}]</td> <td>{$r['prTEXT']}</td> <td><a href='staff_users.php?action=repclear&ID={$r['prID']}'>Clear</a></td> </tr>";
}
print "</table>";
}
function forcelogout()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] > 3)
{
die("403");
}
$_POST['userid'] = abs((int) $_POST['userid']);
if($_POST['userid'])
{
$conn->query("UPDATE users SET force_logout=1 WHERE userid={$_POST['userid']}");
print "<div class='success-msg'>User ID {$_POST['userid']} successfully forced to logout.</div>";
stafflog_add("Forced User ID [{$_POST['userid']}] to logout");
}
else
{
print "<h3>Force User Logout</h3>
<div class='infostaff'>The user will be automatically logged out next time he/she makes a hit to the site.</div>
		<br />
		<br />
<form action='staff_users.php?action=forcelogout' method='post'>
User: ".user_dropdown($c, 'userid')."<br />
<input type='submit' value='Force User to Logout' /></form>";
}
}
function report_clear()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] < 2)
{
die("403");
}
$_GET['ID'] = abs((int) $_GET['ID']);
stafflog_add("Cleared player report ID {$_GET['ID']}");
$conn->query("DELETE FROM preports WHERE prID={$_GET['ID']}");
print "<div class='error-msg'>Report cleared and deleted!</div>";
reports_view();
}
$h->endpage();
?>