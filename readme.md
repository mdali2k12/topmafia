
# app' memo

## run the project on local environment (guidelines for Windows10)
- prerequisites are:
    * having git installed on your machine
    * having PHP 7.4 installed and configured on your machine
    * having **Composer** installed on your machine (you can get it here => https://getcomposer.org/download/ ) and availabe in your system PATH
    * having MariaDB installed and running on port 3306 on your machine
    * having XAMPP installed on your machine
- replace the contents of the **[xampp_install_directory]\xampp\php\php.ini** file (or create the file if not exists) with the contents of the **php.ini** file that is located at the root of this project
- on your **httpd** configuration file located in **[xampp_install_directory]\xampp\apache\conf** folder, uncomment the line (by removing the **#** character at the start of the line) containing **Include conf/extra/httpd-vhosts.conf**; this is necessary to allow your Apache virtual host to be configured
- at the end of the **[xampp_install_directory]\xampp\apache\conf\extra\httpd-vhosts.conf** file, paste the Apache directives (without the backticks) that you'll find below in this readme
- at the end of the **C:\Windows\System32\drivers\etc** file, add the line ```127.0.0.1 topmafia.net.localhost``` (without any backticks)
- put the the contents of this project into a folder called **topmafia**, which will be located in **[xampp_install_directory]\xampp\htdocs**, DONT WRAP THE FILES IN ANOTHER SUBFOLDER, just put them as they are in the aformentioned **topmafia** folder
- using your MariaDB database manager (like **phpmyadmin**, **DBeaver**, or **HeidiSQL**), run the sql\init_db_dev.sql script to initialize database, MariaDB user, and necessary tables
- replace the ./API/.env file placeholder values with the relevant values corresponding to your environment
    * for Google Recaptcha, you'll need to create a recaptcha V3 validator using this form => https://www.google.com/recaptcha/admin/create , while being connected to your Google account; the domain you'll add will be called **topmafia.net.localhost**; as to the 3 checkboxes at the bottom of the recaptcha creation form, just check the first and the third one and then submit your form; when checking on the settings of your newly created recaptcha, you can get access to the recaptcha keys to copy and paste them at the relevant place in your **.env** file
    * you'll need to follow similar procedures for SendGrid (you can manage your keys your SendGrid keys using https://app.sendgrid.com/settings/api_keys, your SendGrid sender email can be configured here => https://app.sendgrid.com/settings/sender_auth) and Facebook API's 
- with a terminal open at the **API** folder of the project run ```composer install``` to install necessary dependencies
- start your Apache server with XAMPP (and optionally the MySQL one if you use the XAMPP database) and go to **topmafia.net.localhost** in your browser (give me a call if not working)
- to keep on working on the Angular app', go to the **frontend** folder and run ```npm install``` and then ```ng serve --open``` to run the under construction SPA (you must have the Angular cli installed on your system to do this)

## Apache
### localhost on XAMPP
```
<VirtualHost *:80>
    Header Set Access-Control-Allow-Origin "*"
    Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"
    Header set Access-Control-Allow-Headers "json, X-Requested-With, Content-Type, X-Token-Auth, Authorization, X-Content-Type-Options"
    SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1
    ServerAdmin webmaster@topmafia.net
    DocumentRoot "C:\xampp\htdocs\topmafia\API"
    ServerName topmafia.net.localhost
    <Directory "C:\xampp\htdocs\topmafia\API">
        Options -Indexes
        FallbackResource /index.php
    </Directory>
    <FilesMatch "\.(htaccess)$">
        Require all denied
    </FilesMatch>
    <FilesMatch "/.(htaccess)$">
        Require all denied
    </FilesMatch>
    <Files composer.json>
        order allow,deny
        Deny from all
    </Files>
    <Files composer.lock>
        order allow,deny
        Deny from all
    </Files>
    <Files .env>
        order allow,deny
        Deny from all
    </Files>
    <Files .env.private>
        order allow,deny
        Deny from all
    </Files>
    <Files .gitignore>
        order allow,deny
        Deny from all
    </Files>
    ErrorLog "logs/topmafia.net-error.log"
    CustomLog "logs/topmafia.net-access.log" common
</VirtualHost>
```

## API routes
- **/** 
    * home route
- **/apptokens** 
    * endpoint for handling app' tokens
- **/emails** 
    * endpoint for trigerring app' emails (including account verification and reset password)
- **/sessions** 
    * route to login and signout a user, a POST request will create a session (e.g. signing the user in), a DELETE request will log out the user (e.g. delete the session)
- **/users** 
    * route that handles **users** entity, a POST request to that route will create a user


## current workflow : SPA / test app' live / Facebook login
### app' template as SPA
- migrate the revised template into a functional Angular app' divided in subcomponents
    * ✅ auth guard 
    * ✅ favicon to implement
    * ✅ migrate index.html script into Angular app'
        - ✅ migrate slideshow
        - ✅ migrate drawer menu
    * ✅ online/offline players feature
    * refactor login-signup-shell.component.html
        - login form
        - register form
            * ✅ migrate markup and styles
                - ✅ center signup button
                - ✅ migrate signup button font
            * ✅ validate [username, password, confirmPassword, email] are not empty
            * validation feedbacks shows up on the form
                - "Sorry the Username must be between 6 and 15 characters inclusive."
                - "You entered invalid characters in your username Keep it simple."
                - "The Username you entered is in use."
                - "You entered invalid characters in your password."
                - "Your passwords do not match."
                - email has been banned feedback to implement
                - email exists feedback to implement
            * implement recaptcha 
                - validation feedback => "Google says you're a robot 🤖"
            * looping through server validation feedbacks to adapt at controller and form level
            * test user creation
            * sponsorship
                - prefill sponsor ID if $_GET["sponsorid"] exists
                - validation => "Are you trying to cheat the game by referring yourself? If we find out, your IP will be banned!"
            * loading spinner on sending form
    * refactor login-signup-shell.component.scss
        - remove unnecessary code
    * ✅ implement drawer menu navigation routes or simili-routes
    * auth service to populate with actual communication logic with the backend
- migrate the API previous views elements to the newly created Angular app'
- migrate the auto login logic to the Angular app'
    * also implement it after registration
### overall app' testing live
### Facebook login
- needs HTTPS ! therefore we need to deploy app' as is in an online server pointed by a SSL protected domaine name
