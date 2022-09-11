## Installation Guid
- Download the Project 
- Install Composer 
- Create .env file in root folder
- Generate app_key using php artisan key:generate
- Update APP_URL as your base url
- Create Database Connection update .env
- You can run the tests using - php artisan test

## API Docs
- Visit baseUrl/docs (Ex - http://localhost:8000/docs)- it will show api documets on your browser
- Documents are generated using knuckleswtf/scribe

## Technologies Used
- Laravel 9
- PHP 8.1
- MySql

## Database Migration and Seeding Data
- php artisan migrate --seed (it will create db tables and seed sample data)

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
