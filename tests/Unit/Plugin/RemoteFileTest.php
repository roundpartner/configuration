<?php

class RemoteFileTest extends PHPUnit_Framework_TestCase
{

    public function testPullConfig()
    {
        $service = new \RoundPartner\Conf\Plugin\RemoteFile();
        $this->assertTrue($service->pullConfig(null, null));
    }
}