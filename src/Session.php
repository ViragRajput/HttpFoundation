<?php

namespace Virag\HttpFoundation;

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function getAll(): array
    {
        return $_SESSION;
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function clear(): void
    {
        session_unset();
    }

    public function regenerateId(): void
    {
        session_regenerate_id(true);
    }

    public function sessionId(): string
    {
        return session_id();
    }

    public function isSecure(): bool
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    }

    public function setLifetime(int $lifetime): void
    {
        session_set_cookie_params($lifetime);
    }

    public function setCookieParams(array $params): void
    {
        session_set_cookie_params($params);
    }

    public function isCookieHttpOnly(): bool
    {
        return ini_get('session.cookie_httponly');
    }

    public function isCookieSecure(): bool
    {
        return ini_get('session.cookie_secure');
    }

    public function getCookieParams(): array
    {
        return session_get_cookie_params();
    }

    public function expiryTime(): int
    {
        return time() + ini_get('session.gc_maxlifetime');
    }

    public function isEmpty(): bool
    {
        return empty($_SESSION);
    }

    public function creationTime(): int
    {
        return isset($_SESSION['__creation_time__']) ? $_SESSION['__creation_time__'] : time();
    }

    public function lastAccessTime(): int
    {
        return isset($_SESSION['__last_access_time__']) ? $_SESSION['__last_access_time__'] : time();
    }

    public function isExpired(): bool
    {
        return time() > ($this->creationTime() + ini_get('session.gc_maxlifetime'));
    }

    public function destroy(): void
    {
        session_destroy();
    }

    public function isPersistent(): bool
    {
        return !isset($_SESSION['__session_expires__']);
    }

    public function storagePath(): string
    {
        return session_save_path();
    }

    public function cookieName(): string
    {
        return session_name();
    }

    public function setSavePath(string $path): void
    {
        session_save_path($path);
    }

    public function isCookieSameSite(): bool
    {
        return ini_get('session.cookie_samesite');
    }

    public function sessionIdChanged(): bool
    {
        return session_id() !== $_SESSION['__old_session_id__'];
    }

    public function getOldSessionId(): string
    {
        return $_SESSION['__old_session_id__'] ?? '';
    }

    public function regenerateOldSessionId(): void
    {
        $_SESSION['__old_session_id__'] = session_id();
    }

    public function unsetOldSessionId(): void
    {
        unset($_SESSION['__old_session_id__']);
    }

    public function setName(string $name): void
    {
        session_name($name);
    }

    public function start(): void
    {
        session_start();
    }

    public function setStatus(string $status): void
    {
        session_status($status);
    }

    public function writeClose(): void
    {
        session_write_close();
    }

    public function getCookieDomain(): string
    {
        return ini_get('session.cookie_domain') ?: '';
    }

    public function setCookieDomain(string $domain): void
    {
        ini_set('session.cookie_domain', $domain);
    }

    public function getCookiePath(): string
    {
        return ini_get('session.cookie_path') ?: '/';
    }

    public function setCookiePath(string $path): void
    {
        ini_set('session.cookie_path', $path);
    }

    public function getCookieSecure(): bool
    {
        return ini_get('session.cookie_secure');
    }

    public function setCookieSecure(bool $secure): void
    {
        ini_set('session.cookie_secure', $secure);
    }

    public function getCookieHttpOnly(): bool
    {
        return ini_get('session.cookie_httponly');
    }

    public function setCookieHttpOnly(bool $httpOnly): void
    {
        ini_set('session.cookie_httponly', $httpOnly);
    }
}
