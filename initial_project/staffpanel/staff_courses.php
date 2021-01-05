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
case "addcourse": addcourse(); return;
case "editcourse": editcourse(); return;
case "delcourse": delcourse(); return;
case "addcourseform": addcourseform(); return;
case "editcourseform": editcourseform(); return;
case "editcoursesubmit": editcoursesubmit(); return;
case "delcourseform": delcourseform(); return;
default: print "Error: This script requires an action."; return;
}
function addcourse()
{
global $conn, $ir, $c, $h, $userid;
$q=$conn->query("SELECT crID, crNAME FROM courses WHERE crNAME='{$_POST['name']}'"); 
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two courses with the same name</div>";
addcourseform();
}
elseif(empty($_POST['name']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
addcourseform();
}
else{
global $conn, $ir, $c, $h, $userid;
$_POST['name'] = $conn->real_escape_string($_POST['name']);
$_POST['desc'] = $conn->real_escape_string($_POST['desc']);
$cost=abs((int) $_POST['cost']);
$energy=abs((int) $_POST['energy']);
$days=abs((int) $_POST['days']);
$str=abs((int) $_POST['str']);
$agil=abs((int) $_POST['agil']);
$gua=abs((int) $_POST['gua']);
$lab=abs((int) $_POST['lab']);
$iq=abs((int) $_POST['iq']);
if($_POST['name'] && $_POST['desc'] && $cost && $days)
{
$conn->query("INSERT INTO courses (crNAME, crDESC, crCOST, crENERGY, crDAYS, crSTR, crGUARD, crLABOUR, crAGIL, crIQ) VALUES('{$_POST['name']}', '{$_POST['desc']}', '$cost', '$energy', '$days', '$str', '$gua',  '$lab', '$agil', '$iq')");
$i = $conn->insert_id;
print "<div class='success-msg'>Course {$_POST['name']} added</div>";
stafflog_add("Added course {$_POST['name']} [$i]");
}
}
}
function addcourseform()
{
global $conn, $ir, $c, $h, $userid;
print "<h3>Add Course</h3>
<div class='infostaff'>You can create a new course to be added to the game.</div>
		<br />
		<br />
<form action='staff_courses.php?action=addcourse' method='post'>
Name: <input type='text' name='name' /><br />
Description: <input type='text' name='desc' /><br />
Cost (Money): <input type='number' name='cost' /><br />
Cost (Energy): <input type='number' name='energy' /><br />
Length (Days): <input type='number' name='days' /><br />
Strength Gain: <input type='number' name='str' /><br />
Agility Gain: <input type='number' name='agil' /><br />
Guard Gain: <input type='number' name='gua' /><br />
Labour Gain: <input type='number' name='lab' /><br />
IQ Gain: <input type='number' name='iq' /><br />
<input type='submit' value='Add Course' /></form>";
}





function editcourse()
{
global $conn, $ir, $c, $h, $userid;
$u=$conn->query("SELECT crID, crNAME FROM courses WHERE crNAME='{$_POST['name']}' AND crID!='{$_POST['id']}'");
if(mysqli_num_rows($u) != 0)
{
print "<div class='error-msg'>This course name already exists</div>";
editcourseform();
}
elseif(empty($_POST['name']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
editcourseform();
}
else{
global $conn, $ir, $c, $h, $userid;
$cost=abs((int) $_POST['cost']);
$energy=abs((int) $_POST['energy']);
$days=abs((int) $_POST['days']);
$str=abs((int) $_POST['str']);
$agil=abs((int) $_POST['agil']);
$gua=abs((int) $_POST['gua']);
$lab=abs((int) $_POST['lab']);
$iq=abs((int) $_POST['iq']);
$name=$conn->real_escape_string($_POST['name']);
$desc=$conn->real_escape_string($_POST['desc']);
$conn->query("UPDATE courses SET crNAME='$name', crDESC='$desc', crCOST=$cost, crENERGY=$energy, crDAYS=$days, crSTR=$str, crGUARD=$gua, crLABOUR=$lab, crAGIL=$agil, crIQ=$iq WHERE crID={$_POST['id']}");
print "<div class='success-msg'>Course $name was edited successfully</div>";
stafflog_add("Edited course $name [{$_POST['id']}]");
editcourseform();
}
}
function editcoursesubmit() {
global $conn, $ir, $c, $h, $userid;
$_POST['course'] = abs((int) $_POST['course']);
    $q=$conn->query("SELECT crID, crNAME FROM courses WHERE crID='{$_POST['course']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, forum ID doesnt exist</div>";
editcourseform();
}
elseif(empty($_POST['course']))
{
print "<div class='error-msg'>You need to select a course to edit</div>";
editcourseform();
}
    else{
        
global $conn, $ir, $c, $h, $userid;
$_POST['course'] = abs((int) $_POST['course']);
$q=$conn->query("SELECT * FROM courses WHERE crID={$_POST['course']}");
$old=$q->fetch_assoc();
print "<h3>Editing a Course</h3>
<form action='staff_courses.php?action=editcourse' method='post'>
<input type='hidden' name='id' value='{$_POST['course']}' />
Name: <input type='text' name='name' value='{$old['crNAME']}' /><br />
Description: <input type='text' name='desc' value='{$old['crDESC']}' /><br />
Cost (Money): <input type='number' name='cost' value='{$old['crCOST']}' /><br />
Cost (Energy): <input type='number' name='energy' value='{$old['crENERGY']}' /><br />
Length (Days): <input type='number' name='days' value='{$old['crDAYS']}' /><br />
Strength Gain: <input type='number' name='str' value='{$old['crSTR']}' /><br />
Agility Gain: <input type='number' name='agil' value='{$old['crAGIL']}' /><br />
Guard Gain: <input type='number' name='gua' value='{$old['crGUARD']}' /><br />
Labour Gain: <input type='number' name='lab' value='{$old['crLABOUR']}' /><br />
IQ Gain: <input type='number' name='iq' value='{$old['crIQ']}' /><br />
<input type='submit' value='Edit Course' /></form>";
}
}
function editcourseform() {
global $conn,$ir,$c,$h,$userid;
print "<h3>Editing a Course</h3>
<div class='infostaff'>You can edit every aspect of the course here.</div>
		<br />
		<br />
<form action='staff_courses.php?action=editcoursesubmit' method='post'>
Course: ".course_dropdown($c, "course")."<br />
<input type='submit' value='Edit Course' /></form>";
}









function delcourse()
{
global $conn,$ir,$c,$h,$userid;

        $_POST['course'] = $conn->real_escape_string($_POST['course']); 
$q=$conn->query("SELECT crID, crNAME FROM courses WHERE crID='{$_POST['course']}'");

if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, course ID doesnt exist</div>";
delcourseform();
}
elseif(empty($_POST['course']))
{
print "<div class='error-msg'>Select a course to delete</div>";
delcourseform();
}
else
{
if($_POST['course'])
{
        $_POST['course'] = $conn->real_escape_string($_POST['course']); 
$q=$conn->query("SELECT * FROM courses WHERE crID={$_POST['course']}");
$old=$q->fetch_assoc();
$conn->query("UPDATE users SET course=0, cdays=0 WHERE course={$_POST['course']}");
$conn->query("DELETE FROM courses WHERE crID={$_POST['course']}");
print "<div class='success-msg'>Course {$old['crNAME']} deleted</div>";
stafflog_add("Deleted course {$old['crNAME']} [{$_POST['course']}]");
delcourseform();
}
}
}
function delcourseform()
{
global $conn,$ir,$c,$h,$userid;
print "<h3>Deleting a Course</h3>
<div class='infostaff'>This will delete the selected course from the database.</div>
		<br />
		<br />
<form action='staff_courses.php?action=delcourse' method='post'>
Course: ".course_dropdown($c, "course")."<br />
<input type='submit' value='Delete Course' /></form>";
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