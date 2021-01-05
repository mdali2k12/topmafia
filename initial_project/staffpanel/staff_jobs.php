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
case 'newjob': newjob(); return;
case 'newjobform': newjobform(); return;
case 'jobedit': jobedit(); return;
case 'jobeditform': jobeditform(); return;
case 'jobeditsub': jobeditsub(); return;
case 'newjobrank': newjobrank(); return;
case 'newjrankform': newjrankform(); return;
case 'jobrankedit': jobrankedit(); return;
case 'jobrankeditform': jobrankeditform(); return;
case 'jobrankeditsub': jobrankeditsub(); return;
case 'jobdele': jobdele(); return;
case 'jobdelform': jobdelform(); return;
case 'delrankform': delrankform(); return;
case 'jobrankdele': jobrankdele(); return;
default: print "Error: This script requires an action."; return;
}
function newjob()
{
global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
$q=$conn->query("SELECT jNAME FROM jobs WHERE jNAME='{$_POST['jNAME']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>This job already exist</div>";
newjobform();
}
elseif(empty($_POST['jNAME']) || empty($_POST['jDESC']) || empty($_POST['jOWNER']) || empty($_POST['jrPAY']) || empty($_POST['jrNAME']) || empty($_POST['jrLABOURG']) || empty($_POST['jrIQG']) || empty($_POST['jrSTRG']) || empty($_POST['jrLABOURN']) || empty($_POST['jrIQN']) || empty($_POST['jrSTRN']))
{
    print"<div class='error-msg'>You need to fill in all fields</div>";
    newjobform();
}
else{
    
$_POST['jNAME'] = $conn->real_escape_string($_POST['jNAME']);
$_POST['jDESC'] = $conn->real_escape_string($_POST['jDESC']);
$_POST['jOWNER'] = $conn->real_escape_string($_POST['jOWNER']);
$_POST['jrNAME'] = $conn->real_escape_string($_POST['jrNAME']);
$_POST['jrPAY'] = $conn->real_escape_string($_POST['jrPAY']);
$_POST['jrLABOURG'] = $conn->real_escape_string($_POST['jrLABOURG']);
$_POST['jrIQG'] = $conn->real_escape_string($_POST['jrIQG']);
$_POST['jrSTRG'] = $conn->real_escape_string($_POST['jrSTRG']);
$_POST['jrIQN'] = $conn->real_escape_string($_POST['jrIQN']);
$_POST['jrLABOURN'] = $conn->real_escape_string($_POST['jrLABOURN']);
$_POST['jrSTRN'] = $conn->real_escape_string($_POST['jrSTRN']);

$conn->query("INSERT INTO jobs (jNAME, jFIRST, jDESC, jOWNER) VALUES('{$_POST['jNAME']}', 0, '{$_POST['jDESC']}', '{$_POST['jOWNER']}')");
$i=$conn->insert_id;
$conn->query("INSERT INTO jobranks (jrNAME, jrJOB, jrPAY, jrIQG, jrLABOURG, jrSTRG, jrIQN, jrLABOURN, jrSTRN) VALUES('{$_POST['jrNAME']}', $i, {$_POST['jrPAY']}, {$_POST['jrIQG']}, {$_POST['jrLABOURG']}, {$_POST['jrSTRG']}, {$_POST['jrIQN']}, {$_POST['jrLABOURN']}, {$_POST['jrSTRN']})");
$j=$conn->insert_id;
$conn->query("UPDATE jobs SET jFIRST=$j WHERE jID=$i");
     print"<div class='success-msg'>Job has been added</div>";
stafflog_add("Created job {$_POST['jrNAME']} [$i] and job rank {$_POST['jrNAME']} [$j]");
newjobform();
}
}
function newjobform() {
    global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
print"
<h3>Create Job</h3>
<div class='infostaff'>You can create a new job to be added to the game.</div>
		<br />
		<br />
<form action='staff_jobs.php?action=newjob' method='post'>
<b>Job Name:</b> <input type='text' name='jNAME' /><br>
<b>Job Description:</b> <input type='text' name='jDESC' /><br>
<b>Job Owner:</b> <input type='text' name='jOWNER' /><br>
<h3>First Job Rank</h3>
<b>Rank Name:</b> <input type='text' name='jrNAME' /><br>
<b>Salary:</b> <input type='number' name='jrPAY' /><br>
<b>Strength Gained</b>: <input type='number' name='jrSTRG' size=6 maxlength=6>
<b>Labour Gained</b>: <input type='number' name='jrLABOURG' size=6 maxlength=6> 
<b>IQ Gained</b>: <input type='number' name='jrIQG' size=6 maxlength=6><br>
<h3>Requirements</h3>
<b>Str Required</b>: <input type='number' name='jrSTRN' size=8 maxlength=8>
<b>Labour Required</b>: <input type='number' name='jrLABOURN' size=8 maxlength=8> 
<b>IQ Required</b>: <input type='number' name='jrIQN' size=8 maxlength=8><br>
<input type='submit' value='Create Job' /></form>
";
}

function jobedit()
{
    global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['jID']=$conn->real_escape_string($_POST['jID']);
$_POST['jNAME']=$conn->real_escape_string($_POST['jNAME']);
$q=$conn->query("SELECT jID, jNAME FROM jobs WHERE jNAME='{$_POST['jNAME']}' AND jID !='{$_POST['jID']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>This job name already exist</div>";
jobeditform();
}
elseif(empty($_POST['jNAME']) || empty($_POST['jDESC']))
{
print "<div class='error-msg'>You missed one or more of the fields</div>";
jobeditform();
}
else{
    
$_POST['jID']=$conn->real_escape_string($_POST['jID']);
$_POST['jNAME']=$conn->real_escape_string($_POST['jNAME']);
$_POST['jDESC']=$conn->real_escape_string($_POST['jDESC']);
$_POST['jOWNER']=$conn->real_escape_string($_POST['jOWNER']);
$_POST['jFIRST']=$conn->real_escape_string($_POST['jFIRST']);
$conn->query("UPDATE jobs SET jNAME='{$_POST['jNAME']}', jDESC='{$_POST['jDESC']}', jOWNER='{$_POST['jOWNER']}', jFIRST={$_POST['jFIRST']} WHERE jID={$_POST['jID']}");
print "<div class='success-msg'>Job edited</div>";

stafflog_add("Edited job {$_POST['jrNAME']} [{$_POST['jID']}]");
jobeditform();
}
}
function jobeditsub() {
    global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
$q=$conn->query("SELECT jID FROM jobs WHERE jID='{$_POST['jID']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>This job does not exist</div>";
jobeditform();
}
elseif(empty($_POST['jID']))
{
$_POST['jID'] = $conn->real_escape_string($_POST['jID']);
    print"<div class='error-msg'>You need to select a job to edit!</div>";
    jobeditform();
}
else{
    
$q=$conn->query("SELECT * FROM jobs WHERE jID={$_POST['jID']}");
$r=$q->fetch_assoc();
print"
<form action='staff_jobs.php?action=jobedit' method='post'>
<input type='hidden' name='stage2' value='1'>
<input type='hidden' name='jID' value='{$_POST['jID']}'>
<b>Job Name:</b> <input type='text' name='jNAME' value='{$r['jNAME']}'><br>
<b>Job Description:</b> <input type='text' name='jDESC' value='{$r['jDESC']}'><br>
<b>Job Owner:</b> <input type='text' name='jOWNER' value='{$r['jOWNER']}'><br>
<b>First Job Rank:</b> 
".jobrank_dropdown($c,'jFIRST',$r['jFIRST'])."
<br>
<input type='submit' value='Edit' />
</form>
";
}
}

function jobeditform() {
global $conn,$c,$ir,$userid;
    print"<h3>Edit Job</h3>
    <div class='infostaff'>You can edit every aspect of the job here.</div>
		<br />
		<br />
    Edit a job:
<form action='staff_jobs.php?action=jobeditsub' method='post'>
".job_dropdown($c, 'jID')."
<br>
<input type='submit' value='Edit Job' />
</form>
";
}



function jobdele()
{
    global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['jID']=$conn->real_escape_string($_POST['jID']);
$q=$conn->query("SELECT jID, jNAME FROM jobs WHERE jID='{$_POST['jID']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>This job ID doesnt exist</div>";
jobdelform();
}
elseif(empty($_POST['jID']))
{
print "<div class='error-msg'>Select job to delete</div>";
jobdelform();
}
else {
$conn->query("DELETE FROM jobs WHERE jID={$_POST['jID']}");
print "<div class='success-msg'>Job and job rank has been deleted</div>";
$conn->query("DELETE FROM jobranks WHERE jrJOB={$_POST['jID']}");
$s = $conn->affected_rows;
$conn->query("UPDATE users SET job=0,jobrank=0 WHERE job={$_POST['jID']}");

stafflog_add("Deleted job ID [{$_POST['jID']}]");
jobdelform();
}
}
function jobdelform()
{
        global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
print"
<h3>Delete Job</h3>
<div class='infostaff'>This will delete the job and associated job ranks from the database and set users back to being jobless.</div>
		<br />
		<br />
<form action='staff_jobs.php?action=jobdele' method='post'>
Select a job to delete 
".job_dropdown($c, 'jID')."
<br>
<input type='submit' value='Delete Job' />
</form>
";
}





function newjobrank()
{
 global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
$q=$conn->query("SELECT jrNAME FROM jobranks WHERE jrNAME='{$_POST['jrNAME']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>This job rank does not exist</div>";
newjrankform();
}


elseif(empty($_POST['jrPAY']) || empty($_POST['jrNAME']) || empty($_POST['jrJOB']) || empty($_POST['jrLABOURG']) || empty($_POST['jrIQG']) || empty($_POST['jrSTRG']) || empty($_POST['jrLABOURN']) || empty($_POST['jrIQN']) || empty($_POST['jrSTRN']))
{ 
    print"<div class='error-msg'>You need fill in all fields!</div>";
    newjrankform();
}
else {
    
$_POST['jrNAME'] = $conn->real_escape_string($_POST['jrNAME']);
$_POST['jrPAY'] = $conn->real_escape_string($_POST['jrPAY']);
$_POST['jrLABOURG'] = $conn->real_escape_string($_POST['jrLABOURG']);
$_POST['jrIQG'] = $conn->real_escape_string($_POST['jrIQG']);
$_POST['jrSTRG'] = $conn->real_escape_string($_POST['jrSTRG']);
$_POST['jrIQN'] = $conn->real_escape_string($_POST['jrIQN']);
$_POST['jrLABOURN'] = $conn->real_escape_string($_POST['jrLABOURN']);
$_POST['jrSTRN'] = $conn->real_escape_string($_POST['jrSTRN']);
$conn->query("INSERT INTO jobranks (jrNAME, jrJOB, jrPAY, jrIQG, jrLABOURG, jrSTRG, jrIQN, jrLABOURN, jrSTRN) VALUES('{$_POST['jrNAME']}', {$_POST['jrJOB']}, {$_POST['jrPAY']}, {$_POST['jrIQG']}, {$_POST['jrLABOURG']}, {$_POST['jrSTRG']}, {$_POST['jrIQN']}, {$_POST['jrLABOURN']}, {$_POST['jrSTRN']})");

$j=$conn->insert_id;
    print"<div class='success-msg'>Created new job rank!</div>";
    newjrankform();
stafflog_add("Created job rank {$_POST['jrNAME']} [$j]");
    
}
}
function newjrankform() {
     global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
print"
<h3>New Job Rank</h3>
<div class='infostaff'>You can create job ranks for the selected jobs here.</div>
		<br />
		<br />
<form action='staff_jobs.php?action=newjobrank' method='post'>
<b>Rank Name:</b> <input type='text' name='jrNAME' /><br>
<b>Pays:</b> <input type='number' name='jrPAY' /><br>
<b>Job:</b> 
".job_dropdown($c,"jrJOB")."
<br>
<h3>Gain</h3>
Str: <input type='number' name='jrSTRG' size=6 maxlength=6> Lab: <input type='number' name='jrLABOURG' size=6 maxlength=6> IQ: <input type='number' name='jrIQG' size=6 maxlength=6><br>
<h3>Req</h3>
Str: <input type='number' name='jrSTRN' size=8 maxlength=8> Lab: <input type='number' name='jrLABOURN' size=8 maxlength=8> IQ: <input type='number' name='jrIQN' size=8 maxlength=8><br>
<input type='submit' value='Create Job Rank' /></form>
";
}







function jobrankedit()
{
global $conn,$ir,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['jrID']=$conn->real_escape_string($_POST['jrID']);
$_POST['jrNAME']=$conn->real_escape_string($_POST['jrNAME']);
$q=$conn->query("SELECT jrID, jrNAME FROM jobranks WHERE jrNAME='{$_POST['jrNAME']}' AND jrID !='{$_POST['jrID']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>This job rank name already exist</div>";
jobrankeditform();
}
elseif(empty($_POST['jrPAY']) || empty($_POST['jrNAME']) || empty($_POST['jrLABOURG']) || empty($_POST['jrIQG']) || empty($_POST['jrSTRG']) || empty($_POST['jrLABOURN']) || empty($_POST['jrIQN']) || empty($_POST['jrSTRN']))
{
    print"<div class='error-msg'>You need to fill in all fields</div>";
    jobrankeditform();
}
else{
$_POST['jrNAME'] = $conn->real_escape_string($_POST['jrNAME']);
$_POST['jrPAY'] = $conn->real_escape_string($_POST['jrPAY']);
$_POST['jrLABOURG'] = $conn->real_escape_string($_POST['jrLABOURG']);
$_POST['jrIQG'] = $conn->real_escape_string($_POST['jrIQG']);
$_POST['jrSTRG'] = $conn->real_escape_string($_POST['jrSTRG']);
$_POST['jrIQN'] = $conn->real_escape_string($_POST['jrIQN']);
$_POST['jrLABOURN'] = $conn->real_escape_string($_POST['jrLABOURN']);
$_POST['jrSTRN'] = $conn->real_escape_string($_POST['jrSTRN']);
$conn->query("UPDATE jobranks SET jrNAME='{$_POST['jrNAME']}', jrJOB = {$_POST['jrJOB']}, jrPAY= {$_POST['jrPAY']}, jrIQG={$_POST['jrIQG']}, jrLABOURG={$_POST['jrLABOURG']}, jrSTRG={$_POST['jrSTRG']}, jrIQN={$_POST['jrIQN']}, jrLABOURN={$_POST['jrLABOURN']}, jrSTRN={$_POST['jrSTRN']} WHERE jrID={$_POST['jrID']}");

    print"<div class='success-msg'>Edited job rank!</div>";
    jobrankeditform();
stafflog_add("Edited job rank {$_POST['jrNAME']} [{$_POST['jrID']}]");
    
}
}


function jobrankeditsub() {
global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
$q=$conn->query("SELECT jrID FROM jobranks WHERE jrID='{$_POST['jrID']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>This job rank does not exist</div>";
jobrankeditform();
}
elseif(empty($_POST['jrID']))
{
$_POST['jrID'] = $conn->real_escape_string($_POST['jrID']);
    print"<div class='error-msg'>You need to select a job rank to edit!</div>";
    jobrankeditform();
}
else{
$q=$conn->query("SELECT * FROM jobranks WHERE jrID={$_POST['jrID']}");
$r=$q->fetch_assoc();
print"
<form action='staff_jobs.php?action=jobrankedit' method='post'>
<input type='hidden' name='jrID' value='{$_POST['jrID']}'>
<b>Job Rank Name:</b> <input type='text' name='jrNAME' value='{$r['jrNAME']}'><br>
<b>Job:</b> 
".job_dropdown($c,'jrJOB',$r['jrJOB'])."
<br>
<b>Pays:</b> <input type='number' name='jrPAY' value='{$r['jrPAY']}' /><br>
<h3>Gains:</h3>
Str: <input type='number' name='jrSTRG' size=6 maxlength=6 value='{$r['jrSTRG']}'> Lab: <input type='number' name='jrLABOURG' size=6 maxlength=6 value='{$r['jrLABOURG']}'> IQ: <input type='number' name='jrIQG' size=6 maxlength=6 value='{$r['jrIQG']}'><br>
<h3>Reqs:</h3> 
Str: <input type='number' name='jrSTRN' size=8 maxlength=8 value='{$r['jrSTRN']}'> Lab: <input type='number' name='jrLABOURN' size=8 maxlength=8 value='{$r['jrLABOURN']}'> IQ: <input type='number' name='jrIQN' size=8 maxlength=8 value='{$r['jrIQN']}'><br>
<b>Job:</b>
<input type='submit' value='Edit' />
</form>
";
}
}




function jobrankeditform()
{
      global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
print"<h3>Edit job rank</h3>
<div class='infostaff'>You can edit every aspect of the job ranks here.</div>
		<br />
		<br />
<form action='staff_jobs.php?action=jobrankeditsub' method='post'>
Select a job rank to edit 
".jobrank_dropdown($c, 'jrID')."
<br>
<input type='submit' value='Edit Job Rank' />
</form>
";
}





function jobrankdele()
{
          global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['jID'] = $conn->real_escape_string($_POST['jrJOB']);
$_POST['jrID'] = $conn->real_escape_string($_POST['jrID']);
$q=$conn->query("SELECT jrID FROM jobranks WHERE jrID='{$_POST['jrID']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>This job rank does not exist {$_POST['jrID']}</div>";
delrankform();
}
elseif(empty($_POST['jrID']))
{ 
    print"<div class='error-msg'>You need to select a job rank to delete!</div>";
    delrankform();
}
else {
$q=$conn->query("SELECT * FROM jobranks WHERE jrID={$_POST['jrID']}");
$jr=$q->fetch_assoc();
$_POST['jID'] = $conn->real_escape_string($_POST['jrJOB']);
$_POST['jrID'] = $conn->real_escape_string($_POST['jrID']);
$conn->query("DELETE FROM jobranks WHERE jrID={$_POST['jrID']}");
print "<div class='success-msg'>Job rank successfully deleted!</div>";
$conn->query("UPDATE users u LEFT JOIN jobs j ON u.job=j.jID SET u.jobrank=j.jFIRST WHERE u.job={$_POST['jID']} and u.jobrank={$_POST['jrID']}");
$q=$conn->query("SELECT * FROM jobs WHERE jFIRST={$_POST['jrID']}");
if(mysqli_num_rows($q))
{
$r=$q->fetch_assoc();
print "<div class='info-msg'><b>Warning!</b> The Job {$r['jNAME']} now has no first rank! Please go edit it and include a first rank.</div>";
stafflog_add("Deleted job rank ID [{$_POST['jrID']}]");

}delrankform();
}
}


function delrankform()
{
          global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
print "
<h3>Delete Job Rank</h3>
<div class='infostaff'>This will delete the job ranks from the database.</div>
		<br />
		<br />
<form action='staff_jobs.php?action=jobrankdele' method='post'>
Select a job rank to delete 
".jobrank_dropdown($c, 'jrID')."
<br>
<input type='submit' value='Delete Job Rank' />
</form>
";
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