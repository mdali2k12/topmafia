<?php
include "globals.php";

if($ir['mailban'])
{
print"<center><h3>! ERROR !</h3>
You have been mail banned for {$ir['mailban']} days.<br />
<br />
<b>Reason: {$ir['mb_reason']}</b></center>";
$h->endpage();
return;
}
$_GET['ID'] = $conn->real_escape_string($_GET['ID']);
$id = abs ((int) $conn->real_escape_string($_GET['ID']));
	$query = $conn->query("SELECT * FROM mail WHERE mail_to=$userid") or die(mysqli_error());
		$inbox=mysqli_num_rows($query);
?>
  <script>
        $(document).ready(function() {
             $('#err').hide();
             $('#succ').hide();
        
         
        $('.delete').on('click',function() {
            var ajaxUrl = "ajax/ajax_mailfunc.php" + $(this).attr('data-href');

            $.ajax({
                type: "GET",
                url: ajaxUrl,   
                data: "id=" + $(this).attr("data-id"), 
                success: function(data) {
                         var status = JSON.parse(data);
                    console.log(data);
                    $('#err').hide();
                    $('#succ').html(status.success);
                    $('#succ').show();
                    if (typeof status.error != "undefined") {
                        $('#succ').hide();
                        $('#err').html(status.error);
                        $('#err').show();
                    }
                }
            });
        });
        });
        
         var sendMail = function() {
         
             var formData = new FormData(document.getElementById('send'));
         
             user_input = $('#user_input').val();
             mainmsg = $('#mainmsg').val();
             if (mainmsg == "") {
                 $('#succ').hide();
                 $('#err').html("Please fill all the fields correctly!");
                 $('#err').show();
             } else {
                 //validation check
                 formData.append('type', 'validate');
                 $.ajax({
                     processData: false,
                     contentType: false,
                     url: 'ajax/ajax_sendmail.php',
                     data: formData,
                     type: 'POST', 
                     success: function(data) {
                    console.log(data);
                         var ret_val = JSON.parse(data);
                         if (ret_val.status == 'success') {
                             $('#err').hide();
                             $('#succ').html(ret_val.data);
                             $('#succ').show();
                             document.getElementById("send").reset();
                         } else {
                             $('#succ').hide();
                             $('#err').html(ret_val.data);
                             $('#err').show();
                         }
                     } 
                 });
             }
         };
      </script>

                           <div align="right">
                        <a href="mailbox.php?action=inbox" class="userinboxlink">Inbox <?php echo"(".number_format($inbox).")"; ?></a> 
                        <a href="mailbox.php?action=outbox" class="userinboxlink">Sent</a>
                        <a href="mailbox.php?action=compose" class="userinboxlink">Send</a>
                        	<a class='delete' href='#' data-href='?action=delall' data-id='{$r['mail_id']}' style='	padding: 5px 17px;
	font-size: 10px;
	text-transform:uppercase;
	font-weight:600;
	font-family:"Roboto";
	border: 1px solid #111;
	background-color:darkred;'>Clear Inbox</a>
                        
                    </div>
                                <div style="clear: both;"></div><br />
                                <div id="err"></div><div id="succ"></div>
<br />
<?php
$_GET['action'] = $conn->real_escape_string($_GET['action']);
$action = $conn->real_escape_string($_GET['action']);
switch($action)
{
case 'inbox':
mail_inbox();
break;

case 'outbox':
mail_outbox();
break;

case 'compose':
mail_compose();
break;

default:
mail_inbox();
break;
}
function mail_inbox()
{
global $conn,$ir,$c,$userid,$h;

$q=$conn->query("SELECT m.*,u.* FROM mail m LEFT JOIN users_data u ON m.mail_from=u.userid WHERE m.mail_to=$userid ORDER BY mail_time DESC LIMIT 25");
echo"<table class='tableinbox' width='100%'>
<tr>
<th colspan='3' class='tablehead'>Mailbox</th>
</tr>
<tr>
<th>From</th><th>Message</th><th>Received</th>
</tr>";
if(mysqli_num_rows($q)==0)
{
    print"<tr><td colspan='3'>No messages available</td></tr></table>";
}
else {
while($r=$q->fetch_assoc())
{
$sent=date('F j, Y, g:i:s a',$r['mail_time']);
if($r['mail_time'] > 0)
{
$la=time()-$r['mail_time'];
$unit="secs";
if($la >= 60)
{
$la=(int) ($la/60);
$unit="mins";
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
if(!$r['mail_read'])
{
    $userr = abs ((int) $conn->real_escape_string($r['userid']));
print "<tr><td width='20%' align='center'>";
if($r['userid'])
{
    $ui = strlen($r['username']) > 7 ? substr($r['username'],0,7)."..." : $r['username'];
print "<a href='viewuser.php?u={$userr}'>".$conn->real_escape_string($ui)."</a></td>";
}
else
{
print "SYSTEM</td>";
}
    $userr = abs ((int) $conn->real_escape_string($r['userid']));
$fm=urlencode($r['mail_text']);
print"
<td width='60%'>".$conn->real_escape_string($r['mail_text'])."<br />

<div class='linkinbox'>
<a href='mailbox.php?action=compose&ID={$userr}'>Reply</a>
<a href='preport.php?ID={$userr}&amp;report=Fradulent mail: {$fm}'>Report</a>
	 
</div>
</td>
<td width='20%' align='center'><b><font color=orange>NEW!</b></font><br />
<span style='font-size:9px;color:#999;'>$str
<br />
<a class='delete' href='#' data-href='?action=delete' data-id='".abs(@intval($r['mail_id']))."'>Delete</a></span>
</td>
</tr>
";

}
else {
  print "<tr><td width='20%' align='center'>";
    $userr = abs ((int) $conn->real_escape_string($r['userid']));
if($r['userid'])
{
    $ui = strlen($r['username']) > 7 ? substr($r['username'],0,7)."..." : $r['username'];
print "<a href='viewuser.php?u={$userr}'>".$conn->real_escape_string($ui)."</a></td>";
}
else
{
print "SYSTEM</td>";
}
$fm=urlencode($r['mail_text']);
print"
<td width='60%'>".$conn->real_escape_string($r['mail_text'])."<br />

<div class='linkinbox'>
<a href='mailbox.php?action=compose&ID={$userr}'>Reply</a>
<a href='preport.php?ID={$userr}&amp;report=Fradulent mail: {$fm}'>Report</a>
	 
		
</div>
</td>
<td width='20%' align='center'>
<span style='font-size:9px;color:#999;'>$str
<br />
<a class='delete' href='#' data-href='?action=delete' data-id='".abs(@intval($r['mail_id']))."'>Delete</a></span>
</td>
</tr>
";  
}
}
$conn->query("UPDATE mail SET mail_read='1' WHERE mail_to=$userid");
echo"</table>";
}
}
function mail_outbox()
{
global $conn,$ir,$c,$userid,$h;
echo"<table class='tableinbox' width='100%'>
<tr>
<th colspan='3' class='tablehead'>Outbox</th>
</tr>
<tr>
<th>To</th><th>Message</th><th>Sent</th>
</tr>";
$q=$conn->query("SELECT m.*,u.* FROM mail m LEFT JOIN users_data u ON m.mail_to=u.userid WHERE m.mail_from=$userid ORDER BY mail_time DESC LIMIT 20");
if(mysqli_num_rows($q)==0)
{
    print"<tr><td colspan='3'>No sent messages available</td></tr></table>";
}
else{
while($r=$q->fetch_assoc())
{
$sent=date('F j, Y, g:i:s a',$r['mail_time']);
if($r['mail_time'] > 0)
{
$la=time()-$r['mail_time'];
$unit="secs";
if($la >= 60)
{
$la=(int) ($la/60);
$unit="mins";
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
    $userr = abs ((int) $conn->real_escape_string($r['userid']));
    $ui = strlen($r['username']) > 7 ? substr($r['username'],0,7)."..." : $r['username'];
print "<tr><td width='20%' align='center'><a href='viewuser.php?u={$userr}'>$ui</a></td>
<td width='60%'>".$conn->real_escape_string($r['mail_text'])."
</td>
<td width='20%' align='center'>
<span style='font-size:9px;color:#999;'>$str</span></td></tr>";
}
}
print "</table>";
}
function mail_compose()
{
global $conn,$ir,$c,$userid,$h;
$_GET['ID'] = $conn->real_escape_string($_GET['ID']);
$id = abs ((int) $conn->real_escape_string($_GET['ID']));
print "<form name='sendmail' id='send' action='' method='post'>
<table width='100%' class='tableinbox'> 
<tr>
<th colspan='3' class='tablehead'>Send Message</th>
</tr>";
$q=$conn->query("SELECT c.*, u.username FROM contactlist c LEFT JOIN users_data u ON c.cl_ADDED=u.userid WHERE c.cl_ADDER={$userid} ORDER BY u.username ASC");
if(mysqli_num_rows($q) == 0)
{
  print "<tr><th>Select Contact</th><td>You have no contacts! <a href='contactlist.php?action=add'>Add a contact?</a></td></tr>";
}
else
{
  print "<tr><th>Select Contact</th><td><select id='user_select' name='user1' type='dropdown'><option value=''>&lt;Select a Contact...&gt;</option>";
  while($r=$q->fetch_assoc())
  {
    print "<option value='".$conn->real_escape_string($r['username'])."'>".$conn->real_escape_string($r['username'])."</option>";
  }
  print "</select></td></tr>";
}
if($id)
{
    $d=$conn->query("SELECT username FROM users_data WHERE userid={$id}");
  $user=$d->fetch_assoc();
}  
print "
<tr><th>OR Enter Username</th><td><input type='text' id='user_input' name='user2' value='{$user['username']}' maxlength='30' /></td>
</tr>
<tr><th>Message</th>
<td>
<textarea rows=5 cols=40 id='mainmsg' name='message'></textarea><br />
<input type='button' name='action' onclick='javascript:sendMail();' class='buttonsubmit' value='Send' /></td></tr>
</table></form>";
if($id)
{
print "<br /><table width=95% class='tableinbox'><tr><th>Your last five mails to/from this person:</th></tr>";
$q=$conn->query("SELECT m.*,u1.username as sender from mail m left join users_data u1 on m.mail_from=u1.userid WHERE (m.mail_from=$userid AND m.mail_to={$id}) OR (m.mail_to=$userid AND m.mail_from={$id}) ORDER BY m.mail_time DESC LIMIT 5");
while($r=$q->fetch_assoc())
{
$sent=date('F j, Y, g:i:s a',$r['mail_time']);
if($r['mail_time'] > 0)
{
$la=time()-$r['mail_time'];
$unit="secs";
if($la >= 60)
{
$la=(int) ($la/60);
$unit="mins";
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
print "<tr><td width='100%'><b>".$conn->real_escape_string($r['sender'])." wrote:</b> ".$conn->real_escape_string($r['mail_text'])."
<br />
<div align='right' style='color:#333;'>$str</div></td></tr>";
}
print "</table>";
}
}

$h->endpage();
?>