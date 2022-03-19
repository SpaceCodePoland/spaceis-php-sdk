# SpaceIs PHP SDK

PHP SDK for SpaceIs.pl's API v3.

Check [SpaceIs documentation](https://docs.spaceis.pl) for API responses.

Class init:
```php
<?php

use SpaceCode\SpaceIs\SpaceIs;

require_once __DIR__ . '/vendor/autoload.php';

$spaceis = new SpaceIs('apiKey', 'apiUrl (optional)');
```

Get user info:
```php
$spaceis->user->me();
```

Servers:
```php
$spaceis->server->getAll();
$spaceis->server->getSpecific('id/slug');
$spaceis->server->getCommands('id', 'serverToken');
$spaceis->server->getLatestBuys('id/slug', '(int) limit, default: 10');
$spaceis->server->getRichest('id/slug', '(int) limit, default: 10');
```

Discount code:
```php
$spaceis->discountCode->get('code');
```

Voucher:
```php
$spaceis->voucher->use('nick', 'code'); //throws VoucherNotFoundException & VoucherUsedException
```

Subpage:
```php
$spaceis->subpage->get('slug');
```

Variant:
```php
$spaceis->variant->get('serverId/slug', 'productId');
```

Transaction:
```php
$spaceis->transaction->init('serverId/slug', 'productId', 'variantId', 'nick', 'method', 'email', '(nullable) additional', '(nullable) discountCodeId');
$spaceis->transaction->info('transactionId', '(bool) extended, default: false');
```