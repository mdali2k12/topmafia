<?php

##
## Config - values can be changed to own likings
##

$showtime = true;		// show how long the attacker has to wait? true or false only
$time 	  = 10 * 60;		// amount of time between each attack by the SAME attacker ( minutes * seconds)
$message  = "Online attack protection. Time between protected attacks: ". floor($time/60) ." minutes and ". ($time - floor($time/60)*60) ." seconds";
$msg_time = "You need to wait $min more minutes and $sec seconds. Before you can attack again<br /><a data-role='button' data-rel='back' href='index.php'>Back</a>";
$online	  = 10 * 60;	// time before a user isn't considered online (minutes * seconds)

##
## Do not edit below!
## 

  $menuhide = 0;
  $atkpage = 1;
  include "globals.php";
  
  $_GET['ID'] == (int)$_GET['ID'];
  
  if (!$_GET['ID']) {
      print "WTF you doing, bro?<br />
<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      exit;
  } 
  
  elseif ($youdata['location'] != $odata['location'])
{
	print "You can only attack someone in the same location! <br /><a data-role='button' data-rel='back' href='index.php'>Back</a>";
	$db->query("UPDATE users SET attacking=0 WHERE userid=$userid");
	$h->endpage();
	exit;
}

elseif($odata['protected'] >= 1)
{
die("<br><br>This user is protected by a VIP bodyguard, you are unable to get past the bodyguard. You can't attack them. Try again later <br><br> <img src='https://www.mafiamobi.com/images/items/161.png' alt='VIP Bodyguard' title='VIP Bodyguard'> <br>Back Off! <br><br><a data-role='button' data-rel='back' href='explore.php'>Back</a>");
}

  elseif ($odata['jail']) 
  
{
	print "This player is in jail. And can't be attacked! <br /><a data-role='button' data-rel='back' href='index.php'>Back</a>";
	$db->query("UPDATE users SET attacking=0 WHERE userid=$userid");
	$h->endpage();
	exit;
}

elseif ($ir['hospital']) 
{
	print "While in hospital you can't attack. <br /><a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      $_SESSION['attacking'] = 0;
      $ir['attacking'] = 0;
      $db->query("UPDATE users SET attacking=0 WHERE userid=$userid");
      exit;
}

elseif($_GET['ID'] == 1)
		{
			print "ERROR: The Admin ID [1] Cannot be attacked, Nor can he attack anyone. <br /><a data-role='button' data-rel='back' href='index.php'>Back</a>";
			$h->endpage();
			exit;
		}
		
elseif($_GET['ID'] == 2)
		{
			print "ERROR: Sorry but The Admin ID [2] Cannot be attacked. <br /><a data-role='button' data-rel='back' href='index.php'>Back</a>";
			$h->endpage();
			exit;
		}
  
  elseif ($_GET['ID'] == $userid) {
      print "Only the crazy attack themselves.<br />
<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      exit;
  } elseif ($ir['hp'] <= 1) {
      print "Only the crazy attack when their unconscious.<br />
<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      exit;
  } elseif ($userid) {
      $q = $db->query("SELECT laston FROM users WHERE userid=$userid");
      if ($db->num_rows($q) == 0) {
          print "Sorry, we could not find a user with that ID, check your source.<br />
    <a data-role='button' data-rel='back' href='index.php'>Back</a>";
          $h->endpage();
          exit;
      } else {
          $r = $db->fetch_row($q);
          
          if (!$r['laston']) {
              print "Can not attack people that have never logged in.<br />
      <a data-role='button' data-rel='back' href='index.php'>Back</a>";
              $h->endpage();
              exit;
          } else {
              if ($r['laston'] < strtotime("-90 days")) {
                  print "This Member has been unconscious/dormant for over 90 days.  He is presumably dead.  Pick on the living.<br />
        <a data-role='button' data-rel='back' href='index.php'>Back</a>";
                  $h->endpage();
                  exit;
              }
          }
      }
  }
  
  
  
  //get player data
  $youdata = $ir;
  $q = $db->query("SELECT u.*,us.* FROM users u LEFT JOIN userstats us ON u.userid=us.userid WHERE u.userid={$_GET['ID']}");
  $odata = $db->fetch_row($q);
  $myabbr = ($ir['gender'] == "Male") ? "his" : "her";
  $oabbr = ($ir['gender'] == "Male") ? "his" : "her";

  /// check for status on attacked player that would not allow an attack
  
  $lvl = $ir['level'] - 10;
  $lvl50 = $ir['level'] - 30;

##
## Attack protection part start
##

$sql = "SELECT * FROM attacklogs WHERE attacker = {$ir['userid']} AND attacked = {$_GET['ID']} ORDER BY time DESC LIMIT 1";
$res = $db->query($sql);
$row = $db->fetch_row($res);

$wait = ($row['time'] + $time) - time();

/*
 * The following 3 conditions must be true to attack
 *  - the previous attack must be won - else they can attack
 *  - the wait timer must be 0 or less
 *  - the opponents last action must be below current_time - $online parameter
 */
if( ($row['result'] == "won") && ($wait >= 0) && ($odata['laston'] > (time() - $online)) )
{
	echo "<br />", $message;
	$min = floor($wait / 60);
	$sec = $wait - ($min * 60);
	echo "<br />You need to wait $min more minutes and $sec seconds.";
	$h->endpage();
	exit;
}

##
## End Attack protection part
##
  
  else if ($odata['hp'] == 1) {
      print "This player is unconscious.<br />
<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      $_SESSION['attacking'] = 0;
      $ir['attacking'] = 0;
      $db->query("UPDATE users SET attacking=0 WHERE userid=$userid");
      exit;} 
	  
	  elseif($odata['protected'])
{
print "<br><br>This user is protected by a VIP bodyguard, you are unable to get past the bodyguard. Try again later <br><br> <img src='https://www.mafiamobi.com/images/items/161.png' alt='VIP Bodyguard' title='VIP Bodyguard'> <br>Back Off! <br><br><a data-role='button' data-rel='back' href='explore.php'>Back</a>";
$h->endpage();
$_SESSION['attacking']=0;
$ir['attacking']=0;
exit;
}
  
  elseif ($odata['hospital']) {
      print "This player is in hospital.<br />
<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      $_SESSION['attacking'] = 0;
      $ir['attacking'] = 0;
      $db->query("UPDATE users SET attacking=0 WHERE userid=$userid");
      exit;
  } elseif ($ir['hospital']) {
      print "While in hospital you can't attack.<br />
<a href='hospital.php'>&gt; Back</a>";
      $h->endpage();
      $_SESSION['attacking'] = 0;
      $ir['attacking'] = 0;
      $db->query("UPDATE users SET attacking=0 WHERE userid=$userid");
      exit;
  } elseif ($odata['']) {
      print "This player is in .<br />
<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      $_SESSION['attacking'] = 0;
      $ir['attacking'] = 0;
      $db->query("UPDATE users SET attacking=0 WHERE userid=$userid");
      exit;
  } elseif ($ir['']) {
      print "While in  you can't attack.<br />
<a href='.php'>&gt; Back</a>";
      $h->endpage();
      $_SESSION['attacking'] = 0;
      $ir['attacking'] = 0;
      $db->query("UPDATE users SET attacking=0 WHERE userid=$userid");
      exit;
  } elseif ($odata['fed']) {
      print "This player is in Federal .<br />
<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      $_SESSION['attacking'] = 0;
      $ir['attacking'] = 0;
      $db->query("UPDATE users SET attacking=0 WHERE userid=$userid");
      exit;
  } elseif ($odata['travelling']) {
      print "That player is travelling.<br />
<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      $_SESSION['attacking'] = 0;
      $ir['attacking'] = 0;
      $db->query("UPDATE users SET attacking=0 WHERE userid=$userid");
      exit;
  }
  print "<table width=100%><tr><td colspan=2 align=center>";
  if ($_GET['wepid']) {
      if ($_SESSION['attacking'] == 0 && $ir['attacking'] == 0) {
          if ($youdata['energy'] >= $youdata['maxenergy'] / 4) {
              $youdata['energy'] -= floor($youdata['maxenergy'] / 4);
              $me = floor($youdata['maxenergy'] / 4);
              $db->query("UPDATE users SET energy=energy- {$me} WHERE userid=$userid");
              $_SESSION['attacklog'] = "";
              $_SESSION['attackdmg'] = 0;
          } else {
              print "You can only attack someone when you have 25% energy";
              $h->endpage();
              exit;
          }
      }
      $_SESSION['attacking'] = 1;
      $ir['attacking'] = $odata['userid'];
      $db->query("UPDATE users SET attacking={$ir['attacking']} WHERE userid=$userid");
            $db->query("UPDATE users SET tattacks=tattacks+1 WHERE userid=$userid");
      $_GET['wepid'] = (int)$_GET['wepid'];
      $_GET['nextstep'] = (int)$_GET['nextstep'];
      //damage
	  
	  if ($youdata['location'] != $odata['location'])
{
	print "You can only attack someone in the same location! <br /><a data-role='button' data-rel='back' href='index.php'>Back</a>";
	$db->query("UPDATE users SET attacking=0 WHERE userid=$userid");
	$h->endpage();
	exit;
}
      
      if ($_GET['wepid'] != $ir['equip_primary'] && $_GET['wepid'] != $ir['equip_secondary']) {
          print "Stop trying to abuse a game bug. You can lose all your EXP for that.<br />
<a href='index.php'>&gt; Home</a>";
          $db->query("UPDATE users SET exp=0 where userid=$userid", $c);
          die("");
      }
      $qo = $db->query("SELECT i.* FROM items i   WHERE i.itmid={$_GET['wepid']}");
      $r1 = $db->fetch_row($qo);
      $mydamage = (int)(($r1['weapon'] * $youdata['strength'] / ($odata['guard'] / 1.5)) * (rand(8000, 12000) / 10000));
      $hitratio = max(10, min(60 * $ir['agility'] / $odata['agility'], 95));
      if (rand(1, 100) <= $hitratio) {
          $q3 = $db->query("SELECT i.armor FROM items i   WHERE itmid={$odata['equip_armor']} ORDER BY rand()");
          if ($db->num_rows($q3)) {
              $mydamage -= $db->fetch_single($q3);
          }
          if ($mydamage < -100000) {
              $mydamage = abs($mydamage);
          } elseif ($mydamage < 1) {
              $mydamage = 1;
          }
          $crit = rand(1, 40);
          if ($crit == 17) {
              $mydamage *= rand(20, 40) / 10;
          } elseif ($crit == 25 or $crit == 8) {
              $mydamage /= (rand(20, 40) / 10);
          }
          $mydamage = round($mydamage);
          $odata['hp'] -= $mydamage;
          if ($odata['hp'] == 1) {
              $odata['hp'] = 0;
              $mydamage += 1;
          }
          $db->query("UPDATE users SET hp=hp-$mydamage WHERE userid={$_GET['ID']}");
          print "<font color=red>{$_GET['nextstep']}. Using your {$r1['itmname']} you hit {$odata['username']} doing $mydamage damage ({$odata['hp']})</font><br />\n";
          $_SESSION['attackdmg'] += $mydamage;
          $_SESSION['attacklog'] .= "<font color=red>{$_GET['nextstep']}. Using {$myabbr} {$r1['itmname']} {$ir['username']} hit {$odata['username']} doing $mydamage damage ({$odata['hp']})</font><br />\n";
      } else {
          print "<font color=red>{$_GET['nextstep']}. You tried to hit {$odata['username']} but missed ({$odata['hp']})</font><br />\n";
          $_SESSION['attacklog'] .= "<font color=red>{$_GET['nextstep']}. {$ir['username']} tried to hit {$odata['username']} but missed ({$odata['hp']})</font><br />\n";
      }
      if ($odata['hp'] <= 0) {
          $odata['hp'] = 0;
          $_SESSION['attackwon'] = $_GET['ID'];
          $db->query("UPDATE users SET hp=0 WHERE userid={$_GET['ID']}");
          print "<br />
<b>What do you want to do with {$odata['username']} now?</b><br />
<form action='attackwon.php?ID={$_GET['ID']}' method='post'><input type='submit' value='Mug Money' /></form>
<form action='attackcry.php?ID={$_GET['ID']}' method='post'><input type='submit' value='Mug Crystals' /></form>
<form action='attackbeat.php?ID={$_GET['ID']}' method='post'><input type='submit' value='Hospitalize Them' /></form> 
<form action='attacktake.php?ID={$_GET['ID']}' method='post'><input type='submit' value='Leave For Exp' /></form><br />";

if($odata['bounty'] > 0)
{
   print"<form action='attackbounty.php?ID={$_GET['ID']}' method='post'><input type='submit' value='Take Bounty' /></form> <br />"; 
}

if($odata['userid']==977 && $ir['mafiagod']==0)
{print"
<h2>Special Event</h2>
<form action='attackloot.php?ID={$_GET['ID']}' method='post'><input type='submit' value='Take Drop' /></form><br />
";}

          /*<form action='attackbomb.php?ID={$_GET['ID']}' method='post'><input type='submit' value='Leave Them & Bomb (cost $20,000)' /></form>*/
      } else {
          //choose opp gun
          $eq = $db->query("SELECT i.* FROM  items i  WHERE i.itmid IN({$odata['equip_primary']}, {$odata['equip_secondary']})");
          if (mysql_num_rows($eq) == 0) {
              $wep = "Fists";
              $dam = (int)((((int)($odata['strength'] / $ir['guard'] / 100)) + 1) * (rand(8000, 12000) / 10000));
          } else {
              $cnt = 0;
              while ($r = $db->fetch_row($eq)) {
                  $enweps[] = $r;
                  $cnt++;
              }
              $weptouse = rand(0, $cnt - 1);
              $wep = $enweps[$weptouse]['itmname'];
              $dam = (int)(($enweps[$weptouse]['weapon'] * $odata['strength'] / ($youdata['guard'] / 1.5)) * (rand(8000, 12000) / 10000));
          }
          $hitratio = max(10, min(60 * $odata['agility'] / $ir['agility'], 95));
          if (rand(1, 100) <= $hitratio) {
              $q3 = $db->query("SELECT i.armor FROM items i   WHERE itmid={$ir['equip_armor']} ORDER BY rand()");
              if ($db->num_rows($q3)) {
                  $dam -= $db->fetch_single($q3);
              }
              if ($dam < -100000) {
                  $dam = abs($dam);
              } elseif ($dam < 1) {
                  $dam = 1;
              }
              $crit = rand(1, 40);
              if ($crit == 17) {
                  $dam *= rand(20, 40) / 10;
              } elseif ($crit == 25 or $crit == 8) {
                  $dam /= (rand(20, 40) / 10);
              }
              $dam = round($dam);
              $youdata['hp'] -= $dam;
              if ($youdata['hp'] == 1) {
                  $dam += 1;
                  $youdata['hp'] = 0;
              }
              $db->query("UPDATE users SET hp=hp-$dam WHERE userid=$userid");
              $ns = $_GET['nextstep'] + 1;
              print "<font color=blue>{$ns}. Using $oabbr $wep {$odata['username']} hit you doing $dam damage ({$youdata['hp']})</font><br />\n";
              $_SESSION['attacklog'] .= "<font color=blue>{$ns}. Using $oabbr $wep {$odata['username']} hit {$ir['username']} doing $dam damage ({$youdata['hp']}hp left)</font><br />\n";
          } else {
              $ns = $_GET['nextstep'] + 1;
              print "<font color=red>{$ns}. {$odata['username']} tried to hit you but missed ({$youdata['hp']}hp left)</font><br />\n";
              $_SESSION['attacklog'] .= "<font color=blue>{$ns}. {$odata['username']} tried to hit {$ir['username']} but missed ({$youdata['hp']})</font><br />\n";
          }
          if ($youdata['hp'] <= 0) {
              $youdata['hp'] = 0;
              $_SESSION['attacklost'] = 1;
              $db->query("UPDATE users SET hp=0 WHERE userid=$userid");
              print "<form action='attacklost.php?ID={$_GET['ID']}' method='post'><input type='submit' value='Continue' />";
          }
      }
  } elseif ($odata['hp'] < 5) {
      print "You can only attack those who have health<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      exit;
  } elseif ($ir['gang'] == $odata['gang'] && $ir['gang'] > 0) {
      print "You are in the same gang as {$odata['username']}! What are you smoking today dude!<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      exit;
  } elseif ($youdata['energy'] < $youdata['maxenergy'] / 4) {
      print "You can only attack someone when you have 25% energy<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      exit;
  } elseif ($youdata['location'] != $odata['location']) {
      print "You can only attack someone in the same location!<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      $h->endpage();
      exit;
  } else {
  }
  print "</td></tr></table>";
  if ($youdata['hp'] <= 0 || $odata['hp'] <= 0) {
      print "";
  } else {
      $vars['hpperc'] = round($youdata['hp'] / $youdata['maxhp'] * 100);
      $vars['hpopp'] = 100 - $vars['hpperc'];
      $vars2['hpperc'] = round($odata['hp'] / $odata['maxhp'] * 100);
      $vars2['hpopp'] = 100 - $vars2['hpperc'];
      
      
      $mw = $db->query("SELECT i.* FROM  items i  WHERE i.itmid IN({$ir['equip_primary']}, {$ir['equip_secondary']})");
      print "<div class='attackbox'>Attack with:<br /><br />";
      if ($db->num_rows($mw) > 0) {
          while ($r = $db->fetch_row($mw)) {
              if (!$_GET['nextstep']) {
                  $ns = 1;
              } else {
                  $ns = $_GET['nextstep'] + 2;
              }
              
			  print "<div class='attackweapon'><a href='attack.php?nextstep=$ns&amp;ID={$_GET['ID']}&amp;wepid={$r['itmid']}'>{$r['itmname']}<br /><img src='images/items/".$r['itmid'].".png'/></a><br/><span class='attack'>Attack:".$r['weapon']."</span><br/><span class='defense'>Defense:".$r['armor']."</span><br/>";
			  
			  if ($r['itmid'] == $ir['equip_primary']) {  
                  print "(primary)<br/>";	  
              }
              if ($r['itmid'] == $ir['equip_secondary']) {
                  print "(secondary)<br/>";
              }
			  
			  print"</div>";
			  
          }
      } else {
          print "You have nothing to fight with.<a data-role='button' data-rel='back' href='index.php'>Back</a>";
      }
      print "<br class='clear'/></div>";
      print "<table width='100%' align='center'>
	  <tr><td align='right' width='50%'>Your Health:</td><td align='left' width='50%'><img src=greenbar.png width={$vars['hpperc']} height=10><img src=redbar.png width={$vars['hpopp']} height=10>&nbsp;<span class='info'>{$youdata['hp']}</span></td></tr>
	  <tr><td align='right' width='50%'>Opponents Health:</td><td align='left' width='50%'><img src=greenbar.png width={$vars2['hpperc']} height=10><img src=redbar.png width={$vars2['hpopp']} height=10>&nbsp;<span class='info'>{$odata['hp']}</span></td></tr>
	  </table>";
  }
  $h->endpage();
?>