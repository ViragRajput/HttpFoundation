<?php

use PHPUnit\Framework\TestCase;
use ViragHttpFoundation\Cookie;

class CookieTest extends TestCase
{
    public function testSetCookie()
    {
        Cookie::set('test_cookie', 'value');
        $this->assertEquals('value', $_COOKIE['test_cookie']);
    }

    public function testGetCookie()
    {
        $_COOKIE['test_cookie'] = 'value';
        $this->assertEquals('value', Cookie::get('test_cookie'));
    }

    public function testDeleteCookie()
    {
        $_COOKIE['test_cookie'] = 'value';
        Cookie::delete('test_cookie');
        $this->assertNull(Cookie::get('test_cookie'));
    }
}
