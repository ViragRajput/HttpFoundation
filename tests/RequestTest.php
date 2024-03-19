<?php

use PHPUnit\Framework\TestCase;
use ViragHttpFoundation\Request;

class RequestTest extends TestCase
{
    protected $request;

    protected function setUp(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer token123'
        ];

        $parameters = [
            'username' => 'john_doe',
            'password' => 'password123'
        ];

        $this->request = new Request($headers, $parameters, 'POST', '/login', 'Some request body');
    }

    public function testGetHeaders(): void
    {
        $this->assertSame([
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer token123'
        ], $this->request->getHeaders());
    }

    public function testGetHeader(): void
    {
        $this->assertSame('application/json', $this->request->getHeader('Accept'));
        $this->assertSame('application/x-www-form-urlencoded', $this->request->getHeader('Content-Type'));
        $this->assertSame('Bearer token123', $this->request->getHeader('Authorization'));
        $this->assertNull($this->request->getHeader('Nonexistent-Header'));
    }

    public function testGetRequestBody(): void
    {
        $this->assertSame('Some request body', $this->request->getRequestBody());
    }

    public function testGetParameters(): void
    {
        $this->assertSame([
            'username' => 'john_doe',
            'password' => 'password123'
        ], $this->request->getParameters());
    }

    public function testHasParameter(): void
    {
        $this->assertTrue($this->request->hasParameter('username'));
        $this->assertTrue($this->request->hasParameter('password'));
        $this->assertFalse($this->request->hasParameter('email'));
    }

    public function testGetMethod(): void
    {
        $this->assertSame('POST', $this->request->getMethod());
    }

    public function testGetUri(): void
    {
        $this->assertSame('/login', $this->request->getUri());
    }

    public function testGetPath(): void
    {
        $this->assertSame('/login', $this->request->getPath());
    }

    public function testGetBody(): void
    {
        $this->assertSame('Some request body', $this->request->getBody());
    }
}
