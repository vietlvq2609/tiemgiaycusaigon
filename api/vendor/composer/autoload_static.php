<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7cf4b82af60885cc6ed7eeb7ea6e7a77
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7cf4b82af60885cc6ed7eeb7ea6e7a77::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7cf4b82af60885cc6ed7eeb7ea6e7a77::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7cf4b82af60885cc6ed7eeb7ea6e7a77::$classMap;

        }, null, ClassLoader::class);
    }
}
