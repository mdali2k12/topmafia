<?php
$forums = 1;
include(DIRNAME(__FILE__) . '/globals.php');
include(DIRNAME(__FILE__) . '/bbcode_parser.php');


function forums_rank($tp) {
$rank = array(
3 => '#1 Absolute Newbie',
7 => '#2 Newbie',
12 => '#3 Beginner',
18 => '#4 Not Experienced',
25 => '#5 Rookie',
50 => '#6 Average',
100 => '#7 Good',
200 => '#8 Very Good',
350 => '#9 Greater Than Average',
500 => '#10 Experienced',
750 => '#11 Highly Experienced',
1200 => '#12 Honoured',
1800 => '#13 Highly Honoured',
2500 => '#14 Respect King',
5000 => '#15 True Champion'
);
foreach(array_keys($rank) as $key) {
if($tp < $key) {
return $rank[$key];
}
}
}

if(!function_exists('error')) {
function error($str) {
global $h;
echo $str;
$h->endpage();
exit;
}
}

if(!function_exists('success')) {
function success($str) {
echo "<div style='background-color:#78AB46; color:#000; text-align:center; padding: 3px 20px;'>".$str."</div>";
}
}

if(!function_exists('format')) {
function format($str) {
if(is_numeric($str)) { return number_format($str, 0); }
else { return htmlspecialchars(stripslashes($str)); }
}
}

if(!function_exists('profile')) {
function profile($id, $display_id = 0, $display_d = 0) {
global $db, $h, $mtg;
$id = abs(@intval($id));
if(!$id) { error("No ID specified"); }
$query = $db->query("SELECT username FROM users WHERE (userid = ".$id.")");
if(!$db->num_rows($query)) {
return "Deleted";
} else {
$name = $db->fetch_single($query);

if($display_d) {
$donator = $mtg->fetchResult('donatordays', 'users', 'userid', $id);
$b1 = ($donator) ? "<span style='color:red;'>" : false;
$b2 = ($donator) ? "</span>" : false;
} else {
$b1 = false;
$b2 = false;
}
$result = "<a href='viewuser.php?u=".$id."'>".$b1.format($name).$b2."</a>";
if($display_id) { $result .= " [".number_format($id)."]"; }
return $result;
}
}
}

if(!function_exists('time_format')) {
function time_format($seconds) { // Seconds = The currect timestamp minus the second value, stated in the formula
$seconds  = floor($seconds);
$days     = @intval($seconds / 86400);
$seconds -= ($days * 86400);
$hours    = @intval($seconds / 3600);
$seconds -= ($hours * 3600);
$minutes  = @intval($seconds / 60);
$seconds -= ($minutes * 60);
$result   = array();

if($days) { $result[] = number_format($days)." day".($days == 1) ? "" : "s"; }
if($hours) { $result[] = $hours." hour".($hours == 1) ? "" : "s"; }
if($minutes && (count($result) < 2)) { $result[] = $minutes." minute".($minutes == 1) ? "" : "s"; }
if(($seconds && (count($result) < 2)) || !count($result)) { $result[] = $seconds." second".($seconds == 1) ? "" : "s"; }
return implode(", ", $result);
}
}

if(!class_exists('mtg')) {
class mtg extends database {
public function fetchResult($field, $table, $row, $value) {
global $db;
$query = $db->query("SELECT `".$field."` FROM `".$table."` WHERE (`".$row."` = '".$value."')");
return ($db->num_rows($query)) ? $db->fetch_single($query) : "undefined";
}
}
$mtg = new mtg;
}

//Start forums!
echo "<h3>Forums</h3>";
if($ir['forumban']) { error("You have been forum banned for ".time_format($ir['forumban']*86400).".<br /><br />Reason: ".format($ir['fb_reason'])); }
$_GET['viewforum'] = abs(@intval($_GET['viewforum']));
$_GET['viewtopic'] = abs(@intval($_GET['viewtopic']));
$_GET['reply'] = abs(@intval($_GET['reply']));
$_GET['quote'] = abs(@intval($_GET['quote']));
$_GET['empty'] = abs(@intval($_GET['empty']));
$_GET['topic'] = abs(@intval($_GET['topic']));
$_GET['post'] = abs(@intval($_GET['post']));
$_GET['act'] = isset($_GET['act']) && is_string($_GET['act']) ? strtolower(trim($_GET['act'])) : false;
if($_GET['viewtopic'] and $_GET['act'] != 'quote') { $_GET['act']='viewtopic'; }
if($_GET['viewforum']) { $_GET['act']='viewforum'; }
if($_GET['reply']) { $_GET['act']='reply'; }
if($_GET['empty'] == 1 && $_GET['code']=='kill' && $_SESSION['owner']) { emptyallforums(); }
switch($_GET['act']) {
case 'viewforum': viewforum(); break;
case 'viewtopic': viewtopic(); break;
case 'reply': reply(); break;
case 'newtopic': newtopic(); break;
case 'quote': quote(); break;
case 'edit': edit(); break;
case 'move': move(); break;
case 'lock': lock(); break;
case 'delepost': delepost(); break;
case 'deletopic': deletopic(); break;
case 'pin': pin(); break;
case 'recache': recache_forum($_GET['forum']); break;

default: idx(); break;
}

function idx() {
global $ir, $c, $userid, $h, $bbc, $db;
$q = $db->query("SELECT * FROM forum_forums WHERE ff_auth = 'public' ORDER BY ff_id ASC");
echo "<table class='table' width='100%'>
<tr>
<th>Board</th>
<th>Last&nbsp;Post</th>
</tr>";
if(!$db->num_rows($q)) {
echo "<tr>
<td colspan='4' class='center'>No boards</td>
</tr>";
}
while($r = $db->fetch_row($q)) {
echo "<tr>";
echo "<td class='center'><a href='forums.php?viewforum=".$r['ff_id']."' style='font-weight: 800'>".format($r['ff_name'])."</a><br /><span style='font-size:10px;'>".format($r['ff_desc'])."</span><br/><span class='info' style='font-size:10px;'>Posts: ".format($r['ff_posts'])." Topics: ".format($r['ff_topics'])."</span></td>";
if($r['ff_lp_time']) {
$lastpost = $db->fetch_single($db->query("SELECT COUNT(fp_id) FROM forum_posts WHERE (fp_topic_id = ".$r['ff_lp_t_id'].") ORDER BY fp_id DESC LIMIT 1"));
echo "<td class='center'><span class='info'>".date('H:i:s d/m/y', $r['ff_lp_time'])."<br />
In: <a href='forums.php?viewtopic=".$r['ff_lp_t_id']." ".$lastpost."' style='font-weight: 800'>".format($r['ff_lp_t_name'])."</a><br />
By: ".profile($r['ff_lp_poster_id'], 0, 1)."</span></td>";
} else {
echo "<td class='center'>None</td>";
}
echo "</tr>";
}
echo "</table>";

if($ir['user_level'] > 1) {
echo "<h3>Staff-Only Forums</h3><hr />";
$q = $db->query("SELECT * FROM forum_forums WHERE ff_auth = 'staff' ORDER BY ff_id ASC");
echo "<table class='table' width='100%'>
<tr>
<th>Board</th>
<th>Posts</th>
<th>Topics</th>
<th>Last&nbsp;Post</th>
</tr>";
if(!$db->num_rows($q)) {
echo "<tr>
<td colspan='4' class='center'>No boards</td>
</tr>";
}
while($r = $db->fetch_row($q)) {
echo "<tr>
<td class='center'><a href='forums.php?viewforum=".$r['ff_id']."' style='font-weight: 800'>".format($r['ff_name'])."</a><br /><span style='font-size:10px;'>".format($r['ff_desc'])."</span></td>
<td class='center'>".format($r['ff_posts'])."</td>
<td class='center'>".format($r['ff_topics'])."</td>";
if($r['ff_lp_time']) {
$lastpost = $db->fetch_single($db->query("SELECT COUNT(fp_id) FROM forum_posts WHERE (fp_topic_id = ".$r['ff_lp_t_id'].") ORDER BY fp_id DESC LIMIT 1"));
echo "<td class='center'>".date('H:i:s d/m/y', $r['ff_lp_time'])."<br />
In: <a href='forums.php?viewtopic=".$r['ff_lp_t_id']."' style='font-weight: 800'>".format($r['ff_lp_t_name'])."</a><br />
By: ".profile($r['ff_lp_poster_id'], 0, 1)."</td>";
} else {
echo "<td class='center'>None</td>";
}
echo "</tr>";
}
echo "</table>";

echo "<h3>Gang Forums</h3><hr />";
$q = $db->query("SELECT * FROM forum_forums WHERE ff_auth = 'gang' ORDER BY ff_id ASC");
echo "<table class='table' width='100%'>";
echo "<tr>";
echo "<th>Board</th>";
echo "<th>Last&nbsp;Post</th>";
echo "</tr>";
if(!$db->num_rows($q)) {
echo "<tr>";
echo "<td colspan='4' class='center'>No boards</td>";
echo "</tr>";
}
while($r = $db->fetch_row($q)) {
echo "<tr>
<td class='center'><a href='forums.php?viewforum=".$r['ff_id']."' style='font-weight: 800'>".format($r['ff_name'])."</a><br/><span class='info' style='font-size:10px;'>Posts: ".format($r['ff_posts'])." Topics: ".format($r['ff_topics'])."</span></td>";
if($r['ff_lp_time']) {
$lastpost = $db->fetch_single($db->query("SELECT COUNT(fp_id) FROM forum_posts WHERE (fp_topic_id = ".$r['ff_lp_t_id'].") ORDER BY fp_id DESC LIMIT 1"));
echo "<td class='center'>".date('H:i:s d/m/y', $r['ff_lp_time'])."<br />
In: <a href='forums.php?viewtopic=".$r['ff_lp_t_id']."' style='font-weight: 800'>".format($r['ff_lp_t_name'])."</a><br />
By: ".profile($r['ff_lp_poster_id'], 0, 1)."</td>";
} else {
echo "<td class='center'>None</td>";
}
echo "</tr>";
}
echo "</table>";
}
echo "<a href='explore.php' data-role='button'>Back</a>";
}

function viewforum() {
global $ir, $c, $userid, $h, $bbc, $db;
if(!$_GET['viewforum']) { error("Board ID not specified"); }
$query = $db->query("SELECT * FROM forum_forums WHERE (ff_id = ".$_GET['viewforum'].")");
if(!$db->num_rows($query)) { error("Board not found"); }
$r = $db->fetch_row($query);
if(($r['ff_auth'] == 'gang' AND $ir['gang'] != $r['ff_owner'] AND $ir['user_level'] < 2) OR ($r['ff_auth'] == 'staff' AND $ir['user_level'] < 2)) { error("You have no permission to view this forum."); }
$ntl = ($_GET['viewforum'] > 1 OR $ir['user_level'] == 2) ? "&nbsp;[<a href='forums.php?act=newtopic&amp;forum=".$_GET['viewforum']."'>...new...</a>]" : null;
$topics_per_page = 20;
$topics = $r['ff_topics'];
$pages = ceil($topics / $topics_per_page);
$st = isset($_GET['st']) ? $_GET['st'] : 0;
$pst =- 20;
$q = $db->query("SELECT * FROM forum_topics WHERE (ft_forum_id = ".$_GET['viewforum'].") ORDER BY ft_pinned DESC, ft_last_time DESC LIMIT ".$st.", 20");
echo "<a href='forums.php'>Forums</a> &raquo; <a href='forums.php?viewforum=".$_GET['viewforum']."'>".format($r['ff_name'])."</a>".$ntl."<br /><br />";

echo "Pages: ";
for($i = 1; $i <= $pages; $i++) {
$pst += 20;
echo "<a href='forums.php?viewforum=".$r['ff_id']."&amp;st=".$pst."'>";
if($pst == $st) { echo "<strong>"; }
echo $i;
if($pst == $st) { echo "</strong>"; }
echo "</a>&nbsp;";
if($i % 25 == 0) { echo "<br />"; }
}

echo "<table class='table' width='100%'>
<tr>
<th>Topic</th>
<th align='center'>Posts</th>
</tr>";
if(!$db->num_rows($q)) {
echo "<tr>
<td colspan='4' class='center'>No topics</td>
</tr>";
}
while($r2 = $db->fetch_row($q)) {
$pt = ($r2['ft_pinned']) ? "<strong>Pinned:</strong>&nbsp;" : null;
$lt = ($r2['ft_locked']) ? "&nbsp;<strong>(Locked)</strong>" : null;
echo "<tr>
<td class='center' width='50%'>".$pt."<a href='forums.php?viewtopic=".$r2['ft_id']."&amp;lastpost=1'>".format($r2['ft_name'])."</a>".$lt."<br />
<span style='font-size:10px;'>".format($r2['ft_desc'])."</span></td>
<td align='center' width='50%'>".format($r2['ft_posts'])."<br/><span class='info' style='font-size:10px;'>Started: ".date('H:i:s d/m/y', $r2['ft_start_time'])."<br/><span class='info' style='font-size:10px;'>Last Post: ".date('H:i:s d/m/y', $r2['ft_last_time'])."<br />By: ".profile($r2['ft_last_id'], 0, 1)."</span></td>
</tr>
";
}
echo "</table><a data-role='button' data-rel='back' href='forums.php'>Back</a>";
echo "Pages: ";
for($i = 1; $i <= $pages; $i++) {
$pst += 20;
echo "<a href='forums.php?viewforum=".$r['ff_id']."&amp;st=".$pst."'>";
if($pst == $st) { echo "<strong>"; }
echo $i;
if($pst == $st) { echo "</strong>"; }
echo "</a>&nbsp;";
if($i % 25 == 0) { echo "<br />"; }
}
}

function viewtopic() {
global $ir, $c, $userid, $h, $bbc, $db;
if(!$_GET['viewtopic']) { error("Topic ID not specified"); }
$precache = array();

$q = $db->query("SELECT * FROM forum_topics WHERE (ft_id = ".$_GET['viewtopic'].")");
if(!$db->num_rows($q)) { error("Topic not found"); }
$topic = $db->fetch_row($q);
$q2 = $db->query("SELECT * FROM forum_forums WHERE (ff_id = ".$topic['ft_forum_id'].")");
if(!$db->num_rows($q2)) { error("Board not found"); }
$forum = $db->fetch_row($q2);
if(($forum['ff_auth'] == 'gang' AND $ir['gang'] != $forum['ff_owner'] and $ir['user_level'] < 2) OR ($forum['ff_auth'] == 'staff' AND $ir['user_level'] < 2)) { error("You have no permission to view this forum."); }
echo "<a href='forums.php'>Forums</a> &raquo; <a href='forums.php?viewforum=".$forum['ff_id']."'>".format($forum['ff_name'])."</a> &raquo; <a href='forums.php?viewtopic=".$_GET['viewtopic']."'>".format($topic['ft_name'])."</a><br /><br />";

$posts_per_page = 20;
$posts_topic = $topic['ft_posts'];
$pages = ceil($posts_topic / $posts_per_page);
$st = isset($_GET['st']) ? $_GET['st'] : 0;
if(isset($_GET['lastpost'])) { $st = ($pages - 1) * 20; }
$pst =- 20;
echo "Pages: ";
for($i = 1; $i <= $pages; $i++) {
$pst += 20;
echo "<a href='forums.php?viewtopic=".$topic['ft_id']."&amp;st=".$pst."'>";
if($pst == $st) { echo "<strong>"; }
echo $i;
if($pst == $st) { echo "</strong>"; }
echo "</a>&nbsp;";
if($i % 25 == 0) { echo "<br />"; }
}

echo "<br />";
if($forum['ff_auth'] == 'gang' AND $ir['gang'] = $forum['ff_owner']) {
	echo "<a href='forums.php?act=deletopic&amp;topic=".$_GET['viewtopic']."'>Delete</a>";
}
if($ir['user_level'] > 1) {
echo "<form action='forums.php?act=move&amp;topic=".$_GET['viewtopic']."' method='post'><strong>Move topic to:</strong> ".forum_dropdown($c, 'forum', -1)."<input type='submit' value='Move' /></form><br />
<a href='forums.php?act=pin&amp;topic=".$_GET['viewtopic']."'><img src='/imageicons/book_go.png' alt='Pin/Unpin Topic' title='Pin/Unpin Topic' /></a><a href='forums.php?act=lock&amp;topic=".$_GET['viewtopic']."'><img src='/imageicons/key.png' alt='Lock/Unlock Topic' title='Lock/Unlock Topic' /></a><a href='forums.php?act=deletopic&amp;topic=".$_GET['viewtopic']."'><img src='/imageicons/delete.png' alt='Delete Topic' title='Delete Topic' /></a><br />";
}

$q3 = $db->query("SELECT * FROM forum_posts WHERE (fp_topic_id = ".$topic['ft_id'].") ORDER BY fp_time ASC LIMIT ".$st.", 20");
$no = $st;
echo "<table class='table' width='100%'>";
while($r = $db->fetch_row($q3)) {
$no++;
$qlink = "<a href='forums.php?act=quote&amp;viewtopic=".$_GET['viewtopic']."&amp;quotename=".$r['fp_poster_name']."&amp;quotetext=".urlencode($r['fp_text'])."'><img src='/imageicons/comments.png' title='Quote' alt='[Quote]' /></a>";
$elink = ($ir['user_level'] > 1 || $ir['userid'] == $r['fp_poster_id']) ? "<a href='forums.php?act=edit&amp;post=".$r['fp_id']."&amp;topic=".$_GET['viewtopic']."'><img src='/imageicons/page_edit.png' title='Edit' alt='[Edit]' /></a>" : null;
$dlink = ($no > 1 and $ir['user_level'] > 1) ? "<a href='forums.php?act=delepost&amp;post=".$r['fp_id']."'><img src='/imageicons/delete.png' title='Delete' alt='[Delete]' /></a>" : null;
$edittext = ($r['fp_edit_count']) ? "<br /><em>Last edited by ".profile($r['fp_editor_id'], 0, 1)." at ".date('H:i:s d/m/y', $r['fp_editor_time']).", edited <strong>".format($r['fp_edit_count'])."</strong> times in total.</em>" : null;

if(!isset($precache[$r['fp_poster_id']]['userid'])) {
$membq = $db->query("SELECT userid, username, posts, forums_avatar, forums_signature, level FROM users WHERE (userid = ".$r['fp_poster_id'].")");
$memb = $db->fetch_row($membq);
$precache[$memb['userid']] = $memb;
} else {
$memb = $precache[$r['fp_poster_id']];
}
$rank = forums_rank($memb['posts']);

$av = ($memb['forums_avatar']) ? "<img src='".format($memb['forums_avatar'])."' width='100' height='100' />"  : "";
$sig = (!$memb['forums_signature']) ? "No Signature" : stripslashes($bbc->bbcode_parse($memb['forums_signature']));
$r['fp_text'] = $bbc->bbcode_parse($r['fp_text']);

echo "<tr>
<th width='180' class='center'><span class='info'># ".format($no).": ".format($r['fp_subject'])."</span></th>
<th class='center'><span class='info'>Posted: ".date('H:i:s d/m/y',$r['fp_time'])." ".$qlink.$elink.$dlink."</span></th>
</tr>
<tr>
<td valign='top'>".profile($r['fp_poster_id'], 1, 1)."<br />".$av."<br />Level: ".format($memb['level'])."<br /> Forum Rank:<br> $rank<br /> Posts: ".format($memb['posts'])."</td>";

$codes = array(':]', ':D', ':oo:', 'O.o', ':@', ':?', ':lol', ':/', ':O', ':(', 'O.O', '*)', ':)', ':P', ':S', ':??', '<3', ':heart:', 'XD',
);
$images  = array('<img src="smilies/happy.gif" />', '<img src="smilies/grin.gif" />', '<img src="smilies/cool.gif" />', '<img src="smilies/blink.gif" />', '<img src="smilies/angry.gif" />', '<img src="smilies/huh.gif" />', '<img src="smilies/laugh.gif" />', '<img src="smilies/mellow.gif" />', '<img src="smilies/ohmy.gif" />', '<img src="smilies/sad.gif" />', '<img src="smilies/shock.gif" />', '<img src="smilies/rolleyes.gif" />', '<img src="smilies/smile.gif" />', '<img src="smilies/tongue.gif" />', '<img src="smilies/unsure.gif" />', '<img src="smilies/wacko.gif" />', '<img src="smilies/wink.gif" />', '<img src="smilies/love.gif" />', '<img src="smilies/XD.gif" />');
$newmsg = str_replace($codes, $images, $r['fp_text']);

echo "<td valign='top'>".stripslashes($newmsg).$edittext."<br />-------------------<br />".$sig."</td>
</tr>";
}
echo "</table>";

$pst =- 20;
echo "Pages: ";
for($i = 1; $i <= $pages; $i++) {
$pst += 20;
echo "<a href='forums.php?viewtopic=".$topic['ft_id']."&amp;st=".$pst."'>";
if($pst == $st) { echo "<strong>"; }
echo $i;
if($pst == $st) { echo "</strong>"; }
echo "</a>&nbsp;";
if($i % 25 == 0) { echo "<br />"; }
}

if(!$topic['ft_locked']) {
$subject = $db->fetch_single($db->query("SELECT fp_subject FROM forum_posts WHERE (fp_topic_id = ".$topic['ft_id'].") ORDER BY fp_id ASC LIMIT 1"));
echo "<br /><br /><strong>Post a reply to this topic:</strong><br />
<form action='forums.php?reply=".$topic['ft_id']."' method='post'>
<table class='table' width='100%'>
<tr>
<td>Subject</td>
<td class='center'><input type='text' name='fp_subject' maxlength='40' value=\"Re: ".format($subject)."\" /></td>
</tr>
<tr>
<td>Post</td>
<td class='center'><textarea rows='7' cols='40' name='fp_text'></textarea></td>
</tr>
<tr>
<td colspan='2' class='center'><input type='submit' value='Post Reply' /></td>
</tr>
</table>
</form><a data-role='button' data-rel='back' href='forums.php'>Back</a>";
} else {
echo "<br /><br /><em>This topic has been locked, you cannot reply to it.</em><a data-role='button' data-rel='back' href='forums.php'>Back</a>";
}
}

function reply() {
global $ir, $c, $userid, $h, $bbc, $db;
if(!$_GET['reply']) { error("Topic ID not specified"); }
$q = $db->query("SELECT ft_forum_id, ft_name, ft_locked FROM forum_topics WHERE (ft_id = ".$_GET['reply'].")");
if(!$db->num_rows($q)) { error("Topic not found<a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
$topic = $db->fetch_row($q);
$q2 = $db->query("SELECT ff_id, ff_auth, ff_owner FROM forum_forums WHERE (ff_id = ".$topic['ft_forum_id'].")");
if(!$db->num_rows($q2)) { error("Board not found<a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
$forum = $db->fetch_row($q2);
if(($forum['ff_auth'] == 'gang' AND $ir['gang'] != $forum['ff_owner']) OR ($forum['ff_auth'] == 'staff' AND $ir['user_level'] < 2)) { error("You have no permission to reply to this topic."); }
$u = $ir['username'];
if(!$topic['ft_locked']) {
if(empty($_POST['fp_subject'])) { error("Please enter a subject<a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
if(empty($_POST['fp_text'])) { error("Please enter your message<a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
$db->query("INSERT INTO forum_posts (fp_topic_id, fp_forum_id, fp_poster_id, fp_poster_name, fp_time, fp_subject, fp_text, fp_editor_id, fp_editor_name, fp_editor_time, fp_edit_count) VALUES (".$_GET['reply'].", ".$forum['ff_id'].", ".$userid.", '".$u."', ".time().", '".$db->escape($_POST['fp_subject'])."', '".$db->escape($_POST['fp_text'])."', 0, '', 0, 0)");
$db->query("UPDATE forum_topics SET ft_last_id = ".$userid.", ft_last_name = '".$u."', ft_last_time = ".time().", ft_posts = ft_posts + 1 WHERE (ft_id = ".$_GET['reply'].")");
$db->query("UPDATE forum_forums SET ff_lp_time = ".time().", ff_posts = ff_posts + 1, ff_lp_poster_id = ".$userid.", ff_lp_poster_name = '".$u."', ff_lp_t_id = ".$_GET['reply'].", ff_lp_t_name = '".$topic['ft_name']."' WHERE (ff_id = ".$forum['ff_id'].")");
$db->query("UPDATE users SET posts = posts + 1 WHERE (userid = ".$userid.")");
success("Reply Posted");
$_GET['lastpost'] = 1;
$_GET['viewtopic'] = $_GET['reply'];
viewtopic();
}
else { error("<em>This topic has been locked, you cannot reply to it.</em><a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
}

function newtopic() {
global $ir, $c, $userid, $h, $bbc, $db;
if(!$_GET['forum']) { error("Board ID not specified"); }
$q = $db->query("SELECT * FROM forum_forums WHERE (ff_id = ".$_GET['forum'].")");
if(!$db->num_rows($q)) { error("Board not found"); }
$r = $db->fetch_row($q);
if(($r['ff_auth'] == 'gang' AND $ir['gang'] != $r['ff_owner']) OR ($r['ff_auth'] == 'staff' AND $ir['user_level'] < 2)) { error("You have no permission to view this forum."); } 
if(!isset($_POST['ft_name'])) {
echo "<a href='forums.php'>Forums</a> &raquo; <a href='forums.php?viewforum=".$_GET['forum']."'>".format($r['ff_name'])."</a> &raquo; New Topic</span>
<form action='forums.php?act=newtopic&amp;forum=".$_GET['forum']."' method='post'>
<table class='table' width='100%'>
<tr>
<td>Name</td>
<td class='center'><input type='text' name='ft_name' id='ft_name' maxlength='30' value='' /></td>
</tr>
<tr>
<td>Description</td>
<td class='center'><input type='text' name='ft_desc' id='ft_desc' maxlength='30' value='' /></td>
</tr>
<tr>
<td>Text</td>
<td class='center'><textarea rows='8' cols='45' id='fp_text' name='fp_text'></textarea></td>
</tr>
<tr>
<td colspan='2' class='center'><input type='submit' value='Post Topic' /></td>
</tr>
</table>
</form>
<a data-role='button' data-rel='back' href='forums.php'>Back</a>";
} else {
		$namelength=strlen($_POST['ft_name']);
		$desclength=strlen($_POST['ft_desc']);
		$messlength=strlen($_POST['fp_text']);
if(empty($_POST['ft_name'])) { error("You didn't enter a Name.<br/><a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
if(empty($_POST['ft_desc'])) { error("You didn't enter a description.<br/><a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
if(empty($_POST['fp_text'])) { error("You didn't enter a Message. <br/><a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
if($namelength<5) { error("You did not enter a long enough Name.<br/><a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
if($desclength<5) { error("You did not enter a long enough Description.<br/><a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
if($messlength<10) { error("You did not enter a long enough Message.<br/><a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }

$u = $ir['username'];
$db->query("INSERT INTO forum_topics (ft_forum_id, ft_name, ft_desc, ft_posts, ft_owner_id, ft_owner_name, ft_start_time, ft_last_id, ft_last_name, ft_last_time, ft_pinned, ft_locked) VALUES (".$_GET['forum'].", '".$db->escape($_POST['ft_name'])."', '".$db->escape($_POST['ft_desc'])."', 0, ".$userid.", '".$u."', ".time().", 0, '', 0, 0, 0)");
$i = $db->insert_id();
$db->query("INSERT INTO forum_posts (fp_topic_id, fp_forum_id, fp_poster_id, fp_poster_name, fp_time, fp_subject, fp_text, fp_editor_id, fp_editor_name, fp_editor_time, fp_edit_count) VALUES (".$i.", ".$r['ff_id'].", ".$userid.", '".$u."', ".time().", '".$db->escape($_POST['ft_desc'])."', '".$db->escape($_POST['fp_text'])."', 0, '', 0, 0)");

$db->query("UPDATE forum_topics SET ft_last_id = ".$userid.", ft_last_name = '".$u."', ft_last_time = ".time().", ft_posts = ft_posts + 1 WHERE (ft_id = ".$i.")");
$db->query("UPDATE forum_forums SET ff_lp_time = ".time().", ff_posts = ff_posts + 1, ff_topics = ff_topics + 1, ff_lp_poster_id = ".$userid.", ff_lp_poster_name = '".$u."', ff_lp_t_id = ".$i.", ff_lp_t_name = '".$db->escape($_POST['ft_name'])."' WHERE (ff_id = ".$r['ff_id'].")");
$db->query("UPDATE users SET posts = posts + 1 WHERE (userid = ".$userid.")");
success("Topic Posted");

   feed_add(1,"<b>".$u."</b> has started a new topic <b><font color=red>".$_POST['ft_name']."</font></b> in the forums. <a href='forums.php?viewtopic=".$i."'>[view]</a>",$c);
   
$_GET['viewtopic']=$i;
viewtopic();
}
}

function emptyallforums() {
global $ir, $db;
if($ir['user_level'] != 2) { error("You don't have access<a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
$db->query("UPDATE forum_forums SET ff_lp_time = 0, ff_lp_poster_id = 0, ff_lp_poster_name = 'N/A', ff_lp_t_id = 0, ff_lp_t_name = 'N/A', ff_posts = 0, ff_topics = 0");
$db->query("TRUNCATE TABLE forum_topics");
$db->query("TRUNCATE TABLE forum_posts");
}

function quote() {
global $ir, $c, $userid, $h, $bbc, $db;
if(!$_GET['viewtopic']) { error("Topic ID not specified<a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
$q = $db->query("SELECT * FROM forum_topics WHERE (ft_id = ".$_GET['viewtopic'].")");
if(!$db->num_rows($q)) { error("Topic not found"); }
$topic = $db->fetch_row($q);

$q2 = $db->query("SELECT * FROM forum_forums WHERE (ff_id = ".$topic['ft_forum_id'].")");
$forum = $db->fetch_row($q2);
if(($forum['ff_auth'] == 'gang' AND $ir['gang'] != $forum['ff_owner']) OR ($forum['ff_auth'] == 'staff' AND $ir['user_level'] < 2)) { error("You have no permission to reply to this topic."); }

echo "<a href='forums.php'>Home</a> &raquo; <a href='forums.php?viewforum=".$forum['ff_id']."'>".format($forum['ff_name'])."</a> &raquo; <a href='forums.php?viewtopic=".$_GET['viewtopic']."'>".format($topic['ft_name'])."</a> &raquo; Quoting a Post<br /><br />";
if(!$topic['ft_locked']) {
$subject = $db->fetch_single($db->query("SELECT fp_subject FROM forum_posts WHERE (fp_topic_id = ".$topic['ft_id'].") ORDER BY fp_id ASC LIMIT 1"));
echo "<br /><br /><strong>Post a reply to this topic:</strong><br />
<form action='forums.php?reply=".$topic['ft_id']."' method='post'>
<table class='table' width='100%'>
<tr>
<td>Subject</td>
<td class='center'><input type='text' name='fp_subject' value=\"Re: ".format($subject)."\" /></td>
</tr>
<tr>
<td>Post:</td>
<td class='center'><textarea rows='7' cols='40' name='fp_text'>[quote=".format($_GET['quotename'])."]".format($_GET['quotetext'])."[/quote]
</textarea></td>
</tr>
<tr>
<td colspan='2' class='center'><input type='submit' value='Post Reply'></td>
</tr>
</table>
</form><a data-role='button' data-rel='back' href='forums.php'>Back</a>";
}
else { error("<em>This topic has been locked, you cannot reply to it.</em><a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
}

function edit() {
global $ir, $c, $userid, $h, $bbc, $db;
if(!$_GET['topic']) { error("Topic ID not specified"); }
if(!$_GET['post']) { error("Post ID not specified"); }
$q = $db->query("SELECT * FROM forum_topics WHERE (ft_id = ".$_GET['topic'].")");
if(!$db->num_rows($q)) { error("Topic not found"); }
$topic = $db->fetch_row($q);
$q2 = $db->query("SELECT * FROM forum_forums WHERE (ff_id = ".$topic['ft_forum_id'].")");
if(!$db->num_rows($q2)) { error("Board not found"); }
$forum = $db->fetch_row($q2);
if(($forum['ff_auth'] == 'gang' AND $ir['gang'] != $forum['ff_owner']) OR ($forum['ff_auth'] == 'staff' AND $ir['user_level'] < 2)) { error("You have no permission to view this forum."); }
$q3 = $db->query("SELECT * FROM forum_posts WHERE (fp_id = ".$_GET['post'].")");
if(!$db->num_rows($q3)) { error("Post not found"); }
$post = $db->fetch_row($q3);
if(!($ir['user_level'] > 1 || $ir['userid'] == $post['fp_poster_id'])) { error("You have no permission to edit this post."); }
if(!isset($_POST['fp_text'])) {
echo "<a href='forums.php'>Forums</a> &raquo; <a href='forums.php?viewforum=".$forum['ff_id']."'>".format($forum['ff_name'])."</a> &raquo; <a href='forums.php?viewtopic=".$_GET['topic']."'>".format($topic['ft_name'])."</a> &raquo; Editing a Post<br /><br />
<form action='forums.php?act=edit&amp;topic=".$topic['ft_id']."&amp;post=".$_GET['post']."' method='post'>
<table class='table' width='100%'>
<tr>
<td>Subject</td>
<td class='center'><input type='text' name='fp_subject' value=\"".format($post['fp_subject'])."\" /></td>
</tr>
<tr>
<td>Post</td>
<td class='center'><textarea rows='7' cols='40' name='fp_text'>".format($post['fp_text'])."</textarea></td>
</tr>
<tr>
<td colspan='2' class='center'><input type='submit' value='Edit Post'></td>
</tr>
</table>
</form>";
} else {
$db->query("UPDATE forum_posts SET fp_subject = '".$db->escape($_POST['fp_subject'])."', fp_text = '".$db->escape($_POST['fp_text'])."', fp_editor_id = ".$userid.", fp_editor_name = '".$ir['username']."', fp_editor_time = ".time().", fp_edit_count = fp_edit_count + 1 WHERE (fp_id = ".$_GET['post'].")");
success("Post Edited<a data-role='button' data-rel='back' href='forums.php'>Back</a>");
$_GET['viewtopic'] = $_GET['topic'];
viewtopic();
}
}

function recache_forum($forum) {
global $ir, $c, $userid, $h, $bbc, $db;
if($ir['user_level'] != 2) { error("You don't have access"); }
$forum = abs(@intval($forum));
if(!$forum) { error("Forum ID not specified"); }
echo "Recaching forum ID ".format($forum)." ... ";
$q = $db->query(
"SELECT p.*, t.* " .
"FROM forum_posts p " .
"LEFT JOIN forum_topics t ON (p.fp_topic_id = t.ft_id) " .
"WHERE (p.fp_forum_id = ".$forum.") ORDER BY p.fp_time DESC LIMIT 1");
if(!$db->num_rows($q)) {
$db->query("UPDATE forum_forums SET ff_lp_time = 0, ff_lp_poster_id = 0, ff_lp_poster_name = 'N/A', ff_lp_t_id = 0, ff_lp_t_name = 'N/A', ff_posts = 0, ff_topics = 0 WHERE (ff_id = ".$forum.")");
} else {
$r = $db->fetch_row($q);
$posts = $db->fetch_single($db->query("SELECT COUNT(fp_id) FROM forum_posts WHERE (fp_forum_id = ".$forum.")"));
$topics = $db->fetch_single($db->query("SELECT COUNT(ft_id) FROM forum_topics WHERE (ft_forum_id = ".$forum.")"));
$db->query("UPDATE forum_forums SET ff_lp_time = ".$r['fp_time'].", ff_lp_poster_id = ".$r['fp_poster_id'].", ff_lp_poster_name = '".$r['fp_poster_name']."', ff_lp_t_id = ".$r['ft_id'].", ff_lp_t_name = '".$r['ft_name']."', ff_posts = ".$posts.", ff_topics = ".$topics." WHERE (ff_id = ".$forum.")");
}
success("Board recached<a data-role='button' data-rel='back' href='forums.php'>Back</a>");
}

function recache_topic($topic) {
global $ir, $c, $userid, $h, $bbc, $db;
if($ir['user_level'] != 2) { error("You don't have access"); }
$topic = abs(@intval($topic));
if(!$topic) { error("Topic ID not specified"); }
echo "Recaching topic ID ".format($topic)." ... <a data-role='button' data-rel='back' href='forums.php'>Back</a>";

$q = $db->query("SELECT * FROM forum_posts WHERE (fp_topic_id = ".$topic.") ORDER BY fp_time DESC LIMIT 1");
if(!$db->num_rows($q)) {
$db->query("UPDATE forum_topics SET ft_last_id = 0, ft_last_time = 0, ft_last_name = 'N/A', ft_posts = 0 WHERE (ft_id = ".$topic.")");
} else {
$r = $db->fetch_row($q);
$posts = $db->fetch_single($db->query("SELECT COUNT(fp_id) FROM forum_posts WHERE (fp_topic_id = ".$topic.")"));
$db->query("UPDATE forum_topics SET ft_last_id = ".$r['fp_poster_id'].", ft_last_time = ".$r['fp_time'].", ft_last_name = '".$r['fp_poster_name']."', ft_posts = ".$posts." WHERE (ft_id = ".$topic.")");
}
success("Topic recached<a data-role='button' data-rel='back' href='forums.php'>Back</a>");
}

function move() {
global $ir, $c, $userid, $h, $bbc, $db;
if(!in_array($ir['user_level'], array(2, 3))) { error("You don't have access"); }
if(!$_GET['topic']) { error("Topic ID not specified"); }
if(!isset($_POST['forum'])) { error("Forum ID not specified"); }
$q = $db->query("SELECT ft_forum_id, ft_name FROM forum_topics WHERE (ft_id = ".$_GET['topic'].")");
if(!$db->num_rows($q)) { error("Topic not found<a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
$topic = $db->fetch_row($q);

$q2 = $db->query("SELECT ff_name FROM forum_forums WHERE (ff_id = ".$_POST['forum'].")");
if(!$db->num_rows($q2)) { error("Board not found<a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
$forum = $db->fetch_row($q2);
$db->query("UPDATE forum_topics SET ft_forum_id = ".$_POST['forum']." WHERE (ft_id = ".$_GET['topic'].")");
$db->query("UPDATE forum_posts SET fp_forum_id = ".$_POST['forum']." WHERE (fp_topic_id = ".$_GET['topic'].")");
recache_forum($topic['ft_forum_id']);
recache_forum($_POST['forum']);
stafflog_add("Moved Topic ".$topic['ft_name']." to ".$forum['ff_name']);
success("Topic moved<a data-role='button' data-rel='back' href='forums.php'>Back</a>");
}

function lock() {
global $ir, $c, $userid, $h, $bbc, $db;
if(!$_GET['topic']) { error("Topic ID not specified"); }
$q = $db->query("SELECT ft_name, ft_locked FROM forum_topics WHERE (ft_id = ".$_GET['topic'].")");
if(!$db->num_rows($q)) { error("Topic not found"); }
$r = $db->fetch_row($q);
$db->query("UPDATE forum_topics SET ft_locked =- ft_locked + 1 WHERE (ft_id = ".$_GET['topic'].")");
$what = ($r['ft_locked']) ? 'unl' : 'l';
stafflog_add(ucwords($what)."ocked &ldquo;".$r['ft_name']."&rdquo;");
success("You have ".$what."ocked &ldquo;".format($r['ft_name'])."&rdquo; <a data-role='button' data-rel='back' href='forums.php'>Back</a>");
}

function pin() {
global $ir, $c, $userid, $h, $bbc, $db;
if($ir['user_level'] != 2) { error("You don't have access<a data-role='button' data-rel='back' href='forums.php'>Back</a>"); }
if(!$_GET['topic']) { error("Topic ID not specified"); }
$query = $db->query("SELECT ft_name, ft_pinned FROM forum_topics WHERE (ft_id = ".$_GET['topic'].")");
if(!$db->num_rows($query)) { error("Topic not found"); }
$r = $db->fetch_row($query);
$db->query("UPDATE forum_topics SET ft_pinned =- ft_pinned + 1 WHERE (ft_id = ".$_GET['topic'].")");
$what = ($r['ft_pinned']) ? 'unp' : 'p';
stafflog_add(ucwords($what)."inned &ldquo;".$r['ft_name']."&rdquo;");
success("You have ".$what."inned &ldquo;".format($r['ft_name'])."&rdquo; <a data-role='button' data-rel='back' href='forums.php'>Back</a>");
}

function delepost() {
global $ir, $db;
if(!$_GET['post']) { error("Post ID not specified"); }
$q3 = $db->query("SELECT fp_poster_name, fp_topic_id, fp_forum_id, fp_id, fp_subject FROM forum_posts WHERE (fp_id = ".$_GET['post'].")");
if(!$db->num_rows($q3)) { error("Post not found"); }
$post = $db->fetch_row($q3);
$q = $db->query("SELECT ft_name FROM forum_topics WHERE (ft_id = ".$post['fp_topic_id'].")");
if(!$db->num_rows($q)) { error("Topic not found"); }
$topic = $db->fetch_row($q);
$db->query("DELETE FROM forum_posts WHERE (fp_id = ".$post['fp_id'].")");
recache_topic($post['fp_topic_id']);
recache_forum($post['fp_forum_id']);
stafflog_add("Deleted post &ldquo;".$post['fp_subject']."&rdquo; from &ldquo;".$topic['ft_name']."&rdquo;");
success("Post deleted (&ldquo;".format($post['fp_subject'])."&rdquo; from &ldquo;".format($topic['ft_name'])."&rdquo;)<a data-role='button' data-rel='back' href='forums.php'>Back</a>");
}

function deletopic() {
global $ir, $db;
if(!$_GET['topic']) { error("Topic ID not specified"); }
$q = $db->query("SELECT ft_name, ft_forum_id FROM forum_topics WHERE (ft_id = ".$_GET['topic'].")");
if(!$db->num_rows($q)) { error("Topic not found"); }
$topic = $db->fetch_row($q);
$db->query("DELETE FROM forum_topics WHERE (ft_id = ".$_GET['topic'].")");
$db->query("DELETE FROM forum_posts WHERE (fp_topic_id = ".$_GET['topic'].")");
recache_forum($topic['ft_forum_id']);
stafflog_add("Deleted topic &ldquo;".$topic['ft_name']."&rdquo;");
success("Topic &ldquo;".format($topic['ft_name'])."&rdquo; has ben deleted<a data-role='button' data-rel='back' href='forums.php'>Back</a>");
}

$h->endpage();
?>