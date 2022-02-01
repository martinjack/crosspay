![header](doc/header.png)
# Описание

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
    * [__construct]()
2. Приём платежа
    * [payIn]()
3. Приём платежа host-to-host
    * [exchangePayIn]()
4. Токенизация
    * [cardToken]()
5. Создание выплаты
    * [createPayout]()
6. Выплата с обменом 
    * [exchangePayout]()
7. Получение статуса ордера
    * [orderStatus]()
8. История транзакций
    * [historyTransactions]()
9. Создать отчёт
    * [reportCreate]()
10. Получить отчёт
    * [reportGet]()
11. Статус отчёта
    * [reportStatus]()
12. Балансы
    * [balances]()
13. Курсы обменов
    * [exchangeRates]()
14. Обновления ордера
    * [updateOrder]()

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