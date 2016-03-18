<?php

class FileTest extends PHPUnit_Framework_TestCase
{

    public function testPullConfig()
    {
        $workingDirectory = CONFIG_DIR;
        $service = new \RoundPartner\Conf\Plugin\File();
        $this->assertTrue($service->pullConfig('test', $workingDirectory));
    }
}
