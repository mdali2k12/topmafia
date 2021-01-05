<?php
if(!class_exists('headers')){
class headers {
	function startheaders() {
		$userid=$_SESSION['userid'];
	}
	function userdata($ir,$lv,$fm,$cm,$displaypic,$dosessh=1){
	
	include "header_func.php";
	?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>
            <?php echo"{$set['game_name']} - {$ir['username']}"; ?>
        </title>
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="https://topmafia.net/header/css/stylem.css" media='screen, projection' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" type="image/x-icon" href="https://topmafia.net/favicon.ico">
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" media="all">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" media="all">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Courgette:400,500,700" media="all">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163774842-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-163774842-1');
        </script>
       
         <script language="javascript" type="text/javascript">
       
function goBack() {
  window.history.back();
}
$(document).ready(function() {
    $('#test').change(function(){
    $('#text').val($('#text').val()+" "+$('#test option:selected').val());
});
});
     
       </script>
       
      
    
    </head>

    <body>
       
            <div class="mainpage2">
                <div class="usertopbar">
                    <table width="100%">
                        <tr>
                        <td width="27%" align="left"> <?php echo"$u $d"; ?>                                         
<div class="dropdown">
  <button class="dropbtn"><img src="https://topmafia.net/header/images/imageicons/gear-white.png"> </button>
  <div class="dropdown-content">
    <?php echo"<a href='viewuser.php?u=".$ir['userid']."'>";?>Profile</a>
    <a href="preferences.php">Settings</a>
    <a href="logout.php">Logout</a>
  </div>
</div></td>
                        <td width="15%" align="left"><?php echo"Level {$ir['level']}"; ?><Br />
                        
                              <div class="exptext"><?php echo"".cash_format($ir['exp'])." / ".cash_format($ir['exp_needed']).""; ?></div></td>
                        <td width="28%" align="left">
                        <div class="emptyprogressbar">
                                            <div class="expbarprogress" style="width:<?= $experc ?>%;height: 10px;"></div>
                                        </div></td>
                                        <td align="right" class="tabnotif" width="15%">  
                                        <?php 
                                                 if($mc > 0) {
                                                 echo"<a href='mailbox.php'><img src='https://topmafia.net/header/images/imageicons/mail.png' width='16px'>&nbsp;<span class='notifbox'>$mc</span><a/>";}
                                                 elseif($mc == 0) { echo"<a href='mailbox.php'>
                                                 <img src='https://topmafia.net/header/images/imageicons/mail.png' width='16px'></a>";}?>
                                        </td>
                                        
                                        
                                        <td align="center" class="tabnotif"  width="15%">  
                                        <?php 
                                                 if($ec > 0) {
                                                 echo"<a href='events.php'><img src='https://topmafia.net/header/images/imageicons/bel.png' width='16px'>&nbsp;<span class='notifbox'>$ec</span></a>";}
                                                 elseif($ec == 0) { echo"<a href='events.php'><img src='https://topmafia.net/header/images/imageicons/bel.png' width='16px'></a>";}?>
                                        </td>
                        </tr>
                    </table>
                </div>
                <div class="usertopbarmain">
                    <table width="100%">
                        <tr>
                            <td width="5%">
                                <a href="profileimage.php" rel="external"> 
                 
                    <?php print"$displaypic"; ?>
</a>
                            </td>
                           
                                 <td width="23.3%" class="tabstyle">
                                     <div class="iconbeside">
      <img src="https://topmafia.net/header/images/imageicons/lightning-icon.png" style="display:inline-block;width:19px;margin-right:5px;"><div class="emptyprogressxbar" style="margin-top:5px;display:inline:block;">
                                            <div class="energybarprogress" style="width:<?= $enperc ?>%;height: 5px;"></div>
                                        </div></div>
                                        <?php echo"<small>".cash_format($ir['energy'])."</small> / <b>".cash_format($ir['maxenergy']).""; ?></b>
                               </td>
                                <td width="23.3%" class="tabstyle">
                                     <div class="iconbeside">
      <img src="https://topmafia.net/header/images/imageicons/steroidicon.png" style="display:inline-block;width:19px;margin-right:5px;"><div class="emptyprogressxbar" style="margin-top:5px;display:inline:block;">
                                            <div class="willbarprogress" style="width:<?= $wiperc ?>%;height: 5px;"></div>
                                        </div>
                                        </div>                                  <?php echo"<small>".cash_format($ir['will'])."</small> / <b>".cash_format($ir['maxwill']).""; ?></b>
                               </td>
                               <td width="23.3%" class="tabstyle" align="left">
                                     <div class="iconbeside">
      <img src="https://topmafia.net/header/images/imageicons/gun-icon.png" style="display:inline-block;width:16px;margin-right:5px;">
      <div class="emptyprogressxbar" style="margin-top:5px;display:inline:block;">
                                            <div class="bravebarprogress" style="width:<?= $brperc ?>%;height: 5px;"></div>
                                        </div>
                                        </div>                                  <?php echo"<small>".cash_format($ir['brave'])."</small> / <b>".cash_format($ir['maxbrave']).""; ?></b>
                               </td>
                                <td width="25%"  align="left"> <img src="https://topmafia.net/header/images/imageicons/money.png">  <a href="bank.php"><div class="cashmoney"><?php echo''.cash_format($ir['money']).'';?></div></a>
                            <br />
                            <img src="https://topmafia.net/header/images/imageicons/ruby2.png" width="16px"> <a href="crystaltemple.php"><div class="crystaltext2"><?php echo''.cash_format($ir['crystals']).'';?></div></a>
                               </td>
                                
                        </tr>
                    </table> 
                   
                </div>
                    <div class="usertopnav">
                        <a href="index.php" class="usertopnavlink">Home</a> 
                        <a href="explore.php" class="usertopnavlink"><?php echo"{$rr['cityname']}";?></a>
                        <a href="inventory.php" class="usertopnavlink">Items</a>
                        <div class="dropdown2">
  <button class="dropbtn2">▼</button>
  <div class="dropdown2-content">
      
                        <a href="fight.php">Fight</a>
                        <a href="criminal.php">Crimes</a>
                        <a href="gym.php">Gym</a>
                        <a href="jail.php">Jail <span class="barstat"><?php echo"$jc"; ?></span></a>
                        <a href="hospital.php">Hospital <span class="barstat"><?php echo"$hc"; ?></span></a>
  </div>
</div>
                           
                    </div>
                
                                <div style="clear: both;"></div>
                                <div class="mainpage">
                                    <table width="100%" style="margin-top:-5px;">
                                        <tr>
                                            <td width="2%" align="left">
                                                <img src="https://topmafia.net/header/images/imageicons/health.png"></td>
                                                <td width="25%"><div class="emptyprogressxxbar">
                                            <div class="hpbarprogress" style="width:<?= $hpperc ?>%;height: 5px;"></div>
                                        </div>
                                            </td>
                                            <td width="38%" align="left"><?= $hpperc ?>%</td>
                                            <td width="35%" style="padding:5px; font-family:Roboto;" align="right">
                                               
                                    <div class="credittxt"><a href="credits.php">
                            <img src="https://topmafia.net/header/images/imageicons/points2.png" width="30px" style="float:left;margin-top:-7px;margin-left:-8px;"><?php echo''.cash_format($ir['credits']).'';?></a>
                            
                            <a href="donator.php"><span class="donateplus">+</span></span></div>
        </a>
                               </td>
                                        </tr>
                                    </table>
                                  
    <?php
	include"checks.php";
	print"<br />";
	}
	function menuarea() {
	global $ir,$c;
}
	function endpage(){
	global $ir,$c, $conn;
	
        echo '<br /><br />';	
  if($ir['banshout'] ==0){  include"shoutbox/shoutbox.php";   }	 
  
		echo ' <div style="clear: both;"></div><br /><br /></div>';
            
          
$count1 = $conn->query("SELECT `userid` FROM `users_data` WHERE `user_level` = 1");
$registered = mysqli_num_rows($count1);
$Count2 = $conn->query("SELECT `userid` FROM `users_data` WHERE `laston` > unix_timestamp()-15*60");
$onlinenow = mysqli_num_rows($Count2);
echo'<footer id="footer">
        <div class="container-inner">
        <small><img src="https://topmafia.net/header/images/imageicons/online.png">  <a href="usersonline.php">Online '.$onlinenow.'</a> &nbsp;&nbsp; <img src="https://topmafia.net/header/images/imageicons/offline.png">  <a href="userlist.php">Offline '.$registered.'</a></small><br />  <div class="legal">
            <span style="color:#777;">&copy; Copyright 2020 Top Mafia. All Rights Reserved.</span></div>

        </div>
    </footer>
		 </div>
		 ';
		echo '</body>';
		echo '</html>';
		}
	}
}
?>