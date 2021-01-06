<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml" lang="en">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <link rel="shortcut icon" type="image/x-icon" href="https://topmafia.net/favicon.ico">

        <!-- SEO -->
        <title> Top Mafia - Free text based role playing game</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="Join the ultimate battle of becoming the top gangster of your city while experiencing the utmost real life criminal pressure. Do you think your ready to turn your dream into reality? Join the free massively multiplayer mafia text based role playing game and begin your journey.">
        <meta name="keywords" content="mafia, rpg, mafia game, top mafia, text based rpg, rpg, mmorpg">
        <meta name="author" content="Top Mafia Ltd" />
        <link rel="canonical" href="https://www.topmafia.net" />
        <link rel="image_src" href="https://topmafia.net/home/images/backgrounds/newbged.png" />
        <meta property="og:url" content="https://www.topmafia.net/" />
        <meta property="og:title" content="Top Mafia - Free Text Based RPG">
        <meta property="og:site_name" content="Top Mafia - Free Text Based RPG">
        <meta property="og:image" content="https://topmafia.net/home/images/backgrounds/newred.png" />
        <meta property="og:description" content="Join the ultimate battle of becoming the top gangster of your city while experiencing the utmost real life criminal pressure. Do you think your ready to turn your dream into reality? Join the free massively multiplayer mafia text based role playing game and begin your journey." />
        <meta property="site_name" content="Top Mafia" />

        <!-- fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" media="all">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" media="all">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Courgette:400,500,700" media="all">

        <!-- styles -->
        <!-- TODO refactor ? -->
        <link href="./views/css/home.css" media='screen, projection' rel='stylesheet' type='text/css'>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $_ENV["GTAG1"]; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?= $_ENV["GTAG1"]; ?>');
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $_ENV["GTAG2"]; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?= $_ENV["GTAG2"]; ?>');
        </script>

    </head>

    <body>

        <!-- SO template -->
        <div class="contentmainbody2">

            <!-- SO nav -->
            <div class="topbar">
                <div class="nav">
                    <input type="checkbox" id="nav-check"> 
                    <div class="nav-header">
                        <!-- TODO implement online/offline players -->
                        <div class="nav-title">
                            <a href="" class="mainlink3"> <span class="new"><b><span  id="onlinePlayersCount"></span> </b>Online</span></a>
                            <a href="" class="mainlink1"> <span class="new2"><b><span id="playersCount"></span></b> Players</span></a>
                        </div>
                    </div>
                    <div class="nav-links">
                        <div class="dropdown">
                            <button class="dropbtn"><img src="https://topmafia.net/home/images/extra/hamburger.png"></button>
                            <div class="dropdown-content">
                                <a href="/">Home</a>
                                <a href="/game-rules"> Game Rules</a>
                                <a href="/privacy-policy"> Privacy Policy</a>
                                <!-- TODO -->
                                <!-- <a href="contact.php"> Contact Us</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- EO nav -->

            <div style="clear: both;"></div>
            <br /><br />

            <!-- TODO find out what this is used for -->
            <div class="containerlogin"></div>
            <div style="clear: both;"></div>

            <!-- SO main -->
            <div id="content">
                <div style="text-align:left;">
                    <center><h2 class="font">RESET PASSWORD</h2></center>
                    <!-- TODO -->
                    <div id="err">
                        <p>...</p>
                        <br /><br />
                        <center> <a href="/forgot-password">Try Again</a> </center>
                    </div> 
                    <div id="succ">
                        <p>An email was sent to USER_EMAIL with your new password.</p>
                    </div>
                    <form action="forgot_password.php" method="post" name="forgot_password">
                        <label class="font">Email Address</label>
                        <input type="email" id="r_username" name="r_username" class="text-general3" value="" required>
                        <center>
                        <input type="button" class="primary button" onclick="sendForgotPasswordRequest()">
                        </center>
                    </form>
                </div>            
            </div>
            <!-- EO main -->

            <div style="clear: both;"></div>

            <footer id="footer" style="background-color:#111;">
                <div class="container-inner">
                    <div class="legal"><span style="color:#777;">&copy; Copyright 2020 - 2021 Top Mafia. All Rights Reserved.</span></div>
                </div>
            </footer>

        </div>
        <!-- EO template -->

        <!-- dynamic app' URL -->
        <input type="hidden" name="app_url" value="<?=$_ENV['APP_URL'];?>" id="app_url">

        <!-- page scripts -->
        <script src="./views/js/common.js"></script>
        <script src="./views/js/forgot-password/forgot-password.js"></script>

        <!-- TODO 
            * ✅ hide #err & #succ div at page load or set its visibility to hidden before that
            * refactor form
            * request to check if mail provided in form belongs to an existing user
            * if not #err div shows with message "Email is incorrect or invalid!"
            * if so generate a new password and save it to db for this user
            * send the email containing the new password
            * check that email sending process went on without troubles
            * if it did #err div shows with message 
                "There was an issue delivering your email. Please try again later."
            * if it went well sucess div shows with input email
        -->
        
   </body>

</html>