<?php
    include(DIRNAME(__FILE__) . "/sglobals.php");
    if($ir['user_level'] != 2)
    {
        die("You can't access this");
    }
    //-----------
$_GET['action'] = $conn->real_escape_string($_GET['action']);
    $_GET['action'] = isset($_GET['action']) && is_string($_GET['action']) ? strtolower(trim($_GET['action'])) : "";
    //-----------
    switch($_GET['action'])
{
    case 'index': index(); return;
    case 'delete': delete(); return; 

    default: index(); return;
}
function index()
{
    global $conn;
    $y = $conn->query("SELECT COUNT(`userid`) AS `inactive` FROM `users` WHERE ( unix_timestamp() - `laston` ) >= 86400*30 AND `user_level` = 1");
    $x = mysqli_fetch_array($y);
    echo "<div class='infostaff'>You are about to clear Dead Users that are 30 days + from the database.</div>
		<br />
		<br /><div class='info-msg'>Users gone for over 30 days: ".$x['inactive']."</div> <br /><a href='staff_inactive.php?action=delete'>Delete inactive users</a>";         
}                                                                                     
 
function delete()
{
    global $conn;
      $y = $conn->query("SELECT COUNT(`userid`) AS `inactive` FROM `users` WHERE ( unix_timestamp() - `laston` ) >= 86400*30 AND `user_level` = 1");
    $x = mysqli_fetch_array($y);
     if($x['inactive'] == 0)
    {
    echo "<div class='error-msg'>There are no data to delete!</div>";
    index();
    }
    else {
    $b = $conn->query("SELECT `userid`, `username` FROM `users` WHERE ( unix_timestamp() - `laston` ) >= 86400*30 AND `user_level` = 1");  
    
    while($buh = mysqli_fetch_array($b))
    {
        $xx = $conn->query("DELETE FROM `users` WHERE `userid` = {$buh['userid']}");
        $yy = $conn->query("DELETE FROM `userstats` WHERE `userid` = {$buh['userid']}");
        $d = $conn->query("DELETE FROM `itemmarket` WHERE `imADDER` = {$buh['userid']}");
        $f = $conn->query("DELETE FROM `inventory` WHERE `inv_userid` = '{$buh['userid']}'");      
        $h = $conn->query("DELETE FROM `crystalmarket` WHERE `cmADDER` = '{$buh['userid']}'");                                                                                                                                                                     
        echo "<br />[".$buh['userid']."]. ".$buh['username']." DELETED"; 
    }
    stafflog_add("Inactive users removed from game");
}
}
?>