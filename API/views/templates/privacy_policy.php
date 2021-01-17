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
                                <a href="/forgot-password"> Forgot Password </a> 
                                <a href="/game-rules"> Game Rules</a>
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
                    <h2 class="font">PRIVACY POLICY</h2>
                </center>
                <p>Top Mafia Limited Privacy Policy</b><br><br></p>
                <p>Top Mafia Game Limited. ("We") are committed to protecting and respecting your privacy.</p>
                <p>This policy (together with our terms of use and any other documents referred to on it) sets out the basis on which any personal data we collect from you, or that you provide to us,
                    will be processed by us. Please read the following carefully to understand our views and practices regarding your personal data and how we will treat it. 
                    For the purpose of any applicable data protection and privacy legislation, the data controller is Top Mafia Game Limited.
                </p>
                <br>
                <b>
                    <p>INFORMATION WE MAY COLLECT FROM YOU</p>
                </b>
                <p>We may collect and process the following data about you:</p>
                <p>Information that you provide by filling in forms on our site(s) topmafia.net, and other sites of Top Mafia Game Limted. 
                    This includes information provided at the time of registering to use our site, subscribing to our service, posting material or requesting further services. 
                    We may also ask you for information when you enter a competition or promotion sponsored by our business partners and when you report a problem with our site.
                </p>
                <p>If you contact us, we may keep a record of that correspondence.</p>
                <p>We may also ask you to complete surveys that we use for research purposes, although you do not have to respond to them.</p>
                <p>Details of transactions you carry out through our site and of the fulfilment of your orders. 
                    Details of your visits to our site including, but not limited to, traffic data, location data,
                    weblogs and other communication data, whether this is required for our own billing purposes or otherwise and the resources that you access.
                </p>
                <p>For some activities, we may ask you to create a username and password and/or to provide other, 
                    non-personal information such as your age, date of birth, gender, and/or game and platform preferences; and, 
                    combine such information with your personal information. In addition, your web browser may transmit certain geographic information or information regarding your computer
                    (capabilities, game data processing, etc.) to Top Mafia Game Limited. 
                    We may use this information to generate aggregate statistics about our user community and may provide such non-personal information to advertisers and/or our partners. 
                    In addition, Top Mafia Game Limited may use such information for security, system integrity (the prevention of hacking, cheats, etc.), or enforcement purposes.
                </p>
                <br>
                <b>
                    <p>IP ADDRESSES AND COOKIES</p>
                </b>
                <p>We may collect information about your computer, including where available your IP address, operating system and browser type, for system administration and to report aggregate information to our partners. 
                    This is statistical data about our users' browsing actions and patterns, and does not identify any individual. For the same reason,
                    we may obtain information about your general internet usage by using a cookie file which is stored on the hard drive of your computer. 
                    Cookies contain information that is transferred to your computer's hard drive. They help us to improve our site and to deliver a better and more personalised service. They enable us:
                </p>
                <p>To estimate our audience size and usage pattern.</p>
                <p>To store information about your preferences, and so allow us to customise our site according to your individual interests.</p>
                <p>To speed up your searches.</p>
                <p>To recognise you when you return to our site.</p>
                <p>You may refuse to accept cookies by activating the setting on your browser which allows you to refuse the setting of cookies. 
                    However, if you select this setting you may be unable to access certain parts of our site. Unless you have adjusted your browser setting so that it will refuse cookies, 
                    our system will issue cookies when you log on to our site.
                </p>
                <br>
                <b>
                    <p>WHERE WE STORE YOUR PERSONAL DATA</p>
                </b>
                <p>The data that we collect from you may be transferred to, and stored at, 
                    a destination outside the European Economic Area ("EEA"). It may also be processed by staff operating outside the EEA who work for us or for one of our suppliers. 
                    Such staff maybe engaged in, among other things, the fulfilment of your order, the processing of your payment details and the provision of support services. 
                    By submitting your personal data, you agree to this transfer, storing or processing. We will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this privacy policy. 
                    All information you provide to us is stored on our secure servers. Any payment transactions will be encrypted using SSL technology. Where we have given you (or where you have chosen) a
                    password which enables you to access certain parts of our site, you are responsible for keeping this password confidential. We ask you not to share a password with anyone.
                </p>
                <p>Unfortunately, the transmission of information via the internet is not completely secure. Although we will do our best to protect your personal data, we cannot guarantee the security of your data 
                    transmitted to our site; any transmission is at your own risk. Once we have received your information, we will use strict procedures and security features to try to prevent unauthorised access.
                </p>
                <br>
                <b>
                    <p>USES MADE OF THE INFORMATION</p>
                </b>
                <p>We use information held about you in the following ways:</p>
                <p>To ensure that content from our site is presented in the most effective manner for you and for your computer.</p>
                <p>To provide you with information,
                    products or services that you request from us or which we feel may interest you, where you have consented to be contacted for such purposes.
                </p>
                <p>To carry out our obligations arising from any contracts entered into between you and us.</p>
                <p>To allow you to participate in interactive features of our service,
                    when you choose to do so.
                </p>
                <p>To notify you about changes to our service.</p>
                <p>To use your personal information for internal marketing, profiling, or demographic purposes,
                    so we can adapt our products and services to better suit your needs. We do this to better understand and serve our customers.
                </p>
                <br>
                <b>
                    <p>DISCLOSURE OF YOUR INFORMATION</p>
                </b>
                <p>We may disclose your personal information to any member of our group, which means our subsidiaries, our ultimate holding company and its subsidiaries.</p>
                <p>We may disclose your personal information to third parties:</p>
                <p>In the event that we sell or buy any business or assets, in which case we may disclose your personal data to the 
                    prospective seller or buyer of such business or assets.
                </p>
                <p>If Top Mafia Game Limited. or substantially all of its assets are acquired by a third party, in which case personal data held
                    by it about its customers will be one of the transferred assets.
                </p>
                <p>If we are under a duty to disclose or share your personal data in order to comply with any legal obligation, 
                    or in order to enforce or apply our terms of use and other agreements; or to protect the rights, property, or safety of Top Mafia Game Limited., our customers, or others. 
                    This includes exchanging information with other companies and organisations for the purposes of fraud protection and credit risk reduction.
                </p>
                <br>
                <b>
                    <p>YOUR RIGHTS</p>
                </b>
                <p>You have the right to ask us not to process your personal data for marketing purposes. We will usually inform you (before collecting your data) if we intend to use your data for such purposes or 
                    if we intend to disclose your information to any third party for such purposes. You can exercise your right to prevent such processing by by contacting us at webmail@topmafia.net.
                </p>
                <p>Our site may, from time to time, 
                    contain links to and from the websites of our partner networks, advertisers and affiliates. If you follow a link to any of these websites, 
                    please note that these websites have their own privacy policies and that we do not accept any responsibility or liability for these policies. 
                    Please check these policies before you submit any personal data to these websites.
                </p>
                <br>
                <b>
                    <p>ACCESS TO INFORMATION</p>
                </b>
                <p>You have the right to access information held about you. Please direct any access request to our Privacy Administrator.</p>
                <br>
                <b>
                    <p>CHANGES TO OUR PRIVACY POLICY</p>
                </b>
                <p>By using this Website, you signify your assent to this Privacy Policy. 
                    If you do not agree to this Privacy Policy, please do not use this site. 
                    This Privacy Policy may change from time to time, so please check back periodically to ensure that you are aware of any changes. 
                    If we make a material change to this Privacy Policy, we will notify you by posting the change on this website or in this Privacy Policy and, if necessary,
                    give you additional choices regarding such change. Your continued use of the Top Mafia Game Limited sites will signify your acceptance of these changes.
                </p>
                <br>
                <b>
                    <p>CONTACT</p>
                </b>
                <p>Questions, comments and requests regarding this privacy policy are welcomed and should be addressed to webmail@topmafia.net.</p>
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
        
   </body>

</html>