<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2144edbc034f07169eed3dacbcd6539a
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInit2144edbc034f07169eed3dacbcd6539a::$fallbackDirsPsr4;

        }, null, ClassLoader::class);
    }
}
