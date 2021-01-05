<?php
include "globals.php";

function anti_inject($campo)
{
    foreach($campo as $key => $val)
    {
        //remove words that contains syntax sql
        $val = preg_replace(("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$val);

        //Remove empty spaces
        $val = trim($val);

        //Removes tags html/php
        $val = strip_tags($val);

        //Add inverted bars to a string
        $val = addslashes($val);

        // store it back into the array
        $campo[$key] = $val;
    }
    return $campo; //Returns the the var clean
}  

$_GET = anti_inject($_GET);
$_GET['action'] = $conn->real_escape_string($_GET['action']);
$action = $conn->real_escape_string($_GET['action']);

$_SESSION['userid'] = $conn->real_escape_string($_SESSION['userid']);
$user=$conn->real_escape_string($_SESSION['userid']);
$userid = abs ((int) $user);
$_POST = anti_inject($_POST);
if(!empty($action)){
	switch($action){
		case 'signaturechange2':
		do_signature_change();
		break;
		
		case 'signaturechange':
		signature_change();
		break;
	}
} 
function signature_change()
{
global $ir,$c,$userid,$h, $conn;
$_SESSION['userid'] = $conn->real_escape_string($_SESSION['userid']);
$user=$conn->real_escape_string($_SESSION['userid']);
$userid = abs ((int) $user);
 $signa = $conn->query("SELECT userid, signature FROM profilesignatures WHERE userid='{$userid}'");
 $getsig = $signa->fetch_assoc();
print "<center>
<h3>Signature Change</h3>
<b>[BBcode Enabled] <a href='https://www.bbcode.org/reference.php'>[ ? ] </a></b><br />
<select id='test'>
  <option value='[img]URL HERE[/img]'>Insert Image</option>
  <option value='[url=Url Here]Link NAME[/url]'>Insert Link</option>
  <option value='[center]TEXT HERE[/center]'>Center</option>
  <option value='[left]TEXT HERE[/left]'>Left</option>
  <option value='[right]TEXT HERE[/right]'>Right</option>
  <option value='[b]TEXT HERE[/b]'>Bold</option>
  <option value='[i]TEXT HERE[/i]'>Italic</option>
  <option value='[u]TEXT HERE[/u]'>Underline</option>
  <option value='[color=red]TEXT HERE[/color]'>Font (Red)</option>
  <option value='[color=blue]TEXT HERE[/color]'>Font (Blue)</option>
  <option value='[color=yellow]TEXT HERE[/color]'>Font (Yellow)</option>
  <option value='[color=orange]TEXT HERE[/color]'>Font (Orange)</option>
  <option value='[color=black]TEXT HERE[/color]'>Font (Black)</option>
  <option value='[color=white]TEXT HERE[/color]'>Font (White)</option>
  <option value='[color=gray]TEXT HERE[/color]'>Font (Gray)</option>
  <option value='[email]EMAIL HERE[/email]'>Email</option>
  <option value='[quote]TEXT HERE[/quote]'>Quote</option>
  <option value='[highlight]TEXT HERE[/highlight]'>Highlight</option>
  <option value='&nbrlb;'>Break Line</option>
</select>
<form action='signature.php?action=signaturechange2' method='post'>
<textarea id='text' type='text' rows=20 cols=50 name='newsignature'>{$getsig['signature']}</textarea><br /><br />
<input type='submit' class='buttonsubmit' value='Change Signature' /></form>
</center>";
}
function do_signature_change()
{
global $conn,$ir,$c,$userid,$h;
$_SESSION['userid'] = $conn->real_escape_string($_SESSION['userid']);
$user=$conn->real_escape_string($_SESSION['userid']);
$userid = abs ((int) $user);
$_POST['newsignature'] = htmlspecialchars($_POST['newsignature']);
$newsignature = $conn->real_escape_string($_POST['newsignature']);
    if(empty($newsignature))
{
    print"<div id='err'>You need to fill in the field with something. <br />
    <button class='buttonnormal' onclick='goBack()'>Try Again</button></div>";
    
    
}
else {
$_SESSION['userid'] = $conn->real_escape_string($_SESSION['userid']);
$user=$conn->real_escape_string($_SESSION['userid']);
$userid = abs ((int) $user);
 $signa2 = $conn->query("SELECT userid, signature FROM profilesignatures WHERE userid='{$userid}'");
   if (mysqli_num_rows($signa2) == 1) {
       
$_POST['newsignature'] = htmlspecialchars($_POST['newsignature']);
$newsignature = htmlspecialchars($_POST['newsignature']);
$cleansig=str_replace(array("[img]/", ".php[/img]", "[IMG]/", ".php[/IMG]", ".PHP[/IMG]", ".PHP[/img]","\n"),array("", "", "", "", "", "","\n"),strip_tags($newsignature));

$conn->query("UPDATE profilesignatures SET signature='$cleansig' WHERE userid=$userid");
print "<div id='succ'>Profile signature updated!<br /><a href='viewuser.php?u={$ir['userid']}'><button class='buttonnormal'>Profile</button></a></div>";
}
else
{
$_POST['newsignature'] = htmlspecialchars($_POST['newsignature']);
$newsignature = htmlspecialchars($_POST['newsignature']);
$cleansig=str_replace(array("[img]/", ".php[/img]", "[IMG]/", ".php[/IMG]", ".PHP[/IMG]", ".PHP[/img]","\n"),array("", "", "", "", "", "","\n"),strip_tags($newsignature));

$conn->query("INSERT INTO profilesignatures (userid, signature) values ({$userid}, '$cleansig')");
print "<div id='succ'>New profile signature created!<br /><a href='viewuser.php?u={$ir['userid']}'><button class='buttonnormal'>Profile</button></a></div>";
}
}
}
$h->endpage();
?>