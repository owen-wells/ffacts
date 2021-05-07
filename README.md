#FFacts

A laravel single page application to view some win/loss statistics for football leagues. 
Data taken from : (https://www.datahub.io/sports-data/english-premier-league)

## Installation:
Similiar to other laravel projects:

1) Install prerequesites - `npm`, `composer`, `php7.3` and associated `php` packages 

2) Clone the repository

3) set an appropriate `.env` file

4) run `composer install`

5) run `npm install`

6) run `php artisan key:generate`

7) run migrations and seed database (the dump of the dataset by year in json format is included and fed into the database during seeding) with `php artisan migrate` and `php artisan db:seed`

8) (optional) regenerate app.js with `npm run watch`


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
