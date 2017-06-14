<?php

class FileTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var string
     */
    protected $testDirectory;

    public function setUp()
    {
        $this->testDirectory = '/tmp/configs';
        if (!file_exists($this->testDirectory)) {
            mkdir($this->testDirectory);
        }
        $data = <<<DATA
[test]
test_key_one='test value two'
test_key_two='test value two'
test_key_three='test value three'
DATA;

        file_put_contents($this->testDirectory . '/test.ini', $data);
    }

    public function testConfigExists()
    {
        $workingDirectory = CONFIG_DIR;
        $service = new \RoundPartner\Conf\Plugin\File($this->testDirectory);
        $this->assertTrue($service->configExists('test'));
    }

    public function testPullConfig()
    {
        $workingDirectory = CONFIG_DIR;
        $service = new \RoundPartner\Conf\Plugin\File($this->testDirectory);
        $this->assertTrue($service->pullConfig('test', $workingDirectory));
    }

    public function testPullConfigProcessFails()
    {
        $mock = $this->getProcessMock(false);

        $workingDirectory = CONFIG_DIR;
        $service = new \RoundPartner\Conf\Plugin\File($this->testDirectory, get_class($mock));
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
