<?php
include "globals.php";
?>
    <script src="https://topmafia.net/home/javascripts/home.min.8aa9e3ed.js"></script>
    <script>
    $(document).ready(function() {
        $('#err').hide();
        $('#succ').hide();

        $('.data').on('click',function() {
            var ajaxUrl = "ajax/ajax_rating.php" + $(this).attr('data-href');

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
        </script>
    <?php
//Star Of Marriage Script:
 $v = $conn->query("SELECT userid, username, married FROM users_data WHERE userid='{$r['married']}'") or die(mysqli_error());
 $vc = $v->fetch_assoc();
 if($r['married'] == 0) { $married = "<b>Partner:</b> [<font color=red>None</font>]<br>"; }
 else if($r['married'] > 0) { $married = "<b>Partner:</b> [<a href=?u={$vc['userid']}>{$vc['username']}</a>]<br>"; }
 //End Of Marriage Script
$_GET['u'] = $conn->real_escape_string($_GET['u']);
$_GET['u'] = abs((int) $_GET['u']);
$u = abs ((int) $conn->real_escape_string($_GET['u']));
if(!$u)
{
	header("Location: index.php");
	exit;
}
else
{
$q=$conn->query("SELECT u.*,us.*,c.*,h.*,g.*,f.*, v.*, a.* 
FROM users_data u
LEFT JOIN users_stats us ON u.userid=us.userid
LEFT JOIN cities c ON u.location=c.cityid 
LEFT JOIN users_vitals v ON v.userid=u.userid
LEFT JOIN users_avatars a ON a.userid=u.userid
LEFT JOIN houses h ON v.maxwill=h.hWILL 
LEFT JOIN gangs g ON g.gangID=u.gang 
LEFT JOIN fedjail f ON f.fed_userid=u.userid
WHERE u.userid={$u}");
if(mysqli_num_rows($q) == 0)
{
print "Sorry, we could not find a user with that ID, check your source.";
}
else
{
$r=$q->fetch_assoc();
if ( !$r['married'] )
{
$marital="<font color='red'>No</font>";
}
else
{
$k=$conn->query("SELECT username FROM users_data  WHERE userid={$r['married']}", $c);
$marital="<a href='viewuser.php?u={$r['married']}' style='color:green;'>".@mysqli_result($k,0,0)."</a> ";
}

if($r['user_level'] == 1) { $userl="Member"; } else if($r['user_level'] == 2) { $userl="Admin"; } else if ($r['user_level'] == 3) { $userl="Secretary"; } else if ($r['user_level'] == 4) { $userl="Forum Moderator"; } else if ($r['user_level'] == 6) { $userl="Gfx Artist"; } else if($r['user_level'] == 0) { $userl="NPC"; } else if ($r['user_level'] == 7) { $userl="OM Guide"; } else if ($r['user_level'] == 8) { $userl="OM Lawyer"; } else {$userl="Assistant"; }
$lon=($r['laston'] > 0) ?date('F j, Y g:i:s a',$r['laston']) : "Never";
$sup=date('F j, Y',$r['signedup']);
$ts=$r['strength']+$r['agility']+$r['guard']+$r['labour']+$r['IQ'];
$d="";

if($r['signedup'] > 0)
{
$la=time()-$r['signedup'];
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
$strs="$la $unit ago";
}
else
{
  $strs="N/A";
}
if($r['laston'] > 0)
{
$la=time()-$r['laston'];
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
if($r['last_login'] > 0)
{
$ll=time()-$r['last_login'];
$unit2="secs";
if($ll >= 60)
{
$ll=(int) ($ll/60);
$unit2="mins";
}
if($ll >= 60)
{
$ll=(int) ($ll/60);
$unit2="hours";
if($ll >= 24)
{
$ll=(int) ($ll/24);
$unit2="days";
}
}
$str2="$ll $unit2 ago";
}
else
{
  $str2="N/A";
}
if($r['laston'] >= time()-15*60) { $on="<font color=green>Online</font>"; } else { $on="<font color=red>Offline</font>"; }

	$r['exp_needed']=(int) (($r['level']+2)*($r['level']+2)*($r['level']+2)*5);

    $ref=$conn->query("SELECT refby, userid, username FROM users_data WHERE userid='{$r['refby']}'");
$reff=$ref->fetch_assoc();
$referredby = "{$reff['username']}";
if($reff['refby'] == "")
{
    $referredby ="N/A";
}
  $blockcheck = $conn->query("select bl_ADDER, bl_ADDED FROM blacklist WHERE bl_ADDED = '{$u}' AND bl_ADDER = '{$userid}'");
  if (mysqli_num_rows($blockcheck) == 1) {
      print"<div id='err'>You can not view this users profile as you have been blocked!<br /><a href='index.php'><button class='buttonnormal'>Home</button></a></div>";
  }
  else {
      	$u = "{$r['username']}";

		if($r['vip']) { 
		     
		$u = "{$r['username']}";
		$d ="<img src='https://topmafia.net/header/images/imageicons/gamecard/donator.gif'>";
		}
      print"<table class='tableinbox' width='100%'>
<tr>
<th colspan='3' class='tablehead'>".$conn->real_escape_string($u)." $d Profile</th>
</tr>
</table>";
    
  print"
<table class='tableprofile' width='100%'>
<tr>
<td align='left' valign='top'>
";

	      if($r['display_pic'])
{
print "
<img src='{$r['display_pic']}' style='width:100px;height:125px;border:1px solid #fff;'>";
}
elseif($r['display_pic']==""){
    print"<img src='https://topmafia.net/header/images/displayimage/noavatar.png' style='width:125px;height:150px;border:1px solid #fff;'>";
}
print"
		<Br />
		<center>
		<span class='text2'><b>$on</b><br /><small> ($str)</small></span>
		</center>
		</td>
<td width='80%' align='left' valign='top'>
<div class='userprofiletext'>"; 

	
		print"
		<span class='text2'>User ID <b>".number_format($r['userid'])."</b></span>
		<br />
		<span class='text2'>Level <b>".number_format($r['level'])."</b></span>
		<br />
		<span class='text2'>Last Login <b>$str2</b></span>
		<br />
		<span class='text2'>Registered <b>$strs</b></span>
		<br />
		<Br />
			<span class='text2'>Profile Ratings <b>".number_format($r['rating'])."</b>
			<br /><br />
			<a class='data' href='#' data-href='?change=up' data-id='{$r['userid']}' style='border:2px solid #333; padding:5px; text-align:center;border-radius:5px;'>Rate up</a>
	
		<a class='data' href='#' data-href='?change=down' data-id='{$r['userid']}' style='border:2px solid #333; padding:5px; text-align:center;border-radius:5px;'>Rate down</a>
		</span>
</div>
</td>
";
$us = abs((int) $conn->real_escape_string($r['userid']));
?>
<td width="20%" align="center"  valign='top'>
<div class="submenuprofile">
    <a href="mailbox.php?action=compose&ID=<?php echo"{$us}"; ?>"><img src="https://topmafia.net/header/images/imageicons/email2.png" width="16px"> Mail</a>
<a href='attack.php?ID=<?php echo"{$us}"; ?>'><img src="https://topmafia.net/header/images/imageicons/gun-hite.png" width="16px"> Fight</a>
<a href=''><img src="https://topmafia.net/header/images/imageicons/wallet.png" width="16px"> Send</a>
<a href='friendslist.php?action=add&ID=<?php echo"{$us}"; ?>'><img src="https://topmafia.net/header/images/imageicons/like.png" width="16px"> Add</a>
<a href='blacklist.php?action=add&ID=<?php echo"{$us}"; ?>'><img src="https://topmafia.net/header/images/imageicons/delete.png" width="16px"> Block</a>
</div>

<?php
print"
</td>
</tr>
</table>
</tr>
</td>
</table>
";
echo"<div id='err'></div><div id='succ'></div>";
if($r['fedjail'])
{
print "<span class='help'>This player has been banned for {$r['fed_days']} day(s).</span>";
}
if($r['hospital'])
{
print "<span class='helph'>Currently in hospital for {$r['hospital']} minutes.</span>";
}
if($r['jail'])
{
print "<span class='helpj'>Currently in jail for {$r['jail']} minutes.</span>";
}

$_GET['u'] = $conn->real_escape_string($_GET['u']);
$_GET['u'] = abs((int) $_GET['u']);
$u = abs ((int) $conn->real_escape_string($_GET['u']));
		$query = $conn->query("SELECT * FROM profilecomments WHERE profileuserid={$u}") or die(mysqli_error());
		$cc=mysqli_num_rows($query);
echo'<br />
         <div id="content">
            <div id="page-index" class="page">
<div class="tabs">
                    <div class="tabs-buttons">
                        <button data-tab="general" class="active">General</button>
                        <button data-tab="post" class="">Signature</button>
                        <button data-tab="comments" class="">Comments <small>('.number_format($cc).')</small></button>
                    </div>
                    <div class="tabs-content active" data-tab="general">
                         ';
                         

echo"
<div class='weapons'>
<div class='titleheaderbar'>Statistics</div>
<div class='weaponsboxstat'>";
include_once("profile/accountinfo.php");
print"
</div>
</div>";


echo"
<div class='weapons'>
<div class='titleheaderbar'>Achievements</div>
<div class='weaponsbox'>";
include_once("profile/badges.php");
print"
</div>
</div>";


print"
<div class='weapons'>
<div class='titleheaderbar'>Inventory</div>
<div class='weaponsbox'>";
 
 include_once("profile/items.php");
echo"</div></div>";
                         echo'
                    </div>
                    <div class="tabs-content" data-tab="post">
                       ';
                       echo"
<div class='weapons'>
<div class='titleheaderbar'>Profile Signature</div>
<div class='weaponsbox'>";
                       include_once("profile/posts.php");
                       echo'
                    </div>
                    </div>
                    </div>
                    
                    <div class="tabs-content" data-tab="comments">
                      ';
                       echo"
<div class='weapons'>
<div class='titleheaderbar'>Profile Comments</div>
<div class='weaponsbox'>";
                       include_once("profile/commentprofile.php");
                       echo'
                    </div>
                    </div>
                    </div>
            </div>
            </div>
            </div>
            
        ';

print"</table>
";
}
}
}

$h->endpage();
?>
