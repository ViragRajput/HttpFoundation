<?php

namespace ViragHttpFoundation;

class Request
{
    protected $headers;
    protected $parameters;
    protected $method;
    protected $uri;
    protected $path;
    protected $body;

    public function __construct(array $headers = [], array $parameters = [], string $method = 'GET', string $uri ='/', string $body = '')
    {
        $this->headers = $headers;
        $this->parameters = $parameters;
        $this->method = $method;
        $this->uri = $uri;
        $this->path = parse_url($uri, PHP_URL_PATH);
        $this->body = $body;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeader(string $name): ?string
    {
        return $this->headers[$name] ?? null;
    }

    public function getRequestBody(): string
    {
        return $this->body;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function hasParameter(string $name): bool
    {
        return isset($this->parameters[$name]);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getQueryParameters(): array
    {
        return $_GET;
    }

    public function getBodyParameters(): array
    {
        return $_POST;
    }

    public function validateParameters(array $rules): bool
    {
        foreach ($rules as $param => $rule) {
            // Implement validation logic based on $rule
            if (!isset($this->parameters[$param])) {
                return false;
            }
        }
        return true;
    }

    public function getCookies(): array
    {
        return $_COOKIE;
    }

    public function isAjax(): bool
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    public function getScheme(): string
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
    }

    public function getProtocolVersion(): string
    {
        return $_SERVER['SERVER_PROTOCOL'] ?? '';
    }

    public function getUserAgent(): string
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? '';
    }

    public function getMethodLowercase(): string
    {
        return strtolower($this->method);
    }

    public function getReferer(): string
    {
        return $_SERVER['HTTP_REFERER'] ?? '';
    }

    public function getAcceptHeader(): string
    {
        return $_SERVER['HTTP_ACCEPT'] ?? '';
    }

    public function getContentLength(): int
    {
        return isset($_SERVER['CONTENT_LENGTH']) ? (int)$_SERVER['CONTENT_LENGTH'] : 0;
    }

    public function getContentType(): string
    {
        return $_SERVER['CONTENT_TYPE'] ?? '';
    }

    public function getAuthorizationHeader(): string
    {
        return $_SERVER['HTTP_AUTHORIZATION'] ?? '';
    }

    public function getRequestUrl(): string
    {
        return $this->getScheme() . '://' . $_SERVER['HTTP_HOST'] . $this->uri;
    }

    public function getBaseUrl(): string
    {
        return $this->getScheme() . '://' . $_SERVER['HTTP_HOST'];
    }

    public function isSecure(): bool
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    }

    public function isGet(): bool
    {
        return $this->method === 'GET';
    }

    public function isPost(): bool
    {
        return $this->method === 'POST';
    }

    public function isPut(): bool
    {
        return $this->method === 'PUT';
    }

    public function isDelete(): bool
    {
        return $this->method === 'DELETE';
    }

    public function isOptions(): bool
    {
        return $this->method === 'OPTIONS';
    }

    public function isHead(): bool
    {
        return $this->method === 'HEAD';
    }

    public function isPatch(): bool
    {
        return $this->method === 'PATCH';
    }

    public function isMethod(string $method): bool
    {
        return strtoupper($this->method) === strtoupper($method);
    }

    public function isXmlHttpRequest(): bool
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    public function getRefererHost(): string
    {
        return parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) ?? '';
    }

    public function getAcceptedCharsets(): array
    {
        return explode(',', $_SERVER['HTTP_ACCEPT_CHARSET'] ?? '');
    }

    public function getAcceptedLanguages(): array
    {
        return explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '');
    }

    public function getClientIp(): string
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';

        // Check if the client is behind a proxy
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ipAddress;
    }

    public function getRemotePort(): int
    {
        return $_SERVER['REMOTE_PORT'] ?? 0;
    }

    public function isFromLocalhost(): bool
    {
        return in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);
    }
}
