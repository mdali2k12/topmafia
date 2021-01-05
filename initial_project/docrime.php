<?php
$macropage="docrime.php?c={$_GET['c']}";
include "globals.php";
if($ir['jail'] or $ir['hospital']) { die("This page cannot be accessed while in jail or hospital."); }
$_GET['c']=abs((int) $_GET['c']);
if(!$_GET['c'])
{
print "Invalid crime <br /><a href='criminal.php' data-role='button' data-inline='true'>Back</a>";
}
else
{
    
$q=mysql_query("SELECT * FROM crimes WHERE crimeID={$_GET['c']}",$c);
$r=mysql_fetch_array($q);
if($ir['brave'] < $r['crimeBRAVE'])
{
print "You do not have enough Brave to perform this crime. <br />";
}
else
{
$ec="\$sucrate=".str_replace(array("LEVEL","CRIMEXP","EXP","WILL","IQ"), array($ir['level'], $ir['crimexp'], $ir['exp'], $ir['will'], $ir['IQ']),$r['crimePERCFORM']).";";
eval($ec);
print "<br/><br/>";
print $r['crimeITEXT'];
$ir['brave']-=$r['crimeBRAVE'];
mysql_query("UPDATE users SET brave={$ir['brave']} WHERE userid=$userid",$c);
mysql_query("UPDATE users SET crimes=crimes+1 WHERE userid=$userid",$c);
if(rand(1,100) <= $sucrate)
{
print str_replace("{money}",$r['crimeSUCCESSMUNY'],$r['crimeSTEXT']);
$ir['money']+=$r['crimeSUCCESSMUNY'];
$ir['crystals']+=$r['crimeSUCCESSCRYS'];
if($ir['vip'] > 0) 
{
$ir['exp']+=(int) ($r['crimeXP']*80);
$exp = ($r['crimeXP']*80);
}
elseif($ir['tripleweek'] > 0) 
{
$ir['exp']+=(int) ($r['crimeXP']*140);
$exp = ($r['crimeXP']*120);
}
else{
$ir['exp']+=(int) ($r['crimeXP']*40);
$exp = ($r['crimeXP']*40);
}
if($r['crimeSUCCESSCRYS']){
print "<br/><span class='crystals'>and <img src='imageicons/ruby.png'> ".$r['crimeSUCCESSCRYS']." crystals!";
}

print "<br/><img src='images/success.png'><br/><br/>You walk away with<br/><span style='color:limegreen;'><img src='images/money.gif'> ".money_formatter($r['crimeSUCCESSMUNY'])."</span><br/><span style='color:green;'> XP: +$exp </span><br /> <img src='images/exp.gif'> <font color=cyan><b>+".$r['crimeXP']." points</font></b>";

mysql_query("UPDATE users SET money={$ir['money']}, crystals={$ir['crystals']},exp={$ir['exp']}, exp_gained=exp_gained+$exp, crimexp=crimexp+{$r['crimeXP']} WHERE userid=$userid",$c);
mysql_query("UPDATE users SET crimes=crimes+1 WHERE userid=$userid",$c);
mysql_query("UPDATE users SET crimesp=crimesp+1 WHERE userid=$userid",$c);
mysql_query("UPDATE users SET hcrimes=hcrimes+1 WHERE userid=$userid",$c);



if(($r['crimeSUCCESSITEM']) && (rand(1,4) == 1))
  {
	item_add($userid, $r['crimeSUCCESSITEM'], 1);
	$itemid=$r['crimeSUCCESSITEM'];
	$q=$db->query("SELECT * FROM items WHERE itmid=$itemid LIMIT 1");
    $id=$db->fetch_row($q);
	print "<br/><br/><span class='loot'>And you looted 1 ".$id['itmname']."!</span><br/>";
	print "<img src='images/items/".$id['itmid'].".png'/>";
  }
}
else
{
  if(rand(1,2) == 1)
  {
   print"<h2>You Failed!</h2>";
   print "<span class='help'>Perhaps you should increase your will to get better chance of success!</span><br/><a href='criminal.php' data-role='button' data-rel='back'>Back</a>";
   mysql_query("UPDATE users SET crimesf=crimesf+1 WHERE userid=$userid",$c);

  }
  elseif($ir['jailavoid'] > 0)
  {
    	
   	print "<img src='/images/busted.png' alt='busted'><span class='help'>Perhaps you should increase your will to get better chance of success! <br /> <font color=red><b>+++ You manage to get away from being thrown in jail.  Your badge has {$ir['jailavoid']}  minutes remaining!</b></font></span><br/><a href='criminal.php' data-role='button' data-rel='back'>Back</a>";
   	
   	mysql_query("UPDATE users SET crimesf=crimesf+1 WHERE userid=$userid",$c);


  }
  else {
      
   	print "<br/><img src='/images/busted.png' alt='busted'><br/><span class='help'>Perhaps you should increase your will to get better chance of success!</span><br/><a href='criminal.php' data-role='button' data-rel='back'>Back</a>";
   feed_add(1,"<b><font color=red>{$ir['username']}</font></b> just got busted doing crimes and is in jail! <a href='jail.php'>[view]</a>",$c);
       $db->query("UPDATE `users` SET `jail` = '$r[crimeJAILTIME]', `jail_reason` = '$r[crimeJREASON]' WHERE `userid` = '$userid'");   	mysql_query("UPDATE users SET crimesf=crimesf+1 WHERE userid=$userid",$c);


  }
}

print "
<br/><br/>
<div data-inline='true'>
<a href='criminal.php' data-rel='back' data-role='button' data-inline='true'>Back</a>";
	echo '<a href="docrime.php?c='.$_GET['c'].'" data-role="button" data-theme="b" rel="external" data-inline="true">Try Again</a>';

	print"
</div>";
}
}

$h->endpage();
?>