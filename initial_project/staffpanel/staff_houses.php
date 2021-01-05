<?php
include "sglobals.php";
if($ir['user_level'] != 2)
{
die("403");
}
//This contains shop stuffs
$_GET['action'] = $conn->real_escape_string($_GET['action']);
switch($_GET['action'])
{
case "addhouse": addhouse(); return;
case "addhouseform": addhouseform(); return;
case "edithouse": edithouse(); return;
case "edithousesubmit": edithousesubmit(); return;
case "edithouseform": edithouseform(); return;
case "delhouse": delhouse(); return;
case "delhouseform": delhouseform(); return;
default: print "Error: This script requires an action."; return;
}
function addhouse()
{
global $conn, $ir, $c, $h, $userid;

$q=$conn->query("SELECT hID, hNAME FROM houses WHERE hNAME='{$_POST['name']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two houses with the same name</div>";
addhouseform();
}
elseif(empty($_POST['name']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
addhouseform();
}
else
{
$price=abs((int) $_POST['price']);
$will=abs((int) $_POST['will']);
$name = $conn->real_escape_string($_POST['name']);
if($price and $will and $name)
{
$q=$conn->query("SELECT hWILL, hID FROM houses WHERE hWILL={$will}");
if(mysqli_num_rows($q))
{
die("<div class='error-msg'>Sorry, you cannot have two houses with the same maximum will</div>");
}
$conn->query("INSERT INTO houses (hNAME, hPRICE, hWILL) VALUES('$name', '$price', '$will')");
$i=$conn->insert_id;
print "<div class='success-msg'>House {$name} added to the game</div>";
stafflog_add("Created house $name [$i]");
addhouseform();
}
}
}
function addhouseform()
{
global $conn,$ir,$c,$h;
print "<h3>Add House</h3>
<div class='infostaff'>Create a new house in the game by using the form below. Users will bar will be set to the Max Will.</div>
		<br />
		<br />
<form action='staff_houses.php?action=addhouse' method='post'>
Name: <input type='text' name='name' /><br />
Price: <input type='number' name='price' /><br />
Max Will: <input type='number' name='will' /><br />
<input type='submit' value='Add House' /></form>";
}

function edithouse()
{
global $conn, $ir, $c, $h, $userid;
 $u=$conn->query("SELECT hID, hNAME FROM houses WHERE hNAME='{$_POST['name']}' AND hID!='{$_POST['id']}'");
if(mysqli_num_rows($u) != 0)
{
print "<div class='error-msg'>This house name already exists</div>";
edithouseform();
}
elseif(empty($_POST['name']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
edithouseform();
}
else
{
$price=abs((int) $_POST['price']);
$will=abs((int) $_POST['will']);
$q=$conn->query("SELECT hID, hWILL FROM houses WHERE hWILL={$will} AND hID!={$_POST['id']}");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two houses with the same maximum will</div>";
$h->endpage();
exit;
}
$_POST['id'] = $conn->real_escape_string($_POST['id']);
$name = $conn->real_escape_string($_POST['name']);
$q=$conn->query("SELECT * FROM houses WHERE hID={$_POST['id']}");
$old=$q->fetch_assoc();
if($old['hWILL'] == 100 && $old['hWILL'] != $will)
{
die("<div class='error-msg'>Sorry, this house's will bar cannot be edited</div>");
}
$conn->query("UPDATE houses SET hWILL=$will, hPRICE=$price, hNAME='$name' WHERE hID={$_POST['id']}");
$conn->query("UPDATE users SET maxwill=$will WHERE maxwill={$old['hWILL']}");
$conn->query("UPDATE users SET will=maxwill WHERE will > maxwill");
print "<div class='success-msg'>House $name was edited successfully</div>";
stafflog_add("Edited house $name [{$_POST['id']}]");
edithouseform();
}
}

function edithousesubmit() {
global $conn,$ir,$c,$h;
$q=$conn->query("SELECT hID, hNAME FROM houses WHERE hID='{$_POST['house']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, house ID doesnt exist</div>";
edithouseform();
}
elseif(empty($_POST['house']))
{
print "<div class='error-msg'>Select a house to edit</div>";
edithouseform();
}
else{
$_POST['house'] = $conn->real_escape_string($_POST['house']);
$q=$conn->query("SELECT * FROM houses WHERE hID={$_POST['house']}");
$old=$q->fetch_assoc();
print "<h3>Editing a House</h3>
<form action='staff_houses.php?action=edithouse' method='post'>
<input type='hidden' name='step' value='2' />
<input type='hidden' name='id' value='{$_POST['house']}' />
Name: <input type='text' name='name' value='{$old['hNAME']}' />
Price: <input type='number' name='price' value='{$old['hPRICE']}' /><br />
Max Will: <input type='number' name='will' value='{$old['hWILL']}' /><br />
<input type='submit' value='Edit House' /></form>";
}
}

function edithouseform() {
    
global $conn, $ir, $c, $h, $userid;
    print "<h3>Editing a House</h3>
    <div class='infostaff'>You can edit every aspect of the house.</div>
		<br />
		<br />
<form action='staff_houses.php?action=edithousesubmit' method='post'>
House: ".house_dropdown($c, "house")."<br />
<input type='submit' value='Edit House' /></form>";
return;
}




function delhouse()
{
global $conn,$ir,$c,$h,$userid;
$q=$conn->query("SELECT hID, hNAME FROM houses WHERE hID='{$_POST['house']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, house ID doesnt exist</div>";
delhouseform();
}
elseif(empty($_POST['house']))
{
print "<div class='error-msg'>Select a house to delete</div>";
delhouseform();
}
else{

$q=$conn->query("SELECT * FROM houses WHERE hID={$_POST['house']}");
$old=$q->fetch_assoc();
if($old['hWILL']==100)
{
die("<div class='error-msg'>This house cannot be deleted</div>");
}
$q2=$conn->query("SELECT maxwill, userid  FROM users WHERE maxwill={$old['hWILL']}");
$ids=array();
while($r=$q2->fetch_assoc())
{
$ids[]=$r['userid'];
}
if(count($ids))
{
$conn->query("UPDATE users SET money=money+{$old['hPRICE']}, maxwill=100 WHERE userid IN(".implode(', ', $ids).")");
}
$conn->query("UPDATE users SET will=maxwill WHERE will > maxwill");
$conn->query("DELETE FROM houses WHERE hID={$old['hID']}");
print "<div class='success-msg'>House {$old['hNAME']} deleted</div>";
stafflog_add("Deleted house {$old['hNAME']} [{$old['hID']}]");
delhouseform();
}
}

function delhouseform()
{
    
global $conn, $ir, $c, $h, $userid;
print "<h3>Delete House</h3>
<div class='infostaff'>Deleting a house is permanent - be sure. Any users that are currently on the house you delete will be returned to the first house, and their money will be refunded.</div>
		<br />
		<br />
<form action='staff_houses.php?action=delhouse' method='post'>
House: ".house_dropdown($c, "house")."<br />
<input type='submit' value='Delete House' /></form>";
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