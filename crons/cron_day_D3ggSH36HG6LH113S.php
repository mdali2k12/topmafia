<?php
include "config.php";
require "global_func.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_{$_CONFIG['driver']}.php";
$conn = mysqli_connect($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database']);
$c=$conn->connection_id;
$set=array();
$settq = $conn->query("SELECT * FROM settings");  
while ($r = $settq->fetch_assoc()) {
$set[$r['conf_name']]=$r['conf_value'];
}




##
## Purging old gangs
##
#

$gang_max_age = 5 * 24 * 60 * 60;   // days * hours * minutes * seconds
$gang_members = 2; // leave it at 2 for now! possible future update // amount of members needed to be safe of auto-purge. value 2 means gangs with 1 or 0 members might be deleted.


$sql = "SELECT g.*, COUNT(*) as 'members' FROM users_data u, gangs g WHERE u.gang = g.gangID AND g.gangLMM < (unix_timestamp() - $gang_max_age) GROUP BY g.gangID HAVING members < $gang_members";
$rs  = $conn->query($sql);

while($row = $rs->fetch_assoc())
{
    $sql_dg = "DELETE FROM gangs WHERE gangID = {$row->gangID}";
    $conn->query($sql_dg);
    
    $conn->query("INSERT INTO events (evUSER, evTIME, evREAD, evTEXT) VALUES('{$row->gangPRESIDENT}, UNIX_TIMESTAMP(),0,'Your gang was considered inactive and has been deleted!')");
    $conn->query("UPDATE users_data SET new_events = new_events + 1, gang = 0 WHERE userid={$row->gangPRESIDENT}");
    

    $sql_war = "DELETE FROM gangwars WHERE warDECLARER = {$row->gangID}";
    $sql_sur = "DELETE FROM surrenders WHERE surWHO = {$row->gangID}";
    
    $conn->query($sql_war);
    $conn->query($sql_sur);
}

///gang clean end


///drug farm cron

$query = $conn->query("SELECT * FROM drugsell");
$sell = $query->fetch_assoc();
$rand = rand(25000,50000);
$conn->query("UPDATE drugsell SET cannabis=$rand");
$rand2 = rand(250000,300000);
$conn->query("UPDATE drugsell SET cocaine=$rand2");
$rand3 = rand(1000000,1500000);
$conn->query("UPDATE drugsell SET mm=$rand3");
$rand4 = rand(10000000,14000000);
$conn->query("UPDATE drugsell SET heroin=$rand4");
$rand5 = rand(25000000,30000000);
$conn->query("UPDATE drugsell SET lsd=$rand5");

$conn->query("UPDATE users_drugs SET cannabisDays=cannabisDays-1 WHERE cannabisDays > 0");
$conn->query("UPDATE users_drugs SET cocaineDays=cocaineDays-1 WHERE cocaineDays > 0");
$conn->query("UPDATE users_drugs SET mmDays=mmDays-1 WHERE mmDays > 0");
$conn->query("UPDATE users_drugs SET heroinDays=heroinDays-1 WHERE heroinDays > 0");
$conn->query("UPDATE users_drugs SET lsdDays=lsdDays-1 WHERE lsdDays > 0");

$conn->query("UPDATE users_drugs SET mm=0 WHERE mmDays=0");
$conn->query("UPDATE users_drugs SET heroin=0 WHERE heroinDays=0");
$conn->query("UPDATE users_drugs SET cocaine=0 WHERE cocaineDays=0");
$conn->query("UPDATE users_drugs SET cannabis=0 WHERE cannabisDays=0");
$conn->query("UPDATE users_drugs SET lsd=0 WHERE lsdDays=0");

$q = $conn->query("SELECT * FROM users_data");

while($ir=$q->fetch_assoc())
{
  $userid=$ir['userid'];
  if ($ir['ca'] == 'y' && $ir['cannabisDays'] == 0)
  {
  $conn->query("UPDATE users_finance SET money=money+{$sell['cannabis']} WHERE ca='y' AND userid=".$userid."");
  $conn->query("UPDATE users_finance SET ca='n' WHERE ca='y' AND userid=".$userid."");
  event_add($userid,"You successfully grew Cannabis and earned ".money_formatter($sell['cannabis'])."",$c);

  }
  if ($ir['co'] == 'y' && $ir['cocaineDays'] == 0)
  {
  $conn->query("UPDATE users_finance SET money=money+{$sell['cocaine']} WHERE co='y' AND userid=".$userid."");
  $conn->query("UPDATE users_finance SET co='n' WHERE co='y' AND userid=".$userid."");
  event_add($userid,"You successfully grew Cocaine and earned ".money_formatter($sell['cocaine'])."",$c);
  }
  if ($ir['h'] == 'y' && $ir['heroinDays'] == 0)
  {
  $conn->query("UPDATE users_finance SET money=money+{$sell['heroin']} WHERE h='y' AND userid=".$userid."");
  $conn->query("UPDATE users_finance SET h='n' WHERE h='y' AND userid=".$userid."");
  
  event_add($userid,"You successfully grew Heroin and earned ".money_formatter($sell['heroin'])."",$c);
  }
  if ($ir['m'] == 'y' && $ir['mmDays'] == 0)
  {
  $conn->query("UPDATE users_finance SET money=money+{$sell['mm']} WHERE m='y' AND userid=".$userid."");
  $conn->query("UPDATE users_finance SET m='n' WHERE m='y' AND userid=".$userid."");
  event_add($userid,"You successfully grew Mushrooms and earned ".money_formatter($sell['mm'])."",$c);
  }
    if ($ir['m'] == 'y' && $ir['lsdDays'] == 0)
  {
  $conn->query("UPDATE users_finance SET money=money+{$sell['lsd']} WHERE m='y' AND userid=".$userid."");
  $conn->query("UPDATE users_finance SET m='n' WHERE m='y' AND userid=".$userid."");
  event_add($userid,"You successfully grew LSD and earned ".money_formatter($sell['lsd'])."",$c);
  }
}
/// drug farm cron end







///Business cron start

$conn->query("UPDATE `businesses` SET `brank` = '10000' WHERE `brank` > '10000'");

$select_businesses = $conn->query("SELECT * FROM `businesses` LEFT JOIN `businesses_classes` ON (`classId` = `busClass`) ORDER BY `busId` ASC");

while($bs=$select_businesses->fetch_assoc())
 {
   $amount = mysqli_num_rows($conn->query(sprintf("SELECT * FROM `businesses_members` WHERE `bmembBusiness` = '%u'", $bs['busId'])));
   $active = mysqli_num_rows($conn->query(sprintf("SELECT * FROM `users_data` WHERE `business` = '%u' AND active='%d'", $bs['busId'], 1)));

$new_customers = ($bs['brank']*($amount)+ rand(5, 20)*$bs['classCost'] / 1000);
$new_profit = (($new_customers)+ rand(110, 990));
$new_rank = (($amount)+ rand(1, 3));
      $conn->query(sprintf("UPDATE `businesses` SET `busYCust` = `busCust`, `busYProfit` = `busProfit`, `busCust` = '%d', `busProfit` = '%d', `busCash` = '%d' WHERE `busId` = '%u'", $new_customers, $new_profit, ($new_profit + $bs['busCash']), $bs['busId']));
$conn->query(sprintf("UPDATE `businesses` SET `busDays` = `busDays` + '1'"));
$conn->query(sprintf("UPDATE `users_data` SET `activedays` = `activedays` + '1' WHERE `active` = '1'"));
$conn->query(sprintf("UPDATE `users_data` SET `active` = '0' WHERE `active` = '1'"));
$conn->query(sprintf("UPDATE `businesses` SET `brank` = `brank` + '%d' WHERE `busId` = '%u'",  $new_rank, $bs['busId']));
 $fetch_members = $conn->query(sprintf("SELECT * FROM `businesses_members` LEFT JOIN `users_data` ON (`userid` = `bmembMember`) LEFT JOIN `businesses_ranks` ON (`rankId` = `bmembRank`) WHERE `bmembBusiness` = '%u'", $bs['busId'])) OR die('Cron not run');
$conn->query("UPDATE users_stats SET labour = labour + 50, IQ = IQ + 50, strength = strength + 50 WHERE userid = {$bs['busDirector']}");
$conn->query("UPDATE users_data SET comppoints = comppoints + 1 WHERE userid = {$bs['busDirector']}");

   while($fm=$fetch_members->fetch_assoc())
    {
    
 $conn->query(sprintf("UPDATE `users_stats ` SET `{$fm['rankPrim']}` = `{$fm['rankPrim']}` + '%.6f', `{$fm['rankSec']}` = `{$fm['rankSec']}` + '%.6f' WHERE (`userid` = '%u')", $fm['rankPGain'], $fm['rankSGain'], $fm['userid'])) OR die('Cron not run');
   
   $conn->query(sprintf("UPDATE `users_finance` SET `money` = `money` + '%d' WHERE `userid` = '%u'", $fm['bmembCash'], $fm['userid'])) OR die('Cron not run');

 $conn->query(sprintf("UPDATE `users_data` SET `comppoints` = `comppoints` + '1' WHERE `userid` = '%u'", $fm['userid'])) OR die('Cron not run');

     

          
if($bs['busCash'] < $fm['bmembCash'])
       {
         $text = "Member ID {$fm['bmembMember']} was not paid their \$".number_format($fm['bmembCash'])." due to lack of funds." OR die('Cron not run');
         $conn->query(sprintf("INSERT INTO `businesses_alerts` (`alertBusiness`, `alertText`, `alertTime`) VALUES ('%u', '%s', '%d')", $bs['busId'], $text, time())) OR die('Cron not run');
         $conn->query(sprintf("UPDATE `businesses` SET `busDebt` = `busDebt` + '%d' WHERE `busId` = '%u'", $fm['bmembCash'], $bs['busId'])) OR die('Cron not run');
       }
      else
       {
         $conn->query(sprintf("UPDATE `businesses` SET `busCash` = `busCash` - '%d' WHERE `busId` = '%u'", $fm['bmembCash'], $bs['busId'])) OR die('Cron not run');
       }
    }
   if($bs['busDebt'] > $bs['classCost'])
    {
      $send_event = $conn->query(sprintf("SELECT `bmembMember` FROM `businesses_members` WHERE `bmembBusiness` = '%u' ORDER BY `bmembId` DESC", $bs['busId'])) OR die('Cron not run') ;
      while($se=$send_event->fetch_assoc())
       {
         $text = "The {$bs['busName']} business went bankrupt\, all members have been made redundent." OR die('Cron not run');
         event_add($se['bmembMember'], $text);
       }
      $conn->query(sprintf("DELETE FROM `businesses_members` WHERE (`bmembBusiness` = '%u')", $bs['busId'])) OR die('Cron not run');
      $conn->query(sprintf("DELETE FROM `businesses` WHERE (`busId` = '%u')", $bs['busId'])) OR die('Cron not run');
    }
 }

///business cron end

///cron player


$conn->query("UPDATE fedjail set fed_days=fed_days-1");
$q=$conn->query("SELECT * FROM fedjail WHERE fed_days=0");
$ids=array();
while($fr=$q->fetch_assoc())
{
$ids[]=$fr['fed_userid'];
}
if(count($ids) > 0)
{
$conn->query("UPDATE users_data SET fedjail=0 WHERE userid IN(".implode(",", $ids).")");
}

$userid = $conn->query("SELECT userid FROM users_data");
while($i=$userid->fetch_assoc())
{
$hourlyMoney = rand(750,5000);
$hourlyPoints = rand(1,25);
$hourlyexp = rand(10,100);
$week = time() - (60*60);
event_add($i['userid'],"<b>Thank you for playing today! You have been rewarded:</b> ".money_formatter($hourlyMoney).",  ".number_format($hourlyPoints)." crystals, ".$hourlyexp." exp and 1 merit points.",$c);
$conn->query("UPDATE users_data SET main = main +{$hourlyMoney}, second= second+{$hourlyPoints}, hourlyReward = 60 WHERE userid={$i['userid']}");
$conn->query("UPDATE users_finance SET money=money+$hourlyMoney WHERE userid={$i['userid']}");
$conn->query("UPDATE users_data SET merits=merits+1 WHERE userid={$i['userid']}");
$conn->query("UPDATE users_finance SET crystals=crystals+$hourlyPoints WHERE userid={$i['userid']}");
$conn->query("UPDATE users_vitals SET exp=exp+$hourlyexp WHERE userid={$i['userid']}");

}
$conn->query("TRUNCATE TABLE challengesbeaten");
$conn->query("DELETE FROM fedjail WHERE fed_days=0");
$conn->query("UPDATE users_data SET daysingang=daysingang+1, mgang=mgang+1 WHERE gang > 0");
$conn->query("UPDATE users_data SET daysold=daysold+1, mdaysold=mdaysold+1, boxes_opened=0");
$conn->query("UPDATE users_freeze SET mailban=mailban-1 WHERE mailban > 0");
$conn->query("TRUNCATE TABLE chat2");
$conn->query("UPDATE users_freeze SET forumban=forumban-1 WHERE forumban > 0");
$conn->query("UPDATE users_data SET rob=0 where rob=1");
$conn->query("UPDATE users_data SET voting=0");
$conn->query("UPDATE users_data SET vip=vip-1 WHERE vip > 0");

$conn->query("UPDATE users_finance SET bankmoney=bankmoney*1.02 WHERE bankmoney > 0 AND bankmoney < 50000000");
$conn->query("UPDATE users_finance SET bankmoney=bankmoney*1.04 WHERE bankmoney > 0 AND vip > 0");


$conn->query("UPDATE users_data SET cdays=cdays-1 WHERE course > 0");
$q=$conn->query("SELECT * FROM users_data WHERE cdays=0 AND course > 0");
while($r=$q->fetch_assoc())
{
$cd=$conn->query("SELECT * FROM courses WHERE crID={$r['course']}");
$coud=$cd->fetch_assoc();
$userid=$r['userid'];
$conn->query("INSERT INTO coursesdone VALUES({$r['userid']},{$r['course']})");
$upd="";
$ev="";
if($coud['crSTR'] > 0)
{
$upd.=",us.strength=us.strength+{$coud['crSTR']}";
$ev.=", {$coud['crSTR']} strength";
}
if($coud['crGUARD'] > 0)
{
$upd.=",us.guard=us.guard+{$coud['crGUARD']}";
$ev.=", {$coud['crGUARD']} guard";
}
if($coud['crLABOUR'] > 0)
{
$upd.=",us.labour=us.labour+{$coud['crLABOUR']}";
$ev.=", {$coud['crLABOUR']} labour";
}
if($coud['crAGIL'] > 0)
{
$upd.=",us.agility=us.agility+{$coud['crAGIL']}";
$ev.=", {$coud['crAGIL']} agility";
}
if($coud['crIQ'] > 0)
{
$upd.=",us.IQ=us.IQ+{$coud['crIQ']}";
$ev.=", {$coud['crIQ']} IQ";
}
$ev=substr($ev,1);
if ($upd) {
$conn->query("UPDATE users_data u LEFT JOIN users_stats us ON u.userid=us.userid SET us.userid=us.userid $upd WHERE u.userid=$userid");
}
$conn->query("INSERT INTO events (evUSER, evTIME, evREAD, evTEXT) VALUES($userid,unix_timestamp(),0,'Congratulations, you completed the {$coud['crNAME']} and gained $ev!')");
}
$conn->query("UPDATE users_data SET course=0 WHERE cdays=0");
$conn->query("TRUNCATE TABLE users_activitylogs;");
$conn->query("TRUNCATE TABLE votes;");
$conn->query("UPDATE users_vitals SET turns=25");
$conn->query("UPDATE users_data SET amount=0");
$conn->query("TRUNCATE TABLE rating");

    $rez = $conn->query("SELECT `gangID` FROM `gangs`");
    while($rowx = $rez->fetch_assoc())
    {                                       
        $check = $conn->query("SELECT `gang` FROM `users_data` WHERE `gang` = ".$rowx['gangID']."");
        if (!$check->fetch_assoc())
        {
            $del = $conn->query("DELETE FROM `gangs` WHERE `gangID` = ".$rowx['gangID']."");
        } 
    }
?>