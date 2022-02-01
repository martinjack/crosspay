![header](doc/header.png)
# Description

[![Latest Stable Version](https://poser.pugx.org/jackmartin/crosspay/v/stable)](https://packagist.org/packages/jackmartin/crosspay) [![Total Downloads](https://poser.pugx.org/jackmartin/crosspay/downloads)](https://packagist.org/packages/jackmartin/crosspay) [![License](https://poser.pugx.org/jackmartin/crosspay/license)](https://packagist.org/packages/jackmartin/crosspay)

PHP library to work with API [CrossPay](https://crosspay.net/)

> Read this in other language: [English](README.en.md), [Русский](README.md), [Український](README.ua.md)

# Documentation
[API documentation EN](https://docs.crosspay.net/)

[API documentation](https://crosspay.net/api/)

# Requirements
* php 7.2+
* composer

# Composer
```bash
composer require jackmartin/crosspay
```

# Libraries
[Guzzle](https://github.com/guzzle/guzzle)

# Basic methods API
1. Connection setup
    * [__construct](https://github.com/martinjack/crosspay/blob/master/README.en.md#__construct)
2. Payment acceptance
    * [payIn](https://github.com/martinjack/crosspay/blob/master/README.en.md#payment-acceptance)
3. Payment acceptance host-to-host
    * [exchangePayIn](https://github.com/martinjack/crosspay/blob/master/README.en.md#payment-acceptance-host-to-host)
4. Tokenization
    * [cardToken](https://github.com/martinjack/crosspay/blob/master/README.en.md#tokenization)
5. Create payout
    * [createPayout](https://github.com/martinjack/crosspay/blob/master/README.en.md#create-payout)
6. Payout with exchange
    * [exchangePayout](https://github.com/martinjack/crosspay/blob/master/README.en.md#payout-with-exchange)
7. Getting order status
    * [orderStatus](https://github.com/martinjack/crosspay/blob/master/README.en.md#getting-order-status)
8. Transaction History
    * [historyTransactions](https://github.com/martinjack/crosspay/blob/master/README.en.md#transaction-history)
9. Create report
    * [reportCreate](https://github.com/martinjack/crosspay/blob/master/README.en.md#create-report)
10. Get report
    * [reportGet](https://github.com/martinjack/crosspay/blob/master/README.en.md#get-report)
11. Report status
    * [reportStatus](https://github.com/martinjack/crosspay/blob/master/README.en.md#report-status)
12. Balances
    * [balances](https://github.com/martinjack/crosspay/blob/master/README.en.md#balances)
13. Exchange rates
    * [exchangeRates](https://github.com/martinjack/crosspay/blob/master/README.en.md#exchange-rates)
14. Order update
    * [updateOrder](https://github.com/martinjack/crosspay/blob/master/README.en.md#order-update)

# Примеры

### __construct()
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');
```

### Payment acceptance
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->payIn(

        [
            "order_id"              => 'String',
            "currency"              => 'String',
            "wallet_type"           => 'String',
            "amount"                => 'float',
            "payway"                => 'String', //The value is always "card"
            "card_system"           => 'String', //Optional
            "description"           => 'String', //Optional
            "callback"              => 'String', //Optional
            "success_url"           => 'String', //Optional
            "fail_url"              => 'String', //Optional
            "client_email"          => 'String',
            "client_user_agent"     => 'String', //Optional
            "client_id"             => 'String',
            "trusted_user"          => 'int', // 0 | 1 // Optional
        ]

    )->getData()

);
```

### Payment acceptance host-to-host
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->exchangePayIn(

        [
            "amount_to"     => 10.99,
            "order_id"      => "Order-123",
            "currency_to"   => "uah",
            "currency_from" => "uah",
            "wallet_type"   => "ecom",
            "payway"        => "card",
            "client_ip"     => "127.0.0.1",
            "wallet"        => 4000000000000010,
            "expire_month"  => "01",
            "expire_year"   => "2030",
            "cvv"           => "000",
            "browser_info"  => [
                "header_accept"      => "*/*",
                "header_user_agent"  => "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.72 Safari/537.36",
                "language"           => "ua",
                "timezone_offset"    => -180,
                "java_enabled"       => false,
                "screen_color_depth" => 24,
                "screen_height"      => 1080,
                "screen_width"       => 1920,
                "document_width"     => 1862,
                "document_height"    => 481,
            ],
        ]

    )->getData()

);
```

### Tokenization
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->cardToken(

        [
            'order_uuid' => ''
        ]

    )->getData()

);
```

### Create payout
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->createPayout(

        [
            "order_id"      => 'String',
            "currency"      => 'String',
            "wallet_type"   => 'String',
            "wallet"        => 'String',
            "amount"        => 'float',
            "payway"        => 'String', //The value is always "card"
            "description"   => 'String', //Optional
            "callback"      => 'String', //Optional
        ]

    )->getData()

);
```

### Payout with exchange
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->exchangePayout(

        [
            "order_id"         => 'String',
            "currency_from"    => 'String',
            "wallet_from_type" => 'String',
            "currency_to"      => 'String',
            "wallet_to_type"   => 'String',
            "wallet"           => 'String',
            "amount_from"      => 'float', // must be one of amount_from amount_to
            "amount_to"        => 'float', // must be one of amount_from amount_to
            "payway"           => 'String',
            "description"      => 'String', //Optional
            "callback"         => 'String', //Optional
        ]

    )->getData()

);
```

### Getting order status
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->orderStatus(

        [
            'order_id'     => '',
            // 'order_uuid'   => ''
        ]

    )->getData()

);
```

### Transaction History
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->historyTransactions()->getData()

);
```

### Create report
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->reportCreate(['date_from' => '2021-06-17T10:19:43.000Z'])->getData()

);
```

### Get report
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->reportGet(['report_uuid' => '3d1dee42-4ae1-3012-8681-7b62ac7fb240'])->getData()

);
```

### Report status
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->reportStatus(['report_uuid' => '3d1dee42-4ae1-3012-8681-7b62ac7fb240'])->getData()

);
```

### Balances
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->balances()->getData()

);
```

### Exchange rates
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->exchangeRates()->getData()

);
```

### Order update
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Your public key', 'Your private key');

print_r(

    $crosspay->updateOrder(

        [
            "status"  => "success",
            "message" => "",
            "data"    => [[
                "order_id"   => 'String',
                "order_uuid" => 'String',
                "acs_url"    => 'String',
                "pareq"      => 'String',
                "md"         => 'float',
            ]],
        ]

    )->getData()

);
```