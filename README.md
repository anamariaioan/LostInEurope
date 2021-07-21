 LostInEurope
===============================================
This library will help you sort the tickets for your vacation.

Setup
-----
#### 1) In your terminal run this command to clone the project:
```bash
git clone https://github.com/anamariaioan/LostInEurope
```

#### 2) Install composer
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

#### 3) Install PHP Unit 9
```bash
composer require --dev phpunit/phpunit ^9
```

#### 4) Run this command to start your local server
```bash
php -S localhost:8000
```

#### 5) Open Postman, use POST method, pass http://localhost:8000/ as the address and use the json files as examples to test the functionality.
The json files are in "tests/json" directory.


Input format
-----

#### The input format should be json, having the following mandatory fields: "transportation_type", "transportation_type" and "destination". The type for all fields must be string.
Please note that the destinations and departures should be unique, otherwise you will encounter and error. Same goes in case one of the mandatory fields is missing.

Output format
-----
#### Like the input, the output format is also json. 
For every valid input, you will receive the list of your sorted tickets, so you can enjoy your vacation.


Unit Tests
-----

#### 1) Run this command to check the unit tests
```bash
./vendor/bin/phpunit tests/
```

___
Please note that this application does not store any data. 
We only work with the input data which we validate and then sort.