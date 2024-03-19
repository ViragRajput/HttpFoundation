<?php

use PHPUnit\Framework\TestCase;
use ViragHttpFoundation\Response;

class ResponseTest extends TestCase
{
    public function testSendWithDefaultParameters()
    {
        $response = new Response('Hello, World!', 200, ['Content-Type' => 'text/plain']);

        // Start output buffering to capture the output
        ob_start();
        $response->send();

        // Get the captured output and clean the buffer
        $output = ob_get_clean();

        // Perform assertions
        $this->expectOutputString('Hello, World!');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testSetStatusCode()
    {
        $response = new Response();
        $response->setStatusCode(404);
        $this->assertEquals(404, $response->getStatusCode());
    }
}
