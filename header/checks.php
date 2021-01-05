<?php
$IP = $_SERVER['REMOTE_ADDR'];
	$conn->query("UPDATE users_data SET laston=unix_timestamp(),lastip='$IP' WHERE userid=$userid");
		$ids_checkpost=urldecode($_SERVER['QUERY_STRING']);
	// imran fixes
	#if(eregi("[\'|'/'\''<'>'*'~'`']",$ids_checkpost) || strstr($ids_checkpost,'union') || strstr($ids_checkpost,'java') || strstr($ids_checkpost,'script') || strstr($ids_checkpost,'substring(') || strstr($ids_checkpost,'ord()')){
	if(preg_match("[\'|'/'\''<'>'*'~'`']",$ids_checkpost) || strstr($ids_checkpost,'union') || strstr($ids_checkpost,'java') || strstr($ids_checkpost,'script') || strstr($ids_checkpost,'substring(') || strstr($ids_checkpost,'ord()')){
		$passed=0;
		echo "<center>What are you trying to do? whatever it is stop it!</center>"; // or blank so they not know they failed..
		event_add(1,"<font color=red>".$ir['username']."</font> <b> Tried to use [".$_SERVER['SCRIPT_NAME']."{$ids_checkpost}].. ");
		exit;
	}
		
	if($ir['fedjail']){
		$menuhide=1;
		$q = $conn->query("SELECT * FROM fedjail WHERE fed_userid=$userid");
		$r = $q->fetch_assoc();
		die("<h2><font color=red><br/><br/><br/>You have been put in the {$set['game_name']} Federal Jail for {$r['fed_days']} day(s). 	Contact webmail@topmafia.net if you have questions<br /> <br />Reason: {$r['fed_reason']}</b></h2></font></div></body></html>");
	}
	if(!$ir['email']){
		global $domain;
		die ("<body>Your account may be broken. Please mail webmail@{$domain} stating your username and player ID.");
	}
		if(file_exists('ipbans/'.$IP)) {
		die("<b><br/><br/><br/>Your IP has been banned from {$set['game_name']}, there is no way around this.<br/>To contest this ban, Email webmail@topmafia.net</b></div></body></html>");
	}
	  	if($ir['new_announcements']){
	  	    
		print "<span class='help'><b>{$ir['new_announcements']}</b> unread game announcements. <a href='announcements.php' class='linkmain' rel='external'>View</a></span>";
	}
	
		if($ir['voting']==0){
	  	    
		print "<span class='help'>You have not voted for Top Mafia today! <a href='voting.php' class='linkmain' rel='external'>Vote</a></span>";
	}
		if($ir['protected']>0){
	  	    
		print "<span class='help'>You are currently under protection for {$ir['protected']} hours from being attacked.</span>";
	}
  	if($ir['new_update']){
	  	    
		print "<span class='help'><b>{$ir['new_update']}</b> unread game updates. <a href='updatefeed.php' class='linkmain' rel='external'>View</a></span>";
	}
		
			  
				if($ir['hospital'] >0) {
		print "<span class='helph'>Notice: You are currently in hospital for {$ir['hospital']} minutes. Use morphine in your <a href='inventory.php' rel='external'>inventory</a> to recover!</span>";
	  }	
	  if($ir['jail'] > 0) {
		print "<span class='helpj'>Notice: You are currently in jail for {$ir['jail']} minutes. Have <a href='yourgang.php' rel='external'>your gang</a> member bust you out!</span>";


	  }
    
	  
	
		if($ir['mlevel'] > 4){
		$conn->query("UPDATE users_data SET merits=merits+1, mlevel=0 WHERE userid={$ir['userid']}");
		event_add($ir['userid'],"You have been credited 1 merit for reaching level {$ir['level']}.",$c);
	}
	
	if($ir['mmarried'] > 19){
		$conn->query("UPDATE users_data SET merits=merits+1, mmarried=0 WHERE userid={$ir['userid']}");
		event_add($ir['userid'],"You have been credited 1 merit for being married for {$ir['mdays']}.",$c);
	}
	
	if($ir['mgang'] > 19){
		$conn->query("UPDATE users_data SET merits=merits+1, mgang=0 WHERE userid={$ir['userid']}");
		event_add($ir['userid'],"You have been credited 1 merit for being in a gang for {$ir['daysingang']} days.",$c);
	}
	
	if($ir['mdaysold'] > 19){
		$conn->query("UPDATE users_data SET merits=merits+1, mdaysold=0 WHERE userid={$ir['userid']}");
		event_add($ir['userid'],"You have been credited 1 merit for being {$ir['daysold']} days old.",$c);
	}

	?>