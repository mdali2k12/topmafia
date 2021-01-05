<?php
include "sglobals.php";
if($ir['user_level'] != 2)
{
die("403");
}
//This contains item stuffs

$_GET['action'] = $conn->real_escape_string($_GET['action']);
switch($_GET['action'])
{
case 'massitemgive': mass_give_item(); return;
case 'massitemgivesub': mass_give_item_sub(); return;
case 'newitem': new_item_form(); return;
case 'newitemsub': new_item_submit(); return;
case 'giveitem': give_item_form(); return;
case 'giveitemsub': give_item_submit(); return;
case 'killitem': kill_item_form(); return;
case 'killitemsub': kill_item_submit(); return;
case 'edititem': edit_item_begin(); return;
case 'edititemform': edit_item_form(); return;
case 'edititemsub': edit_item_sub(); return;
case 'newitemtype': newitemtype(); return;
case 'newitemtypef': newitemtypeform(); return;
case 'edititemtype': edititemtype(); return;
case 'edititemtypeform': edititemtypeform(); return;
case 'viewitemtypeform': viewitemtypeform(); return;

case 'viewitemuserform': viewitemuserform(); return;
case 'viewitemuser': viewitemuser(); return;

case 'viewitemtype': viewitemtype(); return;
case 'delitemtype': delitemtype(); return;
case 'delitemtypeform': delitemtypeform(); return;
default: print "Error: This script requires an action."; return;
}
function new_item_form()
{
global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Adding an item to the game</h3>
<div class='infostaff'>You can create an item to be added to the games database below.</div>
		<br />
		<br />
<form action='staff_items.php?action=newitemsub' method='post'>
Item Name: <input type='text' name='itmname' value='' /><br />
Item Desc.: <input type='text' name='itmdesc' value='' /><br />
Item Type: ".itemtype_dropdown($c,'itmtype')."<br />
Item Buyable: <input type='checkbox' name='itmbuyable' checked='checked' /><br />
Item Price: <input type='number' name='itmbuyprice' value='0' /><br />
Item Sell Value: <input type='number' name='itmsellprice'  value='0' /><br /><br />

<b>Usage Form</b>
<b><u>Effect 1</u></b><br />
On? <input type='radio' name='effect1on' value='1' /> Yes <input type='radio' name='effect1on' value='0' checked='checked' /> No<br />
Stat: <select name='effect1stat' type='dropdown'>
<option value='gradientdays'>Gradient days</option>
<option value='credits'>Credits</option>
<option value='energy'>Energy</option>
<option value='will'>Will</option>
<option value='brave'>Brave</option>
<option value='maxbrave'>Max Brave</option>
<option value='hp'>Health</option>
<option value='maxhp'>Max Health</option>
<option value='strength'>Strength</option>
<option value='agility'>Agility</option>
<option value='guard'>Guard</option>
<option value='labour'>Labour</option>
<option value='IQ'>IQ</option>
<option value='hospital'>Hospital Time</option>
<option value='jail'>Jail Time</option>
<option value='money'>Money</option>
<option value='crystals'>Crystals</option>
<option value='cdays'>Education Days Left</option>
<option value='bankmoney'>Bank money</option>
<option value='vip'>Vip Days</option>
<option value='vipenergy'>Vip Energy</option>
<option value='protected'>Protected</option>

</select> Direction: <select name='effect1dir' type='dropdown'>
<option value='pos'>Increase</option>
<option value='neg'>Decrease</option>
</select><br />
Amount: <input type='number' name='effect1amount' value='0' /> <select name='effect1type' type='dropdown'>
<option value='figure'>Value</option>
<option value='percent'>Percent</option>
</select>
<b><u>Effect 2</u></b><br />
On? <input type='radio' name='effect2on' value='1' /> Yes <input type='radio' name='effect2on' value='0' checked='checked' /> No<br />
Stat: <select name='effect2stat' type='dropdown'>
<option value='gradientdays'>Gradient days</option>
<option value='energy'>Energy</option>
<option value='credits'>Credits</option>
<option value='will'>Will</option>
<option value='brave'>Brave</option>
<option value='maxbrave'>Max Brave</option>
<option value='hp'>Health</option>
<option value='maxhp'> Max Health</option>
<option value='strength'>Strength</option>
<option value='agility'>Agility</option>
<option value='guard'>Guard</option>
<option value='labour'>Labour</option>
<option value='IQ'>IQ</option>
<option value='hospital'>Hospital Time</option>
<option value='jail'>Jail Time</option>
<option value='money'>Money</option>
<option value='level'>Level</option>
<option value='crystals'>Crystals</option>
<option value='cdays'>Education Days Left</option>
<option value='bankmoney'>Bank money</option>
<option value='vip'>Vip Days</option>
<option value='protected'>Protected</option>
</select> Direction: <select name='effect2dir' type='dropdown'>
<option value='pos'>Increase</option>
<option value='neg'>Decrease</option>
</select><br />
Amount: <input type='number' name='effect2amount' value='0' /> <select name='effect2type' type='dropdown'>
<option value='figure'>Value</option>
<option value='percent'>Percent</option>
</select>
<b><u>Effect 3</u></b><br />
On? <input type='radio' name='effect3on' value='1' /> Yes <input type='radio' name='effect3on' value='0' checked='checked' /> No<br />
Stat: <select name='effect3stat' type='dropdown'>
<option value='gradientdays'>Gradient days</option>
<option value='credits'>Credits</option>
<option value='energy'>Energy</option>
<option value='maxenergy'>Max Energy</option>
<option value='will'>Will</option>
<option value='brave'>Brave</option>
<option value='maxbrave'>Max Brave</option>
<option value='hp'>Health</option>
<option value='maxhp'>Max Health</option>
<option value='strength'>Strength</option>
<option value='agility'>Agility</option>
<option value='guard'>Guard</option>
<option value='labour'>Labour</option>
<option value='IQ'>IQ</option>
<option value='hospital'>Hospital Time</option>
<option value='jail'>Jail Time</option>
<option value='money'>Money</option>
<option value='crystals'>Crystals</option>
<option value='cdays'>Education Days Left</option>
<option value='bankmoney'>Bank money</option>
<option value='crimexp'>Crime XP</option>
<option value='vip'>Vip Days</option>
<option value='protected'>Protected</option>
</select> Direction: <select name='effect3dir' type='dropdown'>
<option value='pos'>Increase</option>
<option value='neg'>Decrease</option>
</select><br />
Amount: <input type='number' name='effect3amount' value='0' /> <select name='effect3type' type='dropdown'>
<option value='figure'>Value</option>
<option value='percent'>Percent</option>
</select>
<b>Combat Usage</b><br />
Weapon Power: <input type='number' name='weapon' value='0' /><br />
Armor Defense: <input type='number' name='armor' value='0' />
<input type='submit' value='Add Item To Game' /></form>";
}
function new_item_submit()
{
global $conn,$ir,$c,$h;
if($ir['user_level'] != 2)
{
die("403");
}
$itmname=$conn->real_escape_string($_POST['itmname']);
$itmdesc=$conn->real_escape_string($_POST['itmdesc']);
$q=$conn->query("SELECT itmid, itmname FROM items WHERE itmname='{$_POST['itmname']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>This item already exist</div>";
new_item_form();
}
elseif(empty($_POST['itmname']) || empty($_POST['itmdesc']))
{
print "<div class='error-msg'>You missed one or more of the fields </div>";
new_item_form();
}
else
{
$itmname=$conn->real_escape_string($_POST['itmname']);
$itmdesc=$conn->real_escape_string($_POST['itmdesc']);
$_POST['itmtype'] = $conn->real_escape_string($_POST['itmtype']);
$_POST['itmtype'] = $conn->real_escape_string($_POST['itmtype']);
$_POST['itmbuyprice'] = $conn->real_escape_string($_POST['itmbuyprice']);
$_POST['itmsellprice'] = $conn->real_escape_string($_POST['itmsellprice']);

$weapon=abs((int) $_POST['weapon']);
$armor=abs((int) $_POST['armor']);
if($_POST['itmbuyable'] == 'on') { $itmbuy=1; } else { $itmbuy=0; }
$efx1=$conn->real_escape_string(serialize(array("stat" => $_POST['effect1stat'], "dir" => $_POST['effect1dir'], "inc_type" => $_POST['effect1type'], "inc_amount" => abs((int) $_POST['effect1amount']))));
$efx2=$conn->real_escape_string(serialize(array("stat" => $_POST['effect2stat'], "dir" => $_POST['effect2dir'], "inc_type" => $_POST['effect2type'], "inc_amount" => abs((int) $_POST['effect2amount']))));
$efx3=$conn->real_escape_string(serialize(array("stat" => $_POST['effect3stat'], "dir" => $_POST['effect3dir'], "inc_type" => $_POST['effect3type'], "inc_amount" => abs((int) $_POST['effect3amount']))));
$conn->query("INSERT INTO items (itmtype, itmname, itmdesc, itmbuyprice, itmsellprice, itmbuyable, effect1_on, effect1, effect2_on, effect2, effect3_on, effect3, weapon, armor) VALUES({$_POST['itmtype']},'$itmname','$itmdesc',{$_POST['itmbuyprice']},{$_POST['itmsellprice']},$itmbuy, '{$_POST['effect1on']}', '$efx1', '{$_POST['effect2on']}', '$efx2', '{$_POST['effect3on']}', '$efx3', $weapon, $armor)");
$ii = $conn->insert_id;
print "<div class='success-msg'>The {$_POST['itmname']} Item was added to the game</div>";
stafflog_add("Created Item {$_POST['itmname']} [$ii]");
new_item_form();
}
}
function give_item_form()
{
global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Giving Item To User</h3>
<div class='infostaff'>Here you can credit an item or items to a selected user.</div>
		<br />
		<br />
<form action='staff_items.php?action=giveitemsub' method='post'>
User: ".user_dropdown($c,'user')."<br />
Item: ".item_dropdown($c,'item')."<br />
Quantity: <input type='number' name='qty' value='1' /><br />
<input type='submit' value='Give Item' /></form>";
}
function give_item_submit()
{
global $conn,$ir,$c;
if($ir['user_level'] != 2)
{
die("403");
}

$_POST['user'] = $conn->real_escape_string($_POST['user']);

$_POST['item'] = $conn->real_escape_string($_POST['item']);

$_POST['qty'] = $conn->real_escape_string($_POST['qty']);

$_POST['qty'] = abs((int) $_POST['qty']);

$q=$conn->query("SELECT userid FROM users WHERE userid='{$_POST['user']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, user doesnt exist</div>";
give_item_form();
}

elseif(empty($_POST['item']) || empty($_POST['user'])|| empty($_POST['qty']))
{
    print"<div class='error-msg'>You need to select or fill in all fields</div>";
    give_item_form();
}
else{
$conn->query("INSERT INTO inventory (inv_itemid, inv_userid, inv_qty) VALUES({$_POST['item']},{$_POST['user']},{$_POST['qty']})",$c) or die(mysqli_error());
print "<div class='success-msg'>You gave {$_POST['qty']} of item ID {$_POST['item']} to user ID {$_POST['user']}</div>";
stafflog_add("Gave ".number_format($_POST['qty'])." of item ID [{$_POST['item']}] to user ID [{$_POST['user']}]");
give_item_form();
}
}
function kill_item_form()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Deleting Item</h3>
<div class='infostaff'>This will permanently remove the item from the database.</div>
		<br />
		<br />
<form action='staff_items.php?action=killitemsub' method='post'>
Item: ".item_dropdown($c,'item')."<br />
<input type='submit' value='Kill Item' /></form>";
}
function kill_item_submit()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['item'] = $conn->real_escape_string($_POST['item']);
$q=$conn->query("SELECT itmid FROM items WHERE itmid='{$_POST['item']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, item doesnt exist</div>";
kill_item_form();
}
elseif(empty($_POST['item']))
{
    print "<div class='error-msg'>Sorry, item field is empty</div>";
kill_item_form();
}
else {
$_POST['item'] = $conn->real_escape_string($_POST['item']);
$d=$conn->query("SELECT * FROM items WHERE itmid={$_POST['item']}");
$itemi=$d->fetch_assoc();
$conn->query("DELETE FROM items WHERE itmid={$_POST['item']}");
$conn->query("DELETE FROM shopitems WHERE sitemITEMID={$_POST['item']}");
$conn->query("DELETE FROM inventory WHERE inv_itemid={$_POST['item']}");
$conn->query("DELETE FROM itemmarket WHERE imITEM={$_POST['item']}");

print "<div class='success-msg'>The {$itemi['itmname']} Item was removed from the game</div>";
stafflog_add("Deleted Item {$itemi['itmname']} [{$_POST['item']}]");
kill_item_form();
}
}








function viewitemtypeform()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>View Items in Item Type</h3>
<div class='infostaff'>You can view all the items within the selected item type.</div>
		<br />
		<br />
<form action='staff_items.php?action=viewitemtype' method='post'>
Item Type: ".itemtype_dropdown($c,'itemtype')."<br />
<input type='submit' value='Views Item Type' /></form>";
}
function viewitemtype()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['itemtype'] = $conn->real_escape_string($_POST['itemtype']);
$q=$conn->query("SELECT itmtypeid FROM itemtypes WHERE itmtypeid='{$_POST['itemtype']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, item type doesnt exist</div>";
viewitemtypeform();
}
elseif(empty($_POST['itemtype']))
{
    print "<div class='error-msg'>Sorry, item type field is empty</div>";
viewitemtypeform();
}
else {
$_POST['itemtype'] = $conn->real_escape_string($_POST['itemtype']);
$d=$conn->query("SELECT * FROM items WHERE itmtype={$_POST['itemtype']} ORDER BY itmid ASC");
$d1=$conn->query("SELECT itmtypename, itmtypeid FROM itemtypes WHERE itmtypeid={$_POST['itemtype']}");
$r1=$d1->fetch_assoc();
echo"

<h3>Viewing all Items in Item Type: {$r1['itmtypename']} [{$_POST['itemtype']}]</h3>
<table class='table' width='100%'>
 <tr>
 <th>Item ID</th>
 <th>Item Name</th>
 <th>Buy Price</th>
 <th>Sell Price</th>
 <th>Buyable</th>
 <th>Armor</th>
 <th>Weapon</th>
 </tr>";
while($r=$d->fetch_assoc())
{
 echo"
 <tr>
 <td>".$r['itmid']."</td>
 <td>".$r['itmname']."</td>
 <td>".money_formatter($r['itmbuyprice'])."</td>
 <td>".money_formatter($r['itmsellprice'])."</td>
 <td>";
 if($r['itmbuyable'] > 0) {
  echo "<font color=green><b>&check;</b></font>";
}else{
  echo "<font color=red><b>X</b></font>";
}
 echo"</td><td>";
  if($r['armor'] > 0) {
  echo "<font color=green><b>&check;</b></font>";
}else{
  echo "<font color=red><b>X</b></font>";
}
 echo"</td><td>";
  if($r['weapon'] > 0) {
  echo "<font color=green><b>&check;</b></font>";
}else{
  echo "<font color=red><b>X</b></font>";
}
  echo "</td></tr>";
}
echo"
 </table>";

stafflog_add("Viewed Items in Item Type {$r1['itmtypename']} [{$_POST['itemtype']}]");

}
}

















function viewitemuserform()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>View Users with Item</h3>
<div class='infostaff'>This will display all users that have this specific item in their inventory.</div>
		<br />
		<br />
<form action='staff_items.php?action=viewitemuser' method='post'>
Item: ".item_dropdown($c,'itemtype')."<br />
<input type='submit' value='Views Users' /></form>";
}
function viewitemuser()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['itemtype'] = $conn->real_escape_string($_POST['itemtype']);
$q=$conn->query("SELECT itmid FROM items WHERE itmid='{$_POST['itemtype']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, item doesnt exist</div>";
viewitemuserform();
}
elseif(empty($_POST['itemtype']))
{
    print "<div class='error-msg'>Sorry, item field is empty</div>";
viewitemuserform();
}
else {
$_POST['itemtype'] = $conn->real_escape_string($_POST['itemtype']);
$d=$conn->query("SELECT itmid, itmname FROM items WHERE itmid={$_POST['itemtype']}");
$item=$d->fetch_assoc();

 $query = $conn->query("SELECT
    inv_itemid, inv_userid, inv_qty,
    count( distinct(inv_userid) ) users,
    sum( inv_qty ) total
FROM
    inventory
WHERE
    inv_itemid = {$_POST['itemtype']}
GROUP BY
    inv_itemid");
$r=$query->fetch_assoc();

echo"<h3>Checking for users with the item: {$item['itmname']} [{$_POST['itemtype']}]</h3>
<br />Users found with this item: ".number_format($r['users'])."
<br /><Br />Qty of this item owned by users: ".number_format($r['total'])."";

$p=$conn->query("SELECT *, sum(inv_qty) total FROM inventory INNER JOIN users ON inv_userid=userid WHERE inv_itemid={$_POST['itemtype']} GROUP BY inv_userid");

echo"
<table class='table' width='100%'>
 <tr>
 <th>User</th>
 <th>Qty Owned</th>
 </tr>";
while($r1=$p->fetch_assoc())
{
 echo"
 <tr>
 <td>".$r1['username']." [".$r1['userid']."]</td>
 <td>".$r1['total']."</td>
 </tr>";
}
echo"
 </table>";


stafflog_add("Viewed users with: {$item['itmname']} [{$_POST['itemtype']}]");

}
}







function edit_item_begin()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Editing Item</h3>
<div class='infostaff'>You can edit every aspect of the item here.</div>
		<br />
		<br />
<form action='staff_items.php?action=edititemform' method='post'>
Item: ".item_dropdown($c,'item')."<br />
<input type='submit' value='Edit Item' /></form>";
}
function edit_item_form()
{
global $conn,$ir,$c,$h;
if($ir['user_level'] != 2)
{
die("403");
}

$_POST['item'] = $conn->real_escape_string($_POST['item']);
$qq=$conn->query("SELECT itmid, itmname FROM items WHERE itmid ='{$_POST['item']}'");
if(mysqli_num_rows($qq) == 0)
{
print "<div class='error-msg'>This item does not exist</div>";
edit_item_begin();
}
elseif(empty($_POST['item']))
{
   print"<div class='error-msg'>You need to select an item</div>";
   edit_item_begin();
   }
   else{
$d=$conn->query("SELECT * FROM items WHERE itmid={$_POST['item']}");
$itemi=$d->fetch_assoc();
print "<h3>Editing Item</h3>
<form action='staff_items.php?action=edititemsub' method='post'>
<input type='hidden' name='itmid' value='{$_POST['item']}' />
Item Name: <input type='text' name='itmname' value='{$itemi['itmname']}' /><br />
Item Desc.: <input type='text' name='itmdesc' value='{$itemi['itmdesc']}' /><br />
Item Type: ".itemtype_dropdown($c,'itmtype',$itemi['itmtype'])."<br />
Item Buyable: <input type='checkbox' name='itmbuyable'";
if ($itemi['itmbuyable']) { print " checked='checked'"; }
print " /><br />Item Price: <input type='number' name='itmbuyprice' value='{$itemi['itmbuyprice']}' /><br />
Item Sell Value: <input type='number' name='itmsellprice' value='{$itemi['itmsellprice']}' /><b>Usage Form</b>";
$stats=array(
"maxenergy" => "Max Energy",
"gradientdays" => "Gradient Days",
"credits" => "Credits",
"energy" => "Energy",
"will" => "Will",
"brave" => "Brave",
"maxbrave" => "Max Brave",
"hp" => "Health",
"maxhp" => "Max Health",
"strength" => "Strength",
"agility" => "Agility",
"guard" => "Guard",
"labour" => "Labour",
"IQ" => "IQ",
"hospital" => "Hospital Time",
"jail" => "Jail Time",
"money" => "Money",
"level" => "Level",
"crystals" => "Crystals",
"cdays" => "Education Days Left",
"bankmoney" => "Bank money",
"vip" => "Vip Days",
"protected" => "Protected");
for($i=1;$i<=3;$i++)
{
  if($itemi["effect".$i])
  {
    $efx=unserialize($itemi["effect".$i]);
  }
  else
  {
    $efx=array("inc_amount" => 0);
  }
  $switch1=($itemi['effect'.$i.'_on'] > 0) ? " checked='checked'" : "";
  $switch2=($itemi['effect'.$i.'_on'] > 0) ? "" : " checked='checked'";
  print "<b><u>Effect {$i}</u></b><br />
On? <input type='radio' name='effect{$i}on' value='1'$switch1 /> Yes <input type='radio' name='effect{$i}on' value='0'$switch2 /> No<br />
Stat: <select name='effect{$i}stat' type='dropdown'>";
  foreach($stats as $k => $v)
  {
    if($k==$efx['stat'])
    {
      print "<option value='{$k}' selected='selected'>{$v}</option>\n";
    }
    else
    {
      print "<option value='$k'>{$v}</option>\n";
    }
  }
  if($efx['dir']=="neg")
  {
    $str="<option value='pos'>Increase</option><option value='neg' selected='selected'>Decrease</option>";
  }
  else
  {
    $str="<option value='pos' selected='selected'>Increase</option><option value='neg'>Decrease</option>";
  }
  if($efx['inc_type']=="percent")
  {
    $str2="<option value='figure'>Value</option><option value='percent' selected='selected'>Percent</option>";
  }
  else
  {
    $str2="<option value='figure' selected='selected'>Value</option><option value='percent'>Percent</option>";
  }
  print "</select> Direction: <select name='effect{$i}dir' type='dropdown'>{$str}
  </select><br />
  Amount: <input type='number' name='effect{$i}amount' value='{$efx['inc_amount']}' /> <select name='effect{$i}type' type='dropdown'>{$str2}</select>";
}

print "<b>Combat Usage</b><br />
Weapon Power: <input type='number' name='weapon' value='{$itemi['weapon']}' /><br />
Armor Defense: <input type='number' name='armor' value='{$itemi['armor']}' />
<input type='submit' value='Edit Item' /></form>";
}
}
function edit_item_sub()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
$itmname=$conn->real_escape_string($_POST['itmname']);
$itmdesc=$conn->real_escape_string($_POST['itmdesc']);
$_POST['itmid']=$conn->real_escape_string($_POST['itmid']);
$q=$conn->query("SELECT itmid, itmname FROM items WHERE itmname='{$_POST['itmname']}' AND itmid !='{$_POST['itmid']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>This item name already exist</div>";
edit_item_begin();
}
elseif(empty($_POST['itmname']) || empty($_POST['itmdesc']))
{
print "<div class='error-msg'>You missed one or more of the fields</div>";
edit_item_begin();
}
else
{
$_POST['itmid']=$conn->real_escape_string($_POST['itmid']);
$itmname=$conn->real_escape_string($_POST['itmname']);
$itmdesc=$conn->real_escape_string($_POST['itmdesc']);
$_POST['itmtype'] = $conn->real_escape_string($_POST['itmtype']);
$_POST['itmtype'] = $conn->real_escape_string($_POST['itmtype']);
$_POST['itmbuyprice'] = $conn->real_escape_string($_POST['itmbuyprice']);
$_POST['itmsellprice'] = $conn->real_escape_string($_POST['itmsellprice']);
$weapon=abs((int) $_POST['weapon']);
$armor=abs((int) $_POST['armor']);
if($_POST['itmbuyable'] == 'on') { $itmbuy=1; } else { $itmbuy=0; }
$conn->query("DELETE FROM items WHERE itmid={$_POST['itmid']}",$c);
$efx1=$conn->real_escape_string(serialize(array("stat" => $_POST['effect1stat'], "dir" => $_POST['effect1dir'], "inc_type" => $_POST['effect1type'], "inc_amount" => abs((int) $_POST['effect1amount']))));
$efx2=$conn->real_escape_string(serialize(array("stat" => $_POST['effect2stat'], "dir" => $_POST['effect2dir'], "inc_type" => $_POST['effect2type'], "inc_amount" => abs((int) $_POST['effect2amount']))));
$efx3=$conn->real_escape_string(serialize(array("stat" => $_POST['effect3stat'], "dir" => $_POST['effect3dir'], "inc_type" => $_POST['effect3type'], "inc_amount" => abs((int) $_POST['effect3amount']))));
$conn->query("INSERT INTO items VALUES('{$_POST['itmid']}',{$_POST['itmtype']},'$itmname','$itmdesc',{$_POST['itmbuyprice']},{$_POST['itmsellprice']},$itmbuy, '{$_POST['effect1on']}', '$efx1', '{$_POST['effect2on']}', '$efx2', '{$_POST['effect3on']}', '$efx3', $weapon, $armor)");
print "<div class='success-msg'>The {$_POST['itmname']} Item was edited successfully</div>";
stafflog_add("Edited Item {$_POST['itmname']} [{$_POST['itmid']}]");
edit_item_begin();
}
}

function newitemtype()
{
global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}

$_POST['name'] = $conn->real_escape_string($_POST['name']);
$q=$conn->query("SELECT itmtypename FROM itemtypes WHERE itmtypename='{$_POST['name']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>This item type already exist</div>";
newitemtypeform();
}
elseif(empty($_POST['name']))
{
   print"<div class='error-msg'>You need to enter a item type name</div>";
   newitemtypeform();
   }
   else
{
    
$_POST['name'] = $conn->real_escape_string($_POST['name']);
$conn->query("INSERT INTO itemtypes (itmtypename) VALUES('{$_POST['name']}')");
$i=$conn->insert_id;
print "<div class='success-msg'>Item Type {$_POST['name']} added</div>";
stafflog_add("Added Item Type [{$_POST['name']}] [$i]");
newitemtypeform();
}
}
function newitemtypeform()
{
print "<h3>Add Item Type</h3>
<div class='infostaff'>Create a new item group or type using the form below.</div>
		<br />
		<br />
<form action='staff_items.php?action=newitemtype' method='post'>
Name: <input type='text' name='name' /><br />
<input type='submit' name='submit' value='Add Item Type' /></form>";
}
function edititemtypeform()
{
print "<h3>Delete Item Type</h3>
<div class='infostaff'>Delete every aspect of the item group or type using the form below.</div>
		<br />
		<br />
<form action='staff_items.php?action=edititemtype' method='post'>
Item Type: ".itemtype_dropdown($c,'itemtype')." <br />
<input type='submit' name='submit' value='Delete Item Type' /></form>";
}
function edititemtype()
{
    global $conn,$ir,$c,$h,$userid;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['itemtype'] = $conn->real_escape_string($_POST['itemtype']);
$q=$conn->query("SELECT itmtypeid FROM itemtypes WHERE itmtypeid='{$_POST['itemtype']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, item type doesnt exist</div>";
edititemtypeform();
}
elseif(empty($_POST['itemtype']))
{
    print "<div class='error-msg'>Sorry, item type field is empty</div>";
edititemtypeform();
}
else {
$_POST['itemtype'] = $conn->real_escape_string($_POST['itemtype']);
$d=$conn->query("SELECT * FROM itemtypes WHERE itmtypeid={$_POST['itemtype']}");
$itemi=$d->fetch_assoc();
$conn->query("UPDATE items SET itmtype=0 WHERE itmtype={$_POST['itemtype']}");

$conn->query("DELETE FROM itemtypes WHERE itmtypeid={$_POST['itemtype']}");

print "<div class='success-msg'>The {$itemi['itmtypename']} Item type was removed from the game and the items in this group have been set to default group.</div>";
stafflog_add("Deleted Item Type {$itemi['itmtypename']} [{$_POST['itemtype']}]");
edititemtypeform();
}
}


function mass_give_item()
{
global $conn,$ir,$c;
print "<h3>Giving Item To All Users</h3>
<div class='infostaff'>You can give items to every active user in the game.</div>
		<br />
		<br />
<form action='staff_items.php?action=massitemgivesub' method='post'>
Item: ".item_dropdown($c,'item')." <br />
Quantity: <input type='number' name='qty' value='1' />
<input type='submit' value='Mass Send' /></form>";
}
function mass_give_item_sub()
{
global $conn,$ir,$c; 

$_POST['item'] = $conn->real_escape_string($_POST['item']);
$_POST['qty'] = $conn->real_escape_string($_POST['qty']);
$_POST['qty'] = abs((int) $_POST['qty']);

$q=$conn->query("SELECT itmid FROM items WHERE itmid='{$_POST['item']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, item doesnt exist</div>";
mass_give_item();
}
elseif(empty($_POST['item']) || empty($_POST['qty']))
{
    print"<div class='error-msg'>You need to select or fill in all fields</div>";
    mass_give_item();
}

else{
$q=$conn->query("SELECT userid, fedjail FROM users WHERE fedjail=0",$c);
while($r=$q->fetch_assoc())
{
$week = time() - (60*60*24*7);
if($r['laston'] > $week)
{
$_POST['item'] = $conn->real_escape_string($_POST['item']);
$_POST['qty'] = $conn->real_escape_string($_POST['qty']);
$_POST['qty'] = abs((int) $_POST['qty']);
$conn->query("INSERT INTO inventory (inv_itemid, inv_userid, inv_qty) VALUES({$_POST['item']},{$r['userid']},{$_POST['qty']})",$c) or
die(mysqli_error());
event_add($r['userid'],"All active users were given an item $itemname, Click <a href='inventory.php'>Here</a> to check.",$c);
print "<div class='success-msg'>Item Sent To {$r['username']}</div>";
}
}
stafflog_add("Gave ".number_format($_POST['qty'])." of item ID [{$_POST['item']}] to all active users");
print "<font color=blue>Mass item sending complete!</br></font>";
}
}
$h->endpage();
?>