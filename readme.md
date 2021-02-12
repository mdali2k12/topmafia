
# app' memo


## current assignement : SPA / test app' live / Facebook login

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

