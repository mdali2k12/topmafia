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
                                <!-- TODO -->
                                <!-- <a href="forgot_password.php"> Forgot Password </a>  -->
                                <a href="/game-rules"> Game Rules</a>
                                <a href="privacy.html"> Privacy Policy</a>
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
                <div style="text-align:left;" class="desc">
                    <center>
                    <h2 class="font">GAME RULES</h2>
                    </center>
                    <p>Players are only allowed to have one account, owning two or more accounts will result in all accounts being jailed,
                    if you are on the same IP as another player, mail staff and let them know.
                    </p>
                    <br />
                    <p>If a player finds an error with Top Mafia and exploits that error to their advantage, this will result in their account being deleted.</p>
                    <br />
                    <p>You are responsible for whatever happens on your account, don't give out your password to anyone.</p>
                    <br />
                    <p>Accounts are personal on not transferable. They are also not to be sold. Doing so will result in the said account being fed jailed</p>
                    <br />
                    <p>All game items, crystals and cash are property of the Game devlopers, and are not to be sold via means outside of the game. 
                    (Example: Selling items or crystals for real cash via paypal will result in your account being removed from the game)
                    </p>
                    <br />
                    <p>Children play this game, so keep it PG-13. Mild swearing will be permitted, but F-bombing, sexual vulgarities
                    or excessive swearing will result in some time in Fed until you clean up your act.
                    </p>
                    <br />
                    <p>Profile images with nudity, profanity, or otherwise offensive images will be removed, and may result in jail time.</p>
                    <br />
                    <p>We understand that you play other games, but do not advertise them here. You get 1 warning, afterwards its Fed time.</p>
                    <br />
                    <p>Do not spam the staff's mailbox, if you have a problem, message one of us once. They will deal with your problem in a timely
                    manner, but do not mail them repeatedly, or mail multiple staff members.
                    </p>
                    <br />
                    <p>Do not harrass other players, use common sense on this one, if you don't know when your crossing the line from fantasy into
                    harrassment, assume that you are harrassing the other player. This will not be tolerated and will result in a stiff punishment.
                    </p>
                    <br />
                    <p>Scamming will not be tolerated in any manner. Any attempt to scam anyone will result in being jailed for a long long time.</p>
                    <br />
                    <p>If a member of staff is bothering you for any unfair or just plain, weird reason, mail Admin</p>
                    <br />
                    <p>Common sense rules are not posted here, if you can't determine the difference between what is ok, and what is not, you should
                    consider not interacting with other people until you do understand.
                    </p>
                    <br />
                    <p>These rules are subject to change without notice, check them from time to time, as ignorance will not be accepted as an excuse.</p>
                    <br />
                    <p>Staff reserve the right to fed-jail or remove any accounts that are suspected of exploiting the game from leveling or training at levels that are deemed impossible by normal gameplay methods.</p>
                    <br />
                    <p>You are not allowed to use Macros, Auto Clickers, refreshers or any kind of plugin/BOT/script to do anything in the game for you. We monitor this and can easily track it. So if you are caught doing this, you will loose your account.</p>
                    <br />
                    <p>Continued and repeat attacks on the same player is not allowed. (*Rule now hard coded into the game and auto inforced)</p>
                    <br />
                    <p>Blackmailing or bullying lower level or stat players is not allowed.</p>
                    <br />
                    <p>Misleading players to vote against or for players is not allowed. Vote fixing will also be punished and may result it all your votes being removed!</p>
                    <br />
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
        <script src="./views/js/home/home.js"></script>
        
   </body>

</html>