<?php

namespace Virag\HttpFoundation;

class UrlGenerator
{
    protected $basePath;

    public function __construct(string $basePath = '/')
    {
        $this->basePath = rtrim($basePath, '/');
    }

    public function generate(string $path): string
    {
        return $this->basePath . '/' . ltrim($path, '/');
    }
}
