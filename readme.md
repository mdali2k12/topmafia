
# app' memo

## last updates : reset password link
- ✅ user forgot his password, he clicks on link to display the form
- ✅ form is protected by recaptcha
- user inputs his email
- user sends request to API by validating his input
- on the UI, recaptcha disappears and user gets feedback
- API parses request and validates it (recaptcha token + email format + existing account)
- an app' token is generated
- when user receives email and clicks on link containing the token 
    * he's redirected to a form inviting him to update his password 
    * app' token is consumed
- reset password form is validated with feedback to user
- user password is updated

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

