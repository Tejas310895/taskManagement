## TASK MANAGEMENT API BACKEND SYSTEM

Alows you to make curd operation ('GET','POST','PUT','DELETE') task api's when called for the frontend server with bearer token which can be generated below methods:

## Generate credentials
php spark shield:user create -n userName -e xyz@gmail.com --> will ask for the password provide it and credentials are generated

## Once generated credentials 
http://localhost:8080/auth/jwt -> provide the credentials {"email" : "", "password" : "" } --> will return you the token 

## Once token is generated will be able to make api calls 
In Authorization header Add the bearer token will work fine 

GET - http://localhost:8080/tasks
POST - http://localhost:8080/tasks -> To create post data
PUT - http://localhost:8080/tasks/{id} -> Update with data in request body
DELETE - http://localhost:8080/tasks/{id} -> Delete the record

## Authentication with sheild
## JWT generated with firebase jwt generator