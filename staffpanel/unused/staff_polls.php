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
case 'spoll': startpoll(); break;
case 'startpoll': startpollsub(); break;
case 'endpoll': endpoll(); break;
default: print "Error: This script requires an action."; break;
}
function startpoll()
{
global $ir, $c, $userid, $conn;

print "<h3>Setup  a poll </h3> <hr />
<form action='staff_polls.php?action=startpoll' method='post'>
Question: <input type='text' name='question'><br />
Choice 1: <input type='text' name='choice1' value=''><br />
Choice 2: <input type='text' name='choice2' value=''><br />
Choice 3: <input type='text' name='choice3' value=''><br />
Choice 4: <input type='text' name='choice4' value=''><br />
Choice 5: <input type='text' name='choice5' value=''><br />
Choice 6: <input type='text' name='choice6' value=''><br />
Choice 7: <input type='text' name='choice7' value=''><br />
Choice 8: <input type='text' name='choice8' value=''><br />
Choice 9: <input type='text' name='choice9' value=''><br />
Choice 10: <input type='text' name='choice10' value=''><br />
Results hidden till end: <input type='radio' name='hidden' value='1'> Yes <input type='radio' name='hidden' value='0' checked='checked'> No
<input type='submit' value='Submit'></form>";
}
function startpollsub()
{
global $ir, $c,$userid, $conn;
if(empty($_POST['question']) || empty($_POST['choice1']) || empty($_POST['choice2']) || empty($_POST['choice3']))
{
    print"<div class='error-msg'>You need to fill in the fields correctly!</div>";
    startpoll();
}
else {
$question=$conn->real_escape_string($_POST['question']);
$_POST['hidden']=$conn->real_escape_string($_POST['hidden']);
$choice1=$conn->real_escape_string($_POST['choice1']);
$choice2=$conn->real_escape_string($_POST['choice2']);
$choice3=$conn->real_escape_string($_POST['choice3']);
$choice4=$conn->real_escape_string($_POST['choice4']);
$choice5=$conn->real_escape_string($_POST['choice5']);
$choice6=$conn->real_escape_string($_POST['choice6']);
$choice7=$conn->real_escape_string($_POST['choice7']);
$choice8=$conn->real_escape_string($_POST['choice8']);
$choice9=$conn->real_escape_string($_POST['choice9']);
$choice10=$conn->real_escape_string($_POST['choice10']);
$poll=$conn->query("INSERT into polls (active, question, choice1, choice2, choice3, choice4, choice5, choice6, choice7, choice8, choice9, choice10, hidden) VALUES('1', '$question', '$choice1', '$choice2', '$choice3', '$choice4', '$choice5', '$choice6', '$choice7', '$choice8', '$choice9' ,'$choice10', '{$_POST['hidden']}')");
print "<div class='success-msg'>New poll has been setup!</div>";
startpoll();
}
}
function endpoll()
{
global $ir, $c,$userid, $conn;
if(!$_POST['poll'])
{
print "Choose a poll to close<br>
<form action='staff_polls.php?action=endpoll' method='post'>
";
$q=$conn->query("SELECT * FROM polls WHERE active='1'");
while($r=$q->fetch_assoc())
{
print "<input type='radio' name='poll' value='{$r['id']}' /> Poll ID {$r['id']} - {$r['question']}<br />";
}
print "<input type='submit' value='Close Selected Poll' /></form>";
}
else
{
$conn->query("UPDATE polls SET active='0' WHERE id={$_POST['poll']}");
print "Poll closed";
}
}
function report_clear()
{
global $conn,$conn,$ir,$c,$h,$userid;
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