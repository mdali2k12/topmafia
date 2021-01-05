<?php
include "config.php";
include "class/class.phpmailer-lite.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_{$_CONFIG['driver']}.php";
$conn = mysqli_connect($_CONFIG['hostname'], $_CONFIG['username'], $_CONFIG['password'], $_CONFIG['database']);

?>
<!DOCTYPE html>

        <html xmlns="https://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> Top Mafia - Contact Us</title>
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
	<center><h2 class="font">CONTACT US</h2></center>
	
	<?php

function send_email($to,$msg,$email){
        try {
                            
          $mail = new PHPMailerLite(true); //New instance, with exceptions enabled
        
          $body             = "
          <html>
          <body>
            <h2>You've received a message below:</h2>
            <p>Email: ".htmlspecialchars($email)."
            <p>".$_POST['msg']."</p>
          </body>
          </html>";
          $body             = preg_replace('/\\\\/','', $body); //Strip backslashes
        
         $mail->AddReplyTo("webmail@topmafia.net","Top Mafia");
          $mail->SetFrom('webmail@topmafia.net', 'Top Mafia');
          $mail->AddAddress($to);
        
          $mail->Subject  = "You have a contact form request";
        
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
    
    $action = htmlspecialchars(strip_tags($_POST['action']));
    if($action) {
    $msg = htmlspecialchars(strip_tags($_POST['msg']));
	function valid_email($email)
{
    // First, we check that there's one @ symbol, and that the lengths are right
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    return true;
}

                            $email = filter_var($_POST['r_email'], FILTER_VALIDATE_EMAIL);
        if(empty($msg))
        {
            echo"<div id='err'>You need to fill in all fields correctly!</div><br />";
        }  elseif (!valid_email($email)) {
                            
            echo"<div id='err'>invalid email format!</div><br />";
                        }
        else{
      send_email("webmail@topmafia.net", $msg, $email);
      print"<div id='succ'>Message has been sent successfully and will be responded to within 24 hours.</div><br />";
        }
    }
    
?> 
                           <form action="" name="action" method="post">
	
                            
                        	<label class="font">Email Address</label>
                            <input type="email" id="r_email" name="r_email" class="text-general3" value="" required>
                            	<label class="font">Message</label><br />
                            <textarea type="text" name="msg" class="text-general3" id="msg" style="height:200px; width:100%;"></textarea>
                             <center>
                             <input type="submit" name="action" class="primary button" value="Send">
                             </center>
                        </form>

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