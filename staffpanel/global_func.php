<?php

function my_Sql_regcase($str){

    $res = "";

    $chars = str_split($str);
    foreach($chars as $char){
        if(preg_match("/[A-Za-z]/", $char))
            $res .= "[".mb_strtoupper($char, 'UTF-8').mb_strtolower($char, 'UTF-8')."]";
        else
            $res .= $char;
    }

    return $res;
}

if(!function_exists('is_sale_percentage_off')){
	function is_sale_percentage_off(){
		global $set;
		if(!empty($set['sale_off_dates'])){
			$sale_off_dates = implode(',', unserialize($set['sale_off_dates']));
			if(!empty($sale_off_dates)){
				$dates = explode(',',$sale_off_dates);
				$today = date('m/d/Y');
				foreach($dates as $date){
					if($today == trim($date)){
						return true;
					}
				}
			}
			return false;
		}else{
			return false;
		}
	}
}

function getheist($id) 
{
	global $conn;
	$res = $conn->query("SELECT `hname` FROM `heists` WHERE `hid` = '".$id."'");
	$row = $res->fetch_assoc();
	return htmlentities($row['hname']);
}
function getuser($id)
{
	global $conn;
	$res = $conn->query("SELECT `username` FROM `users` WHERE `userid` = '".$id."'");
	$row = $res->fetch_assoc();
	return "<a href='viewuser.php?u={$id}'><span style='color:red'>".htmlentities($row['username'])."</span></a>";
}
function heist_dropdown($connection, $ddname = "heists", $selected = -1)
{
    global $conn;
    $ret = "<select name='$ddname' type='dropdown'>";
    $q =
            $conn->query(
                    "SELECT `hid`, `hname`
    				 FROM `heists`
    				 ORDER BY `hid` ASC");
    if ($selected == -1)
    {
        $first = 0;
    }
    else
    {
        $first = 1;
    }
    while ($r = $q->fetch_assoc())
    {
        $ret .= "\n<option value='{$r['hid']}'";
        if ($selected == $r['hid'] || $first == 0)
        {
            $ret .= " selected='selected'";
            $first = 1;
        }
        $ret .= ">{$r['hname']}</option>";
    }
    $conn->free_result($q);
    $ret .= "\n</select>";
    return $ret;
}




  function stat_format($stat_format) {
        // first strip any formatting;
        $stat_format = (0+str_replace(",","",$stat_format));
        
        // is this a number?
        if(!is_numeric($stat_format)) return false;
        
        // now filter it;
        if($stat_format>1000000000000) return round(($stat_format/1000000000000),1).'T';
        else if($stat_format>1000000000) return round(($stat_format/1000000000),1).'B';
        else if($stat_format>1000000) return round(($stat_format/1000000),1).'M';
        else if($stat_format>1000) return round(($stat_format/1000),1).'K';
       
        
        return number_format($stat_format);
    }

    
    
    
  function cash_format($cash_format) {
        // first strip any formatting;
        $cash_format = (0+str_replace(",","",$cash_format));
        
        // is this a number?
        if(!is_numeric($cash_format)) return false;
        
        // now filter it;
        if($cash_format>1000000000000) return round(($cash_format/1000000000000),1).'T';
        else if($cash_format>1000000000) return round(($cash_format/1000000000),1).'B';
        else if($cash_format>1000000) return round(($cash_format/1000000),1).'M';  else if($cash_format>1000) return round(($cash_format/1000),1).'K';
       
        
        return number_format($cash_format);
    }



if(!function_exists('calculate_sale_percentage_off')){
	function calculate_sale_percentage_off(){
		global $set;
		if(isset($set['percent_off_sale'])){
			return (1 - ($set['percent_off_sale'] / 100));
		}else{
			return 0;
		}
	}
}

if(!function_exists('sms_send')){
	function sms_send($message,$user){
	global $ir,$c,$userid;
	$gamename="Mafia Reborn";
	//Do not include www. or http:// in the game url
	$gameurl="MafiaReborn.com";
	$blah=$conn->query("SELECT * FROM users WHERE userid=$user",$c);
	$r= $blah->fetch_assoc();
	  
	if(($r['notify'] == 0) && ($r['user_level'] != 0)){
	  
			$recipient = $r['email']; //recipient
			$username = $r['username']; //username
			$mail_body = "$message";
	
			include "lib/swift_required.php";
			include "lib/SmtpApiHeader.php";
			 
			$hdr = new SmtpApiHeader();
			 
			// Specify that this is an initial contact message
			$hdr->setCategory("initial");
			 
			// The subject of your email  
			$subject = "Game Alert";
			 
			// Where is this message coming from.  For example, this message can be from support@yourcompany.com, info@yourcompany.com
			$from = array("admin@MafiaReborn.com" => "Mafia Reborn");
			 
			// If you do not specify a sender list above, you can specifiy the user here. If a sender list IS specified above
			// This email address becomes irrelevant.
			$to = array("$recipient"=>"$username");
			 
			# Create the body of the message (a plain-text and an HTML version).
			# text is your plain-text email
			# html is your html version of the email
			# if the reciever is able to view html emails then only the html
			# email will be displayed
			
			/*
			 * Note the variable substitution here =)
			 */
			 
			$text = $mail_body;
			 
			$html = $mail_body;
			 
			// Your SendGrid account credentials
			$username = 'mafiamddddobi';
			$password = 'testda123!';
			
			// Create new swift connection and authenticate
			$transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
			$transport ->setUsername($username);
			$transport ->setPassword($password);
			$swift = Swift_Mailer::newInstance($transport);
			 
			// Create a message (subject)
			$message = new Swift_Message($subject);
			 
			// add SMTPAPI header to the message
			$headers = $message->getHeaders();
			$headers->addTextHeader('X-SMTPAPI', $hdr->asJSON());
			 
			// attach the body of the email
			$message->setFrom($from);
			$message->setBody($html, 'text/html');
			$message->setTo($to);
			$message->addPart($text, 'text/plain');
			 
			// send message 
			if ($recipients = $swift->send($message, $failures))
			{
			  // This will let us know how many users received this message
			  // If we specify the names in the X-SMTPAPI header, then this will always be 1.  
			  //echo 'Message sent out to '.$recipients.' users';
			}
			// something went wrong =(
			else
			{
			  //echo "Something went wrong - ";
			  //print_r($failures);
			}
			
			
	  }
	  
	  
	
	if($type == 1 && $r['phoneon'] == 1)
	  {
	  $Name = "$gamename"; //senders name
	  $email = "email@$gameurl"; //senders e-mail address
	  $recipient = "{$r['myphone']}"; //recipient
	  $mail_body = " $message"; //mail body
	  $subject = "Notify"; //subject
	  $header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields
	  mail($recipient, $subject, $mail_body, $header); //mail command :)
	  }  
		
	}
}

if(!function_exists('welcome_email')){
	function welcome_email($mail_body,$user){
		$blah=$conn->query("SELECT * FROM users WHERE userid=$user");
		$r= $blah->fetch_assoc();
	  if(($r['notify'] == 0) && ($r['user_level'] != 0)){
	  
			$recipient = $r['email']; //recipient
			$username = $r['username']; //username
	
			include "lib/swift_required.php";
			include "lib/SmtpApiHeader.php";
			 
			$hdr = new SmtpApiHeader();
			 
			// Specify that this is an initial contact message
			$hdr->setCategory("welcome");
			 
			// The subject of your email  
			$subject = "Welcome to Mafia Reborn!";
			 
			// Where is this message coming from.  For example, this message can be from support@yourcompany.com, info@yourcompany.com
			$from = array("no-reply@MafiaReborn.com" => "Mafia Reborn");
			 
			// If you do not specify a sender list above, you can specifiy the user here. If a sender list IS specified above
			// This email address becomes irrelevant.
			$to = array("$recipient"=>"$username");
			 
			# Create the body of the message (a plain-text and an HTML version).
			# text is your plain-text email
			# html is your html version of the email
			# if the reciever is able to view html emails then only the html
			# email will be displayed
			
			/*
			 * Note the variable substitution here =)
			 */
			 
			$text = $mail_body;
			 
			$html = $mail_body;
			 
			// Your SendGrid account credentials
		// Your SendGrid account credentials
			$username = 'mafiamdddobi';
			$password = 'testda123!';
			// Create new swift connection and authenticate
			$transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
			$transport ->setUsername($username);
			$transport ->setPassword($password);
			$swift = Swift_Mailer::newInstance($transport);
			 
			// Create a message (subject)
			$message = new Swift_Message($subject);
			 
			// add SMTPAPI header to the message
			$headers = $message->getHeaders();
			$headers->addTextHeader('X-SMTPAPI', $hdr->asJSON());
			 
			// attach the body of the email
			$message->setFrom($from);
			$message->setBody($html, 'text/html');
			$message->setTo($to);
			$message->addPart($text, 'text/plain');
			 
			// send message 
			if ($recipients = $swift->send($message, $failures))
			{
			  // This will let us know how many users received this message
			  // If we specify the names in the X-SMTPAPI header, then this will always be 1.  
			  //echo 'Message sent out to '.$recipients.' users';
			}
			// something went wrong =(
			else
			{
			  //echo "Something went wrong - ";
			  //print_r($failures);
			}
			
			
	  }
	
	}
}

if(!function_exists('time_format')){
	function time_format($seconds){
		 // Made by MagicTallGuy
	$seconds = floor($seconds);
	$days = intval($seconds / 86400);
	$seconds -= ($days * 86400);
	$hours = intval($seconds / 3600);
	$seconds -= ($hours * 3600);
	$minutes = intval($seconds / 60);
	$seconds -= ($minutes * 60);
	$result = array();
	
	if($days) { $result[] = sprintf("%u day%s", number_format($days), ($days == 1) ? "" : "s"); }
	if($hours) { $result[] = sprintf("%u hour%s", $hours, ($hours == 1) ? "" : "s"); }
	if($minutes && (count($result) < 2)) { $result[] = sprintf("%u minute%s", $minutes, ($minutes == 1) ? "" : "s"); }
	if(($seconds && (count($result) < 2)) || !count($result)) { $result[] = sprintf("%u second%s", $seconds, ($seconds == 1) ? "" : "s"); }
	return implode(", ", $result);
	}
}

if(!function_exists('bbcode')){
	function bbcode($code){
		
	   $code = htmlentities($code);
	   $search = array
	   (
		  '~\[b\](.*?)\[/b\]~is',
		  '~\[i\](.*?)\[/i\]~is',
		  '~\[size=(.+)\](.*?)\[/size\]~is',
		  '~\[center](.*?)\[/center\]~is',
		  '~\[left](.*?)\[/left\]~is',
		  '~\[right](.*?)\[/right\]~is',
		  '~\[color=(.+)\](.*?)\[/color\]~is',
		  '~\[profile=([0-9])\](.*?)\[/profile\]~is',
		  '~\[img\](.*?)\[/img\]~is',
		  '~\[code\](.*?)\[/code\]~is',
		  '~\[quote=(.+)\](.*?)\[/quote\]~is',
		  '~\[url=(.+)\](.*?)\[/url\]~is',
		  '~\[u\](.*?)\[/u\]~is',
		  '~\[s\](.*?)\[/s\]~is',
		  '~\[o\](.*?)\[/o\]~is',
		  '~\[acronym=(.+)\](.*?)\[/acronym\]~is',
	   );
	   $replace = array
	   (
		  '<strong>\\1</strong>',
		  '<em>\\1</em>',
		  '<span style="font-size: \\1;">\\2</span>',
		  '<div style="padding: 0;" align="center">\\1</div>',
		  '<div style="padding: 0; float: left;">\\1</div>',
		  '<div style="padding: 0; float: right;">\\1</div>',
		  '<span style="color: \\1;">\\2</span>',
		  '<a href="viewuser.php?u=\\1">\\2</a>',
		  '<img src="\\1" alt="Image unavailable" />',
		  '<span style="font-size: 11px;">Code:</span><br />
		  <div style="border: 1px black solid; background: #CCC; width: 99%; max-height: 24em; display: block; white-space: nowrap; overflow: auto;
		  line-height: 1.3em; overflow: auto;">\\1</div>',
		  '<span style="font-size: 11px;">Quote From=<strong>\\1</strong></span>
		  <div style="border: 1px black solid; background: #FFF; color: #000; width: 50%; height: auto;">\\2</div>',
		  '<a href="\\1" target="user_link">\\2</a>',
		  '<span style="text-decoration: underline;">\\1</span>',
		  '<span style="text-decoration: line-through;">\\1</span>',
		  '<span style="text-decoration: overline;">\\1</span>',
		  '<span style="text-decoration: underline;" title="\\1">\\2</span>',
	   );
	   $code = preg_replace('~\&lt;br \/&gt;~is','<br />',$code);
	   $code = preg_replace('~\&lt;br&gt;~is','<br />',$code);
	   $code = str_replace('\n','<br />',$code);
	   $code = str_replace('\r','',$code);
	   $code = str_replace('\\','',$code);
	   $code = nl2br($code);
	   return stripslashes(preg_replace($search, $replace, $code));
	}
}

if(!function_exists('money_formatter')){
    
	function money_formatter($muny,$symb='$'){
		return $symb.number_format($muny);
	}
}

if(!function_exists('itemtype_dropdown')){
	function itemtype_dropdown($connection,$ddname="item_type",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM itemtypes ORDER BY itmtypeid ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['itmtypeid']}'";
	if ($selected == $r['itmtypeid'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.=">{$r['itmtypename']} [{$r['itmtypeid']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('item_dropdown')){
	function item_dropdown($connection,$ddname="item",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM items ORDER BY itmid ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['itmid']}'";
	if ($selected == $r['itmid'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.=">{$r['itmname']}[{$r['itmid']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('item2_dropdown')){
	function item2_dropdown($connection,$ddname="item",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM items ORDER BY itmid ASC");
	if($selected < 1) { $ret.="<option value='0' selected='selected'>-- None --</option>"; }
	else { $ret.="<option value='0'>-- None --</option>"; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['itmid']}'";
	if ($selected == $r['itmid']) { $ret.=" selected='selected'";$first=1; } 
	$ret.=">{$r['itmname']} [{$r['itmid']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('location_dropdown')){
	function location_dropdown($connection,$ddname="location",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM cities ORDER BY cityid ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['cityid']}'";
	if ($selected == $r['cityid'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['cityname']} [{$r['cityid']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('shop_dropdown')){
	function shop_dropdown($connection,$ddname="shop",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM shops ORDER BY shopID ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['shopID']}'";
	if ($selected == $r['shopID'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['shopNAME']} [{$r['shopID']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('gangcrime_dropdown')){
	function gangcrime_dropdown($connection,$ddname="ocNAME",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM orgcrimes ORDER BY ocID ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['ocID']}'";
	if ($selected == $r['ocID'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['ocNAME']}</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}



if(!function_exists('stock_down')){
	function stock_down($connection,$ddname="stockID",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM stock_stocks ORDER BY stockID ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['stockID']}'";
	if ($selected == $r['stockID'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['stockNAME']} [{$r['stockID']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}
if(!function_exists('bot_dropdown')){
	function bot_dropdown($connection,$ddname="user",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM users WHERE user_level=0 ORDER BY userid ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['userid']}'";
	if ($selected == $r['userid'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['username']} [{$r['userid']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('user_dropdown')){
	function user_dropdown($connection,$ddname="user",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM users ORDER BY userid ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['userid']}'";
	if ($selected == $r['userid'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['username']} [{$r['userid']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}


if(!function_exists('stock_dropdown')){
	function stock_dropdown($connection,$ddname="stock",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT
    u.*,
    s.* 
FROM
    users u
    LEFT JOIN stock_holdings s ON u.userid = s.holdingUSER 
WHERE
    u.userid = s.holdingUSER
GROUP BY
    u.userid");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['userid']}'";
	if ($selected == $r['userid'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['username']}</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}





if(!function_exists('gang_dropdown')){
	function gang_dropdown($connection,$ddname="gangid",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM gangs ORDER BY gangID ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['gangID']}'";
	if ($selected == $r['gangID'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['gangNAME']} [{$r['gangID']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('challengebot_dropdown')){
	function challengebot_dropdown($connection,$ddname="bot",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT cb.*,u.* FROM challengebots AS cb LEFT JOIN users AS u ON cb.cb_npcid=u.userid ORDER BY cb.cb_id ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['userid']}'";
	if ($selected == $r['userid'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['username']}</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}
 
if(!function_exists('fed_user_dropdown')){
	function fed_user_dropdown($connection,$ddname="user",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT userid, username, fed_userid FROM users LEFT JOIN fedjail ON userid=fed_userid WHERE userid=fed_userid order by fed_userid ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['userid']}'";
	if ($selected == $r['userid'] || $first == 0) { $ret.=" selected='selected'";$first=1; }  
	$ret.= ">{$r['username']} [{$r['userid']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('chat_user_dropdown')){
	function chat_user_dropdown($connection,$ddname="user",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM users WHERE banshout=1 order by userid ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['userid']}'";
	if ($selected == $r['userid'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['username']}</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}
if(!function_exists('mailb_user_dropdown')){
	function mailb_user_dropdown($connection,$ddname="user",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM users WHERE mailban > 0 order by userid ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['userid']}'";
	if ($selected == $r['userid'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['username']}</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('forumb_user_dropdown')){
	function forumb_user_dropdown($connection,$ddname="user",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM users WHERE forumban > 0 ORDER BY userid ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['userid']}'";
	if ($selected == $r['userid'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['username']}</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('job_dropdown')){
	function job_dropdown($connection,$ddname="job",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM jobs ORDER BY jID ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['jID']}'";
	if ($selected == $r['jID'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.=">{$r['jNAME']} [{$r['jID']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('jobrank_dropdown')){
	function jobrank_dropdown($connection,$ddname="jobrank",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT jr.*,j.* FROM jobranks jr LEFT JOIN jobs j ON jr.jrJOB=j.jID  ORDER BY j.jNAME ASC, jr.jrID ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['jrID']}'";
	if ($selected == $r['jrID'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.=">{$r['jNAME']} [{$r['jID']}] - {$r['jrNAME']} [{$r['jrID']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('house_dropdown')){
	function house_dropdown($connection,$ddname="house",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM houses   ORDER BY hID ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['hID']}'";
	if ($selected == $r['hID'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.=">{$r['hNAME']} [{$r['hID']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('house2_dropdown')){
	function house2_dropdown($connection,$ddname="house",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM houses   ORDER BY hID ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['hWILL']}'";
	if ($selected == $r['hWILL'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.=">{$r['hNAME']} [{$r['hID']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('course_dropdown')){
	function course_dropdown($connection,$ddname="course",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM courses   ORDER BY crID ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['crID']}'";
	if ($selected == $r['crID'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.=">{$r['crNAME']} [{$r['crID']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('crime_dropdown')){
	function crime_dropdown($connection,$ddname="crime",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM crimes   ORDER BY crimeID ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['crimeID']}'";
	if ($selected == $r['crimeID'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.=">{$r['crimeNAME']} [{$r['crimeID']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('crimegroup_dropdown')){
	function crimegroup_dropdown($connection,$ddname="crimegroup",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM crimegroups   ORDER BY cgID ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['cgID']}'";
	if ($selected == $r['cgID'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.=">{$r['cgNAME']} [{$r['cgID']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('feed_add')){
	function feed_add($userid,$text,$connection=0){
		
	global $conn;
	$text=$conn->real_escape_string($text);
	$conn->query("INSERT INTO livefeed (evUSER, evTIME, evREAD, evTEXT) VALUES($userid,UNIX_TIMESTAMP(),0,'$text')");
	return 1;
	}
}
if(!function_exists('mail_add')){
	function mail_add($userid,$text,$connection=0){
		
	global $conn;
	$text=$conn->real_escape_string($text);
	$conn->query("INSERT INTO mail (mail_read, mail_from, mail_to, mail_time, mail_subject, mail_text) VALUES(0,1,$userid, UNIX_TIMESTAMP(),'','$text')");
	$conn->query("UPDATE users SET new_mail=new_mail+1 WHERE userid={$userid}");
	return 1;
	}
}

if(!function_exists('event_add')){
    function event_add($userid,$text,$connection=0){
        
    global $conn;
    $text=$conn->real_escape_string($text);
    $conn->query("INSERT INTO events (evUSER, evTIME, evREAD, evTEXT) VALUES($userid,UNIX_TIMESTAMP(),0,'$text')");
    $conn->query("UPDATE users SET new_events=new_events+1 WHERE userid={$userid}");
    return 1;
    }
}

if(!function_exists('mysql_escape')){
	function mysql_escape($str){
		
	return str_replace("'","''",$str);
	}
}

if(!function_exists('check_level')){
	function check_level(){
		
	global $conn;
	global $ir,$c,$userid;
	$ir['exp_needed']=(int) (($ir['level']+2)*($ir['level']+2)*($ir['level']+2)*5);
	// LEVEL CAP INFO IS BELOW \\
	if($ir['exp'] >= $ir['exp_needed'] and $ir['level'] < 200)
	{
	$expu=$ir['exp']-$ir['exp_needed'];
	$ir['level']+=1;
	$ir['exp']=$expu;
	$ir['brave']+=2;
	$ir['maxbrave']+=2;
	$ir['hp']+=50;
	$ir['maxhp']+=50;
	$ir['crystals']+=50;
	
	$ir['energy']=$ir['maxenergy'];
	$ir['brave']=$ir['maxbrave'];
	$ir['will']=$ir['maxwill'];
	$ir['hp']=$ir['maxhp'];
	
	$ir['exp_needed']=(int) (($ir['level']+2)*($ir['level']+2)*($ir['level']+2)*7);
	$conn->query("UPDATE users SET level=level+1,exp=$expu,brave=brave+2,crystals=crystals+50,maxbrave=maxbrave+2,
	hp=hp+50,maxhp=maxhp+50,mlevel=mlevel+1 where userid=$userid");
		$conn->query("UPDATE users SET brave=maxbrave, energy=maxenergy, will=maxwill, hp=maxhp WHERE userid=$userid");
		
event_add($userid,"Congratulations! You have leveled up and earned 50 crystals.",$c);
feed_add(1,"<a href='viewuser.php?u={$ir['userid']}'><b>{$ir['username']}</b></a> is now level <b>".$ir['level']."</b>.",$c);
	}
	}
}

if(!function_exists('get_rank')){
	function get_rank($stat, $mykey){
		
	global $conn;
	global $ir,$userid,$c;
	$q=$conn->query("SELECT count(*) FROM userstats us LEFT JOIN users u ON us.userid=u.userid WHERE us.$mykey > $stat AND us.userid != $userid AND u.user_level != 0") ;
	$arr  = $q->fetch_row();
    return $arr[0];
	
	}
}
if(!function_exists('get_level')){
	function get_level($stat, $mykey){
		
	global $conn;
	global $ir,$userid,$c;
	$q=$conn->query("SELECT count(*) FROM users WHERE $mykey > $stat AND userid != $userid AND user_level != 0 AND user_level != 2") ;
    $arr  = $q->fetch_row();
    return $arr[0];
	}
}

if(!function_exists('item_add')){
	function item_add($user, $itemid, $qty, $notid=0){
		
	  global $conn;
	  if($notid > 0)
	  {
		$q=$conn->query("SELECT * FROM inventory WHERE inv_userid={$user} and inv_itemid={$itemid} AND inv_id != {$notid}");
	  }
	  else
	  {
		$q=$conn->query("SELECT * FROM inventory WHERE inv_userid={$user} and inv_itemid={$itemid}");
	  }
	  if(mysqli_num_rows($q) > 0)
	  {
		$r=$q->fetch_assoc();
		$conn->query("UPDATE inventory SET inv_qty=inv_qty+{$qty} WHERE inv_id={$r['inv_id']}");
	  }
	  else
	  {
		$conn->query("INSERT INTO inventory (inv_itemid, inv_userid, inv_qty) VALUES ({$itemid}, {$user}, {$qty})");
	  }
	}
}

if(!function_exists('item_remove')){
	function item_remove($user, $itemid, $qty){
		
	  global $conn;
	$q=$conn->query("SELECT * FROM inventory WHERE inv_userid={$user} AND inv_itemid={$itemid}");
	if(mysqli_num_rows($q) > 0)
	{
	$r=$q->fetch_assoc();
	if($r['inv_qty']>$qty)
	{
	$conn->query("UPDATE inventory SET inv_qty=inv_qty-{$qty} WHERE inv_id={$r['inv_id']}");
	}
	else
	{
	$conn->query("DELETE FROM inventory WHERE inv_id={$r['inv_id']}");
	}
	}
	}
}

if(!function_exists('forum_dropdown')){
	function forum_dropdown($connection,$ddname="forum",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM forum_forums ORDER BY ff_id ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['ff_id']}'";
	if ($selected == $r['ff_id'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['ff_name']} [{$r['ff_id']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}
	
if(!function_exists('forum2_dropdown')){
	function forum2_dropdown($connection,$ddname="forum",$selected=-1){
		
	global $conn;
	$ret="<select name='$ddname' type='dropdown'>";
	$q=$conn->query("SELECT * FROM forum_forums WHERE ff_auth != 'gang' ORDER BY ff_id ASC");
	if($selected == -1) { $first=0; } else { $first=1; }
	while($r=$q->fetch_assoc())
	{
	$ret.="\n<option value='{$r['ff_id']}'";
	if ($selected == $r['ff_id'] || $first == 0) { $ret.=" selected='selected'";$first=1; } 
	$ret.= ">{$r['ff_name']} [{$r['ff_id']}]</option>";
	}
	$ret.="\n</select>";
	return $ret;
	}
}

if(!function_exists('make_bigint')){
	function make_bigint($str, $positive=1){
		
	$str = (string) $str;
	$ret = "";
	for($i=0;$i<strlen($str);$i++)
	{
	if((ord($str[$i]) > 47 && ord($str[$i]) < 58) or ($str[$i]=="-" && $positive == 0)) { $ret.=$str[$i]; }
	}
	if(strlen($ret) == 0) { return "0"; }
	return $ret;
	}
}

if(!function_exists('stafflog_add')){
	function stafflog_add($text){
		
	global $conn, $ir;
$IP = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
	$text= $conn->real_escape_string($text);
	$conn->query("INSERT INTO stafflog VALUES(NULL, {$ir['userid']}, unix_timestamp(), '$text', '$IP')");
	}
}

if(!function_exists('business_alert')){
	function business_alert($business, $text){
		$conn->query(sprintf("INSERT INTO `businesses_alerts` (`alertId`, `alertBusiness`, `alertText`, `alertTime`) VALUES ('NULL', '%u', '%s', '%d')", $business, $text, time()));
	}
}

function userNameGrad($user = NULL)
{
	global $conn, $userid;
	if($user == NULL)
		$user = $userid;
	$q = $conn->query("select username, startColor, middleColor, stopColor, gradientdays from users where userid = ".$user);
	 $days = $q->fetch_assoc();
	if($days["gradientdays"] >= 1)
		$name = "<strong><span style='font-size:14px;
		 background-image: linear-gradient(to right, ".$days['startColor'].", ".$days['middleColor'].", ".$days['startColor'].",".$days['stopColor']." );
	  color:transparent;
  -webkit-background-clip: text;
  background-clip: text;
  '>".$days["username"]."</span></strong>";
	else
		$name =$days["username"];
	return $name;
}
?>