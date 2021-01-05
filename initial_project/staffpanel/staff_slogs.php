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
    $y = $conn->query("SELECT COUNT(`id`) AS `inactive` FROM `stafflog` WHERE ( unix_timestamp() - `time` ) >= 86400*30");
    $x = mysqli_fetch_array($y);
    echo"
		<div class='infostaff'>You can clear staff logs over 30 days from the database by using the function below.</div>
		<br />
		<br />";
    echo "<div class='info-msg'>Staff logs over 30 days: ".$x['inactive']."</div><br /><a href='staff_slogs.php?action=delete'>Delete Staff Logs!</a>";         
}                                                                                     
 
function delete()
{
    
    global $conn;
    $y = $conn->query("SELECT COUNT(`id`) AS `inactive` FROM `stafflog` WHERE ( unix_timestamp() - `time` ) >= 86400*30");
    $x = mysqli_fetch_array($y);
        if($x['inactive'] == 0)
    {
    echo "<div class='error-msg'>There are no data to delete!</div>";
    index();
    }
    else{
    $b = $conn->query("DELETE FROM `stafflog` WHERE ( unix_timestamp() - `time` ) >= 86400*30");  
    stafflog_add("Staff logs older than 30 days deleted.");
    echo "<div class='success-msg'>Staff logs successfully deleted!</div>";
    index();
}
}
?>