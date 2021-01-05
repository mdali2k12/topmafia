<?php
include "sglobals.php";
if($ir['user_level'] != 2)
{
die("403");
}
//This contains course stuffs
$_GET['action'] = $conn->real_escape_string($_GET['action']);
switch($_GET['action'])
{
case 'newcrime': new_crime_form(); return;
case 'newcrimesub': new_crime_submit(); return; 
case 'editcrime': edit_crime_begin(); return;
case 'editcrimeform': edit_crime_form(); return;
case 'editcrimesub': edit_crime_sub(); return;
case 'delcrime': delcrime(); return; 
case 'delcrimesubmit': delcrimesubmit(); return; 
case 'delcrimeform': delcrimeform(); return; 
case 'newcrimegroup': new_crimegroup_form(); return;
case 'newcrimegroupsub': new_crimegroup_submit(); return;
case 'editcrimegroup': edit_crimegroup_begin(); return;
case 'editcrimegroupform': edit_crimegroup_form(); return;
case 'editcrimegroupsub': edit_crimegroup_sub(); return;
case 'delcrimegroup': delcrimegroup(); return;
case 'delcrimegroupsubmit': delcrimegroupsubmit(); return;
case 'delcrimegroupconfirm': delcrimegroupconfirm(); return;
case 'reorder': reorder_crimegroups(); return;
case 'reorderform': reorderform(); return;
default: print "Error: This script requires an action."; return;
}
function new_crime_form()
{
global $ir, $c, $conn;
print "<h3>Add new crime</h3>
<div class='infostaff'>You can create a new crime to be added to the game below.</div>
		<br />
		<br />
<form action='staff_crimes.php?action=newcrimesub' method='post'>
Name: <input type='text' name='name' /><br />
Brave Cost: <input type='number' name='brave' /><br />
Success % Formula: <input type='text' name='percform' value='((WILL*0.8)/2.5)+(LEVEL/4)' /><br />
Success Money: <input type='number' name='money' /><br />
Success Crystals: <input type='number' name='crys' /><br />
Success Item: ".item2_dropdown($c, 'item')."<br />
Group: ".crimegroup_dropdown($c,'group')."<br />
Jail Time: <input type='number' name='jailtime' /><br />
Crime XP Given: <input type='number' name='crimexp' /><br />
<input type='submit' value='Create Crime' /></form>";
}
function new_crime_submit()
{ 
global $ir,$c,$userid, $conn;
$_POST['name'] = $conn->real_escape_string($_POST['name']);
$q=$conn->query("SELECT crimeID, crimeNAME FROM crimes WHERE crimeNAME='{$_POST['name']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two crimes with the same name</div>";
new_crime_form();
}
elseif(empty($_POST['name']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
new_crime_form();
}
else{
$_POST['name'] = $conn->real_escape_string($_POST['name']);
$_POST['brave'] = $conn->real_escape_string($_POST['brave']);
$_POST['percform'] = $conn->real_escape_string($_POST['percform']);
$_POST['money'] = $conn->real_escape_string($_POST['money']);
$_POST['crys'] = $conn->real_escape_string($_POST['crys']);
$_POST['item'] = $conn->real_escape_string($_POST['item']);
$_POST['group'] = $conn->real_escape_string($_POST['group']);
$_POST['jailtime'] = $conn->real_escape_string($_POST['jailtime']);
$_POST['crimexp'] = $conn->real_escape_string($_POST['crimexp']);

$conn->query("INSERT INTO crimes (crimeNAME, crimeBRAVE, crimePERCFORM, crimeSUCCESSMUNY, crimeSUCCESSCRYS, crimeSUCCESSITEM, crimeGROUP, crimeJAILTIME, crimeXP) VALUES( '{$_POST['name']}', '{$_POST['brave']}', '{$_POST['percform']}', '{$_POST['money']}', {$_POST['crys']}, {$_POST['item']}, '{$_POST['group']}', {$_POST['jailtime']}, {$_POST['crimexp']})");
$i = $conn->insert_id;
print "<div class='success-msg'>Crime created!</div>";
stafflog_add("Created crime {$_POST['name']} [$i]");
new_crime_form();
} 
}
function edit_crime_begin()
{
global $ir,$c,$h,$userid,$conn;
print "<h3>Editing Crime</h3>
<div class='infostaff'>You can edit every aspect of the crime below.</div>
		<br />
		<br />
<form action='staff_crimes.php?action=editcrimeform' method='post'>
Crime: ".crime_dropdown($c,'crime')."<br />
<input type='submit' value='Edit Crime' /></form>";
}
function edit_crime_form()
{
global $ir,$c,$h,$userid,$conn;
$q=$conn->query("SELECT crimeID, crimeNAME FROM crimes WHERE crimeID='{$_POST['crime']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, crime ID doesnt exist</div>";
edit_crime_begin();
}
elseif(empty($_POST['crime']))
{
print "<div class='error-msg'>You need select crime to edit</div>";
edit_crime_begin();
}
else{
$d=$conn->query("SELECT * FROM crimes WHERE crimeID={$_POST['crime']}");
$itemi=$d->fetch_assoc();
print "<h3>Editing Crime</h3>
<form action='staff_crimes.php?action=editcrimesub' method='post'>
<input type='hidden' name='crimeID' value='{$_POST['crime']}' />
Name: <input type='text' name='crimeNAME' value='{$itemi['crimeNAME']}' /><br />
Brave Cost: <input type='text' name='crimeBRAVE' value='{$itemi['crimeBRAVE']}' /><br />
Success % Formula: <input type='text' name='crimePERCFORM' value='{$itemi['crimePERCFORM']}' /><br />
Success Money: <input type='text' name='crimeSUCCESSMUNY' value='{$itemi['crimeSUCCESSMUNY']}' /><br />
Success Crystals: <input type='text' name='crimeSUCCESSCRYS' value='{$itemi['crimeSUCCESSCRYS']}' /><br />
Success Item: ".item2_dropdown($c, 'crimeSUCCESSITEM', $itemi['crimeSUCCESSITEM'])."<br />
Group: ".crimegroup_dropdown($c,'crimeGROUP', $itemi['crimeGROUP'])."<br />
Jail Time: <input type='text' name='crimeJAILTIME' value='{$itemi['crimeJAILTIME']}' /><br />=
Crime XP Given: <input type='text' name='crimeXP' value='{$itemi['crimeXP']}' /><br />
<input type='submit' value='Edit Crime' /></form>";
}
}
function edit_crime_sub()
{
    
global $ir,$c,$h,$userid, $conn;
$u=$conn->query("SELECT crimeID, crimeNAME FROM crimes WHERE crimeNAME='{$_POST['crimeNAME']}' AND crimeID!='{$_POST['crimeID']}'");
if(mysqli_num_rows($u) != 0)
{
print "<div class='error-msg'>This crime name already exists</div>";
edit_crime_begin();
}
elseif(empty($_POST['crimeNAME']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
edit_crime_begin();
}
else{
$_POST['crimeNAME'] = $conn->real_escape_string($_POST['crimeNAME']);
$_POST['crimeBRAVE'] = $conn->real_escape_string($_POST['crimeBRAVE']);
$_POST['crimePERCFORM'] = $conn->real_escape_string($_POST['crimePERCFORM']);
$_POST['crimeSUCCESSMUNY'] = $conn->real_escape_string($_POST['crimeSUCCESSMUNY']);
$_POST['crimeSUCCESSCRYS'] = $conn->real_escape_string($_POST['crimeSUCCESSCRYS']);
$_POST['crimeSUCCESSITEM'] = $conn->real_escape_string($_POST['crimeSUCCESSITEM']);
$_POST['crimeGROUP'] = $conn->real_escape_string($_POST['crimeGROUP']);
$_POST['crimeJAILTIME'] = $conn->real_escape_string($_POST['crimeJAILTIME']);
$_POST['crimeXP'] = $conn->real_escape_string($_POST['crimeXP']);

$conn->query("UPDATE crimes SET crimeNAME='{$_POST['crimeNAME']}', crimeBRAVE='{$_POST['crimeBRAVE']}', crimePERCFORM='{$_POST['crimePERCFORM']}', crimeSUCCESSMUNY='{$_POST['crimeSUCCESSMUNY']}', 
crimeSUCCESSCRYS='{$_POST['crimeSUCCESSCRYS']}', 
crimeSUCCESSITEM='{$_POST['crimeSUCCESSITEM']}', crimeGROUP='{$_POST['crimeGROUP']}', crimeJAILTIME={$_POST['crimeJAILTIME']}, crimeXP={$_POST['crimeXP']} WHERE crimeID={$_POST['crimeID']}");
print "<div class='success-msg'>Crime edited</div>";
stafflog_add("Edited crime {$_POST['crimeNAME']} [{$_POST['crimeID']}]");
edit_crime_begin();
}
} 
function delcrimeform()
{
  global $ir,$c,$h,$userid, $conn;
      echo "<h3>Deleting Crime</h3>
      <div class='infostaff'>This will remove the crime from the database.</div>
		<br />
		<br />
      <form action='staff_crimes.php?action=delcrimesubmit' method='post'>
      Crime: ".crime_dropdown($c,'crime')."<br />
      <input type='submit' value='Delete Crime' /></form>";  
}
function delcrimesubmit()
{
global $ir,$c,$h,$userid, $conn;

      $target = $conn->real_escape_string($_POST['crime']);
$q=$conn->query("SELECT crimeNAME FROM crimes WHERE crimeID='$target'");

if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, crime ID doesnt exist</div>";
delcrimeform();
}
elseif(empty($_POST['crime']))
{
print "<div class='error-msg'>Select a crime to delete</div>";
delcrimeform();
}
else
{
      $target = $conn->real_escape_string($_POST['crime']);
      $d=$conn->query("SELECT crimeNAME FROM crimes WHERE crimeID='$target'");
      $itemi=$d->fetch_assoc();
      print "<h3>Confirm</h3>
      Delete crime -  ".$itemi["crimeNAME"]."?
      <form action='staff_crimes.php?action=delcrime' method='post'>
      <input type='hidden' name='crimeID' value='$target' />
      <input type='submit' name='yesorno' value='Yes' />
      <input type='submit' name='yesorno' value='No' onclick=\"window.location='staff_crimes.php?action=delcrime';\" /></form>";
}
}
function delcrime()
{
    
global $ir,$c,$h,$userid, $conn;

      $target = $conn->real_escape_string($_POST['crimeID']);
$q=$conn->query("SELECT crimeNAME FROM crimes WHERE crimeID='$target'");

if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, crime ID doesnt exist</div>";
delcrimeform();
}
else {
    
      $target = $conn->real_escape_string($_POST['crimeID']);
      if($_POST['yesorno']=='No')
      {
         die("<div class='error-msg'>Crime not deleted</div>");
      }
      if ($_POST['yesorno'] != ("No" || "Yes")) die('Eh');
      $d=$conn->query("SELECT crimeNAME FROM crimes WHERE crimeID='$target'");
      $itemi=$d->fetch_assoc();
      $conn->query("DELETE FROM crimes WHERE crimeID='$target'");
      echo "<div class='success-msg'>Crime {$itemi['crimeNAME']} Deleted</div>"; 
stafflog_add("Deleted crime {$itemi['crimeNAME']} [$target]"); 
delcrimeform();
}
}


function new_crimegroup_form()
{
global $ir, $c,$conn;
print "<h3>Adding a new crime group</h3>
<div class='infostaff'>You can create a new crime group or catergory here.</div>
		<br />
		<br />
<form action='staff_crimes.php?action=newcrimegroupsub' method='post'>
Name: <input type='text' name='cgNAME' /><br />
Order Number: <input type='number' name='cgORDER' /><br />
<input type='submit' value='Create Crime Group' /></form>";
}
function new_crimegroup_submit()
{
global $ir,$c,$userid,$conn;
$_POST['cgNAME'] = $conn->real_escape_string($_POST['cgNAME']);
$q=$conn->query("SELECT cgID, cgNAME FROM crimegroups WHERE cgNAME='{$_POST['cgNAME']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two crimes groups with the same name</div>";
new_crimegroup_form();
}
elseif(empty($_POST['cgNAME']) || empty($_POST['cgORDER']))
{
print "<div class='error-msg'>You missed one or more of the required fields</div>";
new_crimegroup_form();
}
else
{
$_POST['cgNAME'] = $conn->real_escape_string($_POST['cgNAME']);
$_POST['cgORDER'] = $conn->real_escape_string($_POST['cgORDER']);
$conn->query("INSERT INTO `crimegroups` (`cgNAME`, `cgORDER`) VALUES('{$_POST['cgNAME']}','{$_POST['cgORDER']}')");
$i = $conn->insert_id;
print "<div class='success-msg'>Crime Group created!</div>";
stafflog_add("Created Crime Group {$_POST['cgNAME']} [$i]");
new_crimegroup_form();
}
}
function edit_crimegroup_begin()
{
global $ir,$c,$h,$userid,$conn;
print "<h3>Editing A Crime Group</h3>
<div class='infostaff'>You can edit every aspect of the crime group below.</div>
		<br />
		<br />
<form action='staff_crimes.php?action=editcrimegroupform' method='post'>
Crime Group: ".crimegroup_dropdown($c,'crimeGROUP')."<br />
<input type='submit' value='Edit Crime Group' /></form>";
}

function edit_crimegroup_form()
{
global $ir,$c,$h,$userid,$conn;
$q=$conn->query("SELECT cgID, cgNAME FROM crimegroups WHERE cgID='{$_POST['crimeGROUP']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, crime group ID doesnt exist</div>";
edit_crimegroup_begin();
}
elseif(empty($_POST['crimeGROUP']))
{
print "<div class='error-msg'>You need select crime group to edit</div>";
edit_crimegroup_begin();
}
else{
$_POST['crimeGROUP'] = $conn->real_escape_string($_POST['crimeGROUP']);
$d=$conn->query("SELECT * FROM crimegroups WHERE cgID={$_POST['crimeGROUP']}");
$itemi=$d->fetch_assoc();
print "<h3>Editing Crime Group</h3>
<form action='staff_crimes.php?action=editcrimegroupsub' method='post'>
<input type='hidden' name='cgID' value='{$_POST['crimeGROUP']}' />
Name: <input type='text' name='cgNAME' value='{$itemi['cgNAME']}' /><br />
Order Number: <input type='text' name='cgORDER' value='{$itemi['cgORDER']}' /><br />
<input type='submit' value='Edit Crime Group' /></form>";
}
}

function edit_crimegroup_sub()
{
global $ir,$c,$h,$userid, $conn;
$u=$conn->query("SELECT cgID, cgNAME FROM crimegroups WHERE cgNAME='{$_POST['cgNAME']}' AND cgID!='{$_POST['cgID']}'");
if(mysqli_num_rows($u) != 0)
{
print "<div class='error-msg'>This crime group name already exists</div>";
edit_crimegroup_begin();
}
elseif(empty($_POST['cgORDER']) || empty($_POST['cgNAME']))
{
print "<div class='error-msg'>You missed one or more of the required fields</div>";
edit_crimegroup_begin();
}

else{
$_POST['cgNAME'] = $conn->real_escape_string($_POST['cgNAME']);
$_POST['cgORDER'] = $conn->real_escape_string($_POST['cgORDER']);
$_POST['cgID'] = $conn->real_escape_string($_POST['cgID']);
$conn->query("UPDATE crimegroups SET  cgNAME='{$_POST['cgNAME']}', cgORDER='{$_POST['cgORDER']}' WHERE cgID='{$_POST['cgID']}'");
print "<div class='success-msg'>Crime Group edited</div>";
stafflog_add("Edited Crime Group {$_POST['cgNAME']}");
edit_crimegroup_begin();
}
}

function delcrimegroup()
{
global $ir,$c,$h,$userid, $conn;
      echo "<h3>Deleting Crime Group</h3>
      <div class='infostaff'>This will delete the crime group from the database.</div>
		<br />
		<br />
      <form action='staff_crimes.php?action=delcrimegroupsubmit' method='post' name='theform'>
      Crime Group: ".crimegroup_dropdown($c,'crimeGROUP')."<br />
Move crimes in deleted group to: ".crimegroup_dropdown($c, 'crimeGROUP2')."<br />
      <input type='submit' value='Delete Crime Group' /></form>";
}
function delcrimegroupsubmit()
{
global $ir,$c,$h,$userid, $conn;
    $q=$conn->query("SELECT cgID, cgNAME FROM crimegroups WHERE cgID='{$_POST['crimeGROUP']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, crime group ID doesnt exist</div>";
delcrimegroup();
}
elseif(empty($_POST['crimeGROUP']))
{
print "<div class='error-msg'>You need select crime group to edit</div>";
delcrimegroup();
}

else{
      
$target = $conn->real_escape_string($_POST['crimeGROUP']);

$target2 = $conn->real_escape_string($_POST['crimeGROUP2']);

if($target==$target2) { die("<div class='error-msg'>You cannot select the same crime group to move the crimes to.</div>"); }
      $d=$conn->query("SELECT cgNAME FROM crimegroups WHERE cgID='$target'");
      $itemi=$d->fetch_assoc();
      print "<h3>Confirm</h3>
      Delete crime group -  ".$itemi["cgNAME"]."?
      <form action='staff_crimes.php?action=delcrimegroupconfirm' method='post'>
      <input type='hidden' name='cgID' value='$target' />
<input type='hidden' name='cgID2' value='$target2' />
      <input type='submit' name='yesorno' value='Yes' />
      <input type='submit' name='yesorno' value='No' /></form>";
}
}
function delcrimegroupconfirm(){
    global $ir,$c,$h,$userid, $conn;
    $q=$conn->query("SELECT cgID, cgNAME FROM crimegroups WHERE cgID='{$_POST['cgID']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, crime group ID doesnt exist</div>";
delcrimegroup();
}
elseif(empty($_POST['cgID']))
{
print "<div class='error-msg'>You need select crime group to delete</div>";
delcrimegroup();
}

else{
    
      
$target = $conn->real_escape_string($_POST['cgID']);

$target2 = $conn->real_escape_string($_POST['cgID2']);
      if($_POST['yesorno']=='No') 
      {
         die("<div class='error-msg'>Crime Group not deleted</div>");
      }
      if ($_POST['yesorno'] != ("No" || "Yes")) die('This shouldnt happen');
      $d=$conn->query("SELECT cgNAME FROM crimegroups WHERE cgID='$target'");
      $itemi=$d->fetch_assoc();
      $conn->query("DELETE FROM crimegroups WHERE cgID='{$_POST['cgID']}'");
$conn->query("UPDATE crimes SET crimeGROUP={$target2} WHERE crimeGROUP={$target}");
stafflog_add("Deleted crime group {$itemi['cgNAME']} [{$_POST['cgID']}]");
      echo "<div class='success-msg'>Crime Group deleted</div>";     
      delcrimegroup();
}
}



function reorder_crimegroups()
{
global $conn,$ir,$c,$h,$userid;

      
$_POST['submit'] = $conn->real_escape_string($_POST['submit']);

if($_POST['submit'])
{
unset($_POST['submit']);
$used=array();
foreach($_POST as $v)
{
if(in_array($v, $used))
{
print "<div class='error-msg'>You have used the same order number twice!</div>";
reorderform();
}
$used[]=$v;
}
foreach($_POST as $k => $v)
{
$cg=str_replace("order","", $k);
if(is_numeric($cg))
{
$conn->query("UPDATE crimegroups SET cgORDER={$v} WHERE cgID={$cg}");
}
}
print "<div class='success-msg'>Crime group order updated!</div>";
stafflog_add("Reordered crime groups");
reorderform();
}
else 
{
    echo"<div class='error-msg'>Something went wrong!</div>";
    reorderform();
    
} 
}


function reorderform()
{
global $conn,$ir,$c,$h,$userid;
$q=$conn->query("SELECT * FROM crimegroups ORDER BY cgORDER ASC, cgID ASC");
$rows=mysqli_num_rows($q);
$i=0;
print "<h3>Re-ordering Crime Groups</h3>
<div class='infostaff'>You can use this to re order the crime group so it displays in the order chosen.</div>
		<br />
		<br />
<table width='80%' cellspacing='1' class='table'>
<tr>
<th>Crime Group</th>
<th>Order</th>
</tr>
<form action='staff_crimes.php?action=reorder' method='post'>
<input type='hidden' name='submit' value='1' />";
while($r=$q->fetch_assoc())
{
$i++;
print "<tr>
<td>{$r['cgNAME']}</td>
<td><select name='order{$r['cgID']}' type='dropdown'>";
for($j=1;$j<=$rows;$j++)
{
if($j == $i)
{
print "<option value='{$j}' selected='selected'>{$j}</option>";
}
else
{
print "<option value='{$j}'>{$j}</option>";
}
}
print "</select></td></tr>";
}
print "<tr>
<td colspan='2' align='center'><input type='submit' value='Reorder' /></td>
</tr></form></table>";
}

function report_clear()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] > 3)
{
die("403");
}
$_GET['ID'] = abs((int) $_GET['ID']);
stafflog_add("Cleared player report ID {$_GET['ID']}");
$conn->query("DELETE FROM preports WHERE prID={$_GET['ID']}");
print "Report cleared and deleted!<br />
<a href='staff_users.php?action=reportsview'>&gt; Back</a>";
}
$h->endpage();
?>