<?php
include "globals.php";
print "<table width=100% class='table' cellspacing='1'><tr><td><a href='mailbox.php?action=inbox'>Inbox</a></td><td><a href='mailbox.php?action=outbox'>Sent</a></td><td><a href='mailbox.php?action=compose'>Send</a></td><td><a href='contactlist.php'>Contacts</a></td><td><a href='mailbox.php?action=delall'>Delete All</a></td></tr> </table><br />";

switch($_GET['action'])
{
case "add":
add_friend();
break;

case "remove":
remove_friend();
break;


default:
friends_list();
break;
}
function friends_list()
{
global $db,$ir,$c,$userid;
print "<br /><a href='contactlist.php?action=add'  data-role='button'>Add a Contact</a><br /><br />
These are the people on your contact list. ";
print "<br />
<table width=100% class='table' cellspacing='1'><tr style='background:gray'> <th>ID</th> <th>Name</th> <th>Mail</th>  <th>Remove</th> </tr>";
$q=$db->query("SELECT fl.*,u.* FROM contactlist fl LEFT JOIN users u ON fl.cl_ADDED=u.userid WHERE fl.cl_ADDER=$userid ORDER BY u.username ASC");
while($r=$db->fetch_row($q))
{
$d="";
if($r['donatordays']) { $r['username'] = "<font color=red>{$r['username']}</font>";$d="<img src='donator.gif' alt='Donator: {$r['donatordays']} Days Left' title='Donator: {$r['donatordays']} Days Left' />"; }
print "<tr> <td>{$r['userid']}</td> <td><a href='viewuser.php?u={$r['userid']}'>{$r['username']}</a> $d</td> <td><a href='mailbox.php?action=compose&ID={$r['userid']}'>Mail</a></td>  <td><a href='contactlist.php?action=remove&f={$r['cl_ID']}'>Remove</a></td> </tr>";
}
print "</table>";
}
function add_friend()
{
global $db,$ir,$c,$userid;
$_POST['ID'] = abs((int) $_POST['ID']);

if($_POST['ID'])
{
$qc=$db->query("SELECT * FROM contactlist WHERE cl_ADDER=$userid AND cl_ADDED={$_POST['ID']}");
$q=$db->query("SELECT * FROM users WHERE userid={$_POST['ID']}");
if($db->num_rows($qc))
{
print "You cannot add the same person twice.";
}
else if($userid==$_POST['ID'])
{
print "There is no point in adding yourself to your own list.";
}
else if($db->num_rows($q)==0)
{
print "Oh no, you're trying to add a ghost.";
}
else
{
$db->query("INSERT INTO contactlist (cl_ADDER, cl_ADDED) VALUES($userid, {$_POST['ID']})");
$r=$db->fetch_row($q);
print "{$r['username']} was added to your contact list.<br />
<a href='contactlist.php' data-role='button'> Back</a>";
}
}
else
{
print "Adding a contact!<form action='contactlist.php?action=add' method='post'>
Contact's player ID number: <input type='text' maxlength='10' name='ID' value='{$_GET['ID']}' /><br />
<input type='submit' value='Add Contact' /></form><br>
<a href='contactlist.php' data-role='button'> Back</a>";
}

}
function remove_friend()
{
global $db,$ir,$c,$userid;
$db->query("DELETE FROM contactlist WHERE cl_ID={$_GET['f']} AND cl_ADDER=$userid");
print "Contact list entry removed!<br />
<a href='contactlist.php'>&gt; Back</a>";
}
$h->endpage();
?>