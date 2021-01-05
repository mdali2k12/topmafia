<?php
$_GET['viewforum'] = abs(@intval($_GET['viewforum']));
$_GET['viewtopic'] = abs(@intval($_GET['viewtopic']));

class headers {
	function startheaders() {
		$userid=$_SESSION['userid'];
	}

	function userdata($ir,$lv,$fm,$cm,$dosessh=1){
		global $conn,$c,$ir, $set, $userid;
		$enperc=(int) ($ir['energy']/$ir['maxenergy']*100);
		$wiperc=(int) ($ir['will']/$ir['maxwill']*100);
		$experc=(int) ( $ir['exp']/$ir['exp_needed']*100);
		$brperc=(int) ($ir['brave']/$ir['maxbrave']*100);
		$hpperc=(int) ($ir['hp']/$ir['maxhp']*100);
		$enopp=100-$enperc;
		$wiopp=100-$wiperc;
		$exopp=100-$experc;
		$bropp=100-$brperc;
		$hpopp=100-$hpperc;
		$d="";
		$u=$ir['username'];
		if($ir['donatordays']) { 
		$u = "<font color=white>{$ir['username']}</font>";
		$d="<img src='donator.gif' alt='Donator: {$ir['donatordays']} Days Left' title='Donator: {$ir['donatordays']} Days Left' />"; }
		if($ir['vip']) { $u = "<font color=white>{$ir['username']}</font>";$d="<img src='vip.gif' alt='V.I.P.: {$ir['vip']} Days Left' title='V.I.P.: {$ir['vip']} Days Left' />"; }
		if($ir['vip'] && $ir['donatordays']) { $u = "<font color=white>{$ir['username']}</font>";$d="<img src='donator.gif' alt='Donator: {$ir['donatordays']} Days Left' title='Donator: {$ir['donatordays']} Days Left' /> <img src='vip.gif' alt='V.I.P.: {$ir['vip']} Days Left' title='V.I.P.: {$ir['vip']} Days Left' />"; }

		$query=$conn->query("SELECT hospital FROM users WHERE hospital>0") or die(mysqli_error());
		$hc=mysqli_num_rows($query);
		$query =$conn->query("SELECT jail FROM users WHERE jail>0") or die(mysqli_error());
		$jc=mysqli_num_rows($query);
	
		if ($ir['married']>0){
			$marr=$conn->query("SELECT * FROM users WHERE userid={$ir['married']}",$c);
			$ma=$marr->fetch_assoc();
			
			if ($ma['willmax']>$ir['maxwill']){
				$conn->query("UPDATE users SET maxwill={$ma['willmax']} WHERE userid=$userid",$c);
			}
			
			if ($ir['willmax']<$ir['maxwill'] && $ir['maxwill']>$ma['willmax']){
				$conn->query("UPDATE users SET maxwill=willmax WHERE userid=$userid",$c);
			}
		}
		
		if ($ir['maxwill']<$ir['willmax']){
			$conn->query("UPDATE users SET maxwill=willmax WHERE userid=$userid",$c);
		}
		
		if ($ir['married']==0 && $ir['maxwill']>$ir['willmax']){
			$conn->query("UPDATE users SET maxwill=willmax WHERE userid=$userid",$c);
		}
	
		$date = date('F j, Y');
		$hour = date('H');
		$minute = date('i');
		$second = date('s');
		$ampm = date('a');
?>
 <!DOCTYPE html>
    <html>

    <head>
		<meta https-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Control Panel</title>
		 <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="css/mdp.css" media='screen, projection' rel='stylesheet' type='text/css'>
		
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
         <script language="javascript" type="text/javascript">
        function moveTime() {
            var sek = document.getElementById("sekundi")
            var mns = document.getElementById("minuti")
            var hrs = document.getElementById("chas")
            sekVal = Number(sek.innerHTML)
            minVal = Number(mns.innerHTML)
            hourVal = Number(hrs.innerHTML)
            sekVal++;
            if (sekVal > 59) {
                sekVal = 0;
                minVal++;
            }
            sek.innerHTML = (sekVal < 10) ? '0' + (sekVal) : sekVal;
            if (minVal > 59) {
                minVal = 0;
                hourVal++;
            }
            mns.innerHTML = (minVal < 10) ? '0' + (minVal) : minVal;
            if (hourVal > 23) {
                hourVal = 0;
                //hourVal++; 
            }
            hrs.innerHTML = (hourVal < 10) ? '0' + (hourVal) : hourVal;
        }

        function SetInternetTimer() {
            setInterval("moveTime()", 1000);
        }
        onload = SetInternetTimer
    </script>
    
		</head>
		<body>

		<?php
		
        $date = date('F j, Y');
	$hour = date('H');
	$minute = date('i');
	$second = date('s');
	$ampm = date('a');
	
		global $conn,$c,$userid, $set;
		$IP = $_SERVER['REMOTE_ADDR'];
		$conn->query("UPDATE users SET laston=unix_timestamp(),lastip='$IP' WHERE userid=$userid");
		if(!$ir['email']){
			global $domain;
			die ("<body>Your account may be broken. Please mail help@{$domain} stating your username and player ID.");
		}
		$ids_checkpost=urldecode($_SERVER['QUERY_STRING']);
if (preg_match("[\'|'/'\''<'>'*'~'`']", $ids_checkpost) || strstr($ids_checkpost, 'union') || strstr($ids_checkpost, 'java') || strstr($ids_checkpost, 'script') || strstr($ids_checkpost, 'substring(') || strstr($ids_checkpost, 'ord()')){
			$passed=0;
			echo "<center>What are you trying to do? whatever it is stop it!</center>"; // or blank so they not know they failed..
			event_add(2,"<font color=red>".$ir['username']."</font> <b> Tried to use [".$_SERVER['SCRIPT_NAME']."{$ids_checkpost}].. ");
			exit;
		}
	
		$gn="";
		global $staffpage, $conn,$ir,$c,$h,$userid,$set, $_CONFIG;
		print "<!-- Begin Main Content -->";
		$query = $conn->query("SELECT * FROM events WHERE evREAD=0 AND evUSER='$userid'") or die(mysqli_error());
		$ec=mysqli_num_rows($query);
		$query = $conn->query("SELECT * FROM mail WHERE mail_read=0 AND mail_to='$userid'") or die(mysqli_error());
		$mc=mysqli_num_rows($query);
		
			print"
			<br />
			";
		
		
		
		print"<div style='width:100%;'>";
		include "smenu.php";

			print '
			<div class="width" style="text-align:left; border-radius:20px; float:left; padding:20px;">';
				
	echo '	<div style="clear: both;"></div>';
		
		if($ir['fedjail']){
			$menuhide=1;
			$q=$conn->query("SELECT * FROM fedjail WHERE fed_userid=$userid");
			$r=$q->fetch_assoc();
			die("<b><font color=red size=+1>You have been put in the {$set['game_name']} Federal Jail for {$r['fed_days']} day(s).<br /><br/>
			Please contact webmail@topmafia.net<br />
			Reason: {$r['fed_reason']}</font></b></body></html>");
		}
		if(file_exists('ipbans/'.$IP)){
			die("<b><font color=red size=+1>Your IP has been banned from {$set['game_name']}, there is no way around this. To contest this ban, Email webmail@topmafia.net</font></b></body></html>");
		}
		function is_whole_number($var){
			$_GET['ID']=$conn->real_escape_string(abs(@intval($_GET['ID'])));
			  return (is_numeric($var)&&(intval($var)==floatval($var)));
		}
		$array = array_merge($_GET, $_POST);
		while ($post_cap = current($array)) {
		if ($post_cap < 0) {
		   echo "<b>ERROR!</b> you should know that negative integers to cheat the game is not allowed.<br/><br/><a href='index.php'>>Go Home</a>";
		   exit;
		}
		if(strpos($post_cap, '+') && ($_POST[confirmPage] == "")) {
			echo "<b>ERROR!</b> - You may not use the + symbol anywhere on the website for security purposes.";
			exit;
		}
	   next($array);
	}
	
		$array_gete = array($_GET);
		while ($tick = current($array_gete)) {
		   $thekey = key($array_gete);
		   $_GET[$thekey] = str_replace("=", "", htmlspecialchars($_GET[$thekey]));
		   next($array_gete);
		}
		$array_poste = array($_POST);
		
		while ($tick = current($array_poste)) {
		   $thekey = key($array_poste);
		   $_POST[$thekey] = str_replace("=", "", htmlspecialchars($_POST[$thekey]));
		   next($array_poste);
		}
	
	
	}

	function menuarea(){
		global $ir,$c;
		$bgcolor = 'blue';
		
	}

	function smenuarea(){
		global $ir,$c;
		$bgcolor = '#000000';
	
	}

	function endpage(){
		global $conn;
		echo '</div>
		</div>
			<br clear="all" />
		
			</div>
			</body>
			</html>';
	}
}
?>