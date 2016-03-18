<?php

class PullConfFactoryTest extends PHPUnit_Framework_TestCase
{

    public function testCreate()
    {
        $this->assertInstanceOf('\RoundPartner\Conf\PullConf', new \RoundPartner\Conf\PullConf());
    }

}
