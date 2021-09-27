<?php
/**
 * Created by PhpStorm.
 * User: Hiệp Nguyễn
 * Date: 27/09/2021
 * Time: 13:44
 */


namespace Nguyenhiep\BookingLunch;


use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BookingServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package
            ->name('booking-lunch')
            ->hasConfigFile();
    }
}