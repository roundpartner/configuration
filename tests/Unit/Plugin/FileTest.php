<?php

class FileTest extends PHPUnit_Framework_TestCase
{

    public function testPullConfig()
    {
        $service = new \RoundPartner\Conf\Plugin\File();
        $this->assertTrue($service->pullConfig(null, null));
    }
}
