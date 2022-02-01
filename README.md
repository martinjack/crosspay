![header](doc/header.png)
# Описание

[![Latest Stable Version](https://poser.pugx.org/jackmartin/crosspay/v/stable)](https://packagist.org/packages/jackmartin/crosspay) [![Total Downloads](https://poser.pugx.org/jackmartin/crosspay/downloads)](https://packagist.org/packages/jackmartin/crosspay) [![License](https://poser.pugx.org/jackmartin/crosspay/license)](https://packagist.org/packages/jackmartin/crosspay)

PHP библиотека для работы с API [CrossPay](https://crosspay.net/)

> Read this in other language: [English](README.en.md), [Русский](README.md), [Український](README.ua.md)

# Документация

[API documentation EN](https://docs.crosspay.net/)

[API documentation](https://crosspay.net/api/)

# Требования
* php 7.2+
* composer

# Composer
```bash
composer require jackmartin/crosspay
```

# Библиотеки
[Guzzle](https://github.com/guzzle/guzzle)

# Основные методы API
1. Настройка подключения
    * [__construct](https://github.com/martinjack/crosspay#__construct)
2. Приём платежа
    * [payIn](https://github.com/martinjack/crosspay#%D0%BF%D1%80%D0%B8%D1%91%D0%BC-%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%B6%D0%B0)
3. Приём платежа host-to-host
    * [exchangePayIn](https://github.com/martinjack/crosspay#%D0%BF%D1%80%D0%B8%D1%91%D0%BC-%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%B6%D0%B0-host-to-host)
4. Токенизация
    * [cardToken](https://github.com/martinjack/crosspay#%D1%82%D0%BE%D0%BA%D0%B5%D0%BD%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D1%8F)
5. Создание выплаты
    * [createPayout](https://github.com/martinjack/crosspay#%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D0%BD%D0%B8%D0%B5-%D0%B2%D1%8B%D0%BF%D0%BB%D0%B0%D1%82%D1%8B)
6. Выплата с обменом 
    * [exchangePayout](https://github.com/martinjack/crosspay#%D0%B2%D1%8B%D0%BF%D0%BB%D0%B0%D1%82%D0%B0-%D1%81-%D0%BE%D0%B1%D0%BC%D0%B5%D0%BD%D0%BE%D0%BC)
7. Получение статуса ордера
    * [orderStatus](https://github.com/martinjack/crosspay#%D0%BF%D0%BE%D0%BB%D1%83%D1%87%D0%B5%D0%BD%D0%B8%D0%B5-%D1%81%D1%82%D0%B0%D1%82%D1%83%D1%81%D0%B0-%D0%BE%D1%80%D0%B4%D0%B5%D1%80%D0%B0)
8. История транзакций
    * [historyTransactions](https://github.com/martinjack/crosspay#%D0%B8%D1%81%D1%82%D0%BE%D1%80%D0%B8%D1%8F-%D1%82%D1%80%D0%B0%D0%BD%D0%B7%D0%B0%D0%BA%D1%86%D0%B8%D0%B9)
9. Создать отчёт
    * [reportCreate](https://github.com/martinjack/crosspay#%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D1%82%D1%8C-%D0%BE%D1%82%D1%87%D1%91%D1%82)
10. Получить отчёт
    * [reportGet](https://github.com/martinjack/crosspay#%D0%BF%D0%BE%D0%BB%D1%83%D1%87%D0%B8%D1%82%D1%8C-%D0%BE%D1%82%D1%87%D1%91%D1%82)
11. Статус отчёта
    * [reportStatus](https://github.com/martinjack/crosspay#%D1%81%D1%82%D0%B0%D1%82%D1%83%D1%81-%D0%BE%D1%82%D1%87%D1%91%D1%82%D0%B0)
12. Балансы
    * [balances](https://github.com/martinjack/crosspay#%D0%B1%D0%B0%D0%BB%D0%B0%D0%BD%D1%81%D1%8B)
13. Курсы обменов
    * [exchangeRates](https://github.com/martinjack/crosspay#%D0%BA%D1%83%D1%80%D1%81%D1%8B-%D0%BE%D0%B1%D0%BC%D0%B5%D0%BD%D0%BE%D0%B2)
14. Обновления ордера
    * [updateOrder](https://github.com/martinjack/crosspay#%D0%BE%D0%B1%D0%BD%D0%BE%D0%B2%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F-%D0%BE%D1%80%D0%B4%D0%B5%D1%80%D0%B0)

# Примеры

### __construct()
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');
```

### Приём платежа
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

print_r(

    $crosspay->payIn(

        [
            "order_id"              => 'String',
            "currency"              => 'String',
            "wallet_type"           => 'String',
            "amount"                => 'float',
            "payway"                => 'String', //Значение всегда "card"
            "card_system"           => 'String', //Необязательный
            "description"           => 'String', //Необязательный
            "callback"              => 'String', //Необязательный
            "success_url"           => 'String', //Необязательный
            "fail_url"              => 'String', //Необязательный
            "client_email"          => 'String',
            "client_user_agent"     => 'String', //Необязательный
            "client_id"             => 'String',
            "trusted_user"          => 'int', // 0 | 1 // Необязательный
        ]

    )->getData()

);
```

### Приём платежа host-to-host
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

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

### Токенизация
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

print_r(

    $crosspay->cardToken(

        [
            'order_uuid' => ''
        ]

    )->getData()

);
```

### Создание выплаты
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

print_r(

    $crosspay->createPayout(

        [
            "order_id"      => 'String',
            "currency"      => 'String',
            "wallet_type"   => 'String',
            "wallet"        => 'String',
            "amount"        => 'float',
            "payway"        => 'String', //Значение всегда "card"
            "description"   => 'String', //Необязательный
            "callback"      => 'String', //Необязательный
        ]

    )->getData()

);
```

### Выплата с обменом
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

print_r(

    $crosspay->exchangePayout(

        [
            "order_id"         => 'String',
            "currency_from"    => 'String',
            "wallet_from_type" => 'String',
            "currency_to"      => 'String',
            "wallet_to_type"   => 'String',
            "wallet"           => 'String',
            "amount_from"      => 'float', // должен быть один из amount_from amount_to
            "amount_to"        => 'float', // должен быть один из amount_from amount_to
            "payway"           => 'String',
            "description"      => 'String', //Необязательный
            "callback"         => 'String', //Необязательный
        ]

    )->getData()

);
```

### Получение статуса ордера
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

print_r(

    $crosspay->orderStatus(

        [
            'order_id'     => '',
            // 'order_uuid'   => ''
        ]

    )->getData()

);
```

### История транзакций
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

print_r(

    $crosspay->historyTransactions()->getData()

);
```

### Создать отчёт
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

print_r(

    $crosspay->reportCreate(['date_from' => '2021-06-17T10:19:43.000Z'])->getData()

);
```

### Получить отчёт
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

print_r(

    $crosspay->reportGet(['report_uuid' => '3d1dee42-4ae1-3012-8681-7b62ac7fb240'])->getData()

);
```

### Статус отчёта
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

print_r(

    $crosspay->reportStatus(['report_uuid' => '3d1dee42-4ae1-3012-8681-7b62ac7fb240'])->getData()

);
```

### Балансы
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

print_r(

    $crosspay->balances()->getData()

);
```

### Курсы обменов
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

print_r(

    $crosspay->exchangeRates()->getData()

);
```

### Обновления ордера
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публичный ключ', 'Ваш секретный ключ');

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