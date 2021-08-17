# Multivendor-discount-app

This multi-vendor app allows its users to sell or buy discount codes.
We have three types of entites(admin, merchant, customer) with different access levels in the app.<br />
Here's how it works in general:
- Merchants add their discounts to the app.<br />
- The admin can app approve or reject the discount.<br />
- if the discount is approved by the admin, users can purchase it and receive a discount code.



## Installation

* Download or clone this repository:

* Go to the project directory and then run the following command to install the essential packages using composer:
```
composer install
```

* Copy .env.example file and save it as .env in the same directory (You need config the project using .env file)

* Generate the application key using:
```
 php artisan key:generate
```

* Run the following command to link storage with public directory:
```
php artisan storage:link
```

* Now you need to run the migration command to create database table properly:
```
php artisan migrate
```

and then import the cities in the database to make app works perfectly:
```
php artisan iran:import-cities
```
* Finally run the app using the following command:
```
php artisan serve
```
The app should be running now on : http://127.0.0.1:8000

Thank You so much for your time :)
