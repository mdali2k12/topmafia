<?php
include_once ("globals.php");
// imran changes
if(is_sale_percentage_off()){
	$promo = calculate_sale_percentage_off();
	$percent_off = $set['percent_off_sale'];
	$promotext = "<h2 style='color:red;font-weight:bold;'>{$percent_off}% Off everything!, {$set['sale_text']}</h2>";
}else{
	$promo = 0;  // To add sale of say 20% Put $promo=0.8 here. Remember to edit IPN_Donator.php with matching discount !!!
	$promotext = "<h2 style='color:red;font-weight:bold;'>20% Off Sale!</h2>";
}
$paypal="{$set['paypal']}";
$onebip="mdali2k12@gmail.com";
$topstatement="You can choose to buy the above upgrades to enhance your game experience. Credits can be used to buy rare items or boosters in the game.<br/><br/>";
$crystalstatement="Crystals packs let you trade crystals in for energy refills, game cash and cool weapons in crystal temple.<br/>";
$itemstatement="Donator items are the BEST game items available. These items are donator only and can't be brought from the shops or crystal temple.<br/>";
$whiskeystatement="Whiskey packs restore brave and will. Allowing you to train faster and harder than before.<br/>";
$donatorstatement="<div style='text-align:left; padding:10px;'>
<table>
<tr>
<td><span class='help2'>This is a intangible service for game credits. We do not give any refunds. Any attempts will result in account deletion.</span>
</td>
</tr>
<tr>
<td>
<h3>VIP </h3>
<span class='info'>When you purchase a VIP pack, you will receive:</span><br/><br/>
&bull; +12% increase in Energy, Will and Brave every 5 minutes. Totaling at 16%. <br/><br/>
&bull; +4% interest gained on bank money and deposit cap removed. <br/><br/>
&bull; +5 Crystal every hour. <br/><br/>
&bull; +$2,000 every hour. <br/><br/>
&bull; +One click attack system unlocked (fast attack)! <br/><br/>
&bull; +Sparring feature unlocked, slighty better gains the Steroid Gym! <br/><br/>
&bull; +Friend list unlocked! <br/><br/>
&bull; +Black list unlocked! <br/><br/>
&bull; Double exp gain on successful crimes. <br/><br/>
&bull; VIP gym will be activated for incredible steroid gains! <br/><br/>
&bull; <img src='donator.gif'> VIP Badge next to your name. <br/><br/>
&bull; Access to more features and better boosters! <br/><br/>
</td></tr></table></div>";

include_once('process-payleap.php');

?>
<script language="javascript">
<!-- Script courtesy of http://www.web-source.net - Your Guide to Professional Web Site Design and Development
function goto(form) { var index=form.select.selectedIndex
if (form.select.options[index].value != "0") {
location=form.select.options[index].value;}}
//-->
</script>
<?php

if(isset($_GET['deactivate']) && ($userid == 1))
{
  $conn->query("UPDATE dpacks SET active=0 WHERE id={$_GET['deactivate']}");
}


if(isset($_GET['activate']) && ($userid == 1))
{
  $conn->query("UPDATE dpacks SET active=1 WHERE id={$_GET['activate']}");
}


if(isset($_GET['hide']) && ($userid == 1))
{
  $conn->query("UPDATE dpacks SET hidden=1 WHERE id={$_GET['hide']}");
}


/* buy block  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */



if(isset($_GET['buy'])) {
  $buy = abs((int) $_GET['buy']);
  $look=$conn->query("SELECT * FROM dpacks WHERE id=$buy");
  
  if(mysqli_num_rows($look) == 0)
    {
    print"<center>This donator pack does not exist or is not for sale.<br>><a href=donator.php rel='external'>Back</a>";
    die("");
    }
  else
    {
    $dp=$look->fetch_assoc();
    if($dp['active'] == 0)
      {
      print"<center>This donator pack does not exist or is not for sale.<br>><a href=donator.php>Back</a>";
      die("");
      }
    }
	
  if(isset($_GET['nbr']))
    {
    $number=$_GET['nbr'];
    }
    else
    {
    $number=1;
    }
	
    $domain=$_SERVER['HTTP_HOST'];
    if($promo>0){
    	$cost = ($number * $dp['price']);
        $final = money_formatter($cost);
    	$promocost = ($number * $dp['price']) * $promo;
		$promocost = number_format($promocost, 2, '.', '');
        $promofinal = "$".$promocost;		
	}else{
    	$cost=$number * $dp['price'];
        $final="$".$cost;
	}

    if($promo>0){
    	echo $promotext;
	}else{
    	echo "";
	}
	
	print"<h2>You are purchasing the {$dp['name']}.</h2>
    <table width=100% cellpadding=5>
    <tr>
    <td>
    <center>You are currently purchasing $number pack(s).<br><br>
    If you would like more please select the<br> number you would like below.<br><br><FORM NAME='form1'><SELECT NAME='select' ONCHANGE='goto(this.form)' SIZE='1'>";
	
	$total=1;
	
    while($total < 51)
    {
    print "<option value='donator.php?buy=$buy&nbr=$total'>$total";
    $total=$total+1;
    }
	
	print"</SELECT></FORM></center>
    </td>
	</tr>
	<tr>
    <td>
    <center>Your total payment will be ";
	
	if($promo>0){
		print"<span style='text-decoration:line-through; color:red;'>$final</span><b style='color:green;'>$promofinal</b>";
	}else{
		print"<b style='color:green;'>$final</b>";
	}
		
	print".<br><br>You will receive items into your inventory instantly after payment.<br><br>
     
    <form action='https://www.paypal.com/cgi-bin/webscr' method='post' style='display:inline-block'> 
    <input type=hidden name=cmd value=_xclick>
    <input type='hidden' name='business' value='$paypal'> 
    <input type='hidden' name='item_name' value='{$domain}|{$dp['id']}|{$number}|{$userid}'>
    <input type='hidden' name='item_number' value='15'>";
	if($promo>0){
		print"<input type='hidden' name='amount' value='$promocost'>";
	}else{
		print"<input type='hidden' name='amount' value='$cost'>";
	}
    print"
    <input type='hidden' name='no_shipping' value='1'>
    <input type='hidden' name='notify_url' value='https://{$domain}/ipn_donator.php?gateway=paypal'>
    <input type='hidden' name='return' value='https://{$domain}/index.php'>
    <input type='hidden' name='cancel_return' value='https://{$domain}/index.php'>
    <input type='hidden' name='cn' value='{$userid}'>
    <input type='hidden' name='currency_code' value='USD'> 
    <input type='hidden' name='tax' value='0'>
	<input type='hidden' name='lc' value='US'>
    <input type='image' data-role='none' src='images/paypal-donate-button.png' border='0' name='submit' alt='Make payments with PayPal - it's fast, free and secure!'>   
    </form>   
    
    </td>
    </tr>
    </table>";
?>
<!-- div data-role="page" data-theme="a" data-cache="never" -->
<div class="payleap-form" style="display:none">
	<form method="post" action="donator.php">
        Name on Card: <input type="text" name="name_on_card" id="name_on_card" value="" /> <br />
        Card Number: <input type="text" name="card_num" id="card_num" value="" /><br />
        Expiration Month: <select name="exp_month" id="exp_month" >
        <?php
        for($i=1; $i<=12; $i++){
            $month = date('m');
            if($i<10)
                $i = '0'.$i;
            if($month == $i)
                echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
            else
                echo '<option value="'.$i.'">'.$i.'</option>';
        }
        ?>
        </select> <br />
        Expiration Year: <select name="exp_year" id="exp_year" >
        <?php
        $y = date('y', strtotime('+15 year'));
        for($i=date('y'), $j=date('Y'); $i<=$y; $i++, $j++){
            $sy = date('y', strtotime('+3 year'));
            if($sy == $i)
                echo '<option value="'.$i.'" selected="selected">'.$j.'</option>';
            else
                echo '<option value="'.$i.'">'.$j.'</option>';
        }
        ?>
        </select> <br />
        <input type='hidden' name='dpackid' id='dpackid' value="<?php echo $dp['id']; ?>" />
        <input type='hidden' name='number' id='number' value="<?php echo $number; ?>" />
        CV Number: <input type="text" name="cv_num" id="cv_num" size="6" value="" /><br />
        <?php
			if($promo>0){
				print "<input type='hidden' name='amount' id='amount' value=$promocost />";
			}else{
				print "<input type='hidden' name='amount' id='amount' value=$cost />";
			}
		?>
        <input type="submit"  value="Make Payment" onclick="return validate_form();" />
    </form>
</div>
<?php
	print "<span class='help'>Note: Your items will be deposited into inventory after payment. <br /></span>
	<a href='donator.php' data-role='button' rel='external'>Go Back</a><br/>";
}

/* add block  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

else if(isset($_GET['add'])){
  if(($userid == 1) && $_GET['add']) {
        print"<br><hr width=75%><br>";
        if($_POST['name'] && $_POST['desc'] && $_POST['price'] && $_POST['itemone'] && $_POST['itemtwo'] && $_POST['itemthree'] && $_POST['itemfour'] && $_POST['itemfive']){
          $money = abs((int) $_POST['money']);
          $crystals = abs((int) $_POST['crystals']);
          $days = abs((int) $_POST['days']);
          $itemone = abs((int) $_POST['itemone']);
          $itemoneqty = abs((int) $_POST['itemoneqty']);
          $itemtwo = abs((int) $_POST['itemtwo']);
          $itemtwoqty = abs((int) $_POST['itemtwoqty']);
          $itemthree = abs((int) $_POST['itemthree']);
          $itemthreeqty = abs((int) $_POST['itemthreeqty']);
          $itemfour = abs((int) $_POST['itemfour']);
          $itemfourqty = abs((int) $_POST['itemfourqty']);
          $itemfive = abs((int) $_POST['itemfive']);
          $itemfiveqty = abs((int) $_POST['itemfiveqty']);
  		
          if($itemone == 1000100)
          {
            $itemone=0;
            $itemoneqty=0;
          }
  		
          if($itemtwo == 1000100)
          {
            $itemtwo=0;
            $itemtwoqty=0;
          }
  		
          if($itemthree == 1000100)
          {
            $itemthree=0;
            $itemthreeqty=0;
          }
  		
          if($itemfour == 1000100)
          {
            $itemfour=0;
            $itemfourqty=0;
          }
  		
          if($itemfive == 1000100)
          {
            $itemfive=0;
            $itemfiveqty=0;
          }
  		
          $info=str_replace(array("'","\n"),array("'","<br />"),strip_tags($_POST['name']));
          $name = $conn->real_escape_string($info);
          $info=str_replace(array("'","\n"),array("'","<br />"),strip_tags($_POST['desc']));
          $desc = $conn->real_escape_string($info);
          $info=str_replace(array("'","\n"),array("'","<br />"),strip_tags($_POST['price']));
          $price = $conn->real_escape_string($info);
      
      	$howmany=0;
  		
          if($itemone > 0)
          {
           if($itemone == $itemtwo || $itemone == $itemthree || $itemone == $itemfour || $itemone == $itemfive)
           {
             print"<center>You shouldn't have the same item in multiple places in a Donator Pack<br>><a href=donator.php>Back</a>";
             die("");
      	 }
      
       	 $juk=$conn->query("SELECT * FROM items WHERE itmid=$itemone");
           
  		 if(mysqli_num_rows($juk) == 0)
           {
             print"<center>One of the items you have selected does not exist.<br>><a href=donator.php>Back</a>";
             die("");
           }
  		 		 
      	 $howmany=1;
      	}
      
  	if($itemtwo > 0)
      {
      if($itemone == $itemtwo || $itemtwo == $itemthree || $itemtwo == $itemfour || $itemtwo == $itemfive)
      {
      print"<center>You shouldn't have the same item in multiple places in a Donator Pack<br>><a href=donator.php>Back</a>";
      die("");
      }
      $juk=$conn->query("SELECT * FROM items WHERE itmid=$itemtwo");
      if(mysqli_num_rows($juk) == 0)
      {
      print"<center>One of the items you have selected does not exist.<br>><a href=donator.php>Back</a>";
      die("");
      }
      $howmany=2;
      }
      if($itemthree > 0)
      {
      if($itemthree == $itemtwo || $itemone == $itemthree || $itemthree == $itemfour || $itemthree == $itemfive)
      {
      print"<center>You shouldn't have the same item in multiple places in a Donator Pack<br>><a href=donator.php>Back</a>";
      die("");
      }
      $juk=$conn->query("SELECT * FROM items WHERE itmid=$itemthree");
      if(mysqli_num_rows($juk) == 0)
      {
      print"<center>One of the items you have selected does not exist.<br>><a href=donator.php>Back</a>";
      die("");
      }
      $howmany=3;
      }
      if($itemfour > 0)
      {
      if($itemfour == $itemtwo || $itemfour == $itemthree || $itemone == $itemfour || $itemfour == $itemfive)
      {
      print"<center>You shouldn't have the same item in multiple places in a Donator Pack<br>><a href=donator.php>Back</a>";
      die("");
      }
      $juk=$conn->query("SELECT * FROM items WHERE itmid=$itemfour");
      if(mysqli_num_rows($juk) == 0)
      {
      print"<center>One of the items you have selected does not exist.<br>><a href=donator.php>Back</a>";
      die("");
      }
      $howmany=4;
      }
      if($itemfive > 0)
      {
      if($itemfive == $itemtwo || $itemfive == $itemthree || $itemfive == $itemfour || $itemone == $itemfive)
      {
      print"<center>You shouldn't have the same item in multiple places in a Donator Pack<br>><a href=donator.php>Back</a>";
      die("");
      }
      $juk=$conn->query("SELECT * FROM items WHERE itmid=$itemfive");
      if(mysqli_num_rows($juk) == 0)
      {
      print"<center>One of the items you have selected does not exist.<br>><a href=donator.php>Back</a>";
      die("");
      }
      $howmany=5;
      }
      
      if($itemone == 0 && $howmany > 0 || $itemtwo == 0 && $howmany > 1 || $itemthree == 0 && $howmany > 2 || $itemfour == 0 && $howmany > 3 || $itemfive == 0 && $howmany > 4)
      {
      print"<center>Make sure you fill in the First Item first, Second Item second... etc.<br>Please do not leave one lower item blank while a higher item is not.<br>><a href=donator.php>Back</a>";
      die("");
      }
      
      $huji=$conn->query("SELECT * FROM itemtypes WHERE itmtypeid=999");
      if(mysqli_num_rows($huji) == 0)
      {
      $typename="Donation Items";
      $conn->query("INSERT INTO itemtypes VALUES('999','$typename')");
      }
      $conn->query("INSERT INTO items (itmtype, itmname, itmdesc, itmbuyprice, itmsellprice, itmbuyable, effect1_on, effect1, effect2_on, effect2, effect3_on, effect3, weapon, armor) VALUES('999','$name','$desc','0','0','0', '0', '0', '0', '0', '0', '0', '0', '0')");
      $i=$conn->insert_id();
      $conn->query("INSERT INTO dpacks VALUES ('$i','$name','$crystals','$money','$days','$price','$desc','$howmany','1','0','0');");
      $which=1;
      while($howmany > 0)
      {
      if($which == 5)
      {
      $conn->query("INSERT INTO dpitems VALUES ('$i','$itemfive','$itemfiveqty');");
      $which=21;
      }
      if($which == 4)
      {
      $conn->query("INSERT INTO dpitems VALUES ('$i','$itemfour','$itemfourqty');");
      $which=5;
      }
      if($which == 3)
      {
      $conn->query("INSERT INTO dpitems VALUES ('$i','$itemthree','$itemthreeqty');");
      $which=4;
      }
      if($which == 2)
      {
      $conn->query("INSERT INTO dpitems VALUES ('$i','$itemtwo','$itemtwoqty');");
      $which=3;
      }
      if($which == 1)
      {
      $conn->query("INSERT INTO dpitems VALUES ('$i','$itemone','$itemoneqty');");
      $which=2;
      }
      $howmany=$howmany-1;
      }
      
      print"<center>You have successfully added the $name.<br>><a href=donator.php>Back</a>";
      }
      else
      {
      print"<form action='donator.php?add=site' method='post'>
      <table width=100% border=1>
      <tr>
      <th colspan=3>Add A New Donator Pack</th>
      </tr>
      <tr>
      <th>Name:</th>
      <td><center><input type='text' name='name' value='{$_POST['name']}' /></center></td><td><center>-</center></td>
      </tr>
      <tr>
      <th>Item Description:</th>
      <td><center><input type='text' name='desc' value='{$_POST['desc']}' /></center></td><td><center>-</center></td>
      </tr>
      <tr>
      <th>Price In USD:</th>
      <td><center><input type='text' name='price' value='{$_POST['price']}' /></center></td><td><center>-</center></td>
      </tr>
      <tr>
      <th>Donator Days:</th>
      <td><center><input type='text' name='days' value='{$_POST['days']}' /></center></td><td><center>-</center></td>
      </tr>
      <tr>
      <th>Crystals:</th>
      <td><center><input type='text' name='crystals' value='{$_POST['crystals']}' /></center></td><td><center>-</center></td>
      </tr>
      <tr>
      <th>Money:</th>
      <td><center><input type='text' name='money' value='{$_POST['money']}' /></center></td><td><center>-</center></td>
      </tr>
      <tr>
      <th><br>Item ID:<br><br>Item Quantity:<br><br></th>
      <td><center><input type='text' name='itemone' value='0' /><br><font color=red size=1>Check box if none.</font><br><input type='text' name='itemoneqty' value='0' /></center></td><td><center><input type='checkbox' name='itemone' value='1000100'></center></td>
      </tr>
      <tr>
      <th><br>Item ID:<br><br>Item Quantity:<br><br></th>
      <td><center><input type='text' name='itemtwo' value='0' /><br><font color=red size=1>Check box if none.</font><br><input type='text' name='itemtwoqty' value='0' /></center></td><td><center><input type='checkbox' name='itemtwo' value='1000100'></center></td>
      </tr>
      <tr>
      <th><br>Item ID:<br><br>Item Quantity:<br><br></th>
      <td><center><input type='text' name='itemthree' value='0' /><br><font color=red size=1>Check box if none.</font><br><input type='text' name='itemthreeqty' value='0' /></center></td><td><center><input type='checkbox' name='itemthree' value='1000100'></center></td>
      </tr>
      <tr>
      <th><br>Item ID:<br><br>Item Quantity:<br><br></th>
      <td><center><input type='text' name='itemfour' value='0' /><br><font color=red size=1>Check box if none.</font><br><input type='text' name='itemfourqty' value='0' /></center></td><td><center><input type='checkbox' name='itemfour' value='1000100'></center></td>
      </tr>
      <tr>
      <th><br>Item ID:<br><br>Item Quantity:<br><br></th>
      <td><center><input type='text' name='itemfive' value='0' /><br><font color=red size=1>Check box if none.</font><br><input type='text' name='itemfiveqty' value='0' /></center></td><td><center><input type='checkbox' name='itemfive' value='1000100'></center></td>
      </tr>
      <tr>
      <th colspan=3><input type='submit' value='Add New Donator Pack' /></form></th>
      </tr>
      </table>";
      }

	}

}

/* edit block ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

elseif(isset($_GET['edit'])) {
if(($userid == 1) && $_GET['edit']) {
        $_GET['edit'] = abs((int) $_GET['edit']);
        $blak=$conn->query("SELECT * FROM dpacks WHERE id={$_GET['edit']}");
        if(mysqli_num_rows($blak) == 0) {
			print"<center>This donator pack does not exist!<br>><a href=donator.php>Back</a></center>";
			die("");
        }else{
	        $r=$blak->fetch_assocc();
        }
		
        print"<br><hr width=75%><br>";
        if($_POST['name'] && $_POST['desc'] && $_POST['price'] && $_POST['itemone'] && $_POST['itemtwo'] && $_POST['itemthree'] && $_POST['itemfour'] && $_POST['itemfive']) {
        $money = abs((int) $_POST['money']);
        $crystals = abs((int) $_POST['crystals']);
        $days = abs((int) $_POST['days']);
        $itemone = abs((int) $_POST['itemone']);
        $itemoneqty = abs((int) $_POST['itemoneqty']);
        $itemtwo = abs((int) $_POST['itemtwo']);
        $itemtwoqty = abs((int) $_POST['itemtwoqty']);
        $itemthree = abs((int) $_POST['itemthree']);
        $itemthreeqty = abs((int) $_POST['itemthreeqty']);
        $itemfour = abs((int) $_POST['itemfour']);
        $itemfourqty = abs((int) $_POST['itemfourqty']);
        $itemfive = abs((int) $_POST['itemfive']);
        $itemfiveqty = abs((int) $_POST['itemfiveqty']);
        if($itemone == 1000100){
			$itemone=0;
			$itemoneqty=0;
        }
        if($itemtwo == 1000100){
			$itemtwo=0;
			$itemtwoqty=0;
        }
        if($itemthree == 1000100) {
			$itemthree=0;
			$itemthreeqty=0;
        }
        if($itemfour == 1000100)
        {
        $itemfour=0;
        $itemfourqty=0;
        }
        if($itemfive == 1000100)
        {
        $itemfive=0;
        $itemfiveqty=0;
        }
        $info=str_replace(array("'","\n"),array("'","<br />"),strip_tags($_POST['name']));
        $name = $conn->real_escape_string($info);
        $info=str_replace(array("'","\n"),array("'","<br />"),strip_tags($_POST['desc']));
        $desc = $conn->real_escape_string($info);
        $info=str_replace(array("'","\n"),array("'","<br />"),strip_tags($_POST['price']));
        $price = $conn->real_escape_string($info);
        
        $howmany=0;
        if($itemone > 0)
        {
        if($itemone == $itemtwo || $itemone == $itemthree || $itemone == $itemfour || $itemone == $itemfive)
        {
        print"<center>You shouldn't have the same item in multiple places in a Donator Pack<br>><a href=donator.php>Back</a>";
        die("");
        }
        $juk=$conn->query("SELECT * FROM items WHERE itmid=$itemone");
        if(mysqli_num_rows($juk) == 0)
        {
        print"<center>One of the items you have selected does not exist.<br>><a href=donator.php>Back</a>";
        die("");
        }
        $howmany=1;
        }
        if($itemtwo > 0)
        {
        if($itemone == $itemtwo || $itemtwo == $itemthree || $itemtwo == $itemfour || $itemtwo == $itemfive)
        {
        print"<center>You shouldn't have the same item in multiple places in a Donator Pack<br>><a href=donator.php>Back</a>";
        die("");
        }
        $juk=$conn->query("SELECT * FROM items WHERE itmid=$itemtwo");
        if(mysqli_num_rows($juk) == 0)
        {
        print"<center>One of the items you have selected does not exist.<br>><a href=donator.php>Back</a>";
        die("");
        }
        $howmany=2;
        }
        if($itemthree > 0)
        {
        if($itemthree == $itemtwo || $itemone == $itemthree || $itemthree == $itemfour || $itemthree == $itemfive)
        {
        print"<center>You shouldn't have the same item in multiple places in a Donator Pack<br>><a href=donator.php>Back</a>";
        die("");
        }
        $juk=$conn->query("SELECT * FROM items WHERE itmid=$itemthree");
        if(mysqli_num_rows($juk) == 0)
        {
        print"<center>One of the items you have selected does not exist.<br>><a href=donator.php>Back</a>";
        die("");
        }
        $howmany=3;
        }
        if($itemfour > 0)
        {
        if($itemfour == $itemtwo || $itemfour == $itemthree || $itemone == $itemfour || $itemfour == $itemfive)
        {
        print"<center>You shouldn't have the same item in multiple places in a Donator Pack<br>><a href=donator.php>Back</a>";
        die("");
        }
        $juk=$conn->query("SELECT * FROM items WHERE itmid=$itemfour");
        if(mysqli_num_rows($juk) == 0)
        {
        print"<center>One of the items you have selected does not exist.<br>><a href=donator.php>Back</a>";
        die("");
        }
        $howmany=4;
        }
        if($itemfive > 0)
        {
        if($itemfive == $itemtwo || $itemfive == $itemthree || $itemfive == $itemfour || $itemone == $itemfive)
        {
        print"<center>You shouldn't have the same item in multiple places in a Donator Pack<br>><a href=donator.php>Back</a>";
        die("");
        }
        $juk=$conn->query("SELECT * FROM items WHERE itmid=$itemfive");
        if(mysqli_num_rows($juk) == 0)
        {
        print"<center>One of the items you have selected does not exist.<br>><a href=donator.php>Back</a>";
        die("");
        }
        $howmany=5;
        }
        
        if($itemone == 0 && $howmany > 0 || $itemtwo == 0 && $howmany > 1 || $itemthree == 0 && $howmany > 2 || $itemfour == 0 && $howmany > 3 || $itemfive == 0 && $howmany > 4)
        {
        print"<center>Make sure you fill in the First Item first, Second Item second... etc.<br>Please do not leave one lower item blank while a higher item is not.<br>><a href=donator.php>Back</a>";
        die("");
        }
        
        $conn->query("UPDATE dpacks SET crystals=$crystals WHERE id={$r['id']}");
        $conn->query("UPDATE dpacks SET money=$money WHERE id={$r['id']}");
        $conn->query("UPDATE dpacks SET days=$days WHERE id={$r['id']}");
        $conn->query("UPDATE dpacks SET price=$price WHERE id={$r['id']}");
        $conn->query("UPDATE dpacks SET name='$name' WHERE id={$r['id']}");
        $conn->query("UPDATE dpacks SET items=$howmany WHERE id={$r['id']}");
        $conn->query("UPDATE dpacks SET description='$desc' WHERE id={$r['id']}");
        $conn->query("UPDATE items SET itmdesc='$desc' WHERE itmid={$r['id']}");
        $conn->query("UPDATE items SET itmname='$name' WHERE itmid={$r['id']}");
        
        $conn->query("DELETE FROM dpitems WHERE dpid={$r['id']}");
        $which=1;
        while($howmany > 0)
        {
        if($which == 5)
        {
        $conn->query("INSERT INTO dpitems VALUES ('{$r['id']}','$itemfive','$itemfiveqty');");
        $which=21;
        }
        if($which == 4)
        {
        $conn->query("INSERT INTO dpitems VALUES ('{$r['id']}','$itemfour','$itemfourqty');");
        $which=5;
        }
        if($which == 3)
        {
        $conn->query("INSERT INTO dpitems VALUES ('{$r['id']}','$itemthree','$itemthreeqty');");
        $which=4;
        }
        if($which == 2)
        {
        $conn->query("INSERT INTO dpitems VALUES ('{$r['id']}','$itemtwo','$itemtwoqty');");
        $which=3;
        }
        if($which == 1)
        {
        $conn->query("INSERT INTO dpitems VALUES ('{$r['id']}','$itemone','$itemoneqty');");
        $which=2;
        }
        $howmany=$howmany-1;
        }
        
        print"<center>You have successfully edited the $name.<br>><a href=donator.php>Back</a>";
        }
        else
        {
        print"<form action='donator.php?edit={$_GET['edit']}' method='post'>
        <table width=50% border=1 align=center>
        <tr>
        <th colspan=3>Edit The {$r['name']}</th>
        </tr>
        <tr>
        <th>Name:</th>
        <td><center><input type='text' name='name' value='{$r['name']}' /></center></td><td><center>-</center></td>
        </tr>
        <tr>
        <th>Item Description:</th>
        <td><center><input type='text' name='desc' value='{$r['description']}' /></center></td><td><center>-</center></td>
        </tr>
        <tr>
        <th>Price In USD:</th>
        <td><center><input type='text' name='price' value='{$r['price']}' /></center></td><td><center>-</center></td>
        </tr>
        <tr>
        <th>Donator Days:</th>
        <td><center><input type='text' name='days' value='{$r['days']}' /></center></td><td><center>-</center></td>
        </tr>
        <tr>
        <th>Crystals:</th>
        <td><center><input type='text' name='crystals' value='{$r['crystals']}' /></center></td><td><center>-</center></td>
        </tr>
        <tr>
        <th>Money:</th>
        <td><center><input type='text' name='money' value='{$r['money']}' /></center></td><td><center>-</center></td>
        </tr>";
        
        if($r['items'] > 0)
        {
        $test="one";
        $tezt="oneqty";
        $jihu=$conn->query("SELECT * FROM dpitems WHERE dpid={$r['id']}");
        while($wun=$jihu->fetch_assoc())
        {
        print"<tr>
        <th><br>Item ID:<br><br>Item Quantity:<br><br></th>
        <td><center><input type='text' name='item$test' value='{$wun['itemid']}' /><br><font color=red size=1>Check box if none.</font><br><input type='text' name='item$tezt' value='{$wun['quantity']}' /></center></td><td><center><input type='checkbox' name='item$test' value='1000100'></center></td>
        </tr>";
        if($test == "four")
        {
        $test="five";
        $tezt="fiveqty";
        }
        if($test == "three")
        {
        $test="four";
        $tezt="fourqty";
        }
        if($test == "two")
        {
        $test="three";
        $tezt="threeqty";
        }
        if($test == "one")
        {
        $test="two";
        $tezt="twoqty";
        }
        }
        }
        $left=5-$r['items'];
        while($left > 0)
        {
        if($left == 5)
        {
        $test="one";
        $tezt="oneqty";
        }
        if($left == 4)
        {
        $test="two";
        $tezt="twoqty";
        }
        if($left == 3)
        {
        $test="three";
        $tezt="threeqty";
        }
        if($left == 2)
        {
        $test="four";
        $tezt="fourqty";
        }
        if($left == 1)
        {
        $test="five";
        $tezt="fiveqty";
        }
        print"<tr>
        <th><br>Item ID:<br><br>Item Quantity:<br><br></th>
        <td><center><input type='text' name='item$test' value='0' /><br><font color=red size=1>Check box if none.</font><br><input type='text' name='item$tezt' value='0' /></center></td><td><center><input type='checkbox' name='item$test' value='1000100' CHECKED></center></td>
        </tr>";
        $left=$left-1;
        }
        print"<tr>
        <th colspan=3><input type='submit' value='Edit Donator Pack' /></form></th>
        </tr>
        </table>";
        }
    }

}

/* delete block ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

elseif(($userid == 1) && $_GET['del'])
{
    
	  $_GET['del'] = abs((int) $_GET['del']);
      $blak=$conn->query("SELECT * FROM dpacks WHERE id={$_GET['del']}");
      
	  if(mysqli_num_rows($blak) == 0)
      {
        print"<center>This donator pack does not exist!<br>><a href=donator.php>Back</a></center>";
        die("");
      }
      else
      {
        $r=$blak->fetch_assoc();
      }
	  
      print"<br><hr width=75%><br>";
      
	  if($_GET['confirm'])
      {
        $conn->query("UPDATE dpacks SET active=0 WHERE id='{$_GET['del']}'");
        print"<center>You have successfully deleted the {$r['name']}.<br>><a href=donator.php>Back</a>";
      }
      else
      {
        print"<form action='donator.php?del={$_GET['del']}&confirm=delete' method='post'>
        <table width=55% border=1>
        <tr>
        <th colspan=2>Are you sure you would like to delete the {$r['name']}?<br><font color=red size=1>This will only remove the item from the donate page, it will still exist in the items.</font></th>
        </tr>
        <tr>
        <th colspan=2><input type='submit' value='Delete Donator Pack' /></form></th>
        </tr>
        </table>";
	  }
	
}

else
{
 
    if($userid == 1)
    {
    print"<br/><a href=donator.php?add=site data-theme='e' data-role='button' rel='external'>Add New Donator Pack</a><br>";
    }
    $second="";
    $span=4;
    if($userid == 1)
    {
    $second="<th width=10%>---</th><th width=10%>---</th>";
    $span=6;
    }
    print"<table width=100% border=0 cellspacing=1 class=regular>
 
	 
	";
	
	if(isset($_GET['t'])){
		$t2 = $_GET['t'];
		// imran changes from crystal to 'crystal' and so on
		if($t2 == 'crystal'){
			print "<tr><td colspan=$span><center>$crystalstatement</center></td></tr>";
		} elseif ($t2 == 'pack'){
			print "<tr><td colspan=$span><center>$donatorstatement</center></td></tr>";
		} elseif ($t2 == 'item'){
			print "<tr><td colspan=$span><center>$itemstatement</center></td></tr>";
		} elseif ($t2 == 'whiskey'){
			print "<tr><td colspan=$span><center>$whiskeystatement</center></td></tr>";
		}else{
			print "<tr><td colspan=$span><center>$topstatement</center></td></tr>";
		}
	}
	if($promo>0){print "<tr><td colspan=$span><center>$promotext</center></td></tr>";}else{}
	
	if(isset($_GET['t'])) {
  	  if($userid == 1){
		  print"<tr><th><center>Pack</center></th><th><center>Bonus</center></th><th style='text-align:center;'>Price</th>$second</tr>";
		  $hk=$conn->query("SELECT * FROM dpacks WHERE (hidden=0 AND name LIKE '%".$_GET['t']."%') ORDER BY price ASC");
      }else{
		  print"<tr><th><center>Pack</center></th><th><center>Bonus</center></th><th style='text-align:center;'>Price</th>$second</tr>";
      $hk=$conn->query("SELECT * FROM dpacks WHERE (active=1 AND name LIKE '%".$_GET['t']."%') ORDER BY price ASC");
      }
	}else{
	  $hk=$conn->query("SELECT * FROM dpacks WHERE (hidden=0 AND name LIKE '%12345%') ORDER BY price ASC");
	}
	
    while($r=$hk->fetch_assoc()) {
    if($userid == 1) {
	    $sekond="<td><a href='donator.php?edit={$r['id']}' rel='external'><font color=gray>Edit</font></a></td><td><a href='donator.php?del={$r['id']}' rel='external'><font color=red>Del</font></a></td>";
    }
    print"<tr><td style=' border-bottom:4px solid #333333;'>";
    if(($userid == 1) && $r['active'] == 0 && $r['hidden'] == 0) {
	    print"<font size=1 color=green>(<a href='donator.php?activate={$r['id']}' rel='external'><font color=green size=1>Activate For Sale</font></a>)</font><br>";
    }
    print"{$r['name']}<br/><span class='dinfo'>{$r['description']}</span><br/><img src='images/items/{$r['id']}.png' style='border:1px solid #fff;'><a href=iteminfo.php?ID={$r['id']}><img src='images/info.png' /></a><br />";
    if(($userid == 1) && $r['active'] == 1) {
	    print"<br><font size=1 color=red>(<a href='donator.php?deactivate={$r['id']}' rel='external'><font color=red size=1>Deactivate</font></a>)</font><br>";
    }
    if(($userid == 1) && $r['active'] == 0 && $r['hidden'] == 0) {
	    print"<br><font size=1 color=red>(<a href='donator.php?hide={$r['id']}' rel='external'><font color=red size=1>Hide Forever</font></a>)</font><br>";
    }
	echo"<td style='text-align:left; border-bottom:4px solid #555;'><span class='dinfo'>You Get:</span><br/>";
    if($r['days'] > 0) {
	    print"<span class='dinfo2'><img src='https://mafiamobi.com/donator.gif'> {$r['days']} Donator Days</span><br/>";
    }
	
    if($r['money'] > 0) {
		$muneh=money_formatter($r['money']);
		print"<span class='dinfo2'><img src='https://mafiamobi.com/smileys/notes.gif'> $muneh Game Money</span><br/>";
    }
	
    if($r['crystals'] > 0) {
	    print"<span class='dinfo2'><img src='https://mafiamobi.com/imageicons/ruby.png'>  {$r['crystals']} Crystals</span><br/>";
    }
	
    if($r['items'] > 0) {
    $lao=$conn->query("SELECT * FROM dpitems WHERE dpid={$r['id']}");
		while($dpitem=$lao->fetch_assoc()) {
			$juk=$conn->query("SELECT * FROM items WHERE itmid={$dpitem['itemid']}");
			$item=$juk->fetch_assoc();
			$s="";
			if($dpitem['quantity'] > 1) {
				$s="s";
			}
			print"<span class='dinfo3'>{$dpitem['quantity']} x {$item['itmname']}</span><br/>";
		}
    }
    print"</td><td style='text-align:center; border-bottom:4px solid #999999;'>";
    
    if($promo>0){
		$finalp=$r['price']*$promo;
		$finalprice=round($finalp,2);
    	echo "<span style='text-decoration:line-through; color:#777;'>\${$r['price']}</span><br/><span style=' color:gold;font-weight:bold; font-size:20px;'>\$$finalprice</span><br/><a href='donator.php?buy={$r['id']}' rel='external'><img src='images/buy-now-button.png' /></a>";
    }else{
    	echo"<span style='font-size:20px; color:gold;font-weight:bold;'>\${$r['price']}</span><br/><a href='donator.php?buy={$r['id']}' rel='external'><img src='images/buy-now-button.png' /></a>";
	}
		if(isset($sekond)){
	    	print"</td>$sekond</tr>";
		}
    }
    	print"</table></center>";
}
$h->endpage();
?>