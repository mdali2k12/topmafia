<?php
	session_start();

	// define constants
	define('FACEBOOK_APP_ID', '2260196357426691');
    define('FACEBOOK_SECRET', 'e0f2571bd6f085074a4d970e753aa882');
    define('REDIRECT_URL', '');
	define('SCOPE', 'email');
	$permissions = ['email']; // optional

	// require FB autoloader
    require 'facebook/vendor/autoload.php';

	 $fb = new Facebook\Facebook([
    	 'app_id' => FACEBOOK_APP_ID,
    	 'app_secret' => FACEBOOK_SECRET,
    	 'redirect_uri' => REDIRECT_URL,
    	 'default_graph_version' => 'v3.3',
    	 'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : '1083050648494456|4bd199d4003150bdb747e23abddf70be',
    	 'persistent_data_handler'=>'session'
    ]);
    
    
    $accessToken = '';
    
    $helper = $fb->getRedirectLoginHelper();

	if(isset($_GET['state'])){
        $_SESSION['FBRLH_state']=$_GET['state'];
    }
    
include "config.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_{$_CONFIG['driver']}.php";
$conn = mysqli_connect($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database']);
$c=$conn->connection_id; 

    
    try {
        $accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\facebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: again ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	if (isset($accessToken)) {
		if (isset($_SESSION['facebook_access_token'])) {
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
		} else {
			// getting short-lived access token
			$_SESSION['facebook_access_token'] = (string) $accessToken;
			// OAuth 2.0 client handler
			$oAuth2Client = $fb->getOAuth2Client();
			// Exchanges a short-lived access token for a long-lived one
			$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
			$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
			// setting default access token to be used in script
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
		}
		
		// redirect the user to the profile page if it has "code" GET variable
		if (isset($_GET['code'])) {
			try {
        		$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
        		
        		$profile = $profile_request->getGraphUser();
        		$fbid = $profile->getProperty('id');           // To Get Facebook ID
        		$fbfullname = $profile->getProperty('name');   // To Get Facebook full name
        		$fbemail = $profile->getProperty('email');    //  To Get Facebook email
        	
        		# save the user nformation in session variable
        		$_SESSION['fb_id'] = $fbid;
        		$_SESSION['fb_name'] = $fbfullname;
        		$_SESSION['fb_email'] = $fbemail;
        	
    		} catch(Facebook\Exceptions\FacebookResponseException $e) {
				// When Graph returns an error
				echo 'Graph returned an error: ' . $e->getMessage();
				session_destroy();
				// redirecting user back to app login page
				$loginUrl = $helper->getLoginUrl('https://topmafia.net/home/fbauthenticate.php', $permissions);
				header('Location: ' . $loginUrl);
    		exit;
    		}
				catch(Facebook\Exceptions\FacebookSDKException $e) {
				// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
    		} 
		}
		// getting basic info about user
		
	} else {
		// replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used            
		$loginUrl = $helper->getLoginUrl('https://topmafia.net/home/fbauthenticate.php', $permissions);
		header('Location: ' . $loginUrl);
		exit;
	}

	
	
	$user_id = htmlspecialchars($_SESSION['fb_id']);
	$user_email = htmlspecialchars($_SESSION['fb_email']);
	$user_name = htmlspecialchars($_SESSION['fb_name']);
	$user_pic = $_SESSION['fb_picture'];
	

   include "config.php";
include "global_func.php";
include "class/class.phpmailer-lite.php";
global $_CONFIG;
define("MONO_ON", 1);
$conn = mysqli_connect($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database']);
$c=$conn->connection_id; 


//$user_profile = $facebook->api('/v2.3/me');
/* $arrayVals = array(
  'picture' => 'https://www.ocwars.com/images/fbfeed.png',
  'link' => 'https://apps.facebook.com/ocwars',
  'name'    => 'Mafia Den',
  'caption'    => 'Become the King of the Den!',
  'message' => $user_profile['first_name'].' has just played Mafia Den.'
  );
 */
//$facebook->api('/me/feed','post',$arrayVals);


//$user_profile = $facebook->api('/v2.3/me');
//$sqlSel = "select * from users where email='" . $user_profile['email'] . "'";

$sqlSel = "select * from users_data where email='" . $user_email. "'";

$resSel = $conn->query($sqlSel);

if (mysqli_num_rows($resSel) == 1)
{

	$_SESSION['loggedin'] = 1; 
	$mem = $resSel->fetch_assoc();
	
	$_SESSION['userid'] = abs((int) $mem['userid']);
   $userids = abs((int) $mem['userid']);
	$IP = htmlspecialchars($_SERVER['REMOTE_ADDR']);
	$q = "UPDATE users_data SET lastip_login='$IP',last_login=unix_timestamp() WHERE userid={$userids}";
	
	$conn->query($q);
	$time = time();
	$newtime = $time;
	$q1 = "SELECT * FROM users_session WHERE userid={$userids}";
	
	$ki = $conn->query($q1);
	if (mysqli_num_rows($ki) == 1)
	{
		$r = $ki->fetch_assoc();
		$_SESSION['userid'] = abs((int) $mem['userid']);
   $userids = abs((int) $mem['userid']);
		$sessco = $conn->real_escape_string($r['sesscode']);
		  if ($_SESSION['session'] != $sessco) {
        $code = sha1(mt_rand(1, 90000) . 'SALT');

            $conn->query("DELETE FROM users_session WHERE userid={$userids}");
            $conn->query("INSERT INTO users_session (userid, timeout, sesscode, fb)  VALUES ('{$userids}',unix_timestamp(), '{$code}', 1);");
         $conn->query("INSERT INTO users_activitylogs (userid, timein, sesscode, fb, ip)  VALUES ('{$userids}', unix_timestamp(), '{$code}', 1, '{$IP}');");
        $_SESSION['session'] = $code;
            
        }
        if ($_SESSION['session'] == $sessco) {
            $conn->query("UPDATE users_session SET timeout=unix_timestamp() WHERE session={$sessco}");
        } 
	}
	if (mysqli_num_rows($ki) == 0)
	{
	 $code = sha1(mt_rand(1, 90000) . 'SALT');

        $conn->query("INSERT INTO users_session (userid, timeout, sesscode, fb) VALUES ('{$userids}',unix_timestamp(), '{$code}', 1);");
         $conn->query("INSERT INTO users_activitylogs (userid, timein, sesscode, fb)  VALUES ('{$userids}', unix_timestamp(), '{$code}', 1);");
        $_SESSION['session'] = $code;
	}
	//Generate a random string.
$token1 = openssl_random_pseudo_bytes(16);
 
//Convert the binary data into hexadecimal representation.
$gentoken = bin2hex($token1);
    $_SESSION['token'] = htmlspecialchars($gentoken);
    $token = $_SESSION['token'];
    $uqq = $conn->query("SELECT userid, username, login_name, userpass FROM users_data WHERE username='{$userName}' AND `userpass`=md5('$password')");
    $mems = $uqq->fetch_assoc();
    
    $conn->query("UPDATE users_data SET sessiontoken='{$token}' WHERE userid={$userids}");
    
    
	if ($set['validate_period'] == "login" && $set['validate_on'])
	{
		$conn->query("UPDATE users_data SET verified=0 WHERE userid={$userids}");
	}
}
else
{
	$resMax = $conn->query("select max(userid) as userid from users_data");
	
	if (mysqli_num_rows($resMax) > 0)
	{
		$rowMax = $resMax->fetch_assoc();
		$maxUserId = abs(@intval($rowMax['userid']));
	}
	$maxUserId = $maxUserId + 1;
	$userEmailArray = explode("@", $user_email);
	$userName = $conn->real_escape_string($userEmailArray[0]);
	$password = substr(md5($maxUserId), 27);
	$firstNameIs = $user_name;
	$lastNameIs = $user_name;
	$fbidd = abs(@intval($user_id));
	$sm = 100;
	$email = $conn->real_escape_string($user_email);
	$ip = htmlspecialchars($_SERVER['REMOTE_ADDR']);

	// TODO: need to include global_func for is_disposable_email.
	// should really break it up into multiple includes
	
	$verify_code = abs(@intval(rand(10000,99999)));
	
	$q = "INSERT INTO users_data (username, login_name, laston, userpass, vip, user_level, location, gender, signedup, email, lastip, lastip_signup, validate, email_code2) VALUES('{$userName}', '{$userName}', unix_timestamp(), md5('{$password}'), 0, 1, 1, 'Male', unix_timestamp(), '{$email}', '{$ip}', '{$ip}', 1, '{$verify_code}')";

	$conn->query($q);
	$i = $conn->insert_id;
	
                            $conn->query("INSERT INTO users_facebook (userid, username, email) VALUES($i, '{$userName}', '{$email}')");
                            
                            $conn->query("INSERT INTO users_stats (userid, strength, agility, guard, labour, IQ, robskill) VALUES({$i}, 10, 10, 10, 10, 10, 0)");
                            
	    $conn->query("INSERT INTO users_finance (userid, money, bankmoney, crystals, bankcrystals, credits, refpoints) VALUES({$i}, '100', 0, 0, 0, 0, 0)");
 
                            $conn->query("INSERT INTO users_vitals (userid, level, exp, energy, maxenergy, will, maxwill, willmax,  brave, maxbrave, hp, maxhp) VALUES({$i}, 1, 0, 100, 100, 100, 100, 0, 5, 5, 100, 100)");
	
  $conn->query("INSERT INTO users_avatars (userid, display_pic) VALUES({$i}, 'https://graph.facebook.com/${fbidd}/picture?type=large')");
	
	

 function send_email($to,$userName,$password,$verify_code){
        try {
          $mail = new PHPMailerLite(true); //New instance, with exceptions enabled
	
          $body             = "
          <html>
          <body>
            <p>You used facebook to login to Top Mafia!</p>
            <p>Your email used is <strong>".htmlspecialchars($to)."</strong></p>
            <p>Your username is <strong>".htmlspecialchars($userName)."</strong></p>
            <p>Your password is <strong>".htmlspecialchars($password)."</strong></p>
            <p>Email verification code <strong>".htmlspecialchars($verify_code)."</strong></p>- head back to <a href='https://www.topmafia.net/'>Top Mafia</a> and log in.</p>
          </body>
          </html>";
          $body             = preg_replace('/\\\\/','', $body); //Strip backslashes
        
          $mail->AddReplyTo("webmail@topmafia.net","Top Mafia");
        
          $mail->SetFrom('webmail@topmafia.net', 'Top Mafia');
          $mail->AddAddress($to);
        
          $mail->Subject  = "Facebok login details for Top Mafia!";
        
          $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
          $mail->WordWrap   = 80; // set word wrap
        
          $mail->MsgHTML($body);
        
          $mail->IsHTML(true); // send as HTML
        
          $mail->Send();
          return true;
        } catch (phpmailerException $e) {
          echo $e->errorMessage(); 
          //return false;
        }
    }
	$sent = 'unset';
        
            send_email($email,$userName,$password,$verify_code);

	
	$sqlSel = "select * from users_data where username='" . $userName . "' and userpass='" . md5($password) . "'";
	$resSel = $conn->query($sqlSel);
	if (mysqli_num_rows($resSel) == 1)
	{
		$_SESSION['loggedin'] = 1;
		$mem = $resSel->fetch_assoc(); 
			$_SESSION['userid'] = abs((int) $mem['userid']);
   $userids = abs((int) $mem['userid']);
		$sessco = abs((int) $r['sesscode']);
		$IP = htmlspecialchars($_SERVER['REMOTE_ADDR']);
		$conn->query("UPDATE users_data SET lastip_login='{$IP}',last_login=unix_timestamp() WHERE userid={$userids}");
		$time = time();
		$newtime = $time;
		$ki = $conn->query("SELECT * FROM users_session WHERE userid={$userids}");
		if (mysqli_num_rows($ki) == 1)
		{
			$r = $ki->fetch_assoc();
				$_SESSION['userid'] = abs((int) $mem['userid']);
   $userids = abs((int) $mem['userid']);
		$sessco = $conn->real_escape_string($r['sesscode']);
		 if ($_SESSION['session'] != $sessco) {
        $code = sha1(mt_rand(1, 90000) . 'SALT');

            $conn->query("DELETE FROM users_session WHERE userid={$userids}");
            $conn->query("INSERT INTO users_session (userid, timeout, sesscode, fb)  VALUES ('{$userids}',unix_timestamp(), '{$code}', 1);");
         $conn->query("INSERT INTO users_activitylogs (userid, timein, sesscode, fb, ip)  VALUES ('{$userids}', unix_timestamp(), '{$code}', 1, '{$IP}');");
        $_SESSION['session'] = $code;
            
        }
        if ($_SESSION['session'] == $r['sesscode']) {
            $conn->query("UPDATE users_session SET timeout=unix_timestamp() WHERE session={$sessco}");
        } 
		}
		if (mysqli_num_rows($ki) == 0)
		{
	 $code = sha1(mt_rand(1, 90000) . 'SALT');

        $conn->query("INSERT INTO users_session (userid, timeout, sesscode, fb) VALUES ('{$userids}', unix_timestamp(), '{$code}', 1);");
         $conn->query("INSERT INTO users_activitylogs (userid, timein, sesscode, fb, ip)  VALUES ('{$userids}', unix_timestamp(), '{$code}', 1, '{$IP}');");
        $_SESSION['session'] = $code;
		}
			//Generate a random string.
$token1 = openssl_random_pseudo_bytes(16);
 
//Convert the binary data into hexadecimal representation.
$gentoken = bin2hex($token1);
    $_SESSION['token'] = htmlspecialchars($gentoken);
    $token = $_SESSION['token'];
    $uqq = $conn->query("SELECT userid, username, login_name, userpass FROM users_data WHERE username='{$userName}' AND `userpass`=md5('{$password}')");
    $mems = $uqq->fetch_assoc();
    
    $conn->query("UPDATE users_data SET sessiontoken='{$token}' WHERE userid={$userids}");
    
		if ($set['validate_period'] == "login" && $set['validate_on'])
		{
			$conn->query("UPDATE users_data SET verified=0 WHERE userid={$userids}");
		}
	}
}

header("Location: ../index.php#");
exit; 
?>