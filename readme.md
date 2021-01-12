
# app' memo

## last updatesa 

### account verification with one-time link
- ✅ user has a "verified" field in db, which is a boolean set to false by default
- ✅ an apptokens table exists in db, containing a verifiedAt, a token, a type, and a userId field
- ✅ on signup, an account verification token linked to the new user is created and stored in apptokens entity
- an email object is configured with below data
    * AddReplyTo                         => "webmail@topmafia.net", "Top Mafia" 
    * SetFrom                            => "webmail@topmafia.net", "Top Mafia" 
    * AddAddressTo                       => $to parameter
    * Subject                            => "Your login details for Top Mafia!"
    * template with necessary parameters => 
        ```html
            <html>
                <body>
                    <h2>Your login details for Top Mafia!</h2>
                    <p>Your username is <strong>".$username."</strong></p>
                    <p>Your password is <strong>".$password."</strong> </p>
                    <p>Email verification code <strong> ".$accountVerificationToken."</strong></p>- head back to <a href='https://www.topmafia.net/'>Top Mafia</a></p>
                </body>
            </html> 
        ```
- this email is sent to the user who just signed up
- when the user clicks on the link in the email a request hits a /apptokens endpoint with a GET request that contains the verification token as a query string
- the query string is then parsed by the API for validation
- if validation passes, the "verified" in the users table is set to true for the new user and the "verifiedAt" field of the token record is also set to 
- if validation doesnt pass then 
- in the meantime, user lands on a view that shows the outcome of the operation
- in the UI, user is thanked for having verified and auto logged in
- in the UI, user is invited to be resent an account verification link if operation fails; on click of button outcome of resending the email appears as a feedback

## app' routes

- **/** 
    * home route
- **/passwords** 
    * current route for password reset flow
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
    Header set Access-Control-Allow-Headers "X-Requested-With, Content-Type, X-Token-Auth, Authorization, X-Content-Type-Options"
    SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1

    ServerAdmin webmaster@topmafia.net
    DocumentRoot "C:\xampp\htdocs\topmafia\refactored_project"
    ServerName topmafia.net.localhost

    <Directory "C:\xampp\htdocs\topmafia\refactored_project">
        Options -Indexes
        Options FollowSymLinks
        AllowOverride All
        Order allow,deny
        Allow from all
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

