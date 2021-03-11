<?php

namespace Helpers;

class Logger
{
    public static function log(string $message, $bold = false)
    {
        if (defined('PHPUNIT_COMPOSER_INSTALL') || defined('__PHPUNIT_PHAR__') || defined('TEST_MODE')) {
            return;
        }

        if ($message && $bold) {
            echo "<br><strong>{$message}</strong><br>";
        } else if ($message) {
            echo "{$message}<br>";
        }
    }
}
