<?php

namespace fw_micro\security;

/**
 * Class AES
 * @package fw_micro\security
 */
class AES
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $cipher = "aes-128-gcm";

    /**
     * @var string
     */
    private $iv;

    /**
     * @var null
     */
    private $tag;

    /**
     * AES constructor.
     * @param string $key
     * @param string|null $iv
     * @param null $tag
     */
    public function __construct(string $key, string $iv = null, $tag= null)
    {
        $this->key = $key;
        if ($iv === null) {
            $ivlen = openssl_cipher_iv_length($this->cipher);
            $this->iv = openssl_random_pseudo_bytes($ivlen);
        } else {
            $this->iv = $iv;
        }
        $this->tag = $tag;
    }

    /**
     * @param string $text
     * @return false|string
     */
    public function encrypt(string $text)
    {
        $this->tag = null;
        return openssl_encrypt($text, $this->cipher, $this->key, 0, $this->iv, $this->tag);
    }

    /**
     * @param string $text
     * @return false|string
     */
    public function decrypt(string $text)
    {
        return openssl_decrypt($text, $this->cipher, $this->key, 0, $this->iv, $this->tag);
    }

    /**
     * @return null
     */
    public function getIv()
    {
        return $this->iv;
    }

    /**
     * @return null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param int $length
     * @return string
     */
    public function generateKey(int $length = 256): string
    {
        return openssl_random_pseudo_bytes($length);
    }
}