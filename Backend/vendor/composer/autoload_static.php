<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6dac33748b8b81f589b19e9113b591bb
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Valery\\Backend\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Valery\\Backend\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6dac33748b8b81f589b19e9113b591bb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6dac33748b8b81f589b19e9113b591bb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6dac33748b8b81f589b19e9113b591bb::$classMap;

        }, null, ClassLoader::class);
    }
}
