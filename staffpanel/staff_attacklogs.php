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
    $y = $conn->query("SELECT COUNT(`log_id`) AS `inactive` FROM `attacklogs` WHERE ( unix_timestamp() - `time` ) >= 86400*15");
    $x = mysqli_fetch_array($y);
    echo "<div class='infostaff'>You are about to clear Attack Logs that are 15 days + from the database.</div>
		<br />
		<br /><div class='info-msg'>Attack logs over 15 days: ".$x['inactive']."</div><br /><a href='staff_attacklogs.php?action=delete'>Delete attack logs over 15 days !</a>";         
}                                                                                     
 
function delete()
{
    
    global $conn;
        $y = $conn->query("SELECT COUNT(`log_id`) AS `inactive` FROM `attacklogs` WHERE ( unix_timestamp() - `time` ) >= 86400*15");
    $x = mysqli_fetch_array($y);
         if($x['inactive'] == 0)
    {
    echo "<div class='error-msg'>There are no data to delete!</div>";
    index();
    }
    else{
    $b = $conn->query("DELETE FROM `attacklogs` WHERE ( unix_timestamp() - `time` ) >= 86400*15");  
    stafflog_add("Attack logs older than 15 days deleted.");
    echo "<div class='success-msg'>Events successfully deleted!</div>";
}
}
?>