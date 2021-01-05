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
                                <a href="terms.html"> Game Rules</a>
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
                <div class="container-inner">
                    <div id="page-index" class="page">

                        <!-- error/success feedbacks -->
                        <div id="err"></div>
                        <div id="succ"></div>
                        <br />

                        <!-- SO tabs -->
                        <div class="tabs">

                            <!-- SO tabs buttons -->
                            <div class="tabs-buttons">
                                <button data-tab="login" class="active">Login</button>
                                <button data-tab="register" class="">Signup</button>
                                <button data-tab="story" class="">Story</button>
                            </div>
                            <!-- EO tabs buttons -->

                            <!-- SO login tab -->
                            <div class="tabs-content active" data-tab="login">
                                <br />
                                <form method="post" autocomplete="off" action="" id="form">
                                    <label class="font">Username</label>
                                    <input type="username" id="username" name="username" class="text-general3" value="">
                                    <br /><br />
                                    <label class="font">Password</label>
                                    <input type="password" autocomplete="current-password" id="password" name="password" class="text-general3" value="">
                                    <center>
                                    <br />
                                    <input type="button" name="action" class="primary button" onclick="javascript:validateLogin();"  value="Log in"></center>
                                </form>
                                <center><a href="https://topmafia.net/home/fbauthenticate.php"><button class="facebook button">Facebook Login</button></a></center>
                            </div>
                            <!-- EO login tab -->

                            <!-- SO register tab -->
                            <div class="tabs-content" data-tab="register">
                                <br />
                                <form method="post" autocomplete="off" action="" name="register" id="register">
                                    <label class="font">Username</label>
                                    <input type="text" id="s_username" name="username" class="text-general3" value="">
                                    <label class="font">Password</label>
                                    <input type="password" autocomplete="new-password" id="s_password" name="password" class="text-general3" value="">
                                    <label class="font">Confirm Password</label>
                                    <input type="password" autocomplete="confirm-password" id="s_cpassword" name="cpassword" class="text-general3" value="">
                                    <label class="font">Email</label>
                                    <input type="email" id="s_email" name="email" class="text-general3" value="">
                                    <label class="font">Gender</label>
                                    <select name="gender" class="text-general3" id="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    </select>
                                    <label class="font">Referral ID</label>
                                    <input type="number" id="s_ref" name="ref" class="text-general3" value="0">
                                    <br /><br />
                                    <center>
                                    <input type="button" name="action" class="primary button" onclick="javascript:validateSignup();" value="Sign up">
                                    </center>
                                </form>
                            </div>
                            <!-- EO register tab -->

                            <!-- SO story tab -->
                            <div class="tabs-content" data-tab="story">
                                <div class="desc">
                                    <p>Join the ultimate battle of becoming the top gangster of your city while experiencing the utmost real life criminal pressure!</p>
                                    <p>Create fear and earn respect in your neighbourhood, operate the largest drug cartels, recruit the best gangsters for your gang and offer protection to the city. It doesn't stop there! Once your on top you can travel in your own private jet and hire the most powerful security team to keep you protected wherever you are. </p>
                                    <p>You can choose to relax under the Miami sun or try your luck at the best casinos of Las Vegas. Anything is possible here at Top Mafia.</p>
                                    <p>There are tons of features & activities to keep you entertained and busy all day!</p>
                                    <p>Do you think your ready to turn your dream into reality? Join the free massively multiplayer mafia text based role playing game and begin your journey!</p>
                                </div>
                            </div>
                            <!-- EO story tab -->

                        </div>
                        <!-- EO tabs -->

                    </div>
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
        <!-- TODO find out what does the first cript below do -->
        <script src="./views/js/home/home.min.8aa9e3ed.js"></script>
        <script src="./views/js/home/home.js"></script>
        
   </body>

</html>