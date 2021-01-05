<?php
$primarypaypal = "f.ishaq97@gmail.com";
include "config.php";

function anti_inject($campo){
	
    foreach($campo as $key => $val)
    {
        //remove words that contains syntax sql
        $val = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$val);

        //Remove empty spaces
        $val = trim($val);

        //Removes tags html/php
        $val = strip_tags($val);

        //Add inverted bars to a string
        $val = addslashes($val);

        // store it back into the array
        $campo[$key] = $val;
    }
    return $campo; //Returns the the var clean
}  

$_GET = anti_inject($_GET);
$_POST = anti_inject($_POST);

global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_{$_CONFIG['driver']}.php";
$db = new database;
$db->configure($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database'], $_CONFIG['persistent']);
$db->connect();
$c = $db->connection_id;
require 'global_func.php';
$set   = array();
$settq = $db->query("SELECT * FROM settings");
while ($r = $db->fetch_row($settq)) {
    $set[$r['conf_name']] = $r['conf_value'];
}

if ($_GET['gateway'] == 'paypal') {
    // read the post from PayPal system and add 'cmd'
    $req = 'cmd=_notify-validate';

    foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
    }

    // post back to PayPal system to validate
    
    
    //post back to PayPal system to validate (replaces old headers)
$header = "POST /cgi-bin/webscr HTTP/1.1\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Host: www.paypal.com\r\n";
$header .= "Connection: close\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);


    // assign posted variables to local variables
    $item_name        = $_POST['item_name'];
    $item_number      = $_POST['item_number'];
    $payment_status   = $_POST['payment_status'];
    $payment_amount   = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id           = $_POST['txn_id'];
    $receiver_email   = $_POST['receiver_email'];
    $payer_email      = $_POST['payer_email'];



    if (!$fp) {
	// HTTP ERROR
    } else {
	fputs($fp, $header . $req);
	while (!feof($fp)) {
	    $res = fgets($fp, 1024);
	    if (strcmp(trim($res), "VERIFIED") == 0) {
		// check the payment_status is Completed
		if ($payment_status != "Completed") {
		    fclose($fp);
		    die("");
		}
		// check that txn_id has not been previously processed
		// check that receiver_email is your Primary PayPal email
		if ($receiver_email != $primarypaypal) {
		    fclose($fp);
		    die("");
		}
		// check that payment_amount/payment_currency are correct
		//if($payment_currency != "USD") { fclose ($fp);die(""); }
		// parse for pack
		$packr = explode('|', $item_name);
		if (str_replace("www.", "", $packr[0]) != str_replace("www.", "", $_SERVER['HTTP_HOST'])) {
		    fclose($fp);
		    die("");
		}
		
		$meki = $db->query("SELECT * FROM dpacks WHERE id={$packr[1]} AND active=1");
		if ($db->num_rows($meki) == 0) {
		    fclose($fp);
		    die("");
		} else {
		    $r = $db->fetch_row($meki);
		}
		// imran changes
		#$total = $r['price'] * $packr[2]; // #*#* HERE *#*#* add discount here (*.8; = 20% for example)
		if(is_sale_percentage_off()){
			$total = $r['price'] * $packr[2] * calculate_sale_percentage_off();
		}else{
			$total = $r['price'] * $packr[2];
		}
		$total = number_format($total, 2, '.', '');
		if ($total != $payment_amount) {
		    fclose($fp);
		    die("");
		}
		// grab IDs
		$buyer  = $packr[3];
		$number = $packr[2];
		// all seems to be in order, credit it.
		
		item_add($buyer, $r['id'], $number);
		
		// process payment
		event_add($buyer, "Your donation has been successfully credited to your inventory. Thank you!.", $c);
		
		event_add(1, "ID $buyer has purchased $number {$r['name']}(s) for $$payment_amount.", $c);
		$msg="ID $buyer has purchased $number {$r['name']}(s) for $$payment_amount.";
        sms_send($msg,1);
		$text  = "ID $buyer has purchased $number {$r['name']}(s) for $$payment_amount.";
		$text  = mysql_escape($text);
		$ditem = $r['id'];
		$db->query("INSERT INTO donations (buyer, timestamp, payment, quantity, item, text) VALUES($buyer,UNIX_TIMESTAMP(),$payment_amount,$number,$ditem,'$text')");
		$db->query("UPDATE users SET donated=donated+$payment_amount WHERE userid=$buyer");
	    } else if (strcmp(trim($res), "INVALID") == 0) {
	    }
	}
	
	fclose($fp);
    }
} elseif ($_GET['gateway'] == 'onebip') {

    // Check MD5 hash – anti-fraud measure
    if (isset($_REQUEST['hash'])) {
	$my_api_key = 'fwoDpHtGfCsIw6WMVIQ0KeHl'; // stored in your account settings
	$basename = basename($_SERVER['REQUEST_URI']);
	$pos = strrpos($basename, "&hash");
	$basename_without_hash = substr($basename, 0, $pos);    
	$my_hash = md5($my_api_key . $basename_without_hash);
	
	if ($my_hash != $_REQUEST['hash']) {
	    die("ERROR: Invalid hash code");
	}
    }

    // Onebip parameters:
    $payment_id         = $_REQUEST['payment_id'];
    $country            = $_REQUEST['country'];
    $currency           = $_REQUEST['currency'];
    $price              = $_REQUEST['price'];
    $tax                = $_REQUEST['tax'];
    $commission         = $_REQUEST['commission'];
    $amount             = $_REQUEST['amount'];
    $original_price     = $_REQUEST['original_price'];
    $original_currency  = $_REQUEST['original_currency'];
    $item_code		= $_REQUEST['item_code'];  

    // check that payment_amount/payment_currency are correct
    /* if($currency != "USD") {
	fclose ($fp);
	die("ERROR: Wrong currency");
    } */
    // parse for pack
    $packr = explode('|', $item_code);
    if (str_replace("www.", "", $packr[0]) != str_replace("www.", "", $_SERVER['HTTP_HOST'])) {
	fclose($fp);
	die("ERROR");
    }
    
    $meki = $db->query("SELECT * FROM dpacks WHERE id={$packr[1]} AND active=1");
    if ($db->num_rows($meki) == 0) {
	fclose($fp);
	die("ERROR");
    } else {
	$r = $db->fetch_row($meki);
    }
    
    $total = $r['price'] * $packr[2]; // add onebip discount here *.8 for 20% off 
    $total = number_format($total, 2, '.', '');
    $total = $total * 1.2; // added 20% to cover some of the fees
    $payment_amount = number_format($total, 2, '.', '');
    $total = $payment_amount * 100;
    if ($total != $original_price) {
	fclose($fp);
	die("ERROR");
    }
    // grab IDs
    $buyer  = $packr[3];
    $number = $packr[2];
    // all seems to be in order, credit it.
    
    item_add($buyer, $r['id'], $number);
    
    // process payment
    event_add($buyer, "Your donation has been successfully credited to your inventory. Thank you!.", $c);
    event_add(1, "ID $buyer has purchased $number {$r['name']}(s) for $$payment_amount.", $c);
    $text  = "ID $buyer has purchased $number {$r['name']}(s) for $$payment_amount.";
    $text  = mysql_escape($text);
    $ditem = $r['id'];
		$db->query("INSERT INTO donations (buyer, timestamp, payment, quantity, item, text) VALUES($buyer,UNIX_TIMESTAMP(),$payment_amount,$number,$ditem,'$text')");
    $db->query("UPDATE users SET donated=donated+$payment_amount WHERE userid=$buyer");

    echo 'OK'; // it is important you print "OK" in uppercase
}
?>
