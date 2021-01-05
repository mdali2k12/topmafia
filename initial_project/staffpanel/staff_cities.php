<?php
include "sglobals.php";
if($ir['user_level'] != 2)
{
die("403");
}
//This contains city stuffs
$_GET['action'] = $conn->real_escape_string($_GET['action']);
switch($_GET['action'])
{
case "addcity": addcity(); return;
case "addcityform": addcityform(); return;
case "editcity": editcity(); return;
case "editcitysubmit": editcitysubmit(); return;
case "editcityform": editcityform(); return;
case "delcity": delcity(); return;
case "delcityform": delcityform(); return;
default: print "Error: This script requires an action."; return;
}
function addcity()
{
global $conn, $ir, $c, $h, $userid;

$q=$conn->query("SELECT cityid, cityname FROM cities WHERE cityname='{$_POST['name']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two city with the same name</div>";
addcityform();
}
elseif(empty($_POST['name']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
addcityform();
} 

else{
$minlevel=abs((int) $_POST['minlevel']);
$name=$conn->real_escape_string($_POST['name']);
$desc=$conn->real_escape_string($_POST['desc']);
if($minlevel and $desc and $name)
{
$q=$conn->query("SELECT cityid, cityname FROM cities WHERE cityname='{$name}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two cities with the same name</div>";
$h->endpage();
exit;
}

$conn->query("INSERT INTO cities (cityname, citydesc, cityminlevel) VALUES('$name', '$desc', '$minlevel')");
$i=$conn->insert_id;
print "<div class='success-msg'>City {$name} added to the game</div>";
stafflog_add("Created city $name [$i]");
addcityform();
}
}
}
function addcityform()
{
global $conn, $ir, $c, $h, $userid;
print "<h3>Add City</h3>
<div class='infostaff'>You create a new location in the game here.</div>
		<br />
		<br />
<form action='staff_cities.php?action=addcity' method='post'>
Name: <input type='text' name='name' /><br />
Description: <input type='text' name='desc' /><br />
Minimum Level: <input type='number' name='minlevel' /><br />

<input type='submit' value='Add City' /></form>";
}







function editcity()
{
global $conn, $ir, $c, $h, $userid;
$u=$conn->query("SELECT cityid, cityname FROM cities WHERE cityname='{$_POST['name']}' AND cityid!='{$_POST['id']}'");
if(mysqli_num_rows($u) != 0)
{
print "<div class='error-msg'>This city name already exists</div>";
editcityform();
}
elseif(empty($_POST['name']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
editcityform();
}
else{
$minlevel=abs((int) $_POST['minlevel']);
$name=$conn->real_escape_string($_POST['name']);
$desc=$conn->real_escape_string($_POST['desc']);
$_POST['id'] = $conn->real_escape_string($_POST['id']);
$q=$conn->query("SELECT cityid, cityname FROM cities WHERE cityname='{$name}' AND cityid!={$_POST['id']}");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two cities with the same name</div>";
$h->endpage();
exit;
}
$name=$_POST['name'];
$q=$conn->query("SELECT cityid, cityname FROM cities WHERE cityid={$_POST['id']}");
$old=$q->fetch_assoc();
$conn->query("UPDATE cities SET cityminlevel=$minlevel, citydesc='$desc', cityname='$name' WHERE cityid={$_POST['id']}");
print "<div class='success-msg'>City $name was edited successfully</div>";
stafflog_add("Edited city $name [{$_POST['id']}]");
editcityform();
}
}

function editcitysubmit() {
global $conn, $ir, $c, $h, $userid;
$q=$conn->query("SELECT cityid, cityname FROM cities WHERE cityid='{$_POST['city']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, city ID doesnt exist</div>";
editcityform();
}
elseif(empty($_POST['city']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
editcityform();
}
    else{
        $_POST['city'] = $conn->real_escape_string($_POST['city']); 
$q=$conn->query("SELECT cityid, cityname, citydesc, cityminlevel FROM cities WHERE cityid={$_POST['city']}");
$old=$q->fetch_assoc();
print "<h3>Editing a City</h3>
<form action='staff_cities.php?action=editcity' method='post'>
<input type='hidden' name='id' value='{$_POST['city']}' />
Name: <input type='text' name='name' value='{$old['cityname']}' /><br />
Description: <input type='text' name='desc' value='{$old['citydesc']}' /><br />
Minimum Level: <input type='number' name='minlevel' value='{$old['cityminlevel']}' /><br />
<input type='submit' value='Edit City' /></form>";
}
 } 
 
 function editcityform() {
global $conn, $ir, $c, $h, $userid;
print "<h3>Editing a City</h3>
<div class='infostaff'>You can edit every aspect of the location here.</div>
		<br />
		<br />
<form action='staff_cities.php?action=editcitysubmit' method='post'>
<input type='hidden' name='step' value='1' />
City: ".location_dropdown($c, "city")."<br />
<input type='submit' value='Edit City' /></form>";
}


function delcity()
{
global $conn,$ir,$c,$h,$userid;

        $_POST['city'] = $conn->real_escape_string($_POST['city']); 
$q=$conn->query("SELECT cityid, cityname FROM cities WHERE cityid='{$_POST['city']}'");

if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, city ID doesnt exist</div>";
delcityform();
}
elseif(empty($_POST['city']))
{
print "<div class='error-msg'>Select a city to delete</div>";
delcityform();
}
else
{
    
        $_POST['city'] = $conn->real_escape_string($_POST['city']); 
$q=$conn->query("SELECT cityid, cityname, citydesc, cityminlevel FROM cities WHERE cityid={$_POST['city']}");
$old=$q->fetch_assoc();
if($old['cityid']==1)
{
die("<div class='error-msg'>This city cannot be deleted</div>");
}
$conn->query("UPDATE users SET location=1 WHERE location={$old['cityid']}");
$conn->query("UPDATE shops SET shopLOCATION=1 WHERE shopLOCATION={$old['cityid']}");
$conn->query("DELETE FROM cities WHERE cityid={$old['cityid']}");
print "<div class='success-msg'>City {$old['cityname']} deleted</div>";
stafflog_add("Deleted city {$old['cityname']} [{$old['cityid']}]");
delcityform();
}
}

function delcityform()
{
    global $conn,$ir,$c,$h,$userid;
print "<h3>Delete City</h3>
<div class='infostaff'>This will delete the location from the database and set all users in this location to the default and also move the shops to the default city.</div>
		<br />
		<br />
<div class='info-msg'>Deleting a city is permanent - be sure. Any users and shops that are currently in the city you delete will be moved to the default city (ID 1)</div>
<form action='staff_cities.php?action=delcity' method='post'>
City: ".location_dropdown($c, "city")."<br />
<input type='submit' value='Delete City' /></form>";
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