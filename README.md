PHP Developer Test

Example of deploying a test task:
1. git clone https://github.com/yansem/hicaliber-test.git
2. run the command "composer install"
3. run the command "php artisan key:generate"
4. run the command "npm install"
5. create a file with the path "database/database.sqlite"
6. copy the ".env.example" file and name the new file ".env"
7. run the command "php artisan migrate --seed"
8. run the command "php artisan serve"
9. open new terminal window and run the command "npm run dev"
10. application will be accessible in web browser at http://localhost:8000
