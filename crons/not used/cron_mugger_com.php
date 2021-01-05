<?php
  
//Mugger of the hour.
//sniko
//Free system
//Code for show on head selfie.
//2014.
  
ini_set('display_errors', 1);
error_reporting(E_ALL);
 
define("NO1_CRYSTALS", 30); //Top hour reward
define("TOP_EVER_CRYSTALS", 30); //Top ever reward
define("TOP_24_CRYSTALS", 100); //Top 24 hour mugger
  
require_once('globals.php');
 
 if (!isset($_GET['code']) || $_GET['code'] !== $_CONFIG['code']) {
echo "Wrong code";
    exit;
}
  
//Grab all of the muggers
$strDbQuery = "SELECT `uid`,`total_mugs`,`total_mugged` 
               FROM `mugger_oth`
               WHERE `date_start` >= DATE_SUB(DATE_FORMAT(NOW(), '%Y-%m-%d %k:%i:%s'), INTERVAL 1 hour) 
                 AND `date_start` <= DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-%d %k:%i:%s'), INTERVAL 1 hour)
               ORDER BY `total_mugs` DESC
               LIMIT 1";
  
$arrTopPerson = $db->fetch_row( $db->query($strDbQuery) );
if( empty($arrTopPerson) == FALSE ) {
 
echo PHP_EOL ."";
echo "Awarding the top mugger of this hour. ID: ". $arrTopPerson['uid'];
echo PHP_EOL ."";
 
    //Awards to the top guy (or girl) for this hour.
    $db->query("UPDATE `users` SET `crystals`=`crystals`+". NO1_CRYSTALS ." WHERE `userid` = ". $arrTopPerson['uid']);
    $db->query("UPDATE mugger_oth_global SET `uid` = ". $arrTopPerson['uid'] .", `total_mugs` = ". $arrTopPerson['total_mugs'] .", `total_mugged` = ". $arrTopPerson['total_mugged'] ." WHERE `entry_type` = 'top_hour'");
    unset($arrTopPerson);
}
  
//@todo: update mugger_oth_global
//Update top ever mugger (if they've participated this hour)
$objDb = $db->query("SELECT `uid`,`total_mugs`,`total_mugged` 
                     FROM `mugger_oth`
                     WHERE `date_start` >= DATE_SUB(DATE_FORMAT(NOW(), '%Y-%m-%d %k:%i:%s'), INTERVAL 1 hour) 
                       AND `date_start` <= DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-%d %k:%i:%s'), INTERVAL 1 hour)
                       AND `uid` = (SELECT `uid` FROM `mugger_oth_global` WHERE `entry_type` = 'top_ever')");
if( $db->num_rows($objDb) ) {
    //He (or she!) participated this hour!
    $arrTopEver = $db->fetch_row($objDb);
 
echo PHP_EOL ."";
echo "Updating top muggers total mugs: ". $arrTopEver['uid'];
echo PHP_EOL ."";
echo "Top mugger has ". $arrTopEver['total_mugs'] ." this hour!";
 
    $db->query("UPDATE `mugger_oth_global`
                SET `total_mugs` = `total_mugs` + ". $arrTopEver['total_mugs'] .",
                    `total_mugged` = `total_mugged` + ". $arrTopEver['total_mugged'] ."
                WHERE `uid` = ". $arrTopEver['uid']);
}
  
//Now, see if anybody has beaten the top mugger ever.
$strDbQuery = "SELECT `uid`,`total_mugs` 
               FROM mugger_oth_global
               WHERE `entry_type` = 'top_ever'";
$arrTopEver = $db->fetch_row($db->query($strDbQuery));
  
$strDbQuery = "SELECT `uid`,SUM(`total_mugs`) AS total_ever_mugs,SUM(`total_mugged`) AS `total_ever_mugged`
               FROM `mugger_oth`
               GROUP BY `uid`
               HAVING SUM(`total_mugs`) > ". $arrTopEver['total_mugs'] ."
               ORDER BY SUM(`total_mugs`) DESC 
               LIMIT 1";
$objDb = $db->query($strDbQuery);
if( $db->num_rows($objDb) ) {
    //Holy balls.
    //Someone has beat the total ever guy (or girl!)
    $arrNewTopEver = $db->fetch_row($objDb);
 
echo PHP_EOL ."";
echo "Someone beat the top mugger of all time. New top mugger: ". $arrNewTopEver['uid'];
echo PHP_EOL ."";
echo "Old top mugger: ". $arrTopEver['uid'];
 
    $db->query("UPDATE mugger_oth_global SET `uid` = ". $arrNewTopEver['uid'] .", `total_mugs` = ". $arrNewTopEver['total_ever_mugs'] .", `total_mugged` = ". $arrNewTopEver['total_ever_mugged'] ." WHERE `entry_type` = 'top_ever'");
 
    $db->query("UPDATE `users` SET `crystals`=`crystals`+". TOP_EVER_CRYSTALS ." WHERE `userid` = ". $arrNewTopEver['uid']);
    event_add($arrNewTopEver['uid'], "You are now the top ranking mugger! You are rewarded with ". TOP_EVER_CRYSTALS ." crystals.");
    event_add($arrTopEver['uid'], "You are no longer the top mugger!");
}
unset($objDb, $arrTopEver);
  
  
//Now, see if anybody has overtaken the previous top hour guy (or girl!)
$strDbQuery = "SELECT `uid`,`total_mugs` 
               FROM mugger_oth_global
               WHERE `entry_type` = 'top_24'";
$arrTop24 = $db->fetch_row($db->query($strDbQuery));
  
$strDbQuery = "SELECT `uid`,SUM(`total_mugs`) AS total_24_mugs,SUM(`total_mugged`) AS total_24_mugged
               FROM `mugger_oth`
               WHERE `date_start` >= DATE_SUB(DATE_FORMAT(NOW(), '%Y-%m-%d %k:%i:%s'), INTERVAL 24 hour) 
                 AND `date_start` <= DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-%d %k:%i:%s'), INTERVAL 24 hour)
               GROUP BY `uid`
               HAVING SUM(`total_mugs`) > ". $arrTop24['total_mugs'] ."
               ORDER BY SUM(`total_mugs`) DESC
               LIMIT 1";
$objDb = $db->query($strDbQuery);
if( $db->num_rows($objDb) ) {
    //Holy balls.
    //Someone has beat the total 24 guy (or girl!)
    $arrNewTopEver = $db->fetch_row($objDb);
 
echo PHP_EOL ."";
echo "Someone beat the top mugger 24hour mugger. New top 24hour mugger: ". $arrNewTopEver['uid'];
echo PHP_EOL ."";
echo "Old top mugger: ". $arrTop24['uid'];
 
    $db->query("UPDATE mugger_oth_global SET `uid` = ". $arrNewTopEver['uid'] .", `total_mugs` = ". $arrNewTopEver['total_24_mugs'] .", `total_mugged` = ". $arrNewTopEver['total_24_mugged'] ." WHERE `entry_type` = 'top_24'");
 
    $db->query("UPDATE `users` SET `crystals`=`crystals`+". TOP_24_CRYSTALS ." WHERE `userid` = ". $arrNewTopEver['uid']);
    event_add($arrNewTopEver['uid'], "You are now the top 24 hour mugger! You are rewarded with ". TOP_24_CRYSTALS ." crystals.");
    event_add($arrTop24['uid'], "You are no longer the top 24 hour mugger!");
}
unset($objDb, $arrTopEver);