<?php

namespace AltiriaRestClient\Test;

use AltiriaSmsPhpClient\AltiriaClient;
use AltiriaSmsPhpClient\Exception\AltiriaGwException;
use PHPUnit\Framework\TestCase;

class TestAltiriaSmsPhpClientGetCreditHttp extends TestCase
{
    public $login = 'user@altiria.com';
    public $password = 'mypassword';
    public $debug = false;

    /**
     * Basic test
     */
    public function testOk()
    {
        $client = new AltiriaClient($this->login, $this->password);
        $client->setDebug($this->debug);
        $credit = $client-> getCredit();
        
        //Check your credit here           
        //self::assertSame('100.00', $credit);
    }

    /**
     * Invalid credentials
     */
    public function testErrorInvalidCredentials()
    {
        try {
            $client = new AltiriaClient('unknown', $this->password);
            $client->setDebug($this->debug);
            $client-> getCredit();
            $this->fail('AltiriaGwException should have been thrown');
  
        } catch (\AltiriaSmsPhpClient\Exception\AltiriaGwException $exception) {
            self::assertSame('AUTHENTICATION_ERROR', $exception->getMessage());
            self::assertSame('020', $exception->getStatus());
        }
    }
}