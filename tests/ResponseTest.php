<?php

use PHPUnit\Framework\TestCase;
use ViragHttpFoundation\Response;

class ResponseTest extends TestCase
{
    public function testSend()
    {
        $response = new Response('Test Content', 200, ['Content-Type' => 'text/plain']);

        // Replace header() function with a mock
        $headerMock = $this->getMockBuilder(MockFunction::class)
            ->disableOriginalConstructor()
            ->getMock();
        $headerMock->method('__invoke')
        ->with('Content-Type: text/plain', true, 200);
        $this->overrideFunction('header', $headerMock);

        $this->expectOutputString('Test Content');

        $response->send();
    }

    public function testSetContent()
    {
        $response = new Response();
        $response->setContent('Test Content');
        $this->assertEquals('Test Content', $response->getContent());
    }

    public function testGetStatusCode()
    {
        $response = new Response('', 404);
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testSetStatusCode()
    {
        $response = new Response();
        $response->setStatusCode(404);
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testSetHeader()
    {
        $response = new Response();
        $response->setHeader('Content-Type', 'text/plain');
        $this->assertEquals('text/plain', $response->getHeader('Content-Type'));
    }

    public function testAddHeaders()
    {
        $response = new Response();
        $response->addHeaders(['Content-Type' => 'text/plain', 'X-Custom-Header' => 'Custom']);
        $this->assertEquals('text/plain', $response->getHeader('Content-Type'));
        $this->assertEquals('Custom', $response->getHeader('X-Custom-Header'));
    }

    public function testSetJsonContent()
    {
        $response = new Response();
        $response->setJsonContent(['key' => 'value']);
        $this->assertEquals('{"key":"value"}', $response->getContent());
        $this->assertEquals('application/json', $response->getHeader('Content-Type'));
    }

    public function testSetHtmlContent()
    {
        $response = new Response();
        $response->setHtmlContent('<html><body>Hello</body></html>');
        $this->assertEquals('<html><body>Hello</body></html>', $response->getContent());
        $this->assertEquals('text/html', $response->getHeader('Content-Type'));
    }

    public function testRedirect()
    {
        $response = new Response();
        $response->redirect('/new-location', 301);
        $this->assertEquals(301, $response->getStatusCode());
        $this->assertEquals('/new-location', $response->getHeader('Location'));
    }
}
