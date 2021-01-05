<?php
include "sglobals.php";
//This contains item stuffs

$_GET['action'] = $conn->real_escape_string($_GET['action']);
switch($_GET['action'])
{
case 'gamestats': gamestats(); return;
case 'smugglelogs': smugglelogs(); return;
case 'searchusersmuggle': searchusersmuggle(); return;
case 'smugglelogscomp': smugglelogscomp(); return;
case 'botlogs': botlogs(); return;
case 'dlogs': view_donation_logs(); return;
case 'searchform': searchform(); return;
case 'signuplogs': view_register_logs(); return;
case 'activitylogs': view_activity_logs(); return;
case 'searchuserevents': view_userevent_logs(); return;
case 'searchusermail': view_usermail_logs(); return;
case 'atklogs': view_attack_logs(); return;
case 'itmlogs': view_itm_logs(); return;
case 'cashlogs': view_cash_logs(); return;
case 'eventlogs': eventlogs(); return;
case 'creditlogs': view_credit_logs(); return;
case 'cryslogs': view_crys_logs(); return;
case 'banklogs': view_bank_logs(); return;
case 'maillogs': view_mail_logs(); return;
case 'stafflogs': view_staff_logs(); return;
default: print "Error: This script requires an action."; return;
}

function view_donation_logs()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}

$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$rpp=100;
$time = strtotime("-". date("j") ." days");
$qm=$conn->query("SELECT payment FROM donations WHERE timestamp>={$time}");
while($rm=$qm->fetch_assoc())
{
$total+=$rm['payment'];
}
$tm=$conn->query("SELECT payment FROM donations");
while($t=$tm->fetch_assoc())
{
$ttotal+=$t['payment'];
}
$time=time()-86400;
$ttm=$conn->query("SELECT payment FROM donations WHERE timestamp>={$time}");
while($today=$ttm->fetch_assoc())
{
$todaytotal+=$today['payment'];
}
print'<style>
 /*rex is the container of ex,ex2,ex3*/
div.rex{
width:100%;
border:0px;
margin:0 auto;
padding: 0;
vertical-align:top;
}

div.ex{
background-color:green;
display:inline-block;
margin: 0;
padding:10px;
vertical-align:top;
 border-radius:5px; 
 width:30%;
 color:#fff; 
 text-align:left;
 border:1px solid darkgreen;
 font-size:14px;
}

div.ex2{
background-color:#444;
display:inline-block;
margin: 0;
padding:10px;
 border-radius:5px; 
 width:30%;
 color:#DDD; 
 text-align:left;
 border:1px solid #555;
 font-size:14px;
vertical-align:top;
}


div.ex3{
background-color:#555;
display:inline-block;
margin: 0;
padding:10px;
vertical-align:top;
 border-radius:5px; 
 width:30%;
 color:#DDD; 
 text-align:left;
 border:1px solid #666;
 font-size:14px;
}
</style>';





print'
<h3>Donation Logs</h3>
<div class="infostaff">Donation logs display all records of donations/sales made to the game by players.</div>
		<br />
		<br />
<div class="rex">
    <div class="ex"><strong>$'.money_formatter($todaytotal,"").'</strong>
<br /><small> Today\'s Sales </small></div>
    <div class="ex2"> <strong>$'.money_formatter($total,"").'</strong>
<br /><small> Month Sales </small></div>
    <div class="ex3"><strong>$'.money_formatter($ttotal,"").'</strong>
<br /><small> Total Sales </small></div>
</div>
';
$mypage=floor($_GET['st']/$rpp)+1;
$q2=$conn->query("SELECT id FROM donations");
$rs=mysqli_num_rows($q2);
$pages=ceil($rs/$rpp);
echo "<select id='select_page' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$rpp;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page").onchange = function(){
    var select_page = document.getElementById("select_page").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=dlogs&st=" + select_page;
};
</script>

<?php
print "
<table width=100% cellspacing='1' class='table'> \n<tr style='background:gray'> <th>Time</th> <th>User</th> <th>Amount</th> <th>Item</th> <th>Qty</th> </tr>";
$q=$conn->query("SELECT * FROM donations AS s LEFT JOIN users AS u ON s.buyer=u.userid ORDER BY s.id DESC LIMIT {$_GET['st']},$rpp");
while($r=$q->fetch_assoc())
{
print "<tr><td>".date('F j Y g:i:s a', $r['timestamp'])."</td><td><a href='../viewuser.php?u={$r['buyer']}'>{$r['username']}</a> [{$r['buyer']}]</td><td>\${$r['payment']}</td><td>{$r['item']}</td><td>{$r['quantity']}</td></tr>";
}
print "</table><br />
";
stafflog_add("Looked at Donation logs (page $mypage)");
}




function view_attack_logs()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Attack Logs</h3>
<div class='infostaff'>Attack logs display all records of player vs player fights.</div>
		<br />
		<br />";
$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT attacker FROM attacklogs");
$mypage=floor($_GET['st']/$app)+1;
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=atklogs&st=" + select_page1;
};
</script>

<?php
print "<br />
<table width=100% cellspacing=1 class='table'><tr style='background:gray'><th>Time</th><th>Who Attacked</th><th>Who Was Attacked</th><th>Who Won</th><th>What Happened</th></tr>";
$q=$conn->query("SELECT a.*,u1.username as un_attacker, u2.username as un_attacked FROM attacklogs a LEFT JOIN users u1 ON a.attacker=u1.userid LEFT JOIN users u2 ON a.attacked=u2.userid ORDER BY a.time DESC LIMIT {$_GET['st']},$app");
while($r=$q->fetch_assoc())
{
print "<tr><td>".date('F j, Y, g:i:s a',$r['time'])."</td><td>{$r['un_attacker']} [{$r['attacker']}]</td> <td>{$r['un_attacked']} [{$r['attacked']}]</td>";
if($r['result'] == "won") { print "<td>{$r['un_attacker']}</td><td>";
if($r['stole'] == -1) { print "{$r['un_attacker']} hospitalized {$r['un_attacked']}"; } else if ($r['stole'] == -2) { print "{$r['un_attacker']} attacked {$r['un_attacked']} and left them"; } else { print "{$r['un_attacker']} mugged \${$r['stole']} from {$r['un_attacked']}"; } print "</td>"; }  else { print "<td>{$r['un_attacked']}</td><td>Nothing</td>"; }
print "</tr>";
}
print "</table><br />";
stafflog_add("Looked at Attack logs (page $mypage)");
}









function smugglelogscomp()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>[COMPLETED] Drug Smuggle Logs</h3>
<div class='infostaff'>Completed Drug Smuggle logs displays a record of successful smuggles by players into the city. </div>
<br /><center><a href='staff_logs.php?action=smugglelogs'>[VIEW ACTIVE SMUGGLES]</a></center>

		<br />
		<br />";
$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT id, finished FROM smuggle WHERE finished=1");
$mypage=floor($_GET['st']/$app)+1;
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=smugglelogscomp&st=" + select_page1;
};
</script>

<?php
print "<br />
<h3>Completed</h3>
<table width=100% cellspacing=1 class='table'><tr style='background:gray'><th>Smuggler</th><th>Drug</th><th>City</th><th>Reward</th><th>Time</th><th>Result</th></tr>";


$q1=$conn->query("SELECT useridd, drug, skill, ends, finished, reward, city, userid, username FROM smuggle LEFT JOIN users ON useridd=userid WHERE finished=1 ORDER BY ends DESC LIMIT {$_GET['st']},$app");
while($i=$q1->fetch_assoc())
{
print "<tr><td>{$i['username']} [{$i['userid']}]</td> <td>{$i['drug']} </td><td>{$i['city']}</td><td>".money_formatter($i['reward'])."</td><td>".date('F j, Y, g:i:s a',$i['ends'])."</td><td><font color=green><b>Success</font></b></td></tr>";
}
print "</table><br />";
stafflog_add("Looked at Completed Drug Smuggle logs (page $mypage)");
}







function smugglelogs()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Drug Smuggle Logs</h3>
<div class='infostaff'>Drug Smuggle logs display all records of players trying to smuggle drugs into the city.</div>
<br /><center><a href='staff_logs.php?action=smugglelogscomp'>[VIEW COMPLETED SMUGGLES]</a></center>

		<form action='staff_logs.php?action=searchusersmuggle' method='post'>
		Search user smuggle logs: 
		<input type='number' name='userID' placeholder='Enter User ID' />
		<input type='submit' value='Search' />
		</form>
		<br />
		<br />";
$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT id, finished FROM smuggle WHERE finished=0");
$mypage=floor($_GET['st']/$app)+1;
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=smugglelogs&st=" + select_page1;
};
</script>

<?php
print "<br />
<h3>In Progress</h3>
<table width=100% cellspacing=1 class='table'><tr style='background:gray'><th>Smuggler</th><th>Drug</th><th>City</th><th>Reward</th><th>Time</th><th>Minutes Left</th></tr>";


$q=$conn->query("SELECT useridd, drug, skill, ends, finished, reward, city, userid, username FROM smuggle LEFT JOIN users ON useridd=userid WHERE finished=0 ORDER BY ends DESC LIMIT {$_GET['st']},$app");
while($r=$q->fetch_assoc())
{$time=time();
$ends=$r['ends'];
$secondsleft=$ends-$time;
$minutesleft=$secondsleft/60;
$minutes=$minutesleft;
$minutes=round($minutes);
if($minutes<1){$minutes=0;}
print "<tr><td>{$r['username']} [{$r['userid']}]</td> <td>{$r['drug']} </td><td>{$r['city']}</td><td>".money_formatter($r['reward'])."</td><td>".date('F j, Y, g:i:s a',$r['ends'])."</td><td><font color=red>$minutes minutes</font></td></tr>";
}
print "</table><br />";
stafflog_add("Looked at Drug Smuggle logs (page $mypage)");
}





function view_register_logs()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Signup Logs</h3>
<div class='infostaff'>Below is a list of registrations made within the last 7 days.</div>
		<br />
		<br />";
$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;

$q=$conn->query("SELECT `userid`, `signedup` FROM `users` WHERE ( unix_timestamp() - `signedup` ) <= 86400*7 AND `user_level` != 2");
$mypage=floor($_GET['st']/$app)+1;
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>
 
<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=signuplogs&st=" + select_page1;
};
</script>

<?php
print "<br />
<table width=100% cellspacing=1 class='table'><tr style='background:gray'><th>Time</th><th>Name</th><th>Level</th><th>Money</th><th>Crystals</th><th>Bank Money</th><th>Bank Crystals</th><th>VIP Days</th><th>Donated</th><th>Account Type</th></tr>";

$q=$conn->query("SELECT `userid`, `signedup`, `username`, `money`, `level`, `bankmoney`, `crystals`, `bankcrystal` , `donated`, `fbuser`, `vip` FROM `users` WHERE ( unix_timestamp() - `signedup` ) <= 86400*7 AND `user_level` != 2 ORDER BY signedup DESC LIMIT {$_GET['st']},$app");
while($r=$q->fetch_assoc())
{
  	
    if($r['fbuser'] > 0)
    {
        $type="Facebook";
    }
    elseif($r['fbuser']==0)
    {
        $type="Regular";
    }
    
print "<tr><td>".date('F j, Y, g:i:s a',$r['signedup'])."</td><td>{$r['username']} [{$r['userid']}]</td> <td>{$r['level']}</td> <td>".money_formatter($r['money'])."</td><td>".number_format($r['crystals'])."</td><td>".money_formatter($r['bankmoney'])."</td><td>".number_format($r['bankcrystal'])."</td><td>".number_format($r['vip'])."</td><td>".money_formatter($r['donated'])."</td><td><strong>$type</strong></td>";
print "</tr>";
}
print "</table><br />";
stafflog_add("Looked at Registration logs (page $mypage)");
}










function view_activity_logs()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Activity Logs</h3>
<div class='infostaff'>Below is a list of uses activity on the game in last 24 hours.</div>
		<br />
		<br />";
$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;

$q=$conn->query("SELECT u.*,us.* FROM useractivity_logs u LEFT JOIN users us on u.userid=us.userid WHERE u.timeout > 0 ORDER BY u.timein DESC LIMIT {$_GET['st']},$app");
$mypage=floor($_GET['st']/$app)+1;
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=activitylogs&st=" + select_page1;
};
</script>

<?php
print "<br />
<table width=100% cellspacing=1 class='table'><tr style='background:gray'><th>User</th><th>Account Type</th><th>Login Time</th><th>Logout Time</th><th>Duration</th></tr>";

$q=$conn->query("SELECT u.*,us.* FROM useractivity_logs u LEFT JOIN users us on u.userid=us.userid WHERE u.timeout > 0 ORDER BY u.timein DESC LIMIT {$_GET['st']},$app");
while($r=$q->fetch_assoc())
{ 
	$startTimestamp = ($r['timein']);
	$endTimestamp = ($r['timeout']);
	
	$seconds = $endTimestamp - $startTimestamp;
	$minutes = ($seconds / 60) % 60;
	$hours = floor($seconds / (60 * 60));
	
    if($r['fb'] > 0)
    {
        $type="Facebook";
    }
    elseif($r['fb']==0)
    {
        $type="Regular";
    }
  
    
print "<tr><td>{$r['username']} [{$r['userid']}]</td><td><strong>$type</strong></td> <td>".date('F j, Y, g:i:s a',$r['timein'])."</td> <td>".date('F j, Y, g:i:s a',$r['timeout'])."</td><td><b>$hours</b> hours and <b>$minutes</b> minutes.";
print "</tr>";
}
print "</table><br />";
stafflog_add("Looked at Activity logs (page $mypage)");
}














function botlogs()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Challenge Bot Logs</h3>
<div class='infostaff'>Challenge logs display all records of fights between players vs bots.</div>
		<br />
		<br />";
$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT id FROM challengesbeaten");
$mypage=floor($_GET['st']/$app)+1;
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=botlogs&st=" + select_page1;
};
</script>

<?php
print "<br />
<table width=100% cellspacing=1 class='table'><tr style='background:gray'><th>Challenger</th><th>Bot</th><th>Time</th></tr>";

$q=$conn->query("SELECT u.*,us.* FROM challengesbeaten u LEFT JOIN users us on u.userid=us.userid ORDER BY u.time DESC LIMIT {$_GET['st']},$app");
$q1=$conn->query("SELECT u.*,us.* FROM challengesbeaten u LEFT JOIN users us on us.userid=u.npcid WHERE us.userid=u.npcid");
$r1=$q1->fetch_assoc();
while($r=$q->fetch_assoc())
{
print "<tr><td>{$r['username']} [{$r['userid']}]</td> <td>{$r1['username']} [{$r1['userid']}]</td><td>".date('F j, Y, g:i:s a',$r['time'])."</td>";

print "</tr>";
}
print "</table><br />";
stafflog_add("Looked at Challenge Bot logs (page $mypage)");
}

















function eventlogs()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Game Event Logs</h3>
<div class='infostaff'>Event logs display all records of game events.</div>
		<br />
		<br />
		<form action='staff_logs.php?action=searchuserevents' method='post'>
		Search user events: 
		<input type='number' name='userID' placeholder='Enter User ID' />
		<input type='submit' value='Search' />
		</form>";
$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT evID FROM events");
$mypage=floor($_GET['st']/$app)+1;
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=eventlogs&st=" + select_page1;
};
</script>

<?php
print "<br />
<table width=100% cellspacing=1 class='table'><tr style='background:gray'><th>User</th><th>Event</th><th>Time</th></tr>";

$q=$conn->query("SELECT userid, username, evTEXT, evTIME, evUSER FROM events LEFT JOIN users ON evUSER=userid ORDER BY evTIME DESC LIMIT {$_GET['st']},$app");
while($r=$q->fetch_assoc())
{
print "<tr><td>{$r['username']} [{$r['userid']}]</td> <td>{$r['evTEXT']}</td><td>".date('F j, Y, g:i:s a',$r['evTIME'])."</td>";

print "</tr>";
}
print "</table><br />";
stafflog_add("Looked at Game Event logs (page $mypage)");
}



function view_usermail_logs()
{
global $conn,$ir,$c,$h,$userid;
$_POST['userID'] = $conn->real_escape_string($_POST['userID']);
$s=$conn->query("SELECT mail_to FROM mail WHERE mail_to='{$_POST['userID']}'");
  $q1=$conn->query("SELECT userid, username FROM users WHERE userid='{$_POST['userID']}'");
$r1=$q1->fetch_assoc();
if(mysqli_num_rows($s) == 0)
{
    print"<div class='error-msg'>This user has no mails!</div>";
    view_mail_logs();
} 
elseif(empty($_POST['userID']))
{
    print"<div class='error-msg'>No ID detected!</div>";
    view_mail_logs();
}
else {
print "<h3>{$r1['username']} [{$r1['userid']}] Mail Logs</h3>
<div class='infostaff'>You are viewing the selected users mail logs.</div>
		<br />
		<br />
	";
	
$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT mail_id FROM mail WHERE mail_to='{$_POST['userID']}'");
$mypage=floor($_GET['st']/$app)+1;
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=searchusermail&st=" + select_page1;
};
</script>

<?php
print "<br />
<table width=100% cellspacing=1 class='table'><tr style='background:gray'><th>Subj</th><th>Mail</th><th>From</th><th>Time</th></tr>";

$q=$conn->query("SELECT mail_subject, mail_time, mail_from, mail_to, mail_text, userid, username FROM mail LEFT JOIN users ON mail_from=userid WHERE mail_to='{$_POST['userID']}' ORDER BY mail_time DESC LIMIT {$_GET['st']},$app");

while($r=$q->fetch_assoc())
{
print "<tr><td>{$r['mail_subject']} </td><td>{$r['mail_text']}</td><td>{$r['username']} [{$r['userid']}]</td><td>".date('F j, Y, g:i:s a',$r['mail_time'])."</td>";

print "</tr>";
}
print "</table><br />";
stafflog_add("Looked at User Mail logs (page $mypage)");
}
}




function view_userevent_logs()
{
global $conn,$ir,$c,$h,$userid;
$_POST['userID'] = $conn->real_escape_string($_POST['userID']);
$s=$conn->query("SELECT evUSER FROM events WHERE evUSER='{$_POST['userID']}'");
  $q1=$conn->query("SELECT userid, username FROM users WHERE userid='{$_POST['userID']}'");
$r1=$q1->fetch_assoc();
if(mysqli_num_rows($s) == 0)
{
    print"<div class='error-msg'>This user has no events!</div>";
    eventlogs();
}
elseif(empty($_POST['userID']))
{
    print"<div class='error-msg'>No ID detected!</div>";
    eventlogs();
}
else {
print "<h3>{$r1['username']} [{$r1['userid']}] Event Logs</h3>
<div class='infostaff'>You are viewing the selected users event logs.</div>
		<br />
		<br />
	";
	
$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT evID FROM events WHERE evUSER='{$_POST['userID']}'");
$mypage=floor($_GET['st']/$app)+1;
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=searchuserevents&st=" + select_page1;
};
</script>

<?php
print "<br />
<table width=100% cellspacing=1 class='table'><tr style='background:gray'><th>Event</th><th>Time</th></tr>";

$q=$conn->query("SELECT evTEXT, evTIME, evUSER FROM events WHERE evUSER='{$_POST['userID']}' ORDER BY evTIME DESC LIMIT {$_GET['st']},$app");
while($r=$q->fetch_assoc())
{
print "<tr><td>{$r['evTEXT']}</td><td>".date('F j, Y, g:i:s a',$r['evTIME'])."</td>";

print "</tr>";
}
print "</table><br />";
stafflog_add("Looked at User Event logs (page $mypage)");
}
}






function searchusersmuggle()
{
global $conn,$ir,$c,$h,$userid;
$_POST['userID'] = $conn->real_escape_string($_POST['userID']);
$s=$conn->query("SELECT useridd FROM smuggle WHERE useridd='{$_POST['userID']}'");
  $q1=$conn->query("SELECT userid, username FROM users WHERE userid='{$_POST['userID']}'");
$r1=$q1->fetch_assoc();
if(mysqli_num_rows($s) == 0)
{
    print"<div class='error-msg'>This user has no smuggles!</div>";
    smugglelogs();
}
elseif(empty($_POST['userID']))
{
    print"<div class='error-msg'>No ID detected!</div>";
    smugglelogs();
}
else {
print "<h3>{$r1['username']} [{$r1['userid']}] Smuggle Logs</h3>
<div class='infostaff'>You are viewing the selected users smuggle logs.</div>
		<br />
		<br />
	";
	
$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT id, useridd FROM smuggle WHERE useridd='{$_POST['userID']}'");
$mypage=floor($_GET['st']/$app)+1;
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=searchusersmuggle&st=" + select_page1;
};
</script>

<?php
print "<br />
<h3>In Progress</h3>
<table width=100% cellspacing=1 class='table'><tr style='background:gray'><th>Drug</th><th>City</th><th>Reward</th><th>Time</th><th>Minutes Left</th></tr>";


$_POST['userID'] = $conn->real_escape_string($_POST['userID']);
$q=$conn->query("SELECT * FROM smuggle WHERE finished=0 AND useridd='{$_POST['userID']}' ORDER BY ends DESC LIMIT {$_GET['st']},$app");
while($r=$q->fetch_assoc())
{$time=time();
$ends=$r['ends'];
$secondsleft=$ends-$time;
$minutesleft=$secondsleft/60;
$minutes=$minutesleft;
$minutes=round($minutes);
if($minutes<1){$minutes=0;}
print "<tr><td>{$r['drug']} </td><td>{$r['city']}</td><td>".money_formatter($r['reward'])."</td><td>".date('F j, Y, g:i:s a',$r['ends'])."</td><td><font color=red>$minutes minutes</font></td></tr>";
}
print "</table><br />";

$q11=$conn->query("SELECT useridd, 
    sum( reward ) soldcount FROM smuggle WHERE finished=1 AND useridd='{$_POST['userID']}'");
$r11=$q11->fetch_assoc();
print "<br />
<h3>Completed</h3>
<b>Total Smuggle Value:</b> ".money_formatter($r11['soldcount'])." <br />
<table width=100% cellspacing=1 class='table'><tr style='background:gray'><th>Drug</th><th>City</th><th>Reward</th><th>Time</th><th>Result</th></tr>";


$_POST['userID'] = $conn->real_escape_string($_POST['userID']);
$q=$conn->query("SELECT * FROM smuggle WHERE finished=1 AND useridd='{$_POST['userID']}' ORDER BY ends DESC LIMIT {$_GET['st']},$app");
while($r=$q->fetch_assoc())
{$time=time();
$ends=$r['ends'];
$secondsleft=$ends-$time;
$minutesleft=$secondsleft/60;
$minutes=$minutesleft;
$minutes=round($minutes);
if($minutes<1){$minutes=0;}
print "<tr><td>{$r['drug']} </td><td>{$r['city']}</td><td>".money_formatter($r['reward'])."</td><td>".date('F j, Y, g:i:s a',$r['ends'])."</td><td><font color=green><b>Success</b></font></td></tr>";
}
print "</table><br />";
stafflog_add("Looked at User Smuggle logs (page $mypage)");
}
}











function view_itm_logs()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Item Xfer Logs</h3>
<div class='infostaff'>Item xfer logs display all records of item transfers made in the game by players.</div>
		<br />
		<br />";

$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT ixFROM FROM itemxferlogs");
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);

$mypage=floor($_GET['st']/$app)+1;

echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=itmlogs&st=" + select_page1;
};
</script>
<?php

print "<br />
<table width='100%' cellspacing=1 class='table'><tr style='background:gray'><th>Time</th><th>Who Sent</th> <th>Who Received</th> <th>Sender's IP</th> <th>Receiver's IP</th> <th>Same IP?</th> <th>Item</th> </tr>";
$q=$conn->query("SELECT ix.*,u1.username as sender, u2.username as sent,i.itmname as item FROM itemxferlogs ix LEFT JOIN users u1 ON ix.ixFROM=u1.userid LEFT JOIN users u2 ON ix.ixTO=u2.userid LEFT JOIN items i ON i.itmid=ix.ixITEM ORDER BY ix.ixTIME DESC LIMIT {$_GET['st']},$app");
while($r=$q->fetch_assoc())
{
if($r['ixFROMIP'] == $r['ixTOIP']) { $same="<font color='red'>YES</font>"; } else { $same="<font color='green'>NO</font>"; }
print "<tr><td>".date('F j Y, g:i:s a', $r['ixTIME'])."</td> <td>{$r['sender']} [{$r['ixFROM']}]</td> <td>{$r['sent']} [{$r['ixTO']}]</td> <td>{$r['ixFROMIP']}</td> <td>{$r['ixTOIP']}</td> <td>$same</td> <td>{$r['item']} x{$r['ixQTY']}</td></tr>";
}
print "</table><br />";

stafflog_add("Looked at Item Xfer Logs (page $mypage)");
}











function gamestats()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] !=2)
{
die("403");
}


$qmail=$conn->query("SELECT mail_id FROM mail");
$mail=mysqli_num_rows($qmail);
$qevents=$conn->query("SELECT evID FROM events");
$events=mysqli_num_rows($qevents);

$gn1=$conn->query("SELECT crimeID FROM crimes");
$crimescount=mysqli_num_rows($gn1);

$gn2=$conn->query("SELECT crID FROM courses");
$coursescount=mysqli_num_rows($gn2);

$gn3=$conn->query("SELECT cityid FROM cities");
$citycount=mysqli_num_rows($gn3);

$gn4=$conn->query("SELECT jID FROM jobs");
$jobcount=mysqli_num_rows($gn4);

$gn5=$conn->query("SELECT userid, user_level FROM users WHERE user_level=0");
$botcount=mysqli_num_rows($gn5);

$gn6=$conn->query("SELECT shopID FROM shops");
$shopcount=mysqli_num_rows($gn6);

$gn7=$conn->query("SELECT hID FROM houses");
$housescount=mysqli_num_rows($gn7);

$gn8=$conn->query("SELECT sitemID FROM shopitems");
$shopitemcount=mysqli_num_rows($gn8);

$gn9=$conn->query("SELECT ff_id FROM forum_forums");
$forumcount=mysqli_num_rows($gn9);

$gn10=$conn->query("SELECT fp_id FROM forum_posts");
$forumpostcount=mysqli_num_rows($gn10);


$gn11=$conn->query("SELECT busId FROM businesses");
$businesscount=mysqli_num_rows($gn11);

$gn12=$conn->query("SELECT bmembId FROM businesses_members");
$businessmembs=mysqli_num_rows($gn12);






$gn=$conn->query("SELECT gangID FROM gangs");
$gangcount=mysqli_num_rows($gn);

$gun=$conn->query("SELECT userid FROM users WHERE gang > 0 AND user_level != 2");
$gangmembs=mysqli_num_rows($gun);

$dn=$conn->query("SELECT userid FROM users WHERE donated > 0 AND user_level != 2");
$donators=mysqli_num_rows($dn);

$ndn=$conn->query("SELECT userid FROM users WHERE donated ='0' AND user_level != 2");
$nondonators=mysqli_num_rows($ndn);



$itm=$conn->query("SELECT itmid FROM items");
$itemcount=mysqli_num_rows($itm);

$invlist=$conn->query("select count(distinct inv_userid) total_players, sum(inv_qty * items.itmsellprice) sell_value from inventory, items where items.itmid = inventory.inv_itemid");
$rt=$invlist->fetch_assoc();


$totali=0;
$inq=$conn->query("SELECT inv_qty FROM inventory");
while($rinv=$inq->fetch_assoc())
{
$totali+=$rinv['inv_qty'];
}
$avginv=(int) ($totali/$rt['total_players']);

$querydon=$conn->query("SELECT userid,username, donated FROM users WHERE user_level != 2 ORDER by donated DESC");
$don=$querydon->fetch_assoc();

$q=$conn->query("SELECT userid FROM users WHERE user_level != 2");
$membs=mysqli_num_rows($q);
$q1=$conn->query("SELECT userid FROM users WHERE gender='Male' AND user_level != 2");
$male=mysqli_num_rows($q1);
$q2=$conn->query("SELECT userid FROM users WHERE gender='Female' AND user_level != 2");
$female=mysqli_num_rows($q2);
$q3=$conn->query("SELECT userid FROM users WHERE verified='1' AND user_level != 2");
$verified=mysqli_num_rows($q3);
$q4=$conn->query("SELECT userid FROM users WHERE verified='0' AND user_level != 2");
$unverified=mysqli_num_rows($q4);
$q5=$conn->query("SELECT userid FROM users WHERE maxed='1' AND user_level != 2");
$maxed=mysqli_num_rows($q5);

  $y = $conn->query("SELECT COUNT(`userid`) AS `inactive` FROM `users` WHERE ( unix_timestamp() - `laston` ) >= 86400*30 AND `user_level` != 2");
    $x = mysqli_fetch_array($y);
    $y1 = $conn->query("SELECT COUNT(`userid`) AS `active` FROM `users` WHERE ( unix_timestamp() - `laston` ) <= 86400*7 AND `user_level` != 2");
    $x1 = mysqli_fetch_array($y1);
     $y2 = $conn->query("SELECT COUNT(`userid`) AS `day` FROM `users` WHERE ( unix_timestamp() - `signedup` ) <= 86400 AND `user_level` != 2");
    $x2 = mysqli_fetch_array($y2);  
         $y3 = $conn->query("SELECT COUNT(`userid`) AS `week` FROM `users` WHERE ( unix_timestamp() - `signedup` ) <= 86400*7 AND `user_level` != 2");
    $x3 = mysqli_fetch_array($y3);  
    
$totalbiz=0;
$biz=$conn->query("SELECT busCash FROM businesses");
while($mbizz=$biz->fetch_assoc())
{
$totalbiz+=$mbizz['busCash'];
}

$total=0;
$m=$conn->query("SELECT money FROM users WHERE user_level != 2");
while($m1=$m->fetch_assoc())
{
$total+=$m1['money'];
}
$avg=(int) ($total/$membs);


$query=$conn->query("SELECT userid FROM users WHERE bankmoney>0 AND user_level != 2");
$banks=mysqli_num_rows($query);

$query2=$conn->query("SELECT userid FROM users WHERE bankcrystal>0 AND user_level != 2");
$crystalbanks=mysqli_num_rows($query2);



$totalb=0;
$b=$conn->query("SELECT bankmoney FROM users WHERE user_level != 2");
while($b1=$b->fetch_assoc())
{
$totalb+=$b1['bankmoney'];
}
$avgb=(int) ($totalb/$banks);

$totalcash = $total+$totalb;

$totalc=0;
$c=$conn->query("SELECT crystals FROM users WHERE user_level != 2");
while($c1=$c->fetch_assoc())
{
$totalc+=$c1['crystals'];
}
$avgc=(int) ($totalc/$membs);

$totalgm=0;
$gm=$conn->query("SELECT gangid, gangMONEY FROM gangs");
while($gangm=$gm->fetch_assoc())
{
$totalgm+=$gangm['gangMONEY'];
}
$totalgcm=0;
$gcm=$conn->query("SELECT gangid, gangCRYSTALS FROM gangs");
while($gangcm=$gcm->fetch_assoc())
{
$totalgcm+=$gangcm['gangCRYSTALS'];
}

$totalcb=0;
$cb=$conn->query("SELECT bankcrystal FROM users WHERE user_level != 2");
while($cb1=$cb->fetch_assoc())
{
$totalcb+=$cb1['bankcrystal'];
}
$avgcb=(int) ($totalcb/$crystalbanks);

$totalcrystal = $totalc+$totalcb;
    
    
    
    $time = strtotime("-". date("j") ." days");
$qm=$conn->query("SELECT payment FROM donations WHERE timestamp>={$time}");
while($rm=$qm->fetch_assoc())
{
$totalmonthly+=$rm['payment'];
}
$tm=$conn->query("SELECT payment FROM donations");
while($t=$tm->fetch_assoc())
{
$totalsales+=$t['payment'];
}
$avgdonators=(int) ($totalmonthly/$donators);

$time=time()-86400;
$ttm=$conn->query("SELECT payment FROM donations WHERE timestamp>={$time}");
while($today=$ttm->fetch_assoc())
{
$todaytotal+=$today['payment'];
}

$totaleconomy = $totalcash + $rt['sell_value'] + $totalbiz + $totalgm;
$totalcrystaleco = $totalcrystal + $totalgcm;
    print"
      <h3>Game Statistics</h3>
      <div class='infostaff'>Game statistics is a full record of the game's database information.</div>
		<br />
		<br />
      Cash in Economy: ".money_formatter($totaleconomy)."<br />
      Crystals in Economy: ".number_format($totalcrystaleco)."<br /><br />
<table class='table' width='95%'>

<tr>
<td width='50%'><b>Male Players:</b> ".number_format($male)."</td>
<td width='50%'><b>Female Players:</b> ".number_format($female)."</td>
</tr>
<tr>
<td width='50%'><b>Active Accounts:</b> ".number_format($x1['active'])."</td>
<td width='50%'><b>Dead Accounts:</b> ".number_format($x['inactive'])."</td>
</tr>
<tr>
<td width='50%'><b>Verified Accounts:</b> ".number_format($verified)."</td>
<td width='50%'><b>Unverified Accounts:</b> ".number_format($unverified)."</td>
</tr>
<tr>
<td width='50%'><b>Signups In Day:</b> ".number_format($x2['day'])."</td>
<td width='50%'><b>Signups In Week:</b> ".number_format($x3['week'])."</td>
</tr>
<tr>
<td colspan='2' style='background-color:cyan;'><b>Maxed Accounts:</b> ".number_format($maxed)."</td>
</tr>
<tr>
<td colspan='2' style='background-color:cyan;'><b>Total Accounts:</b> ".number_format($membs)."</td>
</tr>
</table>
<br />
<table class='table' width='95%'>
<tr>
<td width='50%'><b>Donators:</b> ".number_format($donators)."</td>
<td width='50%'><b>Non Donators:</b> ".number_format($nondonators)."</td>
</tr>
<tr>
<td width='50%'><b>Top Donator:</b> <font color=red>{$don['username']} [{$don['userid']}]</font></td>
<td width='50%'><b>Amount Donated:</b> <font color=green>".money_formatter($don['donated'])."</font></td>
</tr>
<tr>
<td width='50%'><b>Donation In Today:</b> ".money_formatter($todaytotal)."</td>
<td width='50%'><b>Donation In Month:</b> ".money_formatter($totalmonthly)."</td>
</tr>
<tr>
<td style='background-color:cyan;' colspan='2'><b>Average Monthly Donation:</b> ".money_formatter($avgdonators)."</td>
</tr>
<tr>
<td colspan='2' style='background-color:cyan;'><b>Total Donations:</b> ".money_formatter($totalsales)."</td>
</tr>
</table>
<br />
<table class='table' width='95%'>
<tr>
<td width='50%'><b>Cash In Hand:</b> ".money_formatter($total)."</td>
<td width='50%'><b>Cash In Bank:</b> ".money_formatter($totalb)."</td>
</tr>
<tr>
<td width='50%'><b>Avg Cash In Hand:</b> ".money_formatter($avg)."</td>
<td width='50%'><b>Avg Cash In Bank:</b> ".money_formatter($avgb)."</td>
</tr>
<tr>
<td width='50%'><b>Crystal In Hand:</b> ".number_format($totalc)."</td>
<td width='50%'><b>Crystal In Bank:</b> ".number_format($totalcb)."</td>
</tr>

<tr>
<td width='50%'><b>Avg Crystal In Hand:</b> ".number_format($avgc)."</td>
<td width='50%'><b>Avg Crystal In Bank:</b> ".number_format($avgcb)."</td>
</tr>
<tr>
<td width='50%'><b>Banks Accounts:</b> ".number_format($banks)."</td>
<td width='50%'><b>Crystal Bank Accounts:</b> ".number_format($crystalbanks)."</td>
</tr>
<tr>
<td colspan='2' style='background-color:cyan;'><b>Total Cash (inc Bank):</b> ".money_formatter($totalcash)."</td>
</tr>
<tr>
<td style='background-color:cyan;' colspan='2'><b>Total Crystals (inc Bank):</b> ".number_format($totalcrystal)."</td>
</tr>
</table>
<br />
<table class='table' width='95%'>
<tr>
<td width='50%'><b>Items In Game:</b> ".number_format($itemcount)."</td>
<td width='50%'><b>Items In Circulation:</b> ".number_format($totali)."</td>
</tr>
<tr>
<td width='50%'><b>Players With Items:</b> ".number_format($rt['total_players'])."</td>
<td width='50%'><b>Average Inventory Items:</b> ".number_format($avginv)."</td>
</tr>
<tr>
<td style='background-color:cyan;' colspan='2'><b>Inventory Value:</b> ".money_formatter($rt['sell_value'])."</td>
</tr>
</table>
<br />
<table class='table' width='95%'>
<tr>
<td width='50%'><b>Gangs In Game:</b>  ".number_format($gangcount)."</td>
<td width='50%'><b>Gangs Members:</b>  ".number_format($gangmembs)."</td>
</tr>
<tr>
<td width='50%' style='background-color:cyan;' colspan='2'><b>Cash In Vault:</b> ".money_formatter($totalgm)."</td>
</tr>
<tr>
<td width='50%' style='background-color:cyan;' colspan='2'><b>Crystal In Vault:</b>  ".number_format($totalgcm)."</td>
</tr>
</table>
<br />
<table class='table' width='95%'>
<tr>
<td width='50%'><b>Business In Game:</b>  ".number_format($businesscount)."</td>
<td width='50%'><b>Business Members:</b>  ".number_format($businessmembs)."</td>
</tr>
<tr>
<td width='50%' style='background-color:cyan;' colspan='2'><b>Cash In Business:</b> ".money_formatter($totalbiz)."</td>
</tr>
</table>
<br />
<table class='table' width='95%'>
<tr>
<td width='50%'><b>Crimes In Game:</b> ".number_format($crimescount)."</td>
<td width='50%'><b>Jobs In Game:</b> ".number_format($jobcount)."</td>
</tr>
<tr>
<td width='50%'><b>Courses In Game:</b> ".number_format($coursescount)."</td>
<td width='50%'><b>Bots In Game:</b> ".number_format($botcount)."</td>
</tr>
<tr>
<td width='50%'><b>Cities In Game:</b> ".number_format($citycount)."</td>
<td width='50%'><b>Houses In Game:</b> ".number_format($housescount)."</td>
</tr>
<tr>
<td width='50%'><b>Shops In Game:</b> ".number_format($shopcount)."</td>
<td width='50%'><b>Shop Items In Game:</b> ".number_format($shopitemcount)."</td>
</tr>
<tr>
<td width='50%'><b>Forums In Game:</b> ".number_format($forumcount)."</td>
<td width='50%'><b>Forum Posts In Game:</b> ".number_format($forumpostcount)."</td>
</tr>
<tr>
<td width='50%'><b>Game Mail:</b> ".number_format($mail)."</td>
<td width='50%'><b>Game Events:</b> ".number_format($events)."</td>
</tr>
</table>
";
stafflog_add("Looked at Game Statistics");
}
















function view_cash_logs()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Cash Xfer Logs</h3>
<div class='infostaff'>Cash xfer logs display all records of cash transfers between players.</div>
		<br />
		<br />";

$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT cxFROM FROM cashxferlogs");
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
$mypage=floor($_GET['st']/$app)+1;
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=cashlogss&st=" + select_page1;
};
</script>
<?php

print"
<table width=100% cellspacing='1' class='table'> <tr style='background:gray'> <th>Time</th> <th>User From</th> <th>User To</th> <th>Multi?</th> <th>Amount</th> <th>&nbsp;</th> </tr>";
$q=$conn->query("SELECT cx.*,u1.username as sender, u2.username as sent FROM cashxferlogs cx LEFT JOIN users u1 ON cx.cxFROM=u1.userid LEFT JOIN users u2 ON cx.cxTO=u2.userid ORDER BY cx.cxTIME DESC LIMIT {$_GET['st']},$app");
while($r=$q->fetch_assoc())
{
if($r['cxFROMIP'] == $r['cxTOIP']) { $m="<span style='color:red;font-weight:800'>MULTI</span>"; } else { $m=""; }
print "<tr> <td>" . date("F j, Y, g:i:s a",$r['cxTIME']) . "</td><td><a href='viewuser.php?u={$r['cxFROM']}'>{$r['sender']}</a> [{$r['cxFROM']}] (IP: {$r['cxFROMIP']}) </td><td><a href='viewuser.php?u={$r['cxTO']}'>{$r['sent']}</a> [{$r['cxTO']}] (IP: {$r['cxTOIP']}) </td> <td>$m</td> <td> $".cash_format($r['cxAMOUNT'])."</td> <td> [<a href='staff_punit.php?action=fedform&XID={$r['cxFROM']}'>Jail Sender</a>] [<a href='staff_punit.php?action=fedform&XID={$r['cxTO']}'>Jail Receiver</a>]</td> </tr>";
}
print "</table>";
stafflog_add("Looked at Cash Xfer Logs (page $mypage)");
}

function view_credit_logs()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] !=2)
{
die("403");
}
print "<h3>Credit Xfer Logs</h3>
<div class='infostaff'>Credit xfer logs display all records of credit transfers between players.</div>
		<br />
		<br />";

$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT cxFROM FROM creditxferlogs");
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
$mypage=floor($_GET['st']/$app)+1;
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=creditlogs&st=" + select_page1;
};
</script>
<?php

print"
<table width=100% cellspacing='1' class='table'> <tr style='background:gray'>  <th>Time</th> <th>User From</th> <th>User To</th> <th>Multi?</th> <th>Amount</th> <th>&nbsp;</th> </tr>";
$q=$conn->query("SELECT cx.*,u1.username as sender, u2.username as sent FROM creditxferlogs cx LEFT JOIN users u1 ON cx.cxFROM=u1.userid LEFT JOIN users u2 ON cx.cxTO=u2.userid ORDER BY cx.cxTIME DESC LIMIT {$_GET['st']}, $app");
while($r=$q->fetch_assoc())
{
if($r['cxFROMIP'] == $r['cxTOIP']) { $m="<span style='color:red;font-weight:800'>MULTI</span>"; } else { $m=""; }
print "<tr> <td>" . date("F j, Y, g:i:s a",$r['cxTIME']) . "</td><td><a href='viewuser.php?u={$r['cxFROM']}'>{$r['sender']}</a> [{$r['cxFROM']}] (IP: {$r['cxFROMIP']}) </td><td><a href='viewuser.php?u={$r['cxTO']}'>{$r['sent']}</a> [{$r['cxTO']}] (IP: {$r['cxTOIP']}) </td> <td>$m</td> <td> ".cash_format($r['cxAMOUNT'])."</td> <td> [<a href='staff_punit.php?action=fedform&XID={$r['cxFROM']}'>Jail Sender</a>] [<a href='staff_punit.php?action=fedform&XID={$r['cxTO']}'>Jail Receiver</a>]</td> </tr>";
}
print "</table>";
stafflog_add("Looked at Credit Xfer Logs (page $mypage)");
}


function view_bank_logs()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Bank Xfer Logs</h3>
<div class='infostaff'>Bank xfer logs display all records of bank transfers between players.</div>
		<br />
		<br />";

$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT cxFROM FROM bankxferlogs");
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
$mypage=floor($_GET['st']/$app)+1;
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=banklogs&st=" + select_page1;
};
</script>
<?php

print"
<table width=100% cellspacing='1' class='table'> <tr style='background:gray'>  <th>Time</th> <th>User From</th> <th>User To</th> <th>Multi?</th> <th>Amount</th> <th>Bank Type</th> <th>&nbsp;</th> </tr>";
$q=$conn->query("SELECT cx.*,u1.username as sender, u2.username as sent FROM bankxferlogs cx LEFT JOIN users u1 ON cx.cxFROM=u1.userid LEFT JOIN users u2 ON cx.cxTO=u2.userid ORDER BY cx.cxTIME DESC LIMIT {$_GET['st']},$app");
$banks=array(
'bank' => 'City Bank',
'cyber' => 'Cyber Bank');
while($r=$q->fetch_assoc())
{
$mb=$banks[$r['cxBANK']];
if($r['cxFROMIP'] == $r['cxTOIP']) { $m="<span style='color:red;font-weight:800'>MULTI</span>"; } else { $m=""; }
print "<tr> <td>" . date("F j, Y, g:i:s a",$r['cxTIME']) . "</td><td><a href='viewuser.php?u={$r['cxFROM']}'>{$r['sender']}</a> [{$r['cxFROM']}] (IP: {$r['cxFROMIP']}) </td><td><a href='viewuser.php?u={$r['cxTO']}'>{$r['sent']}</a> [{$r['cxTO']}] (IP: {$r['cxTOIP']}) </td> <td>$m</td> <td> $".cash_format($r['cxAMOUNT'])."</td> <td>$mb</td> <td> [<a href='staff_punit.php?action=fedform&XID={$r['cxFROM']}'>Jail Sender</a>] [<a href='staff_punit.php?action=fedform&XID={$r['cxTO']}'>Jail Receiver</a>]</td> </tr>";
}
print "</table>";
stafflog_add("Looked at Bank Xfer Logs (page $mypage)");
}
function view_crys_logs()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Crystal Xfer Logs</h3>
<div class='infostaff'>Crystal xfer logs display all records of crystal transfers between players.</div>
		<br />
		<br />";

$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT cxFROM FROM crystalxferlogs");
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
$mypage=floor($_GET['st']/$app)+1;
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=crystallogs&st=" + select_page1;
};
</script>
<?php

print"
<table width=100% cellspacing='1' class='table'> <tr style='background:gray'> <th>Time</th> <th>User From</th> <th>User To</th> <th>Multi?</th> <th>Amount</th> <th>&nbsp;</th> </tr>";
$q=$conn->query("SELECT cx.*,u1.username as sender, u2.username as sent FROM crystalxferlogs cx LEFT JOIN users u1 ON cx.cxFROM=u1.userid LEFT JOIN users u2 ON cx.cxTO=u2.userid ORDER BY cx.cxTIME DESC LIMIT {$_GET['st']},$app");
while($r=$q->fetch_assoc())
{
if($r['cxFROMIP'] == $r['cxTOIP']) { $m="<span style='color:red;font-weight:800'>MULTI</span>"; } else { $m=""; }
print "<tr><td>" . date("F j, Y, g:i:s a",$r['cxTIME']) . "</td><td><a href='viewuser.php?u={$r['cxFROM']}'>{$r['sender']}</a> [{$r['cxFROM']}] (IP: {$r['cxFROMIP']}) </td><td><a href='viewuser.php?u={$r['cxTO']}'>{$r['sent']}</a> [{$r['cxTO']}] (IP: {$r['cxTOIP']}) </td> <td>$m</td> <td> ".cash_format($r['cxAMOUNT'])."</td> <td> [<a href='staff_punit.php?action=fedform&XID={$r['cxFROM']}'>Jail Sender</a>] [<a href='staff_punit.php?action=fedform&XID={$r['cxTO']}'>Jail Receiver</a>]</td> </tr>";
}
print "</table>";
stafflog_add("Looked at Crystal Xfer Logs (page $mypage)");
}
function view_mail_logs()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Mail Logs</h3>
<div class='infostaff'>Mail logs display all records of conversations between players.</div>
		<br />
		<br />
		<form action='staff_logs.php?action=searchusermail' method='post'>
		Search user mails: 
		<input type='number' name='userID' placeholder='Enter User ID' />
		<input type='submit' value='Search' />
		</form>";

$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
$app=100;
$q=$conn->query("SELECT mail_id FROM mail WHERE mail_from != 0");
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
$mypage=floor($_GET['st']/$app)+1;
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=maillogs&st=" + select_page1;
};
</script>
<?php

print"
<table width=100% cellspacing='1' class='table'> \n<tr style='background:gray'> <th>Time</th> <th>User From</th> <th>User To</th> <th width>Subj</th> <th width=30%>Msg</th> <th>&nbsp;</th> </tr>";
$q1=$conn->query("SELECT m.*,u1.username as sender, u2.username as sent FROM mail m LEFT JOIN users u1 ON m.mail_from=u1.userid LEFT JOIN users u2 ON m.mail_to=u2.userid WHERE m.mail_from != 0 ORDER BY m.mail_time DESC LIMIT {$_GET['st']},$app");
while($r=$q1->fetch_assoc())
{
print "\n<tr><td>" . date("F j, Y, g:i:s a",$r['mail_time']) . "</td><td>{$r['sender']} [{$r['mail_from']}] </td> <td>{$r['sent']} [{$r['mail_to']}] </td> \n<td> {$r['mail_subject']}</td> \n<td>{$r['mail_text']}</td> <td> [<a href='staff_punit.php?action=mailform&XID={$r['mail_from']}'>MailBan Sender</a>] [<a href='staff_punit.php?action=mailform&XID={$r['mail_to']}'>MailBan Receiver</a>]</td> </tr>";
}
print "</table><br />
";

stafflog_add("Looked at Mail Logs (Page $mypage)");
}

function view_staff_logs()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] < 2)
{
die("403");
}
$_GET['st'] = $conn->real_escape_string($_GET['st']);
if(!$_GET['st']) { $_GET['st']=0; }
$st=abs((int) $_GET['st']);
print "<h3>Staff Logs</h3>
<div class='infostaff'>Staff logs display all records of actions carried out by staff players.</div>
		<br />
		<br />";
$app=100;
$q=$conn->query("SELECT id FROM stafflog");
$attacks=mysqli_num_rows($q);
$pages=ceil($attacks/$app);
$mypage=floor($_GET['st']/$app)+1;
echo "<select id='select_page1' style='float:right;'>";
for($i=1; $i<=$pages; $i++)
{
  $st=($i-1)*$app;
  if($_GET['st'] == $st)
  
    echo "<option value=".$st." selected>Page ".$i."</option>&nbsp;";
  else
    echo "<option value=".$st.">Page ".$i."</option>&nbsp;";
}
echo '</select>';
?>

<script>
document.getElementById("select_page1").onchange = function(){
    var select_page1 = document.getElementById("select_page1").value;
    window.location.href = "https://topmafia.net/staffpanel/staff_logs.php?action=stafflogs&st=" + select_page1;
};
</script>
<?php

print"
<table width=100% cellspacing='1' class='table'> \n<tr style='background:gray'> <th>Staff</th> <th>Action</th> <th>Time</th> <th>IP</th> </tr>";
$q1=$conn->query("SELECT s.*, u.* FROM stafflog AS s LEFT JOIN users AS u ON s.user=u.userid ORDER BY s.time DESC LIMIT {$_GET['st']},$app");
while($r=$q1->fetch_assoc())
{
print "<tr><td>{$r['username']} [{$r['user']}]</td> <td>{$r['action']}</td> <td>".date('F j Y g:i:s a', $r['time'])."</td> <td>{$r['ip']}</td></tr>";
}
print "</table><br />
";
}
function report_clear()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] > 3)
{
die("403");
}
$_GET['ID'] = abs((int) $_GET['ID']);
stafflog_add("Cleared player report ID {$_GET['ID']}");
$conn->query("DELETE FROM preports WHERE prID={$_GET['ID']}");
print "<div class='success-msg'>Report cleared and deleted!</div>";
}
$h->endpage();
?>