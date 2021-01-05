<?php

include_once('sglobals.php');
if($ir['user_level'] != 2)
{
die("403");
}
/* Start Copy Right Notice! */
/*
    # You do not re-distribute my files.
    # You do not claim this as your work.
    # You do not ask for money to other people for my work.
    # This is free not paid.
    # Leaving the copyright is a must (i know alot of you will just take it down :/)
    # All the work under this file is by written consent kyle mulder's and shall be in tact at all times!
    # A description of this file is bellow:
     
    This is a stock market, a working one, a non buggy one, a non exploitable one, a better one, more feature.
    Users can buy stocks and every 5 minutes the stock rate will change (like real life).
    Gives the users something to do.
    The stocks can crash every 5 minutes making everyone loose there investment and there cash.
    There will be a .15% that a stock can crash, more likely to happen quite often, but not all the time.
    If there is a possibility that a stock can crash every 5 minute's. That makes it:
        # 5 minutes => 1 Crash
        # 1 Hour    => 12 Crashes
        # 1 Day     => 288 Crashes
    The above is possibilites, does not mean it WILL always happen.
     
    Anyways lets get on with the file <img src="images/smilies/smile.png" border="0" alt="" title="Smile" class="inlineimg" />
*/
/* End Copy Right Notice! */
 
$_GET['action'] = $conn->real_escape_string($_GET['action']);
$x = (!empty($_GET['action']) && ctype_alnum($_GET['action'])) ? trim($_GET['action']) : FALSE;
switch($x)  {
    default: echo 'Need an action dude.. I need a freaking action, do you want me to die here!'; return;
    case 'add': add_stock(); return;
    case 'addform': add_stockform(); return;
    case 'del': delete_stock(); return;
    case 'edit': edit_stocks(); return;
    case 'editn': edit_stock(); return;
    case 'view': view_stock(); return;
    case 'holders': holder_view(); return;
    case 'stockholders': holder_view2(); return;
}


function holder_view()
{
global $conn,$ir, $userid,  $c;
	if($ir['user_level'] != 2){
		die("403");
	}
$qqq=$conn->query("SELECT * FROM stock_holdings");
if(!mysqli_num_rows($qqq))
{
print"<div class='error-msg'>No share holders found!</div>";
}
else{
print "<h3>Share Holders</h3>
<div class='infostaff'>Below is a record of all users who currently own a share in stocks.</div>
		<br />
		<br />
<form action='staff_stocks.php?action=stockholders' method='post'>
<table border='1' width='50%'>
<tr>
<td align='right'>Share Holder:</td> <td align='left'>".stock_dropdown($c,'user')."</td>
</tr>
<tr>
<td align='center' colspan='2'> <input type='submit' value='View' /> </td>
</tr> </table>
</form>";
}
}



function holder_view2()
{
global $conn,$ir, $userid,  $c;
	if($ir['user_level'] != 2){
		die("403");
	}
$gang = abs( $_POST['user'] );
$qqq=$conn->query("SELECT holdingUSER FROM stock_holdings WHERE holdingUSER = $gang");
if(!mysqli_num_rows($qqq))
{
$_POST['user']=0;
print"<div class='error-msg'>Share holder doesn't exist!</div>";
holder_view();
}
else {
  $query = $conn->query("SELECT
    stockNAME, holdingSTOCK, holdingQTY, stockOPRICE, stockNPRICE,
--     count( distinct(holdingUser) ) users,
    
    sum( holdingQTY ) soldcount,
    sum( holdingQTY ) * ss.stockOPRICE total,
    sum( holdingQTY ) * ss.stockNPRICE new_total,
    sum( holdingQTY ) * ( ss.stockNPRICE - ss.stockOPRICE ) profit 
FROM
    stock_holdings sh
    INNER JOIN stock_stocks ss ON ss.stockID = sh.holdingSTOCK 
WHERE
    holdingUSER = $gang
GROUP BY
    holdingSTOCK");
    
    $qqqq=$conn->query("SELECT userid, username FROM users WHERE userid = $gang");
    $user = $qqqq->fetch_assoc();
    
echo"

<h3>{$user['username']} [{$user['userid']}] Stock Profile</h3>
 
<div class='info-msg'>PS = Per share</div><br />
<table class='table' width='100%'>
 <tr>
 <th>Stock</th>
 <th>Shares Held</th>
 <th>Original</th>
 <th>Change</th>
 <th>Profit/Loss </th>
 </tr>";
while($r=$query->fetch_assoc())
{
 echo"
 <tr>
 <td>".$r['stockNAME']."</td>
 <td>".number_format($r['soldcount'])."</td>
 <td><font color=blue>".money_formatter($r['stockOPRICE'])." PS</font><br />
 ".money_formatter($r['total'])." Total</td>
 <td><font color=blue>".money_formatter($r['stockNPRICE'])." PS</font><br />
 ".money_formatter($r['new_total'])." Total</td>
 <td>";
 if($r['profit'] > 0) {
  echo "<font color=green>+ 
 ".money_formatter($r['profit'])."</font>";
}else{
  echo "<font color=red>- 
 ".money_formatter($r['profit'])."</font>";
}
 echo"</td>
 </tr>";
}
echo"
 </table>";


print"
<h3>Stock History</h3>
		<table width='100%' cellspacing='1' class='table'>
		<tr>
		<th>Action</th>
		<th>Time</th>
		</tr>";
		$q=$conn->query("SELECT s.*, u.* FROM stock_records AS s LEFT JOIN users AS u ON s.recordUSER=u.userid WHERE s.recordUSER = $gang ORDER BY s.recordTIME DESC LIMIT 25");
		
		while($r=$q->fetch_assoc()){
			print "<tr><td>{$r['recordTEXT']}</td> <td>".date('F j Y g:i:s a', $r['recordTIME'])."</td></tr>";
		}
		print "</table>";
}

}



























function view_stock()  {
    global $ir,$h, $conn;
    	if($ir['user_level'] != 2){
		die("403");
	}
    $query = $conn->query("SELECT
    stockNAME, stockOPRICE, holdingQTY, stockNPRICE,
    count( distinct(holdingUSER) ) users,
    holdingSTOCK,
    sum( holdingQTY ) soldcount,
    sum( holdingQTY ) * ss.stockOPRICE total,
    sum( holdingQTY ) * ss.stockNPRICE new_total,
    sum( holdingQTY ) * ( ss.stockNPRICE - ss.stockOPRICE ) profit 
FROM
    stock_holdings sh
    INNER JOIN stock_stocks ss ON ss.stockID = sh.holdingSTOCK 
GROUP BY
    holdingSTOCK");
    
echo"

<h3>View Stock</h3>
 <div class='infostaff'>Below is a full record of all the stock shares sold in the game. *PS = Per Share</div>
		<br />
		<br />
<table class='table' width='100%'>
 <tr>
 <th>Stock</th>
 <th>Share Holders</th>
 <th>Shares Sold</th>
 <th>Original</th>
 <th>Change</th>
 <th>Profit/Loss </th>
 </tr>";
while($r=$query->fetch_assoc())
{
 echo"
 <tr>
 <td>".$r['stockNAME']."</td>
 <td>".number_format($r['users'])."</td>
 <td>".number_format($r['soldcount'])."</td>
 <td><font color=blue>".money_formatter($r['stockOPRICE'])." PS</font><br />
 ".money_formatter($r['total'])." Total</td>
 <td><font color=blue>".money_formatter($r['stockNPRICE'])." PS</font><br />
 ".money_formatter($r['new_total'])." Total</td>
 <td>";
 if($r['profit'] > 0) {
  echo "<font color=green>+ 
 ".money_formatter($r['profit'])."</font>";
}else{
  echo "<font color=red>- 
 ".money_formatter($r['profit'])."</font>";
}
 echo"</td>
 </tr>";
}
echo"
 </table>";
}


function edit_stocks()  {
    global $ir,$h, $conn;
    	if($ir['user_level'] != 2){
		die("403");
	}
    echo '
    
<h3>Edit Stock</h3>
 <div class="infostaff">You can edit every aspect of the stock below.</div>
		<br />
		<br />
    <form action="'.$_SERVER['PHP_SELF'].'?action=editn" method="post">';
        print"Select stock to edit: 
        ".stock_down($c, 'ID')."
        ";
         echo '
         <br />
<input type="submit" value="Edit Stock" />
    </form>';
}
function edit_stock()   {
    global $ir,$h, $conn;
    	if($ir['user_level'] != 2){
		die("403");
	}
    $ID = abs(@intval($_REQUEST['ID']));
    $stre = $conn->query("SELECT stockID,stockNAME,stockOPRICE,stockNPRICE FROM `stock_stocks` WHERE `stockID` = ".$ID) or die(mysqli_error());
    if(mysqli_num_rows($stre) == 0)  {
        echo '<div class="error-msg">Invalid Stock!</div>';
        edit_stocks();
    }
   $u=$conn->query("SELECT * FROM stock_stocks WHERE stockNAME='{$_POST['name']}' AND stockID!='$ID'");
if(mysqli_num_rows($u) != 0)
{
print "<div class='error-msg'>This stock already exists</div>";
edit_stocks();
}
    elseif(!empty($_POST['name']))   {
        $name = $conn->real_escape_string($_POST['name']);
        $nprice = abs(@intval($_POST['nprice']));
        $oprice = abs(@intval($_POST['oprice']));

        $conn->query("UPDATE `stock_stocks` SET `stockNAME` = '".$name."',`stockOPRICE` = ".$oprice.", `stockNPRICE` = ".$nprice." WHERE `stockID` = ".$ID) or die(mysqli_error());
        echo '<div class="success-msg">Stock has been edited</div>';
        stafflog_add("Edited stock {$_POST['name']} [$ID]", $c);
        edit_stocks();
    }
    else    {
        $row = $stre->fetch_assoc();;
        echo '<h3>Editing stock: '.$row['stockNAME'].'</h3>
 
        <form action="'.$_SERVER['PHP_SELF'].'?action=editn&ID='.$ID.'" method="post">
            Stock Name: <input type="text" name="name" value="'.$row['stockNAME'].'" />
 
            Stock Orig Price: <input type="text" name="oprice" value="'.$row['stockOPRICE'].'" />
 
            Stock Now Price: <input type="text" name="nprice" value="'.$row['stockNPRICE'].'" />
 
            <input type="submit" value="Edit Stock" />
        </form>';
    }
}
function add_stock()    {
    global $ir,$h, $conn;
    	if($ir['user_level'] != 2){
		die("403");
	}      
   if(empty($_POST['name']))  
{
print "<div class='error-msg'>You need to fill in all feilds!</div>";
add_stockform();
}
 $u=$conn->query("SELECT * FROM stock_stocks WHERE stockNAME='{$_POST['name']}'");
if(mysqli_num_rows($u) != 0)
{
print "<div class='error-msg'>This stock already exists</div>";
add_stockform();
}
   elseif(!empty($_POST['name']))   {
      
        $name = $conn->real_escape_string($_POST['name']);
        $orgp = abs(@intval($_POST['origp']));
    
        $conn->query("INSERT INTO `stock_stocks` (`stockNAME`,`stockOPRICE`,`stockNPRICE`) VALUES ('".$name."',".$orgp.",".$orgp.")") or die(mysqli_error());
        
$i=$conn->insert_id;
        
        echo '<div class="success-msg">Stock has been added</div>';
        
        stafflog_add("Created stock {$_POST['name']} [$i]", $c);
        view_stock();
    }
   
   
}
function add_stockform()    {
    global $ir,$h, $conn;
    	if($ir['user_level'] != 2){
		die("403");
	}      

        echo '
        
<h3>Add Stock</h3>
 
 <div class="infostaff">You can add a new stock to the game.</div>
		<br />
		<br />
        <form action="'.$_SERVER['PHP_SELF'].'?action=add" method="post">
            Name: <input type="text" name="name" />
 
            Original Price: <input type="number" name="origp" value="2000" />
 
            <input type="submit" value="Add Stock" />
        </form>';
}

function delete_stock() {
    global $ir,$h, $conn;
    	if($ir['user_level'] != 2){
		die("403");
	}
    if(!empty($_POST['del']))    {
        $id = abs(@intval($_POST['stock']));
        $query =         $conn->query("SELECT `stockNAME` FROM `stock_stocks` WHERE `stockID` = ".$id) or die(mysqli_error());
        $stockname = $query->fetch_assoc();
        
        $conn->query("DELETE FROM `stock_stocks` WHERE `stockID` = ".$id) or die(mysqli_error());
        $conn->query("DELETE FROM `stock_holdings` WHERE `holdingSTOCK` = ".$id) or die(mysqli_error());
        echo '<div class="success-msg">Stock has been deleted</div>';
        stafflog_add("Deleted stock {$stockname['stockNAME']} [$id]", $c);
        view_stock();
        
    }
    else    {
        echo '
        
<h3>Delete Stock</h3>
 <div class="infostaff">This will delete the stock from the game and all share holders will loose their shares.</div>
		<br />
		<br />
        <form action="'.$_SERVER['PHP_SELF'].'?action=del" method="post">';
        print"Select stock to delete: 
        ".stock_down($c, 'stock')."
        ";
         echo '
         <br />
         <input type="submit" value="Delete Stock" name="del" />
        </form>';
    }
}
$h->endpage();
?>