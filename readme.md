
Laravel Vue Bucketlist App
An example To Do App built with Laravel and React. It includes:

An auth API, using tymon/jwt-auth to manage the JSON Web Tokens.
Routing with Vue-router (private, public and split routes).
Feature tests.
A base ApiController to help return standardized responses.
Bootstrap for styling.


Development Environment
This project runs on a WAMP stack (WINDOWS,MySQL, & PHP).

The backend built with Laravel. The frontend is 100% Vue js.


Set Up
Clone the repository:
git clone https://github.com//rasheedalt/Laravel-vue-buckelist-project
Create your environment file:
cp .env.example .env
The app key is used to salt passwords. If you need to work with production data you'll want to use the same app key as defined in the .env file in production so password hashes match.

Update these settings in the .env file:
DB_DATABASE (your local database, i.e. "bucketlist")
DB_USERNAME (your local db username, i.e. "root")
DB_PASSWORD (your local db password, i.e. "")
HASHIDS_SALT (use the app key or match the variable used in production)
Install PHP dependencies:
composer install
If you don't have Composer installed, instructions here.

Generate an app key:
php artisan key:generate
Generate JWT keys for the .env file:
php artisan jwt:secret
Run the database migrations:
php artisan migrate
Install Javascript dependencies:
npm install
If you don't have Node and NPM installed, instructions here.

Run an initial build:
npm run dev

#Bucketlist Api
This Api allows users to create and manage bucketlist and add items to the bucketlist

##Register a user [auth/register]POST

##Login a user [auth/login]POST

##Log a user out [auth/logout]POST

##Create a new bucketlist [/bucketlists]POST
	+ Create an item in a bucketlist [/bucketlists/{id}/item]POST
	+ Fetch all items in a bucketlist [/bucketlists/{id}/items]POST
	+ Edit an item in a bucketlist [/bucketlists/{id}/item]GET
	+ Delete an item in a bucketlist item [/{item_id}]DELETE
##Fetch all the bucketlist for a logged-in user [/bucketlistss]POST

##Fetch a single bucketlist [/bucketlistss]GET

##Edit a bucketlist item[/bucketlists/{id}]POST

##Delete a bucketlist item [/bucketlists/id]DELETE

##Search a bucketlist item with bucketlist name [/bucketlists/q="bucketlist4"]POST

