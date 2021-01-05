<?php
include "sglobals.php";
if($ir['user_level'] != 2)
{
die("403");
}
//This contains forum stuffs
$_GET['action'] = $conn->real_escape_string($_GET['action']);
switch($_GET['action'])
{
case "addforum": addforum(); return;
case "addforumform": addforumform(); return;
case "editforum": editforum(); return;
case "editforumsubmit": editforumsubmit(); return;
case "editforumform": editforumform(); return;
case "delforum": delforum(); return;
case "delforumform": delforumform(); return;
default: print "Error: This script requires an action."; return;
}
function addforum()
{
global $conn, $ir, $c, $h, $userid;

$name=$conn->real_escape_string($_POST['name']);
$desc=$conn->real_escape_string($_POST['desc']);
$auth=$conn->real_escape_string($_POST['auth']);
$q=$conn->query("SELECT ff_id, ff_name FROM forum_forums WHERE ff_name='$name'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two forum boards with the same name</div>";
addforumform();
}
elseif(empty($name))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
addforumform();
}
else{
$name=$conn->real_escape_string($_POST['name']);
$desc=$conn->real_escape_string($_POST['desc']);
$auth=$conn->real_escape_string($_POST['auth']);
if($auth and $desc and $name)
{
$q=$conn->query("SELECT ff_id, ff_name FROM forum_forums WHERE ff_name='{$name}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two forums with the same name</div>";
$h->endpage();
exit;
}
$conn->query("INSERT INTO forum_forums (ff_name, ff_desc, ff_auth, ff_lp_poster_name, ff_lp_t_name) VALUES('$name', '$desc', '$auth', 'N/A', 'N/A')");
$i=$conn->insert_id;
print "<div class='success-msg'>Forum {$name} added to the game</div>";
stafflog_add("Created forum $name [$i]");
addforumform();
}
}
}
function addforumform()
{
global $conn, $ir, $c, $h, $userid;
print "<h3>Add Forum</h3>
<div class='infostaff'>You can add a forum board below.</div>
		<br />
		<br />
<form action='staff_forums.php?action=addforum' method='post'>
Name: <input type='text' name='name' /><br />
Description: <input type='text' name='desc' /><br />
Authorization: <input type='radio' name='auth' value='public' checked='checked' /> Public <input type='radio' name='auth' value='staff' /> Staff Only<br />

<input type='submit' value='Add Forum' /></form>";
}













function editforum()
{
global $conn, $ir, $c, $h, $userid;
$u=$conn->query("SELECT ff_id, ff_name FROM forum_forums WHERE ff_name='{$_POST['name']}' AND ff_id!='{$_POST['id']}'");
if(mysqli_num_rows($u) != 0)
{
print "<div class='error-msg'>This forum name already exists</div>";
editforumform();
}
elseif(empty($_POST['name']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
editforumform();
}
else{
$name=$conn->real_escape_string($_POST['name']);
$desc=$conn->real_escape_string($_POST['desc']);
$auth=$conn->real_escape_string($_POST['auth']);
$q=$conn->query("SELECT ff_id, ff_name FROM forum_forums WHERE ff_name='{$name}' AND ff_id!={$_POST['id']}");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two forums with the same name</div>";
$h->endpage();
exit;
}
$name=$conn->real_escape_string($_POST['name']);
$desc=$conn->real_escape_string($_POST['desc']);
$auth=$conn->real_escape_string($_POST['auth']);
$q=$conn->query("SELECT * FROM forum_forums WHERE ff_id={$_POST['id']}");
$old=$q->fetch_assoc();
$conn->query("UPDATE forum_forums SET ff_desc='$desc', ff_name='$name', ff_auth='$auth' WHERE ff_id={$_POST['id']}");
print "<div class='success-msg'>Forum $name was edited successfully</div>";
stafflog_add("Edited forum $name [{$_POST['id']}]");
editforumform();
}
}

function editforumsubmit(){
global $conn, $ir, $c, $h, $userid;
$q=$conn->query("SELECT ff_id, ff_name FROM forum_forums WHERE ff_id='{$_POST['id']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, forum ID doesnt exist</div>";
editforumform();
}
elseif(empty($_POST['id']))
{
print "<div class='error-msg'>You need to select forum to edit</div>";
editforumform();
}
    else{
$q=$conn->query("SELECT * FROM forum_forums WHERE ff_id={$_POST['id']}");
$old=$q->fetch_assoc();
print "<h3>Editing a Forum</h3>
<form action='staff_forums.php?action=editforum' method='post'>
<input type='hidden' name='id' value='{$_POST['id']}' />
Name: <input type='text' name='name' value='{$old['ff_name']}' /><br />
Description: <input type='text' name='desc' value='{$old['ff_desc']}' /><br />
";
if($old['ff_auth']=="public")
{
print "Authorization: <input type='radio' name='auth' value='public' checked='checked' /> Public <input type='radio' name='auth' value='staff' /> Staff Only<br />";
}
else
{
print "Authorization: <input type='radio' name='auth' value='public' /> Public <input type='radio' name='auth' value='staff' checked='checked' /> Staff Only<br />";
}
print"
<input type='submit' value='Edit Forum' /></form>
";
}
}

function editforumform(){
global $conn, $ir, $c, $h, $userid;
print "
<h3>Editing a Forum</h3>
<div class='infostaff'>You can edit every aspect of the forum board here.</div>
		<br />
		<br />
<form action='staff_forums.php?action=editforumsubmit' method='post'>
Forum: ".forum2_dropdown($c, "id")."<br />
<input type='submit' value='Edit Forum' /></form>";
}

















function delforum()
{
global $conn,$ir,$c,$h,$userid;

 $_POST['forum'] = $conn->real_escape_string($_POST['forum']); 
$q=$conn->query("SELECT ff_id, ff_name FROM forum_forums WHERE ff_id='{$_POST['forum']}'");

if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, forum ID doesnt exist</div>";
delforumform();
}
elseif(empty($_POST['forum']))
{
print "<div class='error-msg'>Select a forum to delete</div>";
delforumform();
}
else
{
$q=$conn->query("SELECT * FROM forum_forums WHERE ff_id={$_POST['forum']}");
$old=$q->fetch_assoc();
if($_POST['forum']==$_POST['forum2']) { die("<div class='error-msg'>You cannot select the same forum group to move the posts to!</div>"); }
$conn->query("UPDATE forum_posts SET fp_forum_id={$_POST['forum2']} WHERE location={$old['ff_id']}");
$conn->query("UPDATE forum_topics SET ft_forum_id={$_POST['forum2']} WHERE shopLOCATION={$old['ff_id']}");
recache_forum($_POST['forum2']);
$conn->query("DELETE FROM forum_forums WHERE ff_id={$old['ff_id']}");
print "<div class='success-msg'>Forum {$old['ff_name']} deleted</div>";
stafflog_add("Deleted forum {$old['ff_name']} [{$old['ff_id']}]");
delforumform();
}
}

function delforumform(){
    
global $conn,$ir,$c,$h,$userid;
    print"
<h3>Delete Forum</h3>
<div class='infostaff'>This will delete the forum board from the database.</div>
		<br />
		<br />
<form action='staff_forums.php?action=delforum' method='post' name='theform'>
Forum: ".forum2_dropdown($c, "forum")."<br />
Move posts & topics in the deleted forum to: ".forum2_dropdown($c, "forum2")."<br />
<input type='submit' value='Delete Forum' /></form>";
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
function recache_forum($forum)
{
global $ir, $c, $userid, $h, $conn;

$q=$conn->query("SELECT p.*,t.* FROM forum_posts p LEFT JOIN forum_topics t ON p.fp_topic_id=t.ft_id WHERE p.fp_forum_id=$forum ORDER BY p.fp_time DESC LIMIT 1");
if(!mysqli_num_rows($q))
{
$conn->query("update forum_forums set ff_lp_time=0, ff_lp_poster_id=0, ff_lp_poster_name='N/A', ff_lp_t_id=0, ff_lp_t_name='N/A',ff_posts=0, ff_topics=0 where ff_id={$forum}");

}
else
{
$r=$q->fetch_assoc();
$tn=$conn->real_escape_string($r['ft_name']);
$pn=$conn->real_escape_string($r['fp_poster_name']);
$posts=mysqli_num_rows($conn->query("SELECT fp_id FROM forum_posts WHERE fp_forum_id=$forum"));
$topics=mysqli_num_rows($conn->query("SELECT ft_id FROM forum_topics WHERE ft_forum_id=$forum"));
$conn->query("update forum_forums set ff_lp_time={$r['fp_time']}, ff_lp_poster_id={$r['fp_poster_id']}, ff_lp_poster_name='$pn', ff_lp_t_id={$r['ft_id']}, ff_lp_t_name='$tn',ff_posts=$posts, ff_topics=$topics where ff_id={$forum}");

}
}
$h->endpage();
?>