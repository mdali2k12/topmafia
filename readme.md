
# app' memo


## current assignement : SPA / test app' live / Facebook login

### app' template as SPA
- migrate the revised template into a functional Angular app' divided in subcomponents
    * ✅ favicon to implement
    * migrate index.html script into Angular app'
        - ✅ migrate slideshow
        - ✅ migrate drawer menu
    * refactor app.component.html
    * refactor app.comoponent.scss
    * implement drawer menu navigation routes
- migrate the API previous views to the newly created Angular app'

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

