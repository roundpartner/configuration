<?php

class RemoteFileTest extends PHPUnit_Framework_TestCase
{

    public function testPullConfig()
    {
        $workingDirectory = __DIR__ . '/../../../configs';
        $service = new \RoundPartner\Conf\Plugin\RemoteFile();
        $this->assertTrue($service->pullConfig('test', $workingDirectory));
    }
}