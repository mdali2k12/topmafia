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

 
//Money Lotto
$ticketssold1=$conn->query("SELECT * FROM moneylotto");
$ticketssold = mysqli_num_rows($ticketssold1);
$payout=($ticketssold*250000)*0.80;
$rand=rand(1,$ticketssold);
$win=$conn->query("SELECT * FROM moneylotto WHERE ticketid=$rand");
$winner = $win->fetch_assoc();

event_add($winner['userid'],"Congratulations! You have won the weekly lottery, and claimed your ".money_formatter($payout)." reward! (Check your Bank account)",$c);

$conn->query("INSERT INTO announcements VALUES ('User ID {$winner['userid']} won <b>".money_formatter($payout)."</b> at the weekly lottery. Well done!', unix_timestamp())");
$conn->query("UPDATE users SET new_announcements=new_announcements+1");
$conn->query("UPDATE users_finance SET bankmoney=bankmoney+$payout WHERE userid={$winner['userid']}");
$conn->query("TRUNCATE TABLE moneylotto");
$conn->query("INSERT INTO moneylottowinners (winner, amount) VALUES ('{$winner['userid']}', '$payout')");
//Money Lotto End
 
//Points Lotto
$ticketssold=mysqli_num_rows($conn->query("SELECT * FROM crystallotto"));
$payout=($ticketssold*100)*0.80;
$rand=rand(1,$ticketssold);
$win=$conn->query("SELECT * FROM crystallotto WHERE ticketid=$rand");
$winner = $win->fetch_assoc();
event_add($winner['userid'],"Congratulations! You have won the weekly Crystal lottery, and claimed your $payout crystals reward! (Check your crystal locker)",$c);
$conn->query("INSERT INTO announcements VALUES('User ID {$winner['userid']} won <b>$payout</b> crystals at the weekly Crystal lottery. Well done!', unix_timestamp())");
$conn->query("UPDATE users SET new_announcements=new_announcements+1");
$conn->query("UPDATE users_finance SET bankcrystal=bankcrystal+$payout WHERE userid={$winner['userid']}");
$conn->query("TRUNCATE TABLE crystallotto");
$conn->query("INSERT INTO crystallottowinners (winner, amount) VALUES ('{$winner['userid']}', '$payout')");
//Points Lotto End
 
?>