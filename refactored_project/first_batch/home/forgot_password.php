<?php
session_start();
include "config.php";
include "class/class.phpmailer-lite.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_{$_CONFIG['driver']}.php";
$conn = mysqli_connect($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database']);

?><!DOCTYPE html>

        <html xmlns="https://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> Top Mafia - Forgot Password</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
                <link rel="image_src" href="https://topmafia.net/home/images/backgrounds/newred.png" />
                            <meta property="og:url" content="https://www.topmafia.net/" />
                            
    
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" media="all">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" media="all">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Courgette:400,500,700" media="all">
    <link href="https://topmafia.net/home/css/login/lstyle.css" media='screen, projection' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" type="image/x-icon" href="https://topmafia.net/favicon.ico">
    <script src="https://topmafia.net/home/javascripts/home.min.8aa9e3ed.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-168835434-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-168835434-1');
</script>
 <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XKYMHZZNM1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-XKYMHZZNM1');
</script>
        <script>
            $('document').ready(function(){
  $.ajax({
                'url' : 'ajax/onlinedata.php',
                'type' : 'POST',
                'data' : {},
                'success' : function(data) {
                    var response = JSON.parse(data);
                    $('#users').html(response.users);
                    $('#onlinenow').html(response.onlinenow);
                },
                'error' : function(request,error)
                {
                }
            });
});
        </script>
</head>

<body>
  <div class="contentmainbody2">
  <div class="topbar">
      <div class="nav">
        <input type="checkbox" id="nav-check"> 
        <div class="nav-header">
            <div class="nav-title">
<a href="" class="mainlink3"> <span class="new"><b><span id="onlinenow"></span> </b>Online</span></a>
  
  <a href="" class="mainlink1"> <span class="new2"><b><span id="users"></span></b> Players</span></a>
            </div>
        </div>

        <div class="nav-links">
      <div class="dropdown">
  <button class="dropbtn"><img src="https://topmafia.net/home/images/extra/hamburger.png"></button>
  <div class="dropdown-content">
    <a href="index.html"> Home</a>
    
    
    <a href="forgot_password.php"> Forgot Password </a>
    
    
    <a href="terms.html"> Game Rules</a>
    
    
    <a href="privacy.html"> Privacy Policy</a>
    
    
    <a href="contact.php"> Contact Us</a>
    
    
    </div>
</div>
        </div>
    </div>
    </div>
  <div style="clear: both;"></div>
  <br /><br />
    <div class="containerlogin">
      
</div>
    <div style="clear: both;"></div>
         <div id="content">

                    <div style="text-align:left;">
                      
    <center><h2 class="font">RESET PASSWORD</h2></center>
<?php
function auth_pwgen()
{
    $pw = '';
    $c  = 'bcdfghjklmnprstvwz'; //consonants except hard to speak ones
    $v  = 'aeiou'; //vowels
    $a  = $c . $v; //both
    
    //use two syllables...
    for ($i = 0; $i < 2; $i++) {
        $pw .= $c[rand(0, strlen($c) - 1)];
        $pw .= $v[rand(0, strlen($v) - 1)];
        $pw .= $a[rand(0, strlen($a) - 1)];
    }
    //... and add a nice number
    $pw .= rand(10, 99);
    $pw .= $c[rand(0, strlen($c) - 1)];
    $pw .= $v[rand(0, strlen($v) - 1)];
    $pw .= $a[rand(0, strlen($a) - 1)];
    
    return $pw;
}
function send_email($to, $username, $password)
{
    try {
        $mail = new PHPMailerLite(true); //New instance, with exceptions enabled
        
        $body = "
          <html>
          <body>
            <h2>We've reset your password!</h2>
            <p>Your username is <strong>".htmlspecialchars($username)."</strong></p>
            <p>Your new password is <strong>".htmlspecialchars($password)."</strong>.</p>
          </body>
          </html>";
        $body = preg_replace('/\\\\/', '', $body); //Strip backslashes
        
        $mail->AddReplyTo("webmail@topmafia.net", "Top Mafia");
        $mail->SetFrom('webmail@topmafia.net', 'Top Mafia');
        $mail->AddAddress($to);
        
        $mail->Subject = "Your new password for Top Mafia!";
        
        $mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mail->WordWrap = 80; // set word wrap
        
        $mail->MsgHTML($body);
        
        $mail->IsHTML(true); // send as HTML
        
        $mail->Send();
        return true;
    }
    catch (phpmailerException $e) {
        echo $e->errorMessage();
        //return false;
    }
}
$sent = 'unset';
$usern = $conn->real_escape_string($_POST['r_username']);
if ($usern) {
    $n =  $conn->real_escape_string($_POST['r_username']);
    $q = "SELECT * FROM users_data WHERE ";
    if (preg_match('/[^@]+@[^\.]+\.[\w\.]{3,7}/', $n)) {
        $q .= sprintf("email='%s'", $n);
    } else {
        die("<div id='err'>Email is incorrect or invalid! </div> 
           <br /><br /><center> <a href='forgot_password.php'>Try Again</a> </center>");
    }
    
    $uq = $conn->query($q);
    if (mysqli_num_rows($uq) > 0) {
        $user  = $uq->fetch_assoc();
        $newpw = auth_pwgen();
        $newpww = $conn->real_escape_string($newpw);
        
        $useremail = htmlspecialchars($user['email']);
        
        $userName = htmlspecialchars($user['username']);
        
        $sent  = send_email($useremail, $userName, $newpww);
        session_destroy();
        session_unset();
    } else {
        $sent = 'nouser';
    }
    
    if ($sent === true) {
        $userids = abs ((int) $user['userid']);
        $q    = "UPDATE users_data SET userpass='" . md5($newpww) . "' WHERE userid = " . $userids . ";";
        $sent = $conn->query($q);
    }
}
?> 


  
    <?php
if ($sent !== true):
?>
       <?php
    if ($sent == 'nouser'):
?>
           <p id="err">Sorry, no user with that email was found.</p>
        <?php
    elseif ($sent == false):
?>
           <p id="err">There was an issue delivering your email. Please try again later.</p>
        <?php
    endif;
?>
       
    <?php
else:
?>
   <p id="succ">An email was sent to <?php
    echo htmlspecialchars($user['email']);
?> with your new password.</p>
    <?php
endif;
?>
   <form action="forgot_password.php" method="post" name="forgot_password">
    <label class="font">Email Address</label>
                            <input type="email" id="r_username" name="r_username" class="text-general3" value="" required>
                            <center>
                             <input type="submit" name="action" class="primary button" value="Reset">
                             </center>
                        </form>
   </a>

                    </div>
        </div>
    <div style="clear: both;"></div>
    <footer id="footer" style="background-color:#111;">
        <div class="container-inner">
            <div class="legal"><span style="color:#777;">&copy; Copyright 2020 - 2021 Top Mafia. All Rights Reserved.</span></div>

        </div>
    </footer>
</div>
</body>

</html>