 # A simple lumen based API for user register, login, CRUD books, CRUD categories
 
 INSTRUCTIONS 
 
 update the .env file 
 
 `DB_PORT=3306`
 
 `DB_DATABASE=Homestead`
 
 `DB_USERNAME=root`
 
 `DB_PASSWORD=`

 Run following commands

 `composer install`
 
 `php artisan migrate`
 
 `php artisan db:seed`
 
 Now to run the application using in built server

 `php -S localhost:8000 -t public`

 API endpoints

 http://localhost:8080/login
 
 http://localhost:8080/register
 
 http://localhost:8080/book?api_token=c93361db6a6c607d4dcff1e2c777906521cc932d
 
 http://localhost:8080/book/1?api_token=c93361db6a6c607d4dcff1e2c777906521cc932d
 
 http://localhost:8080/category?api_token=c93361db6a6c607d4dcff1e2c777906521cc932d
 
 http://localhost:8080/category/1?api_token=c93361db6a6c607d4dcff1e2c777906521cc932d