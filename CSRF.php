<?php

namespace fw_micro\security;

/**
 * Class CSRF
 * @package fw_micro\security
 */
class CSRF
{
    private static $key;

    public static function print(): string
    {
        if (self::$key === null) {
            $key = [];
            for ($i = 0; $i < 4; $i++) {
                $key[] = Random::generateRandomString(4);
            }
            self::$key = implode('-', $key);
            $cookieKey = Random::generateRandomString(54);
            setcookie('__csrf', $cookieKey);
            $_SESSION['__csrf'] = self::$key . '_' . $cookieKey;
        }

        return '<input type="hidden" name="__csrf" value="' . self::$key . '"/>';
    }

    public static function validate(): bool
    {
        $csrf = $_POST['__csrf'] ?? $_GET['__csrf'] ?? '';
        $cookieKey = $_COOKIE['__csrf'] ?? '';
        return $_SESSION['__csrf'] === $csrf . '_' . $cookieKey;
    }
}