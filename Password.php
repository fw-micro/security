<?php

namespace fw_micro\security;

/**
 * Class Password
 * @package fw_micro\security
 */
class Password
{
    /**
     * @param string $password
     * @param int $cost
     * @return false|string|null
     */
    public static function hash(string $password, int $cost = 10)
    {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => $cost]);
    }

    /**
     * @param string $hash
     * @param string $password
     * @return bool
     */
    public static function verify(string $hash, string $password): bool
    {
        return password_verify($hash, $password);
    }

    /**
     * @param string $hash
     * @param string $password
     * @param int $cost
     * @return bool
     */
    public static function needUpdate(string &$hash, string $password, int $cost = 10): bool
    {
        if (self::verify($hash, $password) &&
            password_needs_rehash($hash, PASSWORD_DEFAULT, ['cost' => $cost])
        ) {
            $hash = self::hash($password, $cost);
            return true;
        }

        return false;
    }
}