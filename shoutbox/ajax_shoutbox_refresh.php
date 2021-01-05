<?php
session_start();
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

    $output = "";
    
    // Don't select chats from shadowbanned users (unless it's the signed in user)
    $getid = abs ((int) $_GET['userid']);
    $bk = $conn->query("select chat2.*, users.shadowban, ava.display_pic from chat2
          INNER JOIN users_avatars ava on chat2.userid=ava.userid
            INNER JOIN users_data users on chat2.userid=users.userid 
            WHERE (users.shadowban !=1 OR users.userid=" . $getid . ") order by id desc limit 20");
    $output .="<table class='tablechatmain' width='100%' id='shout_box'>";
    if (mysqli_num_rows($bk) == 0) {
        $output .= "<tr style='background:none;box-shadow:none;border:none;'><td>No shouts have been made yet! Make one below.</td></tr>";
    } else {
        while ($chat = $bk->fetch_assoc()) {
            $time = htmlspecialchars(date('g:i a', $chat['time']));
                            if($chat['time'] > 0)
{
$la=time()-$chat['time'];
$unit="seconds";
if($la >= 60)
{
$la=(int) ($la/60);
$unit="minutes";
}
if($la >= 60)
{
$la=(int) ($la/60);
$unit="hours";
if($la >= 24)
{
$la=(int) ($la/24);
$unit="days";
}
}
$str="$la $unit ago";
}
else
{
  $str="N/A";
if($chat['display_pic'] == NULL)
{
    $displaypic = "<img src='".htmlspecialchars('https://topmafia.net/header/images/displayimage/noavatar.png')."' class='chatimage' style='width:35px;height:35px;'>";
}
else {
    $displaypic = "<img src='".htmlspecialchars($chat['display_pic'])."' class='chatimage' style='width:35px;height:35px;'>";
}
            $output .= "<tr>
        <td align='left' width='5%'>";
          
            $output .= " 
        $displaypic
        </td>
  <td align='left' valign='top' width='95%'>
       <a href='viewuser.php?u=".htmlspecialchars($chat['userid'])."'>
       
       <span class='usernamechat'>".htmlspecialchars($chat['user'])."</span></a>
       <br />
       <font color=#999>".htmlspecialchars($chat['chat'])."</font>
       <div style='float:right;font-size:9px;color:#666;'>".htmlspecialchars($str)."</div></td>";
            
        }
        $output .= "</tr></td><div style='clear: both;'></div>";
    }
    
    echo json_encode(array('status' => 'success', 'data' => $output));

?>