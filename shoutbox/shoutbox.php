
<table class="tablechatbox" width="100%">
    <tr>
        <th class="thheader"> <img src="https://topmafia.net/header/images/imageicons/comment-white2.png"> Shoutbox  <div style="float:right;"></span><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><img
                            src="https://topmafia.net/header/images/imageicons/Refresh-icon.png"></a></div></th>
    </tr>
    <tr>
        <td class="paddingchat">

            <center>
               
                <br/>

                <?php
      

                // Don't select chats from shadowbanned users_data (unless it's the signed in user)
                $ir['userid'] = abs((int) $ir['userid']);
                $bk = $conn->query("select chat2.*, users.shadowban, ava.display_pic from chat2
          INNER JOIN users_avatars ava on chat2.userid=ava.userid
            INNER JOIN users_data users on chat2.userid=users.userid 
            WHERE (users.shadowban !=1 OR users.userid=" . $ir['userid'] . ") order by id desc limit 20");
                echo "
<table class='tablechatmain' width='100%' id='shout_box'>";

                if (mysqli_num_rows($bk) == 0) {
                    print "<tr style='background:none;box-shadow:none;border:none;'><td>No shouts have been made yet! Make one below.</td></tr>";
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
 echo "<tr>
        <td align='left' width='5%'>
        $displaypic
        </td>
        <td align='left' valign='top' width='95%'>
       <a href='viewuser.php?u=".htmlspecialchars($chat['userid'])."'>
       <span class='usernamechat'>".htmlspecialchars($chat['user'])."</span></a>
       <br />
       <font color=#999>$chat[chat]</font><br />
       <div style='float:right;font-size:9px;color:#666;'>".htmlspecialchars($str)."</div></td>";
                    }
                    echo "</tr></td><div style='clear: both;'></div>";
                }

                ?>
</table>
<br/>
<center>
    <?php

    if ($ir['banshout'] == 0) {
        ?>

        <form method="post" id="chat" action="" onsubmit="sendMessage();return false;">
            <input class="inputchat" id="inputchat" type="text" name="msg" value=""/>
            <input type="button" class="buttonsubmit" value="Send" onclick="sendMessage()"/>
        </form>
        <?php
    }
    ?>
    <script>
     var sendMessage = function(){
  if($('#inputchat').val() != '')
            $.ajax({
                'url' : 'shoutbox/ajax_shoutbox.php',
                'type' : 'POST',
                'data' : {
                    'msg' : $('#inputchat').val(),
                    'type'      : 'insertMessage',
                    'userid' : "<?php echo $ir['userid'];?>",
                    'username' : "<?php echo $ir['username'];?>"
                },
                'success' : function(data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        $('#shout_box').html(response.data);
                        $('#inputchat').val('')
                    }else{
                        alert('Failed to send message!!!');
                    }
                },
                'error' : function(request,error)
                {
                }
            });
        }
        
        var refreshMsgBox = function() {
            $.ajax({
                'url' : 'shoutbox/ajax_shoutbox_refresh.php',
                'type' : 'GET',
                'data' : {
                    'userid' : "<?php echo $ir['userid'];?>",  
                },
                'success' : function(data){
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        $('#shout_box').html(response.data);    
                    }
                }
            });
        }
        
        $('#document').ready(function(){
            
           // setInterval(function(){
            //    refreshMsgBox(); 
            //},100000);
        });
    </script>
</center>
</tr>
</td>
</table>