<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb7d4b7c0b7a6f9086b5a32461182b467
{
    public static $files = array (
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
        '23c18046f52bef3eea034657bafda50f' => __DIR__ . '/..' . '/symfony/polyfill-php81/bootstrap.php',
        '5897ea0ac4cccf14d323035e65887801' => __DIR__ . '/..' . '/symfony/polyfill-php82/bootstrap.php',
        '8e92226780215d0ec758aa7b73e0ede9' => __DIR__ . '/..' . '/open-telemetry/context/fiber/initialize_fiber_handler.php',
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'c7b4a5d8b94d270f0f9a84f81e1dd63d' => __DIR__ . '/..' . '/open-telemetry/api/Trace/functions.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php82\\' => 23,
            'Symfony\\Polyfill\\Php81\\' => 23,
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
            'PhpOption\\' => 10,
        ),
        'O' => 
        array (
            'OpenTelemetry\\Context\\' => 22,
            'OpenTelemetry\\API\\' => 18,
        ),
        'H' => 
        array (
            'Http\\Promise\\' => 13,
            'Http\\Discovery\\' => 15,
            'Http\\Client\\' => 12,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
            'GrahamCampbell\\ResultType\\' => 26,
        ),
        'E' => 
        array (
            'Elastic\\Transport\\' => 18,
            'Elastic\\Elasticsearch\\' => 22,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php82\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php82',
        ),
        'Symfony\\Polyfill\\Php81\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php81',
        ),
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'PhpOption\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoption/phpoption/src/PhpOption',
        ),
        'OpenTelemetry\\Context\\' => 
        array (
            0 => __DIR__ . '/..' . '/open-telemetry/context',
        ),
        'OpenTelemetry\\API\\' => 
        array (
            0 => __DIR__ . '/..' . '/open-telemetry/api',
        ),
        'Http\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/promise/src',
        ),
        'Http\\Discovery\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/discovery/src',
        ),
        'Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-http/httplug/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'GrahamCampbell\\ResultType\\' => 
        array (
            0 => __DIR__ . '/..' . '/graham-campbell/result-type/src',
        ),
        'Elastic\\Transport\\' => 
        array (
            0 => __DIR__ . '/..' . '/elastic/transport/src',
        ),
        'Elastic\\Elasticsearch\\' => 
        array (
            0 => __DIR__ . '/..' . '/elasticsearch/elasticsearch/src',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'AllowDynamicProperties' => __DIR__ . '/..' . '/symfony/polyfill-php82/Resources/stubs/AllowDynamicProperties.php',
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'CURLStringFile' => __DIR__ . '/..' . '/symfony/polyfill-php81/Resources/stubs/CURLStringFile.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Random\\BrokenRandomEngineError' => __DIR__ . '/..' . '/symfony/polyfill-php82/Resources/stubs/Random/BrokenRandomEngineError.php',
        'Random\\CryptoSafeEngine' => __DIR__ . '/..' . '/symfony/polyfill-php82/Resources/stubs/Random/CryptoSafeEngine.php',
        'Random\\Engine' => __DIR__ . '/..' . '/symfony/polyfill-php82/Resources/stubs/Random/Engine.php',
        'Random\\Engine\\Secure' => __DIR__ . '/..' . '/symfony/polyfill-php82/Resources/stubs/Random/Engine/Secure.php',
        'Random\\RandomError' => __DIR__ . '/..' . '/symfony/polyfill-php82/Resources/stubs/Random/RandomError.php',
        'Random\\RandomException' => __DIR__ . '/..' . '/symfony/polyfill-php82/Resources/stubs/Random/RandomException.php',
        'ReturnTypeWillChange' => __DIR__ . '/..' . '/symfony/polyfill-php81/Resources/stubs/ReturnTypeWillChange.php',
        'SensitiveParameter' => __DIR__ . '/..' . '/symfony/polyfill-php82/Resources/stubs/SensitiveParameter.php',
        'SensitiveParameterValue' => __DIR__ . '/..' . '/symfony/polyfill-php82/Resources/stubs/SensitiveParameterValue.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb7d4b7c0b7a6f9086b5a32461182b467::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb7d4b7c0b7a6f9086b5a32461182b467::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb7d4b7c0b7a6f9086b5a32461182b467::$classMap;

        }, null, ClassLoader::class);
    }
}
