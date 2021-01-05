<?php
include "globals.php";

print "<h3>Underground</h3>
<span class='help'>Welcome to the Underground Fight Club! Here you can challenge NPCs for money.</span>
<table width=100% cellspacing=1 class='table'><tr style='background: gray; '><th>Bot</th><th>&nbsp;</th></tr>";
$q=$db->query("SELECT cb.*,u.*,c.npcid,cy.cityname FROM challengebots cb LEFT JOIN users u ON cb.cb_npcid=u.userid LEFT JOIN challengesbeaten c ON c.npcid=u.userid AND c.userid=$userid LEFT JOIN cities cy ON u.location=cy.cityid ORDER BY u.level ASC");
while($r=$db->fetch_row($q))
{
$earn=$r['cb_money'];
$v=$r['userid'];

if($v){
$qt=$db->query("SELECT count(*) FROM challengesbeaten WHERE npcid=$v");
$times=$db->fetch_single($qt);
print "<tr><td><b>{$r['username']}</b><br/><span class='info'>loc:</span>&nbsp;{$r['cityname']} <span class='info'>lvl:</span>&nbsp;{$r['level']} ";
if($r['hp'] >= $r['maxhp']/2 and $r['location']==$ir['location'] and !$ir['hospital'] and !$ir['jail'] and !$r['hospital'] and !$r['jail']) { print "<font color=green>Ready</font>"; } else { print "<font color=red>Dead</font>"; }
print "</td><td align='center'>";
if($r['npcid'])
{
print "<i>Reward: Exp Only</i> <a href='attack.php?ID={$r['userid']}' data-role='button' data-theme='a' class='bluediv'>Attack</a>";
}
else
{
print "<span class='info'>Reward:</span>".money_formatter($earn)." <a href='attack.php?ID={$r['userid']}' data-role='button' data-theme='b' class='bluediv'>Attack</a>";
}
print "</td></tr>";

}

}
print "</table><a data-role='button' data-rel='back' href='index.php'>Back</a>";
$h->endpage();
?>