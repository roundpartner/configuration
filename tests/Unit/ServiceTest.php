<?php

class ServiceTest extends PHPUnit_Framework_TestCase
{

    public function testHas()
    {
        $this->assertTrue(\RoundPartner\Conf\Service::has('test', 'test_key_two'));
    }

    public function testGet()
    {
        $this->assertEquals('test value three', \RoundPartner\Conf\Service::get('test', 'test_key_three'));
    }
}
