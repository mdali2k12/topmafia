<?php
session_start();
include "config.php";
require "global_func.php";
include "class/class.phpmailer-lite.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_{$_CONFIG['driver']}.php";
$conn = mysqli_connect($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database']);
$c=$conn->connection_id; 
$set = array();
$settq = $conn->query("SELECT * FROM settings");
while ($r = $settq->fetch_assoc()) {
    $set[$r['conf_name']] = $r['conf_value'];
}
//thx to http://www.phpit.net/code/valid-email/ for valid_email
function valid_email($email)
{
    // First, we check that there's one @ symbol, and that the lengths are right
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    return true;
}

function valid_username($username)
{
    if (!preg_match("/^[a-zA-Z0-9_]{3,16}$/", $username)) {
        return false;
    }
    return true;
}
function valid_password($password)
{
    if (!preg_match("/^[a-zA-Z0-9_]{3,16}$/", $password)) {
        return false;
    }
    return true;
}
// imran fixes
$_GET["REF"] = abs((int) $_GET["REF"]);


$ids_checkpost = urldecode($_SERVER['QUERY_STRING']);
// imran fixes
#if(eregi("[\'|'/'\''<'>'*'~'`']",$ids_checkpost) || strstr($ids_checkpost,'union') || strstr($ids_checkpost,'java') || strstr($ids_checkpost,'script') || strstr($ids_checkpost,'substring(') || strstr($ids_checkpost,'ord()')){
if (preg_match("[\'|'/'\''<'>'*'~'`']", $ids_checkpost) || strstr($ids_checkpost, 'union') || strstr($ids_checkpost, 'java') || strstr($ids_checkpost, 'script') || strstr($ids_checkpost, 'substring(') || strstr($ids_checkpost, 'ord()')) {
    $passed = 0;
    $data['status'] = 'error';
    $data['content'] = "What are you trying to do? whatever it is stop it!";
    echo json_encode($data);
//    echo "<center>What are you trying to do? whatever it is stop it!</center>"; // or blank so they not know they failed..
    exit;
}

function anti_inject($campo)
{
    foreach ($campo as $key => $val) {
        //remove words that contains syntax sql
        $val = preg_replace(my_Sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $val);

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
$usern = $conn->real_escape_string($_POST["username"]);
$passn = $conn->real_escape_string($_POST["password"]);
$email = $conn->real_escape_string($_POST["email"]);
$gender = $conn->real_escape_string($_POST["gender"]);
$cpassn = $conn->real_escape_string($_POST["cpassword"]);


                    $IP = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
                    if (file_exists('ipbans/' . $IP)) {
                        $data['status'] = 'error';
                        $data['data'] = "Your IP has been banned";
//                        die("Your IP has been banned. <br /><center><a href='login.php'>Back</a></center>");
                        die(json_encode($data));
                    }
                    if ($usern) {
                        if (!valid_email($email)) {
                            $data['status'] = 'error';
                            $data['data'] = "Invalid E-mail address format";
//                            echo json_encode($data);
//                            die("Invalid E-mail address format.<br /><center><a href='login.php'>Try Again</a></center>");
                            die(json_encode($data));
                        }

                        if (empty($passn)) {
                            $data['status'] = 'error';
                            $data['data'] = "You must enter a password.";
//                            echo json_encode($data);
//                            die("You must enter a password.<br /><center><a href='login.php'>Try Again</a></center>");
                            die(json_encode($data));
                        }
                        if (empty($cpassn)) {
                            $data['status'] = 'error';
                            $data['data'] = "You must fill in both password fields";
//                            echo json_encode($data);
//                            die("You must fill in both password fields.<br /><center><a href='login.php'>Try Again</a></center>");
                            die(json_encode($data));
                        }

                        if (file_exists('emailbans/' . $email)) {
                            $data['status'] = 'error';
                            $data['data'] = "Your email has been banned";
//                            echo json_encode($data);
//                            die("Your email has been banned.");
                            die(json_encode($data));
                        }
                        if (strlen($usern) < 4) {
                            $data['status'] = 'error';
                            $data['data'] = "Sorry the Username you entered is too short";
//                            echo json_encode($data);
//                            die("Sorry the Username you entered is too short.<br /><center><a href='login.php'>Try Again</a></center>");
                            die(json_encode($data));
                        }
                         if (strlen($usern) > 15) {
                            $data['status'] = 'error';
                            $data['data'] = "Sorry the Username you entered is too long";
                            die(json_encode($data));
                        }
                        if (!valid_username($usern)) {
                            $data['status'] = 'error';
                            $data['data'] = "You entered invalid characters in your username Keep it simple.";
                            die(json_encode($data));
//                            echo json_encode($data);
//                            die("You entered invalid characters in your username. Keep it simple.<br /><center><a href='login.php'>Try Again</a></center>");
                        }
                        if (!valid_password($passn)) {
                            $data['status'] = 'error';
                            $data['data'] = "You entered invalid characters in your password.";
                            die(json_encode($data));
//                            echo json_encode($data);
//                            die("You entered invalid characters in your username. Keep it simple.<br /><center><a href='login.php'>Try Again</a></center>");
                        }
                        $sm = 100;
                       $username = $conn->real_escape_string($_POST['username']);
                        $username = str_replace(array("<", ">"), array("&lt;", "&gt;"), $username);
                        $username = htmlspecialchars($_POST['username']);
                        $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
                        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

                        $password = $conn->real_escape_string($_POST['password']);
                        $password = htmlspecialchars($_POST['password']);
                        $password = str_replace(array("<", ">"), array("&lt;", "&gt;"), $password);
                        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
                        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

                        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
                        
                        $q = $conn->query("SELECT * FROM users_data WHERE username='{$username}' OR login_name='{$username}'");
                        $q2 = $conn->query("SELECT * FROM users_data WHERE email='{$email}'");
                        if(mysqli_num_rows($q) > 0) {
                            $data['status'] = 'error';
                            $data['data'] = "The Username you entered is in use.";
                            die(json_encode($data));
//                            echo json_encode($data);
//                            die("The Username you entered is in use.<br /><center><a href='login.php'>Try Again</a></center>");
                        } else if(mysqli_num_rows($q2) > 0) {
                            $data['status'] = 'error';
                            $data['data'] = "The E-mail you entered is in use.";
                            die(json_encode($data));
//                            echo json_encode($data);
//                            die("The E-mail you entered is in use.<br /><center><a href='login.php'>Try Again</a></center>");
                        } else if ($passn != $cpassn) {
                            $data['status'] = 'error';
                            $data['data'] = "Your passwords do not match.";
                            die(json_encode($data));
//                            echo json_encode($data);
//                            die("Your passwords do not match.<br /><center><a href='login.php'>Try Again</a></center>");
                        } else {
                            
$ref = abs ((int) $_POST["ref"]);

                            if (empty($ref)) {
                                $ref = 0;
                            } else {
                                $ref = filter_var($_POST['ref'], FILTER_SANITIZE_NUMBER_INT);
                                $ref = $conn->real_escape_string($_POST['ref']);
                            }
                            $IP = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);

                            $q = $conn->query("SELECT * FROM users_data WHERE lastip='{$IP}' AND userid={$ref}");
                            if(mysqli_num_rows($q) > 0) {
                                $data['status'] = 'error';
                                $data['data'] = "Are you trying to cheat the game by referring yourself? If we find out, your IP will be banned!";
                                die(json_encode($data));
//                                echo json_encode($data);
//                                die("Are you trying to cheat the game by referring yourself? If we find out, your IP will be banned!<br /><center><a href='login.php'>Try Again</a></center>");
                            }

                            if ($ref) {
                                $q = $conn->query("SELECT * FROM users_data WHERE userid={$ref}");
                                $r = $q->fetch_assoc();
                                
                            }
                            $refidd = abs(@intval($_POST["ref"]));
    if ($refidd > 0) {
                        $qref = $conn->query("SELECT userid FROM users_data WHERE userid='{$refidd}'");
                        if(mysqli_num_rows($qref) == 0) {
                                $data['status'] = 'error';
                                $data['data'] = "The referral ID doesnt exists";
                                die(json_encode($data));
                            }
    }
                            $emaili = $conn->real_escape_string($_POST['email']);
                            $emailfinal = filter_var($emaili, FILTER_SANITIZE_EMAIL);
                            $_POST['gender'] = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
                            $genderi = $conn->real_escape_string($_POST['gender']);
                            event_add(1, "<b>{$username}</b> has just signed up to the game!", $c);
                            //feed_add(1, "<b><font color=red>{$_POST['username']}</font></b> has just joined  the game!", $c);
 
                        	$verify_code = rand(10000,99999);
                            $conn->query("INSERT INTO users_data (username, login_name, laston, userpass, vip, user_level, location, gender, signedup, email, lastip, lastip_signup, validate, email_code2) VALUES('{$username}', '{$username}', unix_timestamp(),  md5('{$password}'), 0, 1, 1, '{$genderi}', unix_timestamp(), '{$emailfinal}', '{$IP}', '{$IP}', 1, '{$verify_code}')");
                            $i = $conn->insert_id; 
                            $conn->query("INSERT INTO users_stats (userid, strength, agility, guard, labour, IQ, robskill) VALUES({$i}, 10, 10, 10, 10, 10, 0)");
                            $conn->query("INSERT INTO users_finance (userid, money, bankmoney, crystals, bankcrystals, credits, refpoints) VALUES({$i}, '100', 0, 0, 0, 0, 0)");
                            $conn->query("INSERT INTO users_vitals (userid, level, exp, energy, maxenergy, will, maxwill, willmax,  brave, maxbrave, hp, maxhp) VALUES({$i}, 1, 0, 100, 100, 100, 100, 0, 5, 5, 100, 100)");
                            
  $conn->query("INSERT INTO users_avatars (userid) VALUES({$i})");
 
                            // imran fixes
                            if (!empty($ref)) {
                                $conn->query("UPDATE users_data SET crystals=crystals+25, referrals=referrals+1 WHERE userid={$ref}");
                                $conn->query("UPDATE users_data SET refby='{$ref}', money=money+25000 WHERE userid={$i}");     
                                $r['lastip'] = htmlspecialchars($r['lastip']);
                                $conn->query("INSERT INTO users_referals (refREFER, refREFED, refTIME, refREFERIP, refREFEDIP) VALUES({$ref}, {$i}, unix_timestamp(),'{$r['lastip']}','{$IP}')");   
                                event_add($ref, "For referring {$username} to the game, you have earned 25 crystals!", $c);
                                event_add($i, "You have been credited $25,000 cash for signing up under user id {$ref}!", $c);
                            }
                             
                            $key = abs(@intval(rand(1, 10000000)));
                            $conn->query("UPDATE users_data SET code='{$key}' WHERE userid={$i}"); 
                            
                            function send_email($to,$username,$password,$verify_code){
        try {
          $mail = new PHPMailerLite(true); //New instance, with exceptions enabled
        
          $body             = "
          <html>
          <body>
            <h2>Your login details for Top Mafia!</h2>
            <p>Your username is <strong>".htmlspecialchars($username)."</strong></p>
            <p>Your password is <strong>".htmlspecialchars($password)."</strong> </p>
            <p>Email verification code <strong> ".htmlspecialchars($verify_code)."</strong></p>- head back to <a href='https://www.topmafia.net/'>Top Mafia</a></p>
          </body>
          </html>";
          $body             = preg_replace('/\\\\/','', $body); //Strip backslashes
        
          $mail->AddReplyTo("webmail@topmafia.net","Top Mafia");
        
          $mail->SetFrom('webmail@topmafia.net', 'Top Mafia');
          $mail->AddAddress($to);
        
          $mail->Subject  = "Your login details for Top Mafia!";
        
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
if(isset($username)){
        
            $sent = send_email($emailfinal,$username,$password, $verify_code);
        
        }
        
    
                            $data['status'] = 'success';
                            $data['data'] = "You have signed up successfully!";
//                            echo json_encode($data);
//                            die("<font color=limegreen><b>You have signed up succesfully! </b></font><br /><center><a href='login.php'>Login</a></center>");
                            die(json_encode($data));
                        }
                    }
                    ?>