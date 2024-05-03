<?php

namespace Virag\HttpFoundation;

class Cookie
{
    public static function set(string $name, string $value, int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = true): void
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }

    public static function get(string $name)
    {
        return $_COOKIE[$name] ?? null;
    }

    public static function delete(string $name, string $path = '/', string $domain = ''): void
    {
        // Set cookie with expiration in the past to delete it
        setcookie($name, '', time() - 3600, $path, $domain);
    }

    public static function has(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }

    public static function getAll(): array
    {
        return $_COOKIE;
    }

    public static function clear(): void
    {
        foreach ($_COOKIE as $name => $value) {
            self::delete($name);
        }
    }

    public static function setWithDefaultOptions(string $name, string $value): void
    {
        // Set cookie with default options
        self::set($name, $value, 0, '/', '', false, true);
    }

    public static function setEncrypted(string $name, string $value, string $encryptionKey): void
    {
        // Encrypt the value before setting it as a cookie
        $encryptedValue = self::encrypt($value, $encryptionKey);
        self::setWithDefaultOptions($name, $encryptedValue);
    }

    public static function getDecrypted(string $name, string $encryptionKey)
    {
        // Get the encrypted value from the cookie and decrypt it
        $encryptedValue = self::get($name);
        if ($encryptedValue !== null) {
            return self::decrypt($encryptedValue, $encryptionKey);
        }
        return null;
    }

    private static function encrypt(string $value, string $key): string
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($value, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    private static function decrypt(string $encryptedValue, string $key): string
    {
        list($encryptedData, $iv) = explode('::', base64_decode($encryptedValue), 2);
        return openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);
    }
}
