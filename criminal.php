<?php
$macropage="criminal.php";
include "globals.php";
if($ir['jail'] or $ir['hospital']) { die("This page cannot be accessed while in jail or hospital."); }
$dollar = "$";
$q2=$db->query("SELECT * FROM crimes WHERE crimeBRAVE <= {$ir['maxbrave']} ORDER BY crimeBRAVE ASC");
while ($r2=$db->fetch_row($q2))
{
$crimes[]=$r2;
}
$q=$db->query("SELECT * FROM crimegroups ORDER by cgORDER ASC");
print "
<div>
<h2>Crime Center</h2>";
if($ir['crimebonus'] > 0){
       print"
<span class='help'><img src='https://mafiamobi.com/smileys/exp.gif'> <b>You are currently receiving double xp gain for {$ir['crimebonus']} minutes!</b></span>";

  
}

    if($ir['tripleweek'] > 0)
  {
  
  print"
<span class='help'><img src='https://mafiamobi.com/smileys/exp.gif'> <b>You are currently receiving  3x  gain in your exp!</b></span>";

  }
if($ir['jailavoid'] > 0){
       print"
<span class='help'><img src='https://mafiamobi.com/smileys/exp.gif'> <b>You will avoid going jail on failed crimes for {$ir['jailavoid']} minutes!</b></span>";

  
}
print"
<span class='help'>Complete crimes to gain experience and level up! Crimes require brave points and reward you with crystals and cash!</span><br/>

<table width='100%'>
<tr>
<td><img src='https://www.mafiamobi.com/smileys/exp.gif'> Crime Points: ".number_format($ir['crimexp'])." <a href='crimetrade.php'>[use]</a>
</td>
<td>Crimes Passed: <font color=limegreen> ".number_format($ir['crimesp'])."</font>
</td>
<td>Crimes Failed:  <font color=red>".number_format($ir['crimesf'])."</font>
</td>
<td>Total Crimes: ".number_format($ir['crimes'])."
</td>
</tr>
</table>";

print"</div>";
while($r=$db->fetch_row($q))
{
print "<div class='crimebox'><div class='crimetype'>{$r['cgNAME']}</div>";
foreach($crimes as $v)
  {
  if($v['crimeGROUP'] == $r['cgID'])
    {
      print "
    	<div class='ui-grid-a crime'>
    	<div class='ui-block-a'><div class='crime_info'><span class='title'>{$v['crimeNAME']}</span>
    	<span style='color:limegreen;'><img src='images/money.gif'>".money_formatter($v['crimeSUCCESSMUNY'])."</span><br/>";
    	
    	print"<span style='color:lightblue;'><img src='images/exp.gif'> {$v['crimeXP']}</span>";
    	
    	if($v['crimeSUCCESSCRYS']){
    	print" <span class='crystals'><img src='imageicons/ruby.png'> {$v['crimeSUCCESSCRYS']}</span>";
    	}
    	
    	if($v['crimeSUCCESSITEM']){
    	print"<br/><span class='loot'>chance of loot</span>";
    	}
    	
    	print"</div></div>
    	<div class='ui-block-b'><br/>{$v['crimeBRAVE']} <img src='images/brave_icon.gif'><br/><a data-role='button' class='bluediv' href='docrime.php?c={$v['crimeID']}' data-theme='b'>Commit</a></div>
    	</div>
      ";
    }
  }
print "</div>";
}
$h->endpage();
?>
