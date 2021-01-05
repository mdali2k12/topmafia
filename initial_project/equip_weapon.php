<?php
include "globals.php";
$_GET['ID'] = abs((int) $_GET['ID']);
$id=$db->query("SELECT iv.*,it.* FROM inventory iv LEFT JOIN items it ON iv.inv_itemid=it.itmid WHERE iv.inv_id={$_GET['ID']} AND iv.inv_userid=$userid LIMIT 1");
if($db->num_rows($id)==0)
{
print "Invalid item ID";
$h->endpage();
exit;
}
else
{
$r=$db->fetch_row($id);
}
if(!$r['weapon'])
{
print "This item cannot be equipped to this slot.";
$h->endpage();
exit;
}
if($_GET['type'])
{
if(!in_array($_GET['type'], array("equip_primary", "equip_secondary")))
{
print "This slot ID is not valid.";
$h->endpage();
exit;
}
if($ir[$_GET['type']])
{
item_add($userid, $ir[$_GET['type']], 1);
}
item_remove($userid, $r['itmid'], 1);
$db->query("UPDATE users SET {$_GET['type']} = {$r['itmid']} WHERE userid={$userid}");
print "Item {$r['itmname']} equipped successfully.<br/><a href='inventory.php' data-role='button'>Back</a>";
}
else
{
print "
<h3>Equip Weapon</h3>
<p>Please choose the slot to equip {$r['itmname']} to, if there is already a weapon in that slot, it will be replaced and current one sent back to your inventory:</p>
<form action='equip_weapon.php' method='get'>
<input type='hidden' name='ID' value='{$_GET['ID']}' />
  <div data-role='fieldcontain'>
    <fieldset data-role='controlgroup'>
      <input type='radio' name='type' id='radio-choice-1' value='equip_primary' />
      <label for='radio-choice-1'>Primary</label>
      <input type='radio' name='type' id='radio-choice-2' value='equip_secondary'  />
	  <label for='radio-choice-2'>Secondary</label>
    </fieldset>
  </div>
  <input type='submit' value='Equip'/>
</form>
";
}
$h->endpage();
?>