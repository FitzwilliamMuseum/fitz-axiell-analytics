# Simple Adlib reporting

A simple application that will provide adlib reporting functions.

## Installation

To install this simple laravel application you will need to run the following.

```bash
$ git clone https://github.com/FitzwilliamMuseum/fitz-axiell-analytics.git
$ cd fitz-axiell-analytics
$ composer install
$ php artisan key:generate
$ cp .env.example .env
```
Then edit the .env file with variables (found in password vault as a copy) and install the google services credential file at:

```bash
/storage/app/analytics/service-account-credentials.json
```

This file can be downloaded from our password vault. 

## License

This is licensed under GPLV3 and written by Daniel Pett @portableant