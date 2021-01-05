<?php

	global $conn,$c,$ir, $set, $userid;
		$experc=(int) ($ir['exp']/$ir['exp_needed']*100);
		$exopp=100-$experc;
  $enperc=(int) ($ir['energy']/$ir['maxenergy']*100);
		$wiperc=(int) ($ir['will']/$ir['maxwill']*100);
		$brperc=(int) ($ir['brave']/$ir['maxbrave']*100);
		$hpperc=(int) ($ir['hp']/$ir['maxhp']*100); 
		$enopp=100-$enperc;
		$wiopp=100-$wiperc;
		$bropp=100-$brperc;
		$hpopp=100-$hpperc;
		
		if($ir['exp'] > $ir['exp_needed'])
		{
		    $conn->query("UPDATE users_vitals SET exp='0' WHERE userid=$userid");
		    $ir['exp_needed'] = 0;
            event_add($userid, "You trying to cheat? your exp has been reset.", $c);
		}

		$query = $conn->query("SELECT * FROM events WHERE evREAD=0 AND evUSER='$userid'") or die(mysqli_error());
		$ec=mysqli_num_rows($query);
		
      $q11=$conn->query("SELECT userid, location, cityid, cityname FROM users_data LEFT JOIN cities ON location=cityid WHERE userid={$ir['userid']}");
               $rr=$q11->fetch_assoc();
               
		$query = $conn->query("SELECT * FROM mail WHERE mail_read=0 AND mail_to='$userid'") or die(mysqli_error());
		$mc=mysqli_num_rows($query);
		$query =$conn->query("SELECT hospital FROM users_freeze WHERE hospital>0") or die(mysqli_error());
		$hc=mysqli_num_rows($query);
		$query =$conn->query("SELECT jail FROM users_freeze WHERE jail>0") or die(mysqli_error());
		$jc=mysqli_num_rows($query);

		$counts = $conn->query("SELECT `chat` FROM `chat2`");

		$shouts = mysqli_num_rows($counts);

        $date = date('F j, Y');
	$hour = date('H');
	$minute = date('i');
	$second = date('s');
	$ampm = date('a');
	
	if($ir['married']>0)
	{
	$marr=$conn->query("SELECT * FROM users_data WHERE userid={$ir['married']}",$c);
	$ma=$marr->fetch_assoc();
	if ($ma['willmax']>$ir['maxwill'])
	{
	$conn->query("UPDATE users_vitals SET maxwill={$ma['willmax']} WHERE userid=$userid",$c);
	}
	if ($ir['willmax']<$ir['maxwill'] && $ir['maxwill']>$ma['willmax'])
	{
	$conn->query("UPDATE users_vitals SET maxwill=willmax WHERE userid=$userid",$c);
	}
	if ($ir['maxwill']<$ir['willmax'])
	{
	$conn->query("UPDATE users_vitals SET maxwill=willmax WHERE userid=$userid",$c);
	}
	}
	if ($ir['married']==0 && $ir['maxwill']>$ir['willmax']) 
	{
	$conn->query("UPDATE users_vitals SET maxwill=maxwill WHERE userid=$userid",$c);
	}
		$d="";
		$u= strlen($ir['username']) > 7 ? substr($ir['username'],0,7)."..." : $ir['username'];

		if($ir['vip']) { 
		    
		$usern = strlen($ir['username']) > 7 ? substr($ir['username'],0,7)."..." : $ir['username'];
		$u = "$usern";
		$d ="<img src='https://topmafia.net/header/images/imageicons/gamecard/donator.gif'>";
		}

$page = $_SERVER['REQUEST_URI'];
// Defaults
if(!isset($_SESSION[$page]['count']))
{
    $_SESSION[$page]['count'] = 1;
    $_SESSION[$page]['first_hit'] = time();
    $_SESSION[$page]['banned'] = false;

}
else
{
    $_SESSION[$page]['count']++; // Increase the counter
}

if($_SESSION[$page]['first_hit'] < time() - 15)
{
    $_SESSION[$page]['count'] = 1; // Reset every 15 seconds
    $_SESSION[$page]['first_hit'] = time();
    $_SESSION[$page]['banned'] = false; 
}

if($_SESSION[$page]['count'] >= 100)
{
    $_SESSION[$page]['banned'] = true; 
    // Ban if they hit over 15 times in 15 seconds.
}

// If person is banned, end script
if($_SESSION[$page]['banned'] == true)
{
 session_unset();
session_destroy();
header("Location: logout.php");

}
	$counta = $conn->query("SELECT * FROM `announcements`");

		$news = mysqli_num_rows($counta);

			$countf = $conn->query("SELECT * FROM `updates`");

		$updates = mysqli_num_rows($countf);
?>