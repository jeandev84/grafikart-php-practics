<?php
namespace Tests\Framework\Http\Response;

use Framework\Http\Response\RedirectResponse;
use PHPUnit\Framework\TestCase;

class RedirectResponseTest extends TestCase
{

    public function testStatus()
    {
        $response = new RedirectResponse('/demo');
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testHeader()
    {
        $response = new RedirectResponse('/demo');
        $this->assertEquals(['/demo'], $response->getHeader('Location'));
    }
}
