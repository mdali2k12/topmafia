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
//Code for the ajax Message Insert

function clean($string)
{
    return preg_replace("/[^a-zA-Z0-9\s]/", "", $string); // Removes special chars.
}
$type = $conn->real_escape_string($_POST['type']);

$type = htmlspecialchars($_POST['type']);

if ($type == 'insertMessage') {

$newmsg = $conn->real_escape_string($_POST['msg']);
    // make a function to get userdata



    // input chatbox
if ($newmsg) {
    $_POST['msg'] =  $conn->real_escape_string($_POST['msg']); 
$newmsgi = $conn->real_escape_string($_POST['msg']); 
        // insert chatbox table
        $starter =  $conn->real_escape_string($_POST['username']);
        $id =  abs((int) ($_POST['userid']));
        $conn->query("insert into chat2(time, user, userid, chat) values(unix_timestamp(), '$starter', '$id', '$newmsgi')");
        
        // make return array

        $bk = $conn->query("select chat2.*, users.shadowban, ava.display_pic from chat2
          INNER JOIN users_avatars ava on chat2.userid=ava.userid
            INNER JOIN users_data users on chat2.userid=users.userid 
            WHERE (users.shadowban !=1 OR users.userid=" .$id. ") order by id desc limit 20");
        $data = "<table class='tablechatmain' width='100%' id='shout_box'>";
        if (mysqli_num_rows($bk) == 0) {
            $data = "<tr style='background:none;box-shadow:none;border:none;'><td>No shouts have been made yet! Make one below.</td></tr>";
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
}
if($chat['display_pic'] == NULL)
{
    $displaypic = "<img src='".htmlspecialchars('https://topmafia.net/header/images/displayimage/noavatar.png')."' class='chatimage' style='width:35px;height:35px;'>";
}
else {
    $displaypic = "<img src='".htmlspecialchars($chat['display_pic'])."' class='chatimage' style='width:35px;height:35px;'>";
}
                       
                $data.=" <tr>
        <td align='left' width='5%'>";

              
                $data.= " 
        $displaypic
        </td>
        <td align='left' valign='top' width='95%'>
       <a href='viewuser.php?u=".htmlspecialchars($chat['userid'])."'>
       
       <span class='usernamechat'>".htmlspecialchars($chat['user'])."</span></a>
       <br />
       <font color=#999>".htmlspecialchars($chat['chat'])."</font>
       <div style='float:right;font-size:9px;color:#666;'>".htmlspecialchars($str)."</div></td>";
                
            }
            $data.="</tr></td><div style='clear: both;'></div>";
        }
    }
    echo json_encode(array('status' => 'success', 'data'=> $data));
}

?>