# Bitcoin Price Lumen

Laravel/Lumen Project for Displaying ranged chart for bitcoin Pricing.

# Table of contents
- [Bitcoin Price Lumen](#bitcoin-price-lumen)
- [Table of contents](#table-of-contents)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configurations](#configurations)

# Requirements
- PHP `>= 7.3`
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Composer


# Installation

Run the following Command in your cli.

`git clone ahmedalimahmoud/bitcointPriceLumen`

and then run this Command

`composer install`

and then change .env.example to .env by using this command

`rename .env.example .env`


# Configurations

if you are using localhost folder you need to change APP_URL to your folder path in `.env` file.

- to run the project just run this command

`php -S localhost:8000 -t public/`

# Testing

to run th test run this command.

`.\vendor\bin\phpunit`