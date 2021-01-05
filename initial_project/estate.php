<?php
include "globals.php";
if($ir['jail'] or $ir['hospital']) { die("This page cannot be accessed while in jail or hospital."); }
$mpq=mysql_query("SELECT * FROM houses WHERE hWILL={$ir['willmax']}",$c);
$mp=mysql_fetch_array($mpq);
$_GET['property']=abs((int) $_GET['property']);
if($_GET['property'])
{
$npq=mysql_query("SELECT * FROM houses WHERE hID={$_GET['property']}",$c);
$np=mysql_fetch_array($npq);
if($np['hWILL'] < $mp['hWILL'])
{
print "You cannot go backwards in houses!<br/><a href='estate.php' data-rel='back' data-role='button'>Back</a>";
}
else if ($np['hPRICE'] > $ir['money'])
{
print "You do not have enough money to buy the {$np['hNAME']}.<br/><a href='estate.php' data-rel='back' data-role='button'>Back</a>";
}
else
{
mysql_query("UPDATE users SET money=money-{$np['hPRICE']},maxwill={$np['hWILL']},willmax={$np['hWILL']} WHERE userid=$userid",$c);
print "Congrats, you bought the {$np['hNAME']} for \${$np['hPRICE']}!<br/><a href='estate.php' data-rel='back' data-role='button'>Back</a>";
}
}
else if (isset($_GET['sellhouse']))
{
$npq=mysql_query("SELECT * FROM houses WHERE hWILL={$ir['willmax']}",$c);
$np=mysql_fetch_array($npq);
if($ir['willmax'] == 100)
{
print "You already live in the lowest property!<br/><a href='estate.php' data-rel='back' data-role='button'>Back</a>";
}
else
{
mysql_query("UPDATE users SET money=money+({$np['hPRICE']}*0.7),maxwill=100,willmax=100, will=maxwill WHERE userid=$userid",$c);
$saleprice = $np['hPRICE']*0.7;
print "<span class='help'>You sold your {$np['hNAME']} for \$".money_formatter($saleprice,'')." and went back to living with your parents.</span><br/><a href='estate.php' data-rel='back' data-role='button'>Back</a>";
}
}
else
{
print "
<h2>Real Estate</h2>
<span class='help'>Real Estate increases your will. Higher will increases crime success and training at the gym. Types of Real Estate you can buy are listed below!</span>
<div class='housebox'><div class='housetype'>Your current property:</div>
<div class='house'>";
  $saleprice = $mp['hPRICE']*0.7;
  print"
  <div class='current_house'><img class='house_icon' src='images/realestate/{$mp['hID']}.png' title='{$mp['hNAME']}' alt='{$mp['hNAME']}'><span class='title'>{$mp['hNAME']}</span>Value: \$".money_formatter($saleprice,'')."</div>
  <br class='clear'/>";
    if($ir['willmax'] > 100)
  {
   $saleprice = $mp['hPRICE']*0.7;
   print "<div><a data-role='button' href='estate.php?sellhouse' data-theme='e'>Sell</a></div>";
  }
  
  print "
</div>
</div>
<p>Available Real Estate:</p>
";

$hq=mysql_query("SELECT * FROM houses WHERE hWILL>{$ir['willmax']} ORDER BY hWILL ASC",$c);
while($r=mysql_fetch_array($hq))

{
print "<div class='housebox'>";
$hq=mysql_query("SELECT * FROM houses WHERE hWILL>{$ir['willmax']} ORDER BY hWILL ASC",$c);
while($r=mysql_fetch_array($hq))
{
$saleprice = $r['hPRICE']*0.7;
print "
<div class='house'>
  <div class='house_info'><span class='title'>{$r['hNAME']}</span>
  <img class='house_icon' src='images/realestate/{$r['hID']}.png' title='{$r['hNAME']}' alt='{$r['hNAME']}'>
  <span style='color:limegreen;'>\$$t".money_formatter($r['hPRICE'],'')."</span><br/><span class='info'>Sell: \$$t".money_formatter($saleprice,'')."</span><br/><span style='color:white; font-weight:bold;'>Will: {$r['hWILL']}</span>
  </div>
  <div class='house_cost'><br/><a data-role='button' href='estate.php?property={$r['hID']}' class='bluediv' data-theme='b'>Buy</a></div>
  <br class='clear' />
</div>
";
}
print "</div>";
}
}
$h->endpage();
?>