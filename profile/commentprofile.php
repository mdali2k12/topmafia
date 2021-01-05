<?php
 $comments = $conn->query("SELECT p.*,a.* FROM profilecomments p 
 INNER JOIN users_avatars a ON a.userid=p.posteruserid WHERE p.profileuserid={$_GET['u']} order by p.id desc limit 50");



if ($_POST['comment1']) {
    $friendcheck = $conn->query("select fl_ADDER, fl_ADDED FROM friendslist WHERE fl_ADDED = '{$_GET['u']}' AND fl_ADDER = '{$ir['userid']}' OR fl_ADDED = '{$ir['userid']}' AND fl_ADDER = '{$_GET['u']}'");
    if($ir['userid'] == "{$_GET['u']}")
    {
        print"<center><font color=red>You can't comment on your own profile!</font></center><br />";
    }
    
       elseif (mysqli_num_rows($friendcheck) == 1) {
             $newmsg = htmlspecialchars($conn->real_escape_string($_POST['comment1']), ENT_QUOTES); 
        // insert chatbox table
        $starter = $ir['username'];
        $id = $ir['userid'];
        $conn->query("INSERT INTO profilecomments (posteruserid, time, comment, profileuserid, postername) values('$id', unix_timestamp(), '$newmsg', '{$_GET['u']}', '$starter')");
        $succmsg="<center><font color=limegreen>Successfully posted your comment on their wall!</font></center><br />";
                }
       elseif (mysqli_num_rows($friendcheck) == 0) {
    $checks = $conn->query("select profileuserid, posteruserid  FROM profilecomments WHERE posteruserid = '{$ir['userid']}' AND profileuserid = '{$_GET['u']}'");

                if (mysqli_num_rows($checks) >= 1) {
                    print "<tr style='background:none;'><td>
       <font color=red><center>You can  comment only once unless you are friends with them.</font></center><br /></td></tr>";
                } else {
    $newmsg = htmlspecialchars($conn->real_escape_string($_POST['comment1']), ENT_QUOTES); 
        // insert chatbox table
        $starter = $ir['username'];
        $id = $ir['userid'];
        $conn->query("INSERT INTO profilecomments (posteruserid, time, comment, profileuserid, postername) values('$id', unix_timestamp(), '$newmsg', '{$_GET['u']}', '$starter')");
        $succmsg="<center><font color=limegreen>Successfully posted your comment on their wall!</font></center><br />";
                }
              
} 
                }

                echo "$succmsg
<table class='tableinbox' width='100%'>";



                if (mysqli_num_rows($comments) == 0) {
                    print "<tr><td>
       <font color=#fff>No comments made on this profile yet.</font></td></tr>";
                } else {
                    while ($comment = $comments->fetch_assoc()) {
                        $time = date('g:i a', $comment['time']);
                        if($comment['time'] > 0)
{
$la=time()-$comment['time'];
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
if($comment['display_pic'] == NULL)
{
    $displaypic = "<img src='https://topmafia.net/header/images/displayimage/noavatar.png' style='width:35px;height:35px;border:2px solid #333;'>";
}
else {
    $pic = "
<img src='{$comment['display_pic']}' style='width:35px;height:35px;border:2px solid #333;'>";
$displaypic = $conn->real_escape_string($pic);
}
                        echo "<tr>
        <td align='left' width='5%'>
        $displaypic
        </td>
        <td align='left' valign='top' width='95%'>
       <a href='viewuser.php?u={$comment['posteruserid']}'>
       <span class='usernamechat'>$comment[postername]</span></a>
       <br />
       <font color=#fff>$comment[comment]</font><br />
       <div style='float:right;font-size:9px;color:#999;'>$str</div></td>";
                    }
                    echo "</tr></td><div style='clear: both;'></div>";
                }

                ?>
         
<?php
if($ir['userid'] != $_GET['u'])
{ 
    echo'
<tr><td align="center">
 <form method="post" action="">
            <input class="inputchat" style="text-align:left; width:70%;" type="text" name="comment1" value="" />
            <input type="submit" class="buttonsubmit" value="Comment" />
            </form>
        </td></tr>';
}
        ?>
        
   
</table>       