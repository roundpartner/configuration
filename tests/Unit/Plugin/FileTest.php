<?php

class FileTest extends PHPUnit_Framework_TestCase
{

    public function testConfigExists()
    {
        $workingDirectory = CONFIG_DIR;
        $service = new \RoundPartner\Conf\Plugin\File();
        $this->assertTrue($service->configExists('test', $workingDirectory));
    }

    public function testPullConfig()
    {
        $workingDirectory = CONFIG_DIR;
        $service = new \RoundPartner\Conf\Plugin\File();
        $this->assertTrue($service->pullConfig('test', $workingDirectory));
    }

    public function testPullConfigProcessFails()
    {
        $mock = $this->getProcessMock(false);

        $workingDirectory = CONFIG_DIR;
        $service = new \RoundPartner\Conf\Plugin\File(get_class($mock));
        $this->assertFalse($service->pullConfig('test', $workingDirectory));
    }

    /**
     * @param bool $isSuccessful
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    private function getProcessMock($isSuccessful = true)
    {
        $mock = $this->getMockBuilder('Symfony\Component\Process\Process')
            ->setConstructorArgs(['echo', 'test'])
            ->setMethods(['isSuccessful'])
            ->getMock();
        $mock->expects($this->any())
            ->method('isSuccessful')
            ->willReturn($this->returnValue($isSuccessful));

        return $mock;
    }
}
