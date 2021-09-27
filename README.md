# lunch-booking
booking lunch at erp

# Installation

```
composer require nguyenhiep/lunch_booking
npm install @nesk/puphpeteer
```

# Publish config

```
php artisan vendor:publish --tag=booking-lunch-config
```

# Ussage

```php

$user = new Nguyenhiep\BookingLunch\User("111","12345");
$user->login();
$user->book_lunch()
```
