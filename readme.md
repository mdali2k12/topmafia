
# app' memo


## current assignement : Sponsor ID on signup & Facebook login

### Sponsor ID on registration

- limit abusive sponsorship of sponsor setting up fake accounts using his own ID using these measures => 
    * ✅ validate sponsor id field
    * ✅ if user id doesnt exist in db then the sponsorship request fails with this feedback message: "The sponsorship ID doesnt exist"
    * ✅ if more than one sponsor request after a successful signup involving any given sponsor happens more than once from the same user-agent/IP combination, then the request fails with this message "Are you trying to cheat the game by referring yourself? If we find out, your IP will be banned!"
    * if a request for sponsorship comes from the IP of the sponsor, then the request fails with this message "Are you trying to cheat the game by referring yourself? If we find out, your IP will be banned!"
    * if user who requests for a sponsor has game data in his local storage, then the request fails
- ✅ store sponsorship into a separate db table
- sponsorship is considered validated when
    * sponsor already has a verified account
    * sponsored user confirms his account
- a sponsorship link can allow to prefill the signup form with the right sponsor ID

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
    Header set Access-Control-Allow-Headers "X-Requested-With, Content-Type, X-Token-Auth, Authorization, X-Content-Type-Options"
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

