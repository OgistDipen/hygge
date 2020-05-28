<div style="text-align:justify">
<h1 align="center">Friend Request App - backend</h1>

- Api Documentation can be seen <a  href="https://web.postman.co/collections/7260459-7bd15a46-2393-43f8-b9a8-eb6072ea1796?workspace=47235d8d-d049-4496-89fb-2b990306cba7" target="_blank">HERE </a>.
  (Generated in postman) . For Link to work, you must have an account on postman. Otherwise, contact me to
  send screen shots, or something simillar.

Running App Locally:

1. Download or clone git project.
2. Create .env file in src folder and configure database parameters.

this is my .env file on local machine (sharing this kind of info is fine in this situation.):

        APP_NAME=Laravel
        APP_ENV=local
        APP_KEY=base64:m0W15G/sD1uazI99c5EWX8/XXaW9AzwXiCyjG4JNGps=
        APP_DEBUG=true
        APP_URL=http://localhost

    	LOG_CHANNEL=stack

    	DB_CONNECTION=mysql
    	DB_HOST=127.0.0.1
    	DB_PORT=3306
    	DB_DATABASE=hygge
    	DB_USERNAME=root
    	DB_PASSWORD=luffy9

    	BROADCAST_DRIVER=log
    	CACHE_DRIVER=file
    	QUEUE_CONNECTION=sync
    	SESSION_DRIVER=file
    	SESSION_LIFETIME=120

    	REDIS_HOST=127.0.0.1
    	REDIS_PASSWORD=null
    	REDIS_PORT=6379

    	MAIL_MAILER=smtp
    	MAIL_HOST=smtp.mailtrap.io
    	MAIL_PORT=2525
    	MAIL_USERNAME=null
    	MAIL_PASSWORD=null
    	MAIL_ENCRYPTION=null
    	MAIL_FROM_ADDRESS=null
    	MAIL_FROM_NAME="${APP_NAME}"

    	AWS_ACCESS_KEY_ID=
    	AWS_SECRET_ACCESS_KEY=
    	AWS_DEFAULT_REGION=us-east-1
    	AWS_BUCKET=

    	PUSHER_APP_ID=
    	PUSHER_APP_KEY=
    	PUSHER_APP_SECRET=
    	PUSHER_APP_CLUSTER=mt1

    	MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    	MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

    	JWT_SECRET=RbJp1xN3qSelSUil81zikAgHdRLEp0LtuSs8VoB9zuuuxnam0rukNmRKnuoBpTlMySnCSQYsxiL9iMhXfMYLNxwzrR09CAMptY46vomHmGZ6lAvRFadakrM7H9zEgJOl

3. navigate into src folder and run command for installing dependencies:

   composer install

\* Note, it's neccesery for you to have following folders in you laravel app(in this care src folder):

    src
        storage
            framework
                views
                cache
                sessions

    If any of the folders in framework folder is missing, create it mannualy.

3. (Optional) run: <br />
   php artisan migrate <br />
   php artisan db:seed

Now you should be all set up for checking out app.

Start app by: php artisan serve

<br />
<hr />

<h3>Docker instructions </h3>
<br />

1. download or clone git project
2. Go into src folder and create .env file.
   Configure it according to docker-compose.yml file

My working example is as follows (yours should be the same).

        APP_NAME=Laravel
        APP_ENV=local
        APP_KEY=base64:m0W15G/sD1uazI99c5EWX8/XXaW9AzwXiCyjG4JNGps=
        APP_DEBUG=true
        APP_URL=http://localhost

    	LOG_CHANNEL=stack

    	DB_CONNECTION=mysql
    	DB_HOST=mysql
    	DB_PORT=3306
    	DB_DATABASE=hygge
    	DB_USERNAME=root
    	DB_PASSWORD=secret

    	BROADCAST_DRIVER=log
    	CACHE_DRIVER=file
    	QUEUE_CONNECTION=sync
    	SESSION_DRIVER=file
    	SESSION_LIFETIME=120

    	REDIS_HOST=127.0.0.1
    	REDIS_PASSWORD=null
    	REDIS_PORT=6379

    	MAIL_MAILER=smtp
    	MAIL_HOST=smtp.mailtrap.io
    	MAIL_PORT=2525
    	MAIL_USERNAME=null
    	MAIL_PASSWORD=null
    	MAIL_ENCRYPTION=null
    	MAIL_FROM_ADDRESS=null
    	MAIL_FROM_NAME="${APP_NAME}"

    	AWS_ACCESS_KEY_ID=
    	AWS_SECRET_ACCESS_KEY=
    	AWS_DEFAULT_REGION=us-east-1
    	AWS_BUCKET=

    	PUSHER_APP_ID=
    	PUSHER_APP_KEY=
    	PUSHER_APP_SECRET=
    	PUSHER_APP_CLUSTER=mt1

    	MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    	MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

    	JWT_SECRET=RbJp1xN3qSelSUil81zikAgHdRLEp0LtuSs8VoB9zuuuxnam0rukNmRKnuoBpTlMySnCSQYsxiL9iMhXfMYLNxwzrR09CAMptY46vomHmGZ6lAvRFadakrM7H9zEgJOl

        3. go back to hygge folder and:

            docker-compose build
            docker-compose up -d


            server is running on localhost:8080 port
            phpmyadmin is running on localhost:8899 port
            mysql is on 4306 port


        4. go into src folder and install dependencies:

            composer install

        5. Fix storage permission problem with:

            chmod -R guo+w storage

        6. Log into phpmyadmin container

            go to  http://localhost:8899

            credentials:
                phpmyadmin server: 172.17.0.1:4306
                phpmyadmin username: root
                phpmyadmin password: secret

        7. bash into php container - migrate and seed database;

            to bash:
            docker exec -it php /bin/sh

            then,

            php artisan migrate
            php artisan db:seed


            If you encounter any problem, try this solution:

            php artisan config:clear
            php artisan cache:clear

            and after that try again

            php artisan migrate:refresh
            php artisan db:seed



    		Now go to localhost:8080 and app will be app and running. Check functionality via postman.

<br />
<hr />
<h2 align="center">App Functionality - Steps to follow</h2>
<br />

For authentication, I was using this <a href="https://jwt-auth.readthedocs.io/en/develop/">JWT Library </a>.

<legend>Notes:</legend>
My local address is http://127.0.0.1:8000, so I'l be continuing explanation assuimming your local address is the same, if not, than replace my address with whatever yours is. In docker, address is set to localhost:8080.

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

Remember the value of authorization parameter must be "bearer token you've been providede during login".

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

To accept request send POST request to: http://localhost:8000/api/friend-request/accept/1 this 1 in URL is id of friend-request
with Header parameter: Authorization: bearer token you've been provided during login" (same token as for send request proccedure.)
So if you are the one to whom this request was sent, you will be able to accept it like this, if not you will be provided with error msg.

_Note: User can accept or deny friend request only if the status of friend request is 'sent'. If the status is equal to
'dennied' or 'accepted', user will not be able to change it, I tought that would be the best for purpose of this examination.
Also if the request from user with id 1 to id 2 was sent, once it is accepted or declined, it will not be
possible for user to send the friend request to the same user again._
<br/><br/>

<hr />

Best regards, <br/>
Antonije Ljubisa

</div>
