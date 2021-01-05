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
    $y = $conn->query("SELECT COUNT(`ft_forum_id`) AS `prune` FROM `forum_topics` WHERE ( unix_timestamp() - `ft_start_time` ) >= 86400*35 AND `ft_pinned` = 0");
    $x = mysqli_fetch_array($y);
    echo "<div class='infostaff'>You are about to clear Forum Topics that are 35 days + from the database.</div>
		<br />
		<br />
		<div class='info-msg'>Forum Topics to remove: ".$x['prune']."</div><br /><a href='staff_forum_topic_prune.php?action=delete'>Delete old forum posts</a>";         
}                                                                                     
 
function delete()
{
    global $conn;
        $y = $conn->query("SELECT COUNT(`ft_forum_id`) AS `prune` FROM `forum_topics` WHERE ( unix_timestamp() - `ft_start_time` ) >= 86400*35 AND `ft_pinned` = 0");
    $x = mysqli_fetch_array($y);
         if($x['inactive'] == 0)
    {
    echo "<div class='error-msg'>There are no data to delete!</div>";
    index();
    }
    else{
    $b = $conn->query("SELECT `ft_forum_id` FROM `forum_topics` WHERE ( unix_timestamp() - `ft_start_time` ) >= 86400*35 AND `ft_pinned` = 0");  
    while($buh = mysqli_fetch_array($b))
    {
        $xx = $conn->query("DELETE FROM `forum_topics` WHERE ( unix_timestamp() - `ft_start_time` ) >= 86400*35 AND `ft_pinned` = 0");                                                                                                                                                                     
        echo "<br />".$buh['ft_name'].". DELETED"; 
    }
    stafflog_add("All 35 day older posts removed from the forum.");
}
}
?>