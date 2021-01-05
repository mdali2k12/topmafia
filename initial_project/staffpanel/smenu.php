<?php
global $conn,$c,$ir, $set, $userid;

?>
<style>
    .linkmenu {
    display:block;
    color:#ccc;
    font-size:10px;
    padding:5px;
    margin-top:1px;
    background-color:#000;
}

a.linkmenu {color:white;}
a.linkmenu:hover {color:cyan;}

    .linkmenu2 {
    display:block;
    color:#ccc;
    font-size:10px;
    padding:5px;
    margin-top:1px;
    background-color:#222;
}

a.linkmenu2 {color:white;}
a.linkmenu2:hover {color:cyan;}
</style>


<?php
print "<div class='smenu' style='margin-top:-20px;text-align:left; float:left; padding:10px; background-color:#333;'>";

// imran fixed
//print "<a href='http://www.pocketmafia.com/'>Back To Game</a><hr />";
?>
<style>
.collapsible {
  
    color:#fff;
    text-align:left;
    background-color:#111;
    padding:5px;
    font-size:14px;
    margin-top:5px;
    cursor: pointer;
    border: none;
    outline: none;
    width:100%;
}

.active, .collapsible:hover {
    
  font-weight:bold;
}

.content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
</style>

<?php
echo'<center><a href="" class="datetime">'.$date.' <span id="chas">'.$hour.'</span>:<span id="minuti">'.$minute.'</span>:<span id="sekundi">'.$second.'</span></a></center>';
print"
<div style='border:1px solid #555;'>
<a href='../mailbox.php' class='linkmenu2'>Inbox ($mc)</a>
<a href='../events.php' class='linkmenu2'>Events ($ec)</a></a>
<a href='../index.php' class='linkmenu2'>Back to Game</a>
<a href='../logout.php' class='linkmenu2'>Logout</a>
</div>";
if($ir['user_level']==2)
{
    
print "<button class='collapsible' style='background-color:green;'>Admin</button>
<div class='content'>
<a href='staff.php?action=basicset' class='linkmenu'>Basic Settings</a>
<a href='staff.php?action=announceform' class='linkmenu'>Manage Announcement</a>
<a href='staff.php?action=updateform' class='linkmenu'>Manage Update</a>
<a href='staff_items.php?action=massitemgive' class='linkmenu'>Mass Give Item</a>
<a href='staff_users.php?action=masscredit' class='linkmenu'>Mass Payment</a>
<a href='staff_special.php?action=massmailerform' class='linkmenu'>Mass Mailer</a>
<a href='staff_special.php?action=stafflist' class='linkmenu'>Staff List</a>
</div>";

}
print "
<button class='collapsible'>General</button>
<div class='content'>
<a href='staff.php' class='linkmenu'>Index</a>";
print"</div>";

if($ir['user_level'] <= 3)
{
print "
<button class='collapsible'>Users</button>";
print"<div class='content'>";
if($ir['user_level']==2)
{
print "<a href='staff_users.php?action=newuser' class='linkmenu'>Create New User</a>
<a href='staff_users.php?action=edituser' class='linkmenu'>Edit User</a>
<a href='staff_users.php?action=deluser' class='linkmenu'>Delete User</a>";
}

if($ir['user_level']==2)
{print "
<a href='staff_users.php?action=viewuserprofile' class='linkmenu'>View User Account</a>
<a href='staff_users.php?action=invbeg' class='linkmenu'>View User Inventory</a>
<a href='staff_users.php?action=creditform' class='linkmenu'>Credit User</a>";
}
print "
<a href='staff_users.php?action=forcelogout' class='linkmenu'>Force User Logout</a> 
<a href='staff_users.php?action=reportsview' class='linkmenu'>Player Reports</a>";
print"</div>";


if($ir['user_level']==2)
{
print "<button class='collapsible'>Items</button>";
print"<div class='content'>";
print "<a href='staff_items.php?action=newitem' class='linkmenu'>Create New Item</a>";

print "<a href='staff_items.php?action=giveitem' class='linkmenu'>Give Item To User</a>";
print "<a href='staff_items.php?action=edititem' class='linkmenu'>Edit Item</a>

<a href='staff_items.php?action=viewitemuserform' class='linkmenu'>Item User Search</a>
<a href='staff_items.php?action=killitem' class='linkmenu'>Delete An Item</a>
<a href='staff_items.php?action=newitemtypef' class='linkmenu'>Add Item Type</a>
<a href='staff_items.php?action=viewitemtypeform' class='linkmenu'>View Item Type</a>
<a href='staff_items.php?action=edititemtypeform' class='linkmenu'>Delete Item Type</a>
";
print"</div>";
}
}


if($ir['user_level'] >= 2)
{
print "<button class='collapsible'>Logs</button>
<div class='content'>";
if($ir['user_level']==2)
{
print"
<a href='staff_logs.php?action=gamestats' class='linkmenu'>Game Stats</a>
<a href='staff_logs.php?action=dlogs' class='linkmenu'>Donation Logs</a>
<a href='staff_logs.php?action=creditlogs' class='linkmenu'>Credit Xfer Logs</a>
<a href='staff_logs.php?action=signuplogs' class='linkmenu'>Registration Logs</a>
<a href='staff_logs.php?action=activitylogs' class='linkmenu'>Activity Logs</a>
";
}
print"<a href='staff_logs.php?action=maillogs' class='linkmenu'>Mail Logs</a>
<a href='staff_logs.php?action=eventlogs' class='linkmenu'>Event Logs</a>
<a href='staff_logs.php?action=stafflogs' class='linkmenu'>Staff Logs</a>
<a href='staff_logs.php?action=smugglelogs' class='linkmenu'>Drug Smuggle Logs</a>
<a href='staff_logs.php?action=botlogs' class='linkmenu'>Challenge Logs</a>
<a href='staff_logs.php?action=atklogs' class='linkmenu'>Attack Logs</a>
<a href='staff_logs.php?action=cashlogs' class='linkmenu'>Cash Xfer Logs</a>
<a href='staff_logs.php?action=cryslogs' class='linkmenu'>Crystal Xfer Logs</a>
<a href='staff_logs.php?action=banklogs' class='linkmenu'>Bank Xfer Logs</a>
<a href='staff_logs.php?action=itmlogs' class='linkmenu'>Item Xfer Logs</a>";
print"</div>";
}

if($ir['user_level'] <= 3)
{
print "<button class='collapsible'>Gangs</button>
<div class='content'>
<a href='staff_gangs.php?action=grecord' class='linkmenu'>Gang Record</a>
<a href='staff_gangs.php?action=gwar' class='linkmenu'>Manage Gang Wars</a>";
if($ir['user_level'] == 2)
{
print "
<a href='staff_gangs.php?action=gform' class='linkmenu'>Credit Gang</a>
<a href='staff_gangs.php?action=geditform' class='linkmenu'>Edit Gang</a>";
}

print"
</div>";
}


if($ir['user_level']==2)
{
print " 
<button class='collapsible'>Stocks</button>
<div class='content'>
<a href='staff_stocks.php?action=addform' class='linkmenu'>Add Stock</a>
<a href='staff_stocks.php?action=edit' class='linkmenu'>Edit Stock</a>
<a href='staff_stocks.php?action=del' class='linkmenu'>Del Stock</a>
<a href='staff_stocks.php?action=view' class='linkmenu'>View Stock</a>
<a href='staff_stocks.php?action=holders' class='linkmenu'>Share Holders</a>
</div>
<button class='collapsible'>Shops</button>
<div class='content'>
<a href='staff_shops.php?action=newshop' class='linkmenu'>Create New Shop</a>
<a href='staff_shops.php?action=editshop' class='linkmenu'>Edit Shop</a>
<a href='staff_shops.php?action=del_shop_form' class='linkmenu'>Delete Shop</a>
<a href='staff_shops.php?action=newstock' class='linkmenu'>Add Item To Shop</a>
<a href='staff_shops.php?action=shopitems' class='linkmenu'>View Shop Items</a>
</div>
<button class='collapsible'>Jobs</button>
<div class='content'>
<a href='staff_jobs.php?action=newjobform' class='linkmenu'>Create new Job</a>
<a href='staff_jobs.php?action=jobeditform' class='linkmenu'>Edit a Job</a>
<a href='staff_jobs.php?action=jobdelform' class='linkmenu'>Delete a Job</a>
<a href='staff_jobs.php?action=newjrankform' class='linkmenu'>Create Job Rank</a>
<a href='staff_jobs.php?action=jobrankeditform' class='linkmenu'>Edit a Job Rank</a>
<a href='staff_jobs.php?action=delrankform' class='linkmenu'>Delete a Job Rank</a></div>

<button class='collapsible'>Houses</button>
<div class='content'>
<a href='staff_houses.php?action=addhouseform' class='linkmenu'>Add House</a>
<a href='staff_houses.php?action=edithouseform' class='linkmenu'>Edit House</a>
<a href='staff_houses.php?action=delhouseform' class='linkmenu'>Delete House</a>
</div>

<button class='collapsible'>Cities</button>
<div class='content'>
<a href='staff_cities.php?action=addcityform' class='linkmenu'>Add City</a>
<a href='staff_cities.php?action=editcityform' class='linkmenu'>Edit City</a>
<a href='staff_cities.php?action=delcityform' class='linkmenu'>Delete City</a>
</div>

<button class='collapsible'>Forums</button>
<div class='content'>
<a href='staff_forums.php?action=addforumform' class='linkmenu'>Add Forum</a>
<a href='staff_forums.php?action=editforumform' class='linkmenu'>Edit Forum</a>
<a href='staff_forums.php?action=delforumform' class='linkmenu'>Delete Forum</a>
</div>

<button class='collapsible'>Courses</button>
<div class='content'>
<a href='staff_courses.php?action=addcourseform' class='linkmenu'>Add Course</a>
<a href='staff_courses.php?action=editcourseform' class='linkmenu'>Edit Course</a>
<a href='staff_courses.php?action=delcourseform' class='linkmenu'>Delete Course</a>
</div>

<button class='collapsible'>Crimes</button>
<div class='content'>
<a href='staff_crimes.php?action=newcrime' class='linkmenu'>Create New Crime</a>
<a href='staff_crimes.php?action=editcrime' class='linkmenu'>Edit Crime</a>
<a href='staff_crimes.php?action=delcrimeform' class='linkmenu'>Delete Crime</a>
<a href='staff_crimes.php?action=newcrimegroup' class='linkmenu'>Create Crime Group</a>
<a href='staff_crimes.php?action=editcrimegroup' class='linkmenu'>Edit Crime Group</a>
<a href='staff_crimes.php?action=delcrimegroup' class='linkmenu'>Delete Crime Group</a>
<a href='staff_crimes.php?action=reorderform' class='linkmenu'>Reorder Crime Groups</a>
</div>

<button class='collapsible'>Bots</button>
<div class='content'>
<a href='staff_battletent.php?action=createbotform' class='linkmenu'>Create Bot</a>
<a href='staff_battletent.php?action=addbotform' class='linkmenu'>Add Bot</a>
<a href='staff_battletent.php?action=editbotform' class='linkmenu'>Edit Bot</a>
<a href='staff_battletent.php?action=delbotform' class='linkmenu'>Remove Bot</a>
</div>";
}
print "
<button class='collapsible'>Ban</button>
<div class='content'>
<a href='staff_punit.php?action=banform' class='linkmenu'>Jail User</a>
<a href='staff_punit.php?action=fedeform' class='linkmenu'>Edit Sentence</a>
<a href='staff_punit.php?action=unfedform' class='linkmenu'>Unjail User</a>
<a href='staff_punit.php?action=ipform' class='linkmenu'>Ip Search</a>
<a href='staff_punit.php?action=ipbanform' class='linkmenu'>Ip Ban</a>
</div>";
if($ir['user_level']==2)
{
    print "
    <button class='collapsible'>Cleaner</button>
<div class='content'>
<a href='staff_slogs.php' class='linkmenu'>Clear Staff Logs</a>
<a href='staff_inactive.php' class='linkmenu'>Clear Dead Users</a>
<a href='staff_messages.php' class='linkmenu'>Clear Dead Msgs</a>
<a href='staff_events.php' class='linkmenu'>Clear Dead Events</a>
<a href='staff_gangevents.php' class='linkmenu'>Clear Gang Events</a>
<a href='staff_busevents.php' class='linkmenu'>Clear Business Events</a>
<a href='staff_attacklogs.php' class='linkmenu'>Clear Attack logs</a>
<a href='forumclean.staff.php' class='linkmenu'>Forum Clean</a>
</div>";
}
//print "<div class='titlehr'>";
//print "Staff Online:</div>";
//$q=$conn->query("SELECT * FROM users WHERE laston>(unix_timestamp()-15*60) AND //user_level>1 ORDER BY userid ASC");
//while($r=$q->fetch_assoc())
//{
//$la=time()-$r['laston'];
//$unit="secs";
//if($la >= 60)
//{
//$la=(int) ($la/60);
//$unit="mins";
//}
//if($la >= 60)
//{
//$la=(int) ($la/60);
//$unit="hours";
//if($la >= 24)
//{
//$la=(int) ($la/24);
//$unit="days";
//}
//}
//print "<center><a href='../viewuser.php?u={$r['userid']}' class='linkmenu'//>{$r['username']} ($la $unit)</a></center> ";
//}

print "</div>";

?>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    }
  });
}
</script>
