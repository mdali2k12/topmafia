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


//$Hourexp = rand(100,500);
//$moneyhour = rand(100,500);
//$crystalhour = rand(1,3);
//$user = array(176, 168, 1074, 1072, 863, 928, 848, 10, 25, 36, 7, 16, 23, 160, 856, 862, 874, 886, 902, 918, 870, 876, 885, 873, 882, 890, 894, 903, 921, 930, 949, 962, 964, 967, 951, 957, 963, 968, 971, 975, 999, 1006, 1016, 1046, 1069, 1070, 1068, 1007, 1013, 1017, 1023, 1030); 
 //$randIndex = array_rand($user);
 //$userids = $user[$randIndex];
//bot user hourly rewards and exp
//$conn->query("UPDATE users set exp='$Hourexp', money=money+$moneyhour, crystals=crystals+$crystalhour WHERE userid=$userids");
//end

$query="UPDATE users_finance SET crystals=crystals+5 WHERE vip>0";
$query2="UPDATE users_finance SET money=money+2000 WHERE vip>0";
$conn->query($query);
$conn->query($query2);
$conn->query("UPDATE gangs SET gangCHOURS=gangCHOURS-1 WHERE gangCRIME>0");
$q=$conn->query("SELECT g.*,oc.* FROM gangs g LEFT JOIN orgcrimes oc ON g.gangCRIME=oc.ocID WHERE g.gangCRIME > 0 AND g.gangCHOURS = 0");
while($r=$q->fetch_assoc())
{
$suc=rand(0,1);
if($suc) {
$log=$r['ocSTARTTEXT'].$r['ocSUCCTEXT'];
$muny=(int) (rand($r['ocMINMONEY'],$r['ocMAXMONEY']));
$log=str_replace(array("{muny}","'"),array($muny,"''"),$log);
$conn->query("UPDATE gangs SET gangMONEY=gangMONEY+$muny,gangCRIME=0 WHERE gangID={$r['gangID']}");
$conn->query("INSERT INTO oclogs (oclOC, oclGANG, oclLOG, oclRESULT, oclMONEY, ocCRIMEN, ocTIME) VALUES ({$r['ocID']},{$r['gangID']}, '$log', 'success', $muny, '{$r['ocNAME']}', unix_timestamp())");
$i=$conn->insert_id;
$qm=$conn->query("SELECT * FROM users_data WHERE gang={$r['gangID']}");
while($rm=$qm->fetch_assoc())
{
$conn->query("INSERT INTO events (evUSER, evTIME, evREAD, evTEXT) VALUES ({$rm['userid']},unix_timestamp(),'0',\"Your gang's Organised Crime Succeeded. Go <a href='oclog.php?ID=$i'>here</a> to view the details.\")");
$conn->query("UPDATE users_data SET new_events=new_events+1 WHERE userid={$rm['userid']}");
}
}
else
{
$log=$r['ocSTARTTEXT'].$r['ocFAILTEXT'];
$muny=0;
$log=str_replace(array("{muny}","'"),array($muny,"''"),$log);
$conn->query("UPDATE gangs SET gangCRIME=0 WHERE gangID={$r['gangID']}");
$conn->query("INSERT INTO oclogs (oclOC, oclGANG, oclLOG, oclRESULT, oclMONEY, ocCRIMEN, ocTIME) VALUES ({$r['ocID']},{$r['gangID']}, '$log', 'failure', $muny, '{$r['ocNAME']}', unix_timestamp())");
$i=$conn->insert_id;
$qm=$conn->query("SELECT * FROM users_data WHERE gang={$r['gangID']}");
while($rm=$qm->fetch_assoc())
{
$conn->query("INSERT INTO events (evUSER, evTIME, evREAD, evTEXT) VALUES ({$rm['userid']},unix_timestamp(),'0',\"Your gang's Organised Crime Failed. Go <a href='oclog.php?ID=$i'>here</a> to view the details.\")");
$conn->query("UPDATE users_data SET new_events=new_events+1 WHERE userid={$rm['userid']}");
}
}
} 
if(date('G')==17)
{
$conn->query("UPDATE users_vitals u LEFT JOIN users_stats us ON u.userid=us.userid LEFT JOIN jobs j ON j.jID=u.job LEFT JOIN jobranks jr ON u.jobrank=jr.jrID LEFT JOIN users_finance f ON f.userid=u.userid SET f.money=f.money+jr.jrPAY, u.exp=u.exp+(jr.jrPAY/20) 
WHERE u.job > 0 AND u.jobrank > 0");
$conn->query("UPDATE users_stats us LEFT JOIN users_data u ON u.userid=us.userid LEFT JOIN jobs j ON j.jID=u.job LEFT JOIN jobranks jr ON u.jobrank=jr.jrID SET us.strength=(us.strength+1)+jr.jrSTRG-1,us.labour=(us.labour+1)+jr.jrLABOURG-1,us.IQ=(us.IQ+1)+jr.jrIQG-1 WHERE u.job > 0 AND u.jobrank > 0");
}
$conn->query("TRUNCATE TABLE livefeed;");
$conn->query("UPDATE users SET verified=0");
?>