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


//brave update
$query1="UPDATE users_vitals SET brave=brave+((maxbrave/(12.5))+1) WHERE brave<maxbrave ";
$query3="UPDATE users_vitals SET brave=brave+((maxbrave/(12.5))+1) WHERE brave<maxbrave AND vip>0";
$query4="UPDATE users_vitals SET brave=maxbrave WHERE brave>maxbrave";
$query5="UPDATE users_vitals SET hp=hp+(maxhp/(12.5)) WHERE hp<maxhp";
$query6="UPDATE users_vitals SET hp=maxhp WHERE hp>maxhp";
$query7="UPDATE users_vitals SET hp=maxhp WHERE class='3'";
$conn->query($query1);
$conn->query($query3);
$conn->query($query4);
$conn->query($query5);
$conn->query($query6);
$conn->query($query7);
//enerwill update
$query7="UPDATE users_vitals SET energy=energy+(maxenergy/(12.5)) WHERE energy<maxenergy";
$query9="UPDATE users_vitals SET energy=energy+(maxenergy/(12.5)) WHERE energy<maxenergy AND vip>0";
$query10="UPDATE users_vitals SET energy=maxenergy WHERE energy>maxenergy";
$query11="UPDATE users_vitals SET will=will+(maxwill/(12.5)) WHERE will<maxwill";
$query13="UPDATE users_vitals SET will=will+(maxwill/(12.5)) WHERE will<maxwill AND vip>0";
$query14="UPDATE users_vitals SET will=maxwill WHERE will>maxwill";
$conn->query($query7);
$conn->query($query9);
$conn->query($query10);
$conn->query($query11);
$conn->query($query13);
$conn->query($query14);


$stocks = $conn->query("SELECT stockID FROM `stock_stocks`");
while($soc = $stocks->fetch_assoc())    {
    $rand = mt_rand(1,2);
    if($rand == 2)    {
        $mr = mt_rand(100,1000);
        $conn->query("UPDATE `stock_stocks` SET `stockUD` = 2, `stockCHANGE` = ".$mr.", `stockNPRICE` = (`stockNPRICE` - ".$mr.") WHERE `stockID` = ".$soc['stockID']);
    }
    else    {
        $mr = mt_rand(10,100);
        $conn->query("UPDATE `stock_stocks` SET `stockUD` = 1, `stockCHANGE` = ".$mr.", `stockNPRICE` = (`stockNPRICE` + ".$mr.") WHERE `stockID` = ".$soc['stockID']);
    }
}
$sel = $conn->query("SELECT stockID,stockNAME FROM `stock_stocks` WHERE `stockNPRICE` < 0");
while($soc = $sel->fetch_assoc())    {
    if(mysqli_num_rows($conn->query("SELECT holdingID FROM `stock_holdings` WHERE `holdingSTOCK` = ".$soc['stockID'])))    {
        $user = $conn->query("SELECT holdingUSER FROM `stock_holdings` WHERE `holdingSTOCK` = ".$soc['stockID']);
        $user = $user->fetch_assoc();
        event_add($user['holdingUSER'], 'Stock '.$soc['stockNAME'].' crashed, you lost all your shares.'); 
        $conn->query("DELETE FROM `stock_holdings` WHERE `holdingSTOCK` = ".$soc['stockID']);
    $conn->query("UPDATE `stock_stocks` SET `stockUD` = 1,`stockCHANGE` = 0,`stockNPRICE` = `stockOPRICE` WHERE `stockID` = ".$soc['stockID']);
    }
  
}

?>