
# assignments

## first assignment: refactor login and signup

- **global_func** files should be factorized and should not be duplicated anymore
- ✅ singleton for database connectivity
- routing logic to implement : 
    * ✅ **/** route leads to original **home/index** view
    * ✅ base route redirect should be extracted from globals.php
    * make sure no file in any subfolder can be accessed from the client
    * select most suitable hashing algorithm for usage in strings trait
    * ✅ getting online/offline users on home page
        - test when users register/login funnel ready
    * container login class in home page ?
    * use main tag in home page for semantic readability and SEO
    * handle db connectivity issues
    * improve loading speed
    * home link deactivated on home page
    * optimize images
    * error view to make
    * user can modify his password
    * send SMS's with sendgrid
    * log SendGrid send email error to file & log $response->statusCode(), $response->headers() & $response->body() to file
- implement token-based auth.
- implement forgot password
    * implement a one-time link-based password reset flow
- implement contact functionality
- refactor home.min.js ? https://topmafia.net/home/css/login/lstyle.css ?
- XSS protection 
- CSRF protection
- thorough implementation of https://github.com/PHPMailer/PHPMailer ?
- app' assets protection
- layout file-based views rendering and/or SPA
- implement automated testing
- refactor social auth. with Facebook ?
- define caching policy
- implement dependency injection
- versatile DBMS
- websockets for online/offline users count
- env. switch to disable debug messages when on prod.
- Apache deployment
- implement specific app' user for db and check db credentials on deployment
- dynamic app' footer
- Google Analytics refactoring ?
- WCAG compliance
- GPDR compliance
- fancy email templates

### app' routes

- **/** 
    * home route
- **/users** 
    * route that handles **users** entity, a POST request to that route will create a user
- **/sessions** 
    * route to login and signout a user, a POST request will create a session (e.g. signing the user in), a DELETE request will log out the user (e.g. delete the session)

### localhost on XAMPP
```
<VirtualHost *:80>
    ServerAdmin webmaster@topmafia.net
    DocumentRoot "C:\xampp\htdocs\topmafia\refactored_project"
    ServerName topmafia.net.localhost

    Header set Access-Control-Allow-Origin "*"
    Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"
    Header set Access-Control-Allow-Headers "X-Requested-With, Content-Type, X-Token-Auth, Authorization"
    
    FallbackResource /index.php
    Options -Indexes

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
    <Files .gitignore>
        order allow,deny
        Deny from all
    </Files>

    ErrorLog "logs/topmafia.net-error.log"
    CustomLog "logs/topmafia.net-access.log" common
</VirtualHost>
```

