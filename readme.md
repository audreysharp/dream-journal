## Dream Journal



### Setup

Clone this repository.

In MAMP, set the project root to the 'public' folder of the project.

The Apache port should be 8888 and the MySQL port 8889.
The database the tables are stored in is named 'app'.
Ensure that you already have or have created a database named 'app'.

Run php artisan:migrate to make the tables for the API.

Point your browser to http://localhost:8888.  This is where you will find the link to the documentation.

You can use any code library or GUI that allows you to make POST requests to interact with the API.