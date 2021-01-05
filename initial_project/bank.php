<?php
include "globals.php"; 
if($ir['bankmoney']>-1)
{
switch($_GET['action'])
{
case "deposit":
deposit();
return;

case "withdraw":
withdraw();
return;

default:
index();
return;
}

}
else
{
if(isset($_GET['buy']))
{
if($ir['money']>14999)
{
print "Congratulations, you bought a bank account for \$15,000!<br />
<a href='bank.php' data-rel='back' data-role='button'>Start using my account</a>";
$conn->query("UPDATE users SET money=money-15000,bankmoney=0 WHERE userid=$userid");
}
else
{
print "You do not have enough money to open an account.
<a data-role='button' data-rel='back' href='explore.php'>Back</a>";
}
}
else
{ 
print "Open a bank account today, just \$15,000!<br />
<a href='bank.php?buy' data-role='button'>Yes, sign me up!</a>";
}
}
function index()
{
global $conn, $ir,$c,$userid,$h;
   if($ir['bankinterest'] > 0)
  {
  
  print"
<span class='help'><img src='http://mafiamobi.com/smileys/exp.gif'> <b>You currently have an active premium interest and your balance will go up by 4% instead of 2%!</b></span>";

  }


if($ir['vip'] >0)
  {
      
    $cap=" <font color=green>Limits lifted</font>";
    $interest =" <font color=green>4%</font>";
   $bank = ($ir['bankmoney']*1.04);
  }
  else
  {
      
    $cap=" <font color=red>$50,000,000</font>";
    $interest =" <font color=green>2%</font>";
   $bank = ($ir['bankmoney']*1.02);
  }
  print "\n<h3>You currently have <font color=green>".money_formatter($ir['bankmoney'])." </font> in the bank.</h3>
  \n<h2>Your bank balance at the end of the day will be <font color=limegreen>".money_formatter($bank)." </font></h2>
";
print"
Bank Limitations: $cap <br />
Interest Rate: $interest
<table width='100%' cellspacing=1 class='regular'>
<tr>
<td width='100%' align='center'>
<br /><b>Deposit Money</b><br /><br />
It will cost you 15% of the money you deposit, rounded up.<br /><br /><form action='bank.php?action=deposit' method='post'>
Amount: <input type='number' name='deposit' min='1' value='{$ir['money']}'  /><br />
<input type='submit' value='Deposit' /></form>
</td>
<td><hr/></td></tr>
<tr>
<td width='100%' align='center'>
<br /><b>Withdraw Money</b><br /><br />
There is no fee on withdrawals.<br /><br /><form action='bank.php?action=withdraw' method='post'>
Amount: <input type='number' name='withdraw' min='1' value='{$ir['bankmoney']}' /><br />
<input type='submit' value='Withdraw' /></form>
</td>
</tr>
</table>";
}
function deposit()
{
  global $conn,$ir,$c,$userid,$h;
  $_POST['deposit']=abs((int) $_POST['deposit']);
  if($_POST['deposit'] > $ir['money'])
  {
  print "You do not have enough money to deposit this amount.<a href='bank.php' data-rel='back' data-role='button'>Back</a>";
  }
   elseif($ir['bankmoney'] > 49999999 && $ir['vip']==0){
  print "You have more than \$50,000,000 in your account. You can not deposit anymore. If you have more than \$50,000,000 to protect, get a vip pack to lift the limits. You can get one when you donate to the game.<br><a href='bank.php' data-rel='back' data-role='button'>Back</a>";
  }
  elseif($ir['bankmoney'] + $_POST['deposit'] >= 50000000 && $ir['vip']==0){
  print "The amount you are trying to deposit and the amount you have in the bank equals to more than \$50,000,000. Regular bank is capped at \$50,000,000. If you want to protect larger amounts of cash, get a vip pack. You can get one when you donate to the game.<a href='bank.php' data-rel='back' data-role='button'>Back</a>";
  }
  else
  {
  $fee=ceil($_POST['deposit']*15/100);
  if($fee > 50000000) { $fee=50000000; }
  $gain=$_POST['deposit']-$fee;
  $ir['bankmoney']+=$gain;
  $conn->query("UPDATE users SET bankmoney=bankmoney+$gain, money=money-{$_POST['deposit']} where userid=$userid");
  print "You hand over  ".money_formatter($_POST['deposit'])." to be deposited, <br />
  after the fee is taken (".money_formatter($fee)."), ".money_formatter($gain)." is added to your account. <br />
  <b>You now have ".money_formatter($ir['bankmoney'])." in the bank.</b><br />
  <a href='bank.php' data-rel='back' data-role='button'>Back</a>";
  }

}
function withdraw()
{
global $conn,$ir,$c,$userid,$h;
$_POST['withdraw']=abs((int) $_POST['withdraw']);
if($_POST['withdraw'] > $ir['bankmoney'])
{
print "You do not have enough banked money to withdraw this amount.<a data-role='button' data-rel='back' href='bank.php'>Back</a>";
}
else
{

$gain=$_POST['withdraw'];
$ir['bankmoney']-=$gain;
$conn->query("UPDATE users SET bankmoney=bankmoney-$gain, money=money+$gain where userid=$userid");
print "You ask to withdraw ".money_formatter($gain).", <br />
the banking lady grudgingly hands it over. <br />
<b>You now have ".money_formatter($ir['bankmoney'])." in the bank.</b><br />
<a href='bank.php' data-rel='back' data-role='button'>Back</a>";
}
}
$h->endpage();
?>