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

$user = new Nguyenhiep\BookingLunch\User("111","12345","Dãy 20","WeSave");

//For testing
//$user = new Nguyenhiep\BookingLunch\User("111","12345","Dãy 20","WeSave",null,false);

$page = $user->login();
$user->book_lunch($page);
```


