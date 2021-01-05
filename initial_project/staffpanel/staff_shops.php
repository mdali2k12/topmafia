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
case 'newshop': new_shop_form(); return;
case 'newshopsub': new_shop_submit(); return;
case 'newstock': new_stock_form(); return;
case 'newstocksub': new_stock_submit(); return;
case 'delshop': delshop(); return;
case 'editshop': edit_shop_form(); return;
case 'editshopsub': edit_shop_submit(); return;
case 'editshopsub2': edit_shop_confirm(); return;
case 'del_shop_form': delshopform(); return;
case 'shopitems': view_shop_form(); return;
case 'shop_items': view_items(); return;
case 'sitemdelete': del_items(); return;
default: print "Error: This script requires an action."; return;
}
function new_shop_form()
{
global $conn,$ir,$c,$h;
print "<h3>Adding a New Shop</h3>
<div class='infostaff'>You can add shops to any location within the game.</div>
		<br />
		<br />
<form action='staff_shops.php?action=newshopsub' method='post'>
Shop Name: <input type='text' name='sn' value='' /><br />
Shop Desc: <input type='text' name='sd' value='' /><br />
Shop Location: ".location_dropdown($c,"sl")."<br />
<input type='submit' value='Create Shop' /></form>";
}

function new_shop_submit()
{
global $conn,$ir,$c,$h;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['sl'] = $conn->real_escape_string($_POST['sl']);
$sn = $conn->real_escape_string($_POST['sn']);
$sd = $conn->real_escape_string($_POST['sd']);

$q=$conn->query("SELECT shopID, shopNAME FROM shops WHERE shopNAME='{$_POST['sn']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two shops with the same name</div>";
new_shop_form();
}
elseif(empty($_POST['sn']) || empty($_POST['sd']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
new_shop_form();
}
else
{
    
$_POST['sl'] = $conn->real_escape_string($_POST['sl']);
$sn = $conn->real_escape_string($_POST['sn']);
$sd = $conn->real_escape_string($_POST['sd']);
$conn->query("INSERT INTO shops (shopLOCATION, shopNAME, shopDESCRIPTION) VALUES({$_POST['sl']},'$sn','$sd')");

$i=$conn->insert_id;
print "<div class='success-msg'>The $sn shop was successfully added to the game</div>";
stafflog_add("Added Shop $sn [$i] to city ID [{$_POST['sl']}] ");
new_shop_form();
}
}
function new_stock_form()
{
global $conn,$ir,$c,$h;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Adding an item to a shop</h3>
<div class='infostaff'>Add items from the selectable options to be added to a shop in game.</div>
		<br />
		<br />
<form action='staff_shops.php?action=newstocksub' method='post'>
Shop: ".shop_dropdown($c,"shop")."<br />
Item: ".item_dropdown($c,"item")."<br />
<input type='submit' value='Add Item To Shop' /></form>";
}
function new_stock_submit()
{
global $conn,$ir,$c,$h;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['shop'] = $conn->real_escape_string($_POST['shop']);
$_POST['item'] = $conn->real_escape_string($_POST['item']);
$q=$conn->query("SELECT sitemITEMID, sitemSHOP FROM shopitems WHERE sitemITEMID = '{$_POST['item']}' AND sitemSHOP='{$_POST['shop']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, this item already exist in this shop</div>";
new_stock_form();
}
elseif(empty($_POST['shop']) || empty($_POST['item']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
new_stock_form();
}
else
{
$conn->query("INSERT INTO shopitems (sitemSHOP, sitemITEMID) VALUES({$_POST['shop']},{$_POST['item']})");
print "<div class='success-msg'>Item ID {$_POST['item']} was successfully added to shop ID {$_POST['shop']}</div>";
stafflog_add("Added Item ID [{$_POST['item']}] to shop ID [{$_POST['shop']}]");
new_stock_form();
}
}
function delshop()
{
global $conn, $ir, $c, $h;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['shop'] = $conn->real_escape_string($_POST['shop']);

$q=$conn->query("SELECT shopID FROM shops WHERE shopID='{$_POST['shop']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, shop doesnt exist</div>";
delshopform();
}
else
{
$_POST['shop'] = $conn->real_escape_string($_POST['shop']);
$snm=$conn->query("SELECT shopNAME FROM shops WHERE shopID={$_POST['shop']}");
$sn = $snm->fetch_row();
$conn->query("DELETE FROM shops WHERE shopID={$_POST['shop']}");
$conn->query("DELETE FROM shopitems WHERE sitemSHOP={$_POST['shop']}");
print "<div class='success-msg'>Shop $sn[0] Deleted</div>";
stafflog_add("Deleted Shop $sn[0] [{$_POST['shop']}]");
delshopform();
}
}
function delshopform()
{
global $conn,$ir,$c,$h;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Delete Shop</h3>
<div class='infostaff'>This will delete the shop and items within the shop.</div>
		<br />
		<br />
		<form action='staff_shops.php?action=delshop' method='post'>
Shop: ".shop_dropdown($c, "shop")."<br />
<input type='submit' value='Delete Shop' /></form>";


}




function view_shop_form()
{
global $conn,$ir,$c,$h;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Shop Items</h3>
<div class='infostaff'>You can view a record of items of a selected shop.</div>
		<br />
		<br />
<form action='staff_shops.php?action=shop_items' method='post'>
Shop: ".shop_dropdown($c, "shopid")."<br />
<input type='submit' value='View Items' /></form>";
}

function view_items()
{
global $conn,$ir,$c,$h;
if($ir['user_level'] != 2)
{
die("403");
}

$_POST['shopid'] = $conn->real_escape_string($_POST['shopid']);
if(empty($_POST['shopid']))
{
print "<div class='error-msg'>You need to select a shop</div>";
view_shop_form();
}
else{
$_POST['shopid'] = $conn->real_escape_string($_POST['shopid']);
$oq=$conn->query("SELECT shopNAME, shopID FROM shops WHERE shopID='{$_POST['shopid']}'");
$rm=$oq->fetch_assoc();
print "<h3>{$rm['shopNAME']} Items</h3>";
	print "
		<table width='100%' cellspacing='1' class='table'>
		<tr>
		<th>Item Name</th>
		<th>Type</th>
		<th>Price</th>
		<th></th>
		</tr>";
		$q=$conn->query("
		SELECT
    s.*,
    i.*,
    it.*,
    si.* 
FROM
    shops s
    LEFT JOIN shopitems si ON s.shopID = si.sitemSHOP
    JOIN items i ON i.itmid = si.sitemITEMID 
    JOIN itemtypes it ON i.itmtype = it.itmtypeid
WHERE
    s.shopID = {$_POST['shopid']}");
    
		while($r=$q->fetch_assoc()){
			print "<tr><td>{$r['itmname']} [{$r['itmid']}]</td> <td>{$r['itmtypename']}</td> <td>".money_formatter($r['itmbuyprice'])."</td><td><a href='staff_shops.php?action=sitemdelete&ID={$r['sitemID']}&shopid={$_POST['shopid']}&itemid={$r['itmid']}'>Delete</a></td></tr>";
		}
		print "</table>";
    
}
}



function del_items()
{
global $conn,$ir, $userid,  $c;
if($ir['user_level'] != 2)
{
die("403");
}
$_GET['ID'] = $conn->real_escape_string($_GET['ID']);
$_GET['itemid'] = $conn->real_escape_string($_GET['itemid']);
$_GET['shopid'] = $conn->real_escape_string($_GET['shopid']);
$q1=$conn->query("SELECT sitemID FROM shopitems WHERE sitemID={$_GET['ID']}");
if(!mysqli_num_rows($q1))
{
$_GET['ID']=0;
print"<div class='error-msg'>Shop Item ID doesn't exist!</div>";
view_shop_form();
}
else{
$_GET['shopid'] = $conn->real_escape_string($_GET['shopid']);
$_GET['ID'] = $conn->real_escape_string($_GET['ID']);
$_GET['itemid'] = $conn->real_escape_string($_GET['itemid']);
$oq=$conn->query("SELECT shopNAME, shopID FROM shops WHERE shopID='{$_GET['shopid']}'");
$rm=$oq->fetch_assoc();
$conn->query("DELETE FROM shopitems WHERE sitemID={$_GET['ID']}");
print "<div class='success-msg'>You have successfully deleted this item from {$rm['shopNAME']} shop</div>";
stafflog_add("Deleted a item ID [{$_GET['itemid']}] from {$rm['shopNAME']} shop");

view_shop_form();
}
}

function edit_shop_form()
{
global $conn,$ir,$c,$h;
if($ir['user_level'] != 2)
{
die("403");
}
print "<h3>Edit Shop</h3>
<div class='infostaff'>You can edit all aspects of the shop.</div>
		<br />
		<br />
<form action='staff_shops.php?action=editshopsub' method='post'>
Shop: ".shop_dropdown($c, "shopid")."<br />
<input type='submit' value='Edit Shop' /></form>";


}




function edit_shop_submit()
{
global $conn,$ir,$c,$h;
if($ir['user_level'] != 2)
{
die("403");
}

$_POST['shopid'] = $conn->real_escape_string($_POST['shopid']);
$q=$conn->query("SELECT shopID FROM shops WHERE shopID='{$_POST['shopid']}'");
if(mysqli_num_rows($q) == 0)
{
print "<div class='error-msg'>Sorry, shop doesnt exist</div>";
edit_shop_form();
}
else{
$_POST['shopid'] = $conn->real_escape_string($_POST['shopid']);
$q=$conn->query("SELECT s.*, l.* FROM shops AS s LEFT JOIN cities l ON s.shopLOCATION=l.cityid WHERE shopID={$_POST['shopid']}");
$old=$q->fetch_assoc();
print "<h3>Editing Shop</h3>
<form action='staff_shops.php?action=editshopsub2' method='post'>
<input type='hidden' name='shopid' value='{$_POST['shopid']}'>
Shop Name: <input type='text' name='sn' value='{$old['shopNAME']}' /><br />
Shop Description: <input type='text' name='sd' value='{$old['shopDESCRIPTION']}' /><br />
Current Location: {$old['cityname']}<br /> 

Shop Location: ".location_dropdown($c,"sl")."<br />

<input type='submit' value='Edit Shop' /></form>";
}
}



function edit_shop_confirm()
{
global $conn,$ir,$c,$h;
if($ir['user_level'] != 2)
{
die("403");
}
$_POST['sl'] = $conn->real_escape_string($_POST['sl']);
$_POST['sn'] = $conn->real_escape_string($_POST['sn']);
$_POST['sd'] = $conn->real_escape_string($_POST['sd']);
$_POST['shopid'] = $conn->real_escape_string($_POST['shopid']);

$q=$conn->query("SELECT shopNAME, shopID FROM shops WHERE shopNAME='{$_POST['sn']}' AND shopID !='{$_POST['shopid']}'");
if(mysqli_num_rows($q))
{
print "<div class='error-msg'>Sorry, you cannot have two shops with the same name</div>";
edit_shop_form();
}
elseif(empty($_POST['sn']) || empty($_POST['sd']))
{
print "<div class='error-msg'>You need to fill in all fields</div>";
edit_shop_form();
}
else{
    
$sl = $conn->real_escape_string($_POST['sl']);
$sn = $conn->real_escape_string($_POST['sn']);
$sd = $conn->real_escape_string($_POST['sd']);
$_POST['shopid'] = $conn->real_escape_string($_POST['shopid']);
$conn->query("UPDATE shops SET shopNAME='$sn', shopDESCRIPTION='$sd', shopLOCATION='$sl' WHERE shopID='{$_POST['shopid']}'");
print "<div class='success-msg'>Shop $sn was edited successfully</div>";
stafflog_add("Edited shop $sn [{$_POST['shopid']}]");
edit_shop_form();
}
}



function report_clear()
{
global $conn,$conn,$ir,$c,$h,$userid;
if($ir['user_level'] < 2)
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