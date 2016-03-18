<?php

class FileTest extends PHPUnit_Framework_TestCase
{

    public function testPullConfig()
    {
        $workingDirectory = CONFIG_DIR;
        $service = new \RoundPartner\Conf\Plugin\File();
        $this->assertTrue($service->pullConfig('test', $workingDirectory));
    }

    public function testPullConfigProcessFails()
    {
        $mock = $this->getMockBuilder('Symfony\Component\Process\Process')
            ->setConstructorArgs(['ls', '/tmp/'])
            ->setMethods(['isSuccessful'])
            ->getMock();
        $mock->expects($this->any())
            ->method('isSuccessful')
            ->willReturn($this->returnValue(false));

        $workingDirectory = CONFIG_DIR;
        $service = new \RoundPartner\Conf\Plugin\File(get_class($mock));
        $this->assertFalse($service->pullConfig('test', $workingDirectory));
    }
}
