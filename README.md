 A simple lumen based API for user register, login, CRUD books, CRUD categories
 
 INSTRUCTIONS 
 
 update the .env file 
 
 DB_PORT=3306
 
 DB_DATABASE=Homestead
 
 DB_USERNAME=root
 
 DB_PASSWORD=

 Run following commands

 composer install
 
 php artisan migrate
 
 php artisan db:seed
 
 Now to run the application using in built server

 php -S localhost:8000 -t public

