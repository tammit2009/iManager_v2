<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf62acc9e425ca0d91b86f5465802c26a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Picqer\\Barcode\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Picqer\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/picqer/php-barcode-generator/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf62acc9e425ca0d91b86f5465802c26a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf62acc9e425ca0d91b86f5465802c26a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf62acc9e425ca0d91b86f5465802c26a::$classMap;

        }, null, ClassLoader::class);
    }
}
