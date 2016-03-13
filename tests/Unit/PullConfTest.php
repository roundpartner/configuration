<?php

class PullConfTest extends PHPUnit_Framework_TestCase
{

    public function testGetConfig()
    {
        $config = new \RoundPartner\Conf\PullConf();
        $this->assertTrue($config->pull('test'));
    }

}