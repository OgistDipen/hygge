<h1 align="center">Friend Request App - backend</h1>

- Api Documentation can be seen <a href="https://web.postman.co/collections/7260459-7bd15a46-2393-43f8-b9a8-eb6072ea1796?workspace=47235d8d-d049-4496-89fb-2b990306cba7">HERE </a>.
  (Automatic generated in postman) . For Link to work, you must have an account on postman. Otherwise, contact me to
  send screen shots, or something simillar.

Ruuning Locally:

1. Download or clone git project.
2. Configure database parameters in .env file.
3. Run following code in terminal/shell for migrating tables 'users' and 'friend_requests': php artisan migrate
4. (This step is optional) Run following code in terminal/shell for seeding newly created tables: php artisan db:seed

Now you should be all set up for checking out app.

For authentication, I was using this <a href="https://jwt-auth.readthedocs.io/en/develop/">JWT Library </a>.

<h2 align="center">Steps to follow</h2>

<legend>Notes:</legend>
My local address is http://127.0.0.1:8000, so I'l be continuing explanation assuimming your local address is the same, if not, than replace
my address with whatever your's is.

Also I will be using <a href="https://www.postman.com/">Postman</a> application for sending http requests.

<h3>Features</h3>

Sign up will register new user in users table.

1. To Sign up, follow the next proccedure:

Send POST request to http://localhost:8000/api/register
with body form-data parameters: (Example parameters)

    'name'          => 'Monkey D. Luffy',
    'email'         => 'luffy@gmail.com',
    'password'      => 'password'

That's it. You registered a new user.

2. To Sign in (Login), follow the next proccedure:

send POST request to http://localhost:8000/api/login
with body form-data parameters: (Use data of the user you created- my example)

    'email'         => 'luffy@gmail.com',
    'password'      => 'password'

If everything is right, you will be provided with jwt(token).
That token will be used as users Authorization and authentication over the server.

3. You need at least two users to create friend request, so be sure to create them.

4. Once there are at least two users, we can login with one of them (following step 2),
   and send friend request to other user. To do that, follow next proccedure:

send POST request to http://localhost:8000/api/friend-request/send
with Headers parameter: (Example)
Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.  
 eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsI
mlhdCI6MTU5MDUwOTA1OCwiZXhwIjoxNTkwNTEyNjU4LCJuYmYiOjE1OTA1MD
kwNTgsImp0aSI6IkVPRWI3VzQwUTdtTDFmUngiLCJzdWIiOjEsInBydiI6Ijg
3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.Moj0p
XiXiZy3zQYHqyk7UwrgdhGz6rJxhkpNJTHThS4

\*Remember the value of authorization parameter must be "bearer token you've been providede during login".

And with body form-data parameters: (Example)

    'receiver_user_id'      => 2

This will create friend request with data we provided, and it will set request_status to it's default value 'sent'.

5. In order to Answer on friend with request we must logout with the first user.
   To do that, follow the next proccedure:

   send POST request to http://localhost:8000/api/logout
   with Header parameter: Authorization: bearer token you've been provided during login" (same token as for send request proccedure.)

Now, you are logged out of app, and can again login in with different user. Il assume you will login
with the user to whom we've send friend request.

6. After we logged in with second user. We can Accept or Deny friend request.

To deny request send POST request to: http://localhost:8000/api/friend-request/deny/1 this 1 in URL is id of friend-request
with Header parameter: Authorization: bearer token you've been provided during login" (same token as for send request proccedure.)
So if you are the one to whom this request was sent, you will be able to deny it like this, if not you will be provided with error msg.

6. After we logged in with second user. We can Accept or Deny friend request.

To accept request send POST request to: http://localhost:8000/api/friend-request/accept/1 this 1 in URL is id of friend-request
with Header parameter: Authorization: bearer token you've been provided during login" (same token as for send request proccedure.)
So if you are the one to whom this request was sent, you will be able to accept it like this, if not you will be provided with error msg.

_Note: User can accept or deny friend request only if the status of friend request is 'sent'. If the status is equal to
'deny' or 'accepted', user will not be able to change it. (That functionality is not implemented).
Also if the request from user with id 1 to id 2 was sent, once it is accepted or declined, it will not be
possible for user to send the friend request to the same user again._
<br/><br/>

<hr />

Best regards, <br/>
Antonije Ljubisa
