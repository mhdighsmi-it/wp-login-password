<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit2cda12274d193c1f2dccbfca78692da9
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit2cda12274d193c1f2dccbfca78692da9', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit2cda12274d193c1f2dccbfca78692da9', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit2cda12274d193c1f2dccbfca78692da9::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
