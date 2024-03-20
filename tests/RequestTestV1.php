<?php

use PHPUnit\Framework\TestCase;
use ViragHttpFoundation\Request;

class RequestTestV1 extends TestCase
{
    public function testCreateFromGlobals()
    {
        // Simulating a GET request with some headers
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['HTTP_HOST'] = 'example.com';
        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'en-US,en;q=0.9';
        $_SERVER['QUERY_STRING'] = 'param1=value1&param2=value2';
        $_SERVER['HTTP_X_CUSTOM_HEADER'] = 'Custom Value';
        $_SERVER['CONTENT_LENGTH'] = 0; // Simulating no request body

        // Call the method
        $request = Request::createFromGlobals();

        // Assertions
        $this->assertInstanceOf(Request::class, $request);
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/', $request->getUri());
        $this->assertSame('http://example.com', $request->getSchemeAndHttpHost());
        $this->assertSame('param1=value1&param2=value2', $request->getQueryString());
        $this->assertSame(['param1' => 'value1', 'param2' => 'value2'], $request->getQuery());
        $this->assertSame([], $request->getParameters());
        $this->assertSame([], $request->files());
        $this->assertSame(null, $request->file('nonexistent'));
        $this->assertSame('example.com', $request->getHost());
        $this->assertSame(0, $request->getPort());
        $this->assertSame('', $request->getContent());
    }

    // Add more tests for other methods as needed...
}
