
# app' memo

## current requirement

### user can only be logged in one device at a time 
- given I log into the app' on a device a,
  when I log into the app' on a device b,
  then the session created with my device a login is deleted,
  and a new session is created with my device b login
- given I logged in in Firefox,
  when I log in to the application in Chrome,
  and I reload the page on Firefox,
  then I shouldnt be auto logged in on Firefox
- given I logged in in Firefox,
  when I log in to the application in Chrome,
  and I reload the page on Chrome,
  then I shouldnt be auto logged in on Chrome

### session hijacking protection is implemented
- given I make an HTTP call from the frontend to the "/sessions/{id}" endpoint aiming at verifying or updating my session,
  when my session is verified,
  then the API checks the match between my IP address and the IP address registered for the session,
  and it checks the match between my user agent and the user agent registered for the session,
  and it checks that my access/refresh tokens are not expired,
  and it sends back a success or failure response accordingly

### offline/online users count
- given I make any HTTP call from the frontend to the "/sessions" endpoint, 
  when the response from the API is successful,
  then the count of online/offline players is updated

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

