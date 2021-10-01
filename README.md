# lunch-booking
booking lunch at erp

# Installation

```
composer require nguyenhiep/lunch_booking:dev-master
npm install @nesk/puphpeteer
```

# Publish config

```
php artisan vendor:publish --tag=booking-lunch-config
```

# Ussage

```php

$user = new Nguyenhiep\BookingLunch\User("111","12345");

//For testing
//$user = new Nguyenhiep\BookingLunch\User("111","12345",false);

$page = $user->login();
$user->book_lunch($page);
```


