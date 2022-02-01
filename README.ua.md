![header](doc/header.png)
# Опис

PHP бібліотека для роботи з API [CrossPay](https://crosspay.net/)

> Read this in other language: [English](README.en.md), [Русский](README.md), [Український](README.ua.md)

# Документація

[API documentation EN](https://docs.crosspay.net/)

[API documentation](https://crosspay.net/api/)

# Вимоги
* php 7.2+
* composer

# Composer
```bash
composer require jackmartin/crosspay
```

# Бібліотеки
[Guzzle](https://github.com/guzzle/guzzle)

# Основні методи API
1. Налаштування підключення
    * [__construct]()
2. Прийом платежу
    * [payIn]()
3. Прийом платежу host-to-host
    * [exchangePayIn]()
4. Токенізація
    * [cardToken]()
5. Створення виплат
    * [createPayout]()
6. Виплата з обміном
    * [exchangePayout]()
7. Отримання статусу ордера
    * [orderStatus]()
8. Історія транзакцій
    * [historyTransactions]()
9. Створити звіт
    * [reportCreate]()
10. Отримати звіт
    * [reportGet]()
11. Статус звіту
    * [reportStatus]()
12. Баланси
    * [balances]()
13. Курси обмін
    * [exchangeRates]()
14. Оновлення ордера
    * [updateOrder]()

# Приклади

### __construct()
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');
```

### Прийом платежу
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

print_r(

    $crosspay->payIn(

        [
            "order_id"              => 'String',
            "currency"              => 'String',
            "wallet_type"           => 'String',
            "amount"                => 'float',
            "payway"                => 'String', //Значення завжди "card"
            "card_system"           => 'String', //Необов'язковий
            "description"           => 'String', //Необов'язковий
            "callback"              => 'String', //Необов'язковий
            "success_url"           => 'String', //Необов'язковий
            "fail_url"              => 'String', //Необов'язковий
            "client_email"          => 'String',
            "client_user_agent"     => 'String', //Необов'язковий
            "client_id"             => 'String',
            "trusted_user"          => 'int', // 0 | 1 // Необов'язковий
        ]

    )->getData()

);
```

### Прийом платежу host-to-host
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

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

### Токенізація
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

print_r(

    $crosspay->cardToken(

        [
            'order_uuid' => ''
        ]

    )->getData()

);
```

### Створення виплат
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

print_r(

    $crosspay->createPayout(

        [
            "order_id"      => 'String',
            "currency"      => 'String',
            "wallet_type"   => 'String',
            "wallet"        => 'String',
            "amount"        => 'float',
            "payway"        => 'String', //Значення завжди "card"
            "description"   => 'String', //Необов'язковий
            "callback"      => 'String', //Необов'язковий
        ]

    )->getData()

);
```

### Виплата з обміном
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

print_r(

    $crosspay->exchangePayout(

        [
            "order_id"         => 'String',
            "currency_from"    => 'String',
            "wallet_from_type" => 'String',
            "currency_to"      => 'String',
            "wallet_to_type"   => 'String',
            "wallet"           => 'String',
            "amount_from"      => 'float', // повинен бути один з amount_from amount_to
            "amount_to"        => 'float', // повинен бути один з amount_from amount_to
            "payway"           => 'String',
            "description"      => 'String', //Необов'язковий
            "callback"         => 'String', //Необов'язковий
        ]

    )->getData()

);
```

### Отримання статусу ордера
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

print_r(

    $crosspay->orderStatus(

        [
            'order_id'     => '',
            // 'order_uuid'   => ''
        ]

    )->getData()

);
```

### Історія транзакцій
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

print_r(

    $crosspay->historyTransactions()->getData()

);
```

### Створити звіт
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

print_r(

    $crosspay->reportCreate(['date_from' => '2021-06-17T10:19:43.000Z'])->getData()

);
```

### Отримати звіт
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

print_r(

    $crosspay->reportGet(['report_uuid' => '3d1dee42-4ae1-3012-8681-7b62ac7fb240'])->getData()

);
```

### Статус звіту
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

print_r(

    $crosspay->reportStatus(['report_uuid' => '3d1dee42-4ae1-3012-8681-7b62ac7fb240'])->getData()

);
```

### Баланси
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

print_r(

    $crosspay->balances()->getData()

);
```

### Курси обмін
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

print_r(

    $crosspay->exchangeRates()->getData()

);
```

### Оновлення ордера
```php
require_once 'vendor/autoload.php';

use CrossPay\CrossPay;

$crosspay = new CrossPay('Ваш публічний ключ', 'Ваш секретний ключ');

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