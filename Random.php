<?php

namespace fw_micro\security;

/**
 * Class Random
 * @package fw_micro\security
 */
class Random
{
    /**
     * @param int $length
     * @return false|string
     */
    public static function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
