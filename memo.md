
# assignments

## first assignment: refactor login and signup

- **global_func** files should be factorized and should not be duplicated anymore
- ✅ singleton for database connectivity
- routing logic to implement : 
    * **/** route leads to original **home/index** view
    * base route redirect should be extracted from globals.php
    * test that no file in any subfolder can be accessed from the client
    * select most suitable hashing algorithm for usage in strings trait
- implement token-based auth.
- XSS protection 
- CSRF protection
- implement automated testing
- refactor social auth. with Facebook ?
- define caching policy
- implement dependency injection
- Apache deployment
- implement specific app' user for db and check db credentials on deployment

### app' routes

- **/** 
    * home route
- **/users** 
    * route that handles **users** entity, a POST request to that route will create a user
- **/sessions** 
    * route to login and signout a user, a POST request will create a session (e.g. signing the user in), a DELETE request will log out the user (e.g. delete the session)

