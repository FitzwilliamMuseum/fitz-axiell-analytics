# Simple Adlib reporting

[![DOI](https://zenodo.org/badge/438250158.svg)](https://zenodo.org/badge/latestdoi/438250158)

A simple application that will provide adlib/axiell/google analytics reporting functions and allows one to search for current object location.

![axiell](https://user-images.githubusercontent.com/286552/164111250-06034927-2c9e-4ee7-92d7-b6f2e9412505.jpg)


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
