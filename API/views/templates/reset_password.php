<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml" lang="en">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <link rel="shortcut icon" type="image/x-icon" href="./../../favicon.ico">

        <!-- SEO -->
        <title> Top Mafia - Free text based role playing game</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="Join the ultimate battle of becoming the top gangster of your city while experiencing the utmost real life criminal pressure. Do you think your ready to turn your dream into reality? Join the free massively multiplayer mafia text based role playing game and begin your journey.">
        <meta name="keywords" content="mafia, rpg, mafia game, top mafia, text based rpg, rpg, mmorpg">
        <meta name="author" content="Top Mafia Ltd" />
        <link rel="canonical" href="https://www.topmafia.net" />
        <meta property="og:url" content="https://www.topmafia.net/" />
        <meta property="og:title" content="Top Mafia - Free Text Based RPG">
        <meta property="og:site_name" content="Top Mafia - Free Text Based RPG">
        <meta property="og:image" content="https://topmafia.net/home/images/backgrounds/newred.png" />
        <meta property="og:description" content="Join the ultimate battle of becoming the top gangster of your city while experiencing the utmost real life criminal pressure. Do you think your ready to turn your dream into reality? Join the free massively multiplayer mafia text based role playing game and begin your journey." />
        <meta property="site_name" content="Top Mafia" />

        <link rel="image_src" href="./../assets/images/newbged.png" />

        <!-- fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" media="all">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" media="all">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Courgette:400,500,700" media="all">

        <!-- styles -->
        <!-- TODO refactor ? -->
        <link href="./views/css/common.css" media='screen, projection' rel='stylesheet' type='text/css'>

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

        <!-- GRecaptcha -->
        <script src="https://www.google.com/recaptcha/api.js?render=<?=$_ENV["GRECAPTCHA_SITE_KEY"];?>"></script>

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
                                <a href="/contact"> Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- EO nav -->

            <div style="clear: both;"></div>
            <br /><br />

            
            <div class="templateTopContainer"></div>
            <div style="clear: both;"></div>

            <!-- SO main -->
            <div id="content">
                <div style="text-align:left;">
                    <center><h2 class="font">RESET PASSWORD</h2></center>
                    <div id="err"></div> 
                    <div id="succ"></div>
                    <form>
                        <label class="font" for="password">Password</label>
                        <input type="password" id="password" class="text-general3" required>
                        <label class="font" for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" class="text-general3" required>
                        <center>
                        <input type="button" class="primary button passwordReset" id="pwd_reset_btn" value="Reset password">
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
        <input type="hidden" value="<?=$_ENV["GRECAPTCHA_SITE_KEY"];?>" id="grecaptcha_site_key">

        <!-- setting one-time link data from email as hidden inputs if any -->
        <?php if( 
            isset( $_GET["token"] ) 
            && isset( $_GET["type"] ) 
            && strlen( $_GET["token"] ) > 0
            && strlen( $_GET["type"] ) > 0
        ):?>
            <input type="hidden" id="apptoken" data-token="<?=$_GET['token']?>" data-type="<?=$_GET['type']?>">
        <?php endif ?>
        <?php if( 
            isset( $_GET["userid"] ) 
            && strlen( $_GET["userid"] ) > 0
        ):?>
            <input type="hidden" id="userid" data-userid="<?=$_GET['userid']?>">
        <?php endif ?>

        <!-- page scripts -->
        <script src="./views/js/http.js"></script>
        <script src="./views/js/auth.js"></script>
        <script src="./views/js/common.js"></script>
        <script src="./views/js/reset-password/reset-password.js"></script>

   </body>

</html>