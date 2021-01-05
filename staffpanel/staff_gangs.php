<?php
include "sglobals.php";
//This contains gang stuffs

$_GET['action'] = $conn->real_escape_string($_GET['action']);
$_GET['gang'] = $conn->real_escape_string($_GET['gang']);

$_GET['reason'] = $conn->real_escape_string($_GET['reason']);

$gang = $conn->real_escape_string($_POST['gang']);

$reason = $conn->real_escape_string($_POST['reason']);

switch($_GET['action'])
{
case 'grecord': admin_gang_record(); return;
case 'gcredit': admin_gang_credit(); return;
case 'gform': admin_gang_credit_form(); return;
case 'gconfirm': admin_gang_credit_submit(); return;
case 'editgangname': admin_gang_editnameform(); return;
case 'gwar': admin_gang_wars(); return;
case 'gwardelete': admin_gang_wardelete(); return;
case 'gedit': admin_gang_edit_begin(); return;
case 'geditform': admin_gang_edit_form(); return;
case 'gedit_name': admin_gang_edit_name(); return;
case 'gedit_prefix': admin_gang_edit_prefix(); return;
case 'gedit_prefixform': admin_gang_edit_prefixform(); return;

case 'gedit_finances': admin_gang_edit_finances(); return;
case 'gedit_financesform': admin_gang_edit_financesform(); return;
case 'gedit_staff': admin_gang_edit_staff(); return;
case 'gedit_staffform': admin_gang_edit_staffform(); return;
case 'gedit_capacity': admin_gang_edit_capacity(); return;
case 'gedit_capacityform': admin_gang_edit_capacityform(); return;
case 'gedit_crime': admin_gang_edit_crime(); return;
case 'gedit_crimeform': admin_gang_edit_crimeform(); return;
case 'gedit_ament': admin_gang_edit_ament(); return;
case 'gedit_amentform': admin_gang_edit_amentform(); return;
default: print "Error: This script requires an action."; return;
}
function absint($in, $neg=1)
{
if($neg)
{
return abs((int) $in);
}
else 
{
return (int) $in;
}
}
function admin_gang_record()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] > 3)
{
die("403");
}
$gang = absint( $_POST['gang'] );
if ( $gang )
{
$q=$conn->query("SELECT g.* FROM gangs g WHERE g.gangID=$gang");
if(!mysqli_num_rows($q))
{
$_POST['gang']=0;
print"<div class='error-msg'>Gang doesn't exist!</div>";
admin_gang_record();
}
else if (!$_POST['reason'])
{
$_POST['gang']=0;
print"<div class='error-msg'>Enter a reason for viewing this gang!</div>";
admin_gang_record();
}
else
{
$r=$q->fetch_assoc();
print "<table width='100%' border='1'>
<tr>
<td>
Gang Name: {$r['gangNAME']}<br />
Gang Description: {$r['gangDESC']}<br />
Prefix: {$r['gangPREF']}<br />
Money: {$r['gangMONEY']}<br />
Crystals: {$r['gangCRYSTALS']}<br />
Respect: {$r['gangRESPECT']}<br />
President: {$r['gangPRESIDENT']}<br />
Vice-President: {$r['gangVICEPRES']}<br />
Capacity: {$r['gangCAPACITY']}<br />
Crime: {$r['gangCRIME']}<br />
Hours Left: {$r['gangCHOURS']}<br />
Annnouncement: {$r['gangAMENT']}
</td>
</tr>
</table>";
stafflog_add("Looked at gang ID [{$r['gangID']}] ({$r['gangNAME']}) record with the reason: [{$_POST['reason']}]");
}
}
else
{
print"
<form action='staff_gangs.php?action=grecord' method='post'>
<h3>Gang Record</h3>
<div class='infostaff'>You can view a gang profile here.</div>
		<br />
		<br />
Gang List: ".gang_dropdown($c,'gang')."<br />
Reason for viewing: <input type='text' name='reason' value='' /><br />
<input type='submit' value='Go' />
</form>
";
}
}
function admin_gang_credit()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_POST['gang'] );
$submit = absint( $_POST['submit'] );
$money = absint( $_POST['money'] , 0);
$crystals = absint( $_POST['crystals'] , 0);

$gang = $conn->real_escape_string($_POST['gang']);

$reason = $conn->real_escape_string($_POST['reason']);

$gang1 = absint( $_POST['gang'] );

$q1=$conn->query("SELECT gangID FROM gangs WHERE gangID='$gang'");
if(!mysqli_num_rows($q1))
{
$gang=0;
print"<div class='error-msg'>Gang doesn't exist!</div>";
admin_gang_credit_form();
}
elseif(empty($money))
{
print"<div class='error-msg'>You need to enter an amount higher than 0!</div>";
admin_gang_credit_form();
}
else
{
$qq=$conn->query("SELECT gangName FROM gangs WHERE gangID = $gang");
$q = $qq->fetch_row();
print "You are crediting ".$q[0]." with \$$money and/or $crystals

crystals.<br />
<form action='staff_gangs.php?action=gconfirm' method='post'>
<input type='hidden' name='gang' value='$gang' />
<input type='hidden' name='money' value='$money' />
<input type='hidden' name='crystals' value='$crystals' />
<input type='hidden' name='submit' value='1' />
Reason: <input type='text' name='reason' /><br />
<input type='submit' value='Credit' />
</form>";
}

}
function admin_gang_credit_submit()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_POST['gang'] );
$submit = absint( $_POST['submit'] );
$money = absint( $_POST['money'] , 0);
$crystals = absint( $_POST['crystals'] , 0);
$gang = $conn->real_escape_string($_POST['gang']);
$reason = $conn->real_escape_string($_POST['reason']);
    $qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = NULL");
if(mysqli_num_rows($qqq))
{
$gang=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_credit_form();
}
elseif( $gang && $reason)
{
$conn->query("UPDATE gangs SET gangMONEY=gangMONEY+$money, gangCRYSTALS=gangCRYSTALS+$crystals WHERE gangID = $gang");
print "<div class='success-msg'>The gang was successfully credited</div>";
stafflog_add("Credited gang ID [{$gang}] with ".money_formatter($money)." money and/or ".cash_format($crystals)." crystals with the reason: [{$reason}]");
admin_gang_credit_form();
}
else {
print"<div class='error-msg'>ERROR: You missed something!</div>";
admin_gang_credit_form();
}
}

function admin_gang_credit_form()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
print "<h3>Credit Gang</h3>
<div class='infostaff'>You can credit a selected gang cash or crystals here.</div>
		<br />
		<br />
<form action='staff_gangs.php?action=gcredit' method='post'>
<table border='1' width='50%'>
<tr>
<td align='right'>Gang:</td> <td align='left'>".gang_dropdown($c,'gang')."</td>
</tr> <tr>
<td align='right'>Money:</td> <td align='left'><input type='number' name='money' 

value='1000' /></td>
</tr> <tr>
<td align='right'>Crystals:</td> <td align='left'><input type='number' name='crystals' 

value='10' /></td>
</tr> <tr>
<td align='center' colspan='2'> <input type='submit' value='Credit' /> </td>
</tr> </table>";
}



function admin_gang_wars()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] > 3)
{
die("403");
}
print "<h3>Manage Gang Wars</h3>
<div class='infostaff'>You can manage current gang wars from the records below.</div>
		<br />
		<br />
<table class='table' width='100%'>";
$q=$conn->query("SELECT w.*,g1.gangNAME as declarer, g1.gangRESPECT as drespect, g2.gangNAME as defender, g2.gangRESPECT as frespect FROM gangwars w LEFT JOIN gangs g1 ON w.warDECLARER=g1.gangID LEFT JOIN gangs g2 ON w.warDECLARED=g2.gangID");
while($r=$q->fetch_assoc())
{
print "<tr> <td width=40%><a href='../gangs.php?action=view&ID={$r['warDECLARER']}'>{$r['declarer']}</a> [{$r['drespect']} respect]</a></td> <td width=10%>vs.</td> <td width=40%><a href='gangs.php?action=view&ID={$r['warDECLARED']}'>{$r['defender']}</a> [{$r['frespect']} respect]</a></td> <td>[<a href='staff_gangs.php?action=gwardelete&war={$r['warID']}'>Delete</a>]</td></tr>";
}
print "</table>";
}
function admin_gang_wardelete()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] > 3)
{
die("403");
}

$_GET['war'] = $conn->real_escape_string($_GET['war']);
$q1=$conn->query("SELECT w.*,g1.gangNAME as declarer, g1.gangRESPECT as drespect, g2.gangNAME as defender, g2.gangRESPECT as frespect FROM gangwars w LEFT JOIN gangs g1 ON w.warDECLARER=g1.gangID LEFT JOIN gangs g2 ON w.warDECLARED=g2.gangID WHERE w.warID={$_GET['war']}");
if(!mysqli_num_rows($q1))
{
$_GET['war']=0;
print"<div class='error-msg'>War ID doesn't exist!</div>";
admin_gang_wars();
}
else{
    
$_GET['war'] = $conn->real_escape_string($_GET['war']);
$q=$conn->query("SELECT w.*,g1.gangNAME as declarer, g1.gangRESPECT as drespect, g2.gangNAME as defender, g2.gangRESPECT as frespect FROM gangwars w LEFT JOIN gangs g1 ON w.warDECLARER=g1.gangID LEFT JOIN gangs g2 ON w.warDECLARED=g2.gangID WHERE w.warID={$_GET['war']}");
$r=$q->fetch_assoc();
$conn->query("DELETE FROM gangwars WHERE warID={$_GET['war']}");
print "<div class='success-msg'>You have successfully deleted this war</div>";
stafflog_add("Deleted war ID [{$_GET['war']}] (<a href='gangs.php?action=view&ID={$r['warDECLARER']}'>{$r['declarer']}</a> [{$r['drespect']} respect]</a> vs. <a href='../gangs.php?action=view&ID={$r['warDECLARED']}'>{$r['defender']}</a> [{$r['frespect']} respect]</a>)");

    admin_gang_wars();
}
}
function admin_gang_edit_begin()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_POST['gang'] );
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$_POST['gang']=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
else
{
$gang = absint( $_POST['gang'] );
if ( $gang )
{
$qq=$conn->query("SELECT gangNAME FROM gangs WHERE gangID = $gang");
$q = $qq->fetch_row();
$theirname= $q[0];
$edits = array (
1 => array (
'Name And Description', 'editgangname', '4'
),
2 => array (
'Prefix', 'gedit_prefixform', '4'
),
3 => array (
'Finances + Respect', 'gedit_financesform', '4'
),
4 => array (
'Staff', 'gedit_staffform', '4'
),
5 => array (
'Capacity', 'gedit_capacityform', '4'
),
6 => array (
'Organised Crime', 'gedit_crimeform', '4'
),
7 => array (
'Announcement', 'gedit_amentform', '4'
)
);
print "<h3>Manage Gang</h3>
You are managing the gang: $theirname<br />
Choose an edit to perform.<br />
<table width='100%' class='table' cellspacing='1'><tr style='background: gray'><th>Edit Type</th>

<th>Available For Use</th> <th>Use</th> </tr>\n";
foreach ( $edits as $k => $v)
{
if ($v[2] >= $ir['user_level']) { $a="green'>Yes";$l="<a href='staff_gangs.php?action=$v[1]&gang=$gang'>Go</a>"; } else { $a="red'>No";$l="N/A"; }
print "<tr> <td>$v[0]</td> <td><b><font color='$a</font></b></td> <td>$l</td></tr>\n";
}
print "</table>";
}
}
}


function admin_gang_edit_form()
{
    global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
    print"
    <form action='staff_gangs.php?action=gedit' method='post'>
<h3>Gang Management</h3><div class='infostaff'>You can manage every aspect of the selected gang here.</div>
		<br />
		<br />
".gang_dropdown($c,'gang')."<br />
<input type='submit' value='Go' />
</form>
    ";
}













function admin_gang_edit_name()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$_GET['gang']=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
else{
    
    $gang = absint( $_GET['gang'] );
$submit = absint( $_POST['submit'] );
$q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang", $c);
if ( $submit )
{
    $gangname=$conn->real_escape_string($_POST['gangNAME']);
    $gangdesc=$conn->real_escape_string($_POST['gangDESC']);
$conn->query("UPDATE gangs SET gangNAME='$gangname', gangDESC='$gangdesc' WHERE gangID=$gang");
print "<div class='success-msg'>Gang name and/or description has been successfully modified</div>";
stafflog_add("Edited gang ID [$gang] name and/or description", $c);
admin_gang_edit_form();
}
}
}


function admin_gang_editnameform()
{
    global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$_GET['gang']=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
else {
    $gang = absint( $_GET['gang'] );
$submit = absint( $_POST['submit'] );
$q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang", $c);
$r=$q->fetch_assoc();
    print"
    <h3>Gang Management: Name/Description</h3>
Editing the gang: {$r['gangNAME']}<br />
<form action='staff_gangs.php?action=gedit_name&gang=$gang' method='post'>
<table width='50%' cellspacing='1' class='table'>
<tr>
<td align=right>Name:</td>
<td align=left><input type='text' name='gangNAME' value='{$r['gangNAME']}' /></td>
</tr>
<tr>
<td align=right>Description:</td>
<td align=left><textarea rows='7' cols='40' name='gangDESC'>{$r['gangDESC']}</textarea></td>
</tr>
<tr>
<td align=center colspan=2><input type='hidden' name='submit' value='1' /><input type='submit' value='Edit' /></td>
</tr>
</table>
</form>
    
    ";
}
}

function admin_gang_edit_prefixform()
{
    global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$_GET['gang']=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
else {
    $gang = absint( $_GET['gang'] );
$submit = absint( $_POST['submit'] );
$q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang", $c);
$r=$q->fetch_assoc();
print"<h3>Gang Management: Prefix</h3>
Editing the gang: {$r['gangNAME']}<br />
<form action='staff_gangs.php?action=gedit_prefix&gang=$gang' method='post'>
<table width='50%' cellspacing='1' class='table'>
<tr>
<td align=right>Prefix:</td>
<td align=left><input type='text' name='gangPREF' value='{$r['gangPREF']}' /></td>
</tr>
<tr>
<td align=center colspan=2><input type='hidden' name='submit' value='1' /><input type='submit' value='Edit' /></td>
</tr>
</table>
</form>";
}
}


function admin_gang_edit_prefix()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$_GET['gang']=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}else{
$gang = absint( $_GET['gang'] );
$submit = absint( $_POST['submit'] );
$q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang");
$r=$q->fetch_assoc();
if ( $submit )
{
    $_POST['gangPREF'] = $conn->real_escape_string($_POST['gangPREF']);
$conn->query("UPDATE gangs SET gangPREF='{$_POST['gangPREF']}' WHERE gangID=$gang");
print "<div class='success-msg'>Gang prefix has been successfully modified</div>";
stafflog_add("Edited gang ID [$gang] prefix");
admin_gang_edit_form();
}
}
}





function admin_gang_edit_financesform()
{
   global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
} 
$gang = absint( $_GET['gang'] );
$money = absint( $_POST['money'], 0 );
$crystals = absint( $_POST['crystals'], 0 );
$respect = absint( $_POST['respect'], 0 );
$submit = absint( $_POST['submit'] );
$reason = $_POST['reason'];
$q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang");
$r=$q->fetch_assoc();
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$gang=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
else{
print"
<h3>Gang Management: Financial Details</h3>
Editing the gang: {$r['gangNAME']}<br />
<form action='staff_gangs.php?action=gedit_finances&gang=$gang' method='post'>
<table width='50%' cellspacing='1' class='table'>
<tr>
<td align=right>Money:</td>
<td align=left><input type='number' name='money' value='{$r['gangMONEY']}' /></td>
</tr>
<tr>
<td align=right>Crystals:</td>
<td align=left><input type='number' name='crystals' value='{$r['gangCRYSTALS']}' /></td>
</tr>
<tr>
<td align=right>Respect:</td>
<td align=left><input type='number' name='respect' value='{$r['gangRESPECT']}' /></td>
</tr>
<tr>
<td align=right>Reason for editing:</td>
<td align=left><input type='text' name='reason' value='' /></td>
</tr>
<tr>
<td align=center colspan=2><input type='hidden' name='submit' value='1' /><input type='submit' value='Edit' /></td>
</tr>
</table>
</form>
";
}
}

function admin_gang_edit_finances()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$_GET['gang']=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}else{
$gang = absint( $_GET['gang'] );
$money = absint( $_POST['money'], 0 );
$crystals = absint( $_POST['crystals'], 0 );
$respect = absint( $_POST['respect'], 0 );
$submit = absint( $_POST['submit'] );
$reason = $_POST['reason'];
$q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang");
$r=$q->fetch_assoc();
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$gang=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
elseif(empty($_POST['reason']))
{
print"<div class='error-msg'>You need to enter a reason!</div>";
admin_gang_edit_form();
}
else
{
    
    $_POST['reason'] = $conn->real_escape_string($_POST['reason']);
$conn->query("UPDATE gangs SET gangMONEY=$money, gangCRYSTALS=$crystals, gangRESPECT=$respect WHERE gangID=$gang");
print "<div class='success-msg'>Gang finances and respect has been successfully modified</div>";
stafflog_add("Edited gang ID [$gang] finances and respect with the reason: [$reason]");
admin_gang_edit_form();
}
}
}


function admin_gang_edit_staffform()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$president = absint( $_POST['president'], 0 );
$vicepres = absint( $_POST['vicepres'], 0 );
$submit = absint( $_POST['submit'] );
$reason = $_POST['reason'];

$inv=$conn->query("SELECT iv.*,i.*,it.* FROM inventory iv LEFT JOIN items i ON iv.inv_itemid=i.itmid LEFT JOIN itemtypes it ON i.itmtype=it.itmtypeid WHERE iv.inv_userid={$_POST['user']}");
$q=$conn->query("SELECT g.*,u.* FROM gangs g LEFT JOIN users u ON g.gangPRESIDENT=u.userid WHERE g.gangID=$gang");
$r=$q->fetch_assoc();

$q1=$conn->query("SELECT g.*,u.* FROM gangs g LEFT JOIN users u ON g.gangVICEPRES=u.userid WHERE g.gangID=$gang");
$r2=$q1->fetch_assoc();
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$gang=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
else{
print"
<h3>Gang Management: Staff</h3>
Editing the gang: {$r['gangNAME']}<br />
<form action='staff_gangs.php?action=gedit_staff&gang=$gang' method='post'>
<table width='50%' cellspacing='1' class='table'>
<tr>
<td align=right>President:</td>
<td align=left>Current: <b>{$r['username']}</b>
<br />
".user_dropdown($c,'president')."</td>
</tr>
<tr>
<td align=right>Vice-President:</td>
<td align=left>Current: <b>{$r2['username']}</b>
<br />
".user_dropdown($c,'vicepres')."</td>
</tr>
<tr>
<td align=right>Reason for editing:</td>
<td align=left><input type='text' name='reason' value='' /></td>
</tr>
<tr>
<td align=center colspan=2><input type='hidden' name='submit' value='1' /><input type='submit' value='Edit' /></td>
</tr>
</table>
</form>
";
}  
}



function admin_gang_edit_staff()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$president = absint( $_POST['president'], 0 );
$vicepres = absint( $_POST['vicepres'], 0 );
$submit = absint( $_POST['submit'] );
$reason = $_POST['reason'];
$q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang");
$r=$q->fetch_assoc();
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$gang=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
elseif(empty($_POST['reason']))
{
print"<div class='error-msg'>You need to enter a reason!</div>";
admin_gang_edit_form();
}
else
{
    
    $_POST['reason'] = $conn->real_escape_string($_POST['reason']);
$conn->query("UPDATE gangs SET gangPRESIDENT=$president, gangVICEPRES=$vicepres WHERE gangID=$gang");
print "<div class='success-msg'>Gang staff has been successfully modified</div>";
stafflog_add("Edited gang ID [$gang] staff with the reason: [$reason]");
admin_gang_edit_form();
}

}
function admin_gang_edit_capacityform()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$capacity = absint( $_POST['capacity'], 0 );
$submit = absint( $_POST['submit'] );
$reason = $_POST['reason'];
$q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang");
$r=$q->fetch_assoc();
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$gang=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
else{
print"
<h3>Gang Management: Capacity</h3>
Editing the gang: {$r['gangNAME']}<br />
<form action='staff_gangs.php?action=gedit_capacity&gang=$gang' method='post'>
<table width='50%' cellspacing='1' class='table'>
<tr>
<td align=right>Capacity:</td>
<td align=left><input type='number' name='capacity' value='{$r['gangCAPACITY']}' /></td>
</tr>
<tr>
<td align=right>Reason for editing:</td>
<td align=left><input type='text' name='reason' value='' /></td>
</tr>
<tr>
<td align=center colspan=2><input type='hidden' name='submit' value='1' /><input type='submit' value='Edit' /></td>
</tr>
</table>
</form>";
}
}


function admin_gang_edit_capacity()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$capacity = absint( $_POST['capacity'], 0 );
$submit = absint( $_POST['submit'] );
$reason = $_POST['reason'];
$q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang");
$r=$q->fetch_assoc();
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$gang=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
elseif(empty($_POST['reason']))
{
print"<div class='error-msg'>You need to enter a reason!</div>";
admin_gang_edit_form();
}
else
{
    $_POST['reason'] = $conn->real_escape_string($_POST['reason']);
$conn->query("UPDATE gangs SET gangCAPACITY=$capacity WHERE gangID=$gang");
print "<div class='success-msg'>Gang capacity has been successfully modified</div>";
stafflog_add("Edited gang ID [$gang] capacity with the reason: [$reason]");

admin_gang_edit_form();
}
}




function admin_gang_edit_crimeform()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$crime = absint( $_POST['crime'], 0 );
$chours = absint( $_POST['chours'], 0 );
$submit = absint( $_POST['submit'] );
$reason = $_POST['reason'];
$q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang");
$r=$q->fetch_assoc();

$q1=$conn->query("SELECT g.*,c.* FROM gangs g LEFT JOIN orgcrimes c ON g.gangCRIME=c.ocID WHERE g.gangID=$gang");
$r2=$q1->fetch_assoc();
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$gang=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
else{
print"
<h3>Gang Management: Organised Crimes</h3>
Editing the gang: {$r['gangNAME']}<br />
<form action='staff_gangs.php?action=gedit_crime&gang=$gang' method='post'>
<table width='50%' cellspacing='1' class='table'>
<tr>
<td align=right>Crime:</td>
<td align=left>
Current crime:<b> {$r2['ocNAME']}</b>
<br />
".gangcrime_dropdown($c,'crime')."
</td>
</tr>
<tr>
<td align=right>Crime Hours Left:</td>
<td align=left><input type='number' name='chours' value='{$r['gangCHOURS']}' /></td>
</tr>
<tr>
<td align=right>Reason for editing:</td>
<td align=left><input type='text' name='reason' value='' /></td>
</tr>
<tr>
<td align=center colspan=2><input type='hidden' name='submit' value='1' /><input type='submit' value='Edit' /></td>
</tr>
</table>
</form>
";
}
}

function admin_gang_edit_crime()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$crime = absint( $_POST['crime'], 0 );
$chours = absint( $_POST['chours'], 0 );
$submit = absint( $_POST['submit'] );
$reason = $_POST['reason'];
$q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang");
$r=$q->fetch_assoc();
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$gang=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
elseif(empty($_POST['reason']))
{
print"<div class='error-msg'>You need to enter a reason!</div>";
admin_gang_edit_form();
}
else
{
    $_POST['reason'] = $conn->real_escape_string($_POST['reason']);
$conn->query("UPDATE gangs SET gangCRIME=$crime, gangCHOURS=$chours WHERE gangID=$gang");
print "<div class='success-msg'>Gang crime has been successfully modified</div>";
stafflog_add("Edited gang ID [$gang] organised crime with the reason: [$reason]");

admin_gang_edit_form();
}
}

function admin_gang_edit_amentform()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$submit = absint( $_POST['submit'] );

$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$gang=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
else {
    $q=$conn->query("SELECT * FROM gangs WHERE gangID = $gang");
$r=$q->fetch_assoc();
print"
<h3>Gang Management: Announcement</h3>
Editing the gang: {$r['gangNAME']}<br />
<form action='staff_gangs.php?action=gedit_ament&gang=$gang' method='post'>
<table width='50%' cellspacing='1' class='table'>
<tr>
<td align=right>Announcement:</td>
<td align=left><textarea rows='7' cols='40' name='gangAMENT'>{$r['gangAMENT']}</textarea></td>
</tr>
<tr>
<td align=center colspan=2><input type='hidden' name='submit' value='1' /><input type='submit' value='Edit' /></td>
</tr>
</table>
</form>
";
}
}

function admin_gang_edit_ament()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] !=2)
{
die("403");
}
$gang = absint( $_GET['gang'] );
$submit = absint( $_POST['submit'] );
$qqq=$conn->query("SELECT gangID FROM gangs WHERE gangID = $gang");
if(!mysqli_num_rows($qqq))
{
$gang=0;
print"<div class='error-msg'>Gang ID doesn't exist!</div>";
admin_gang_edit_form();
}
else{
    $_POST['reason'] = $conn->real_escape_string($_POST['reason']);
$_POST['gangAMENT'] = $conn->real_escape_string($_POST['gangAMENT']);
$conn->query("UPDATE gangs SET gangAMENT='{$_POST['gangAMENT']}' WHERE gangID=$gang");
print "<div class='success-msg'>Gang ID $gang announcement has been successfully modified</div>";
stafflog_add("Edited gang ID [$gang] announcement");

admin_gang_edit_form();
}
}


function report_clear()
{
global $conn,$conn,$ir,$c,$h,$userid;
if($ir['user_level'] !=2)
{
die("403");
}
$_GET['ID'] = abs((int) $_GET['ID']);
stafflog_add("Cleared player report ID {$_GET['ID']}");
$conn->query("DELETE FROM preports WHERE prID={$_GET['ID']}");
print "<div class='error-msg'>Report cleared and deleted!</div>";
}
$h->endpage();
?>