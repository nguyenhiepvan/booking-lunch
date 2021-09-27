<?php
/**
 * Created by PhpStorm.
 * User: Hiệp Nguyễn
 * Date: 27/09/2021
 * Time: 11:46
 */

require_once __DIR__ . "/vendor/autoload.php";

use Carbon\Carbon;
use Nguyenhiep\BookingLunch\User;

$user = new User("9743","12345",null,false);
$user->login();