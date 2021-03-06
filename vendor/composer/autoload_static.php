<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit91479cc41f9cba23289e4a9ebf84bc94
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'P4GPNGBKS\\Blocks\\' => 17,
            'P4GPNGBKS\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'P4GPNGBKS\\Blocks\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes/blocks',
        ),
        'P4GPNGBKS\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'P4GPNGBKS\\Blocks\\Base_Block' => __DIR__ . '/../..' . '/classes/blocks/class-base-block.php',
        'P4GPNGBKS\\Blocks\\Test_Block' => __DIR__ . '/../..' . '/classes/blocks/class-test-block.php',
        'P4GPNGBKS\\P4_GPN_GBKS' => __DIR__ . '/../..' . '/classes/class-loader-gpn.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit91479cc41f9cba23289e4a9ebf84bc94::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit91479cc41f9cba23289e4a9ebf84bc94::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit91479cc41f9cba23289e4a9ebf84bc94::$classMap;

        }, null, ClassLoader::class);
    }
}
