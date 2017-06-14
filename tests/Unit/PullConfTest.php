<?php

class PullConfTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \RoundPartner\Conf\PullConf
     */
    protected $config;

    public function setUp()
    {
        $mock = $this->getMockBuilder('RoundPartner\Conf\Plugin\File')
            ->setMethods(['pullConfig'])
            ->getMock();
        $mock->expects($this->any())
            ->method('pullConfig')
            ->willReturn($this->returnValue(true));

        $this->cleanConfigFolder();
        $this->config = new \RoundPartner\Conf\PullConf(CONFIG_DIR);
        $this->config->addPlugin($mock);
    }

    public function testGetConfig()
    {
        $this->assertTrue($this->config->pull('test'));
    }

    public function testGetConfigArray()
    {
        $this->assertTrue($this->config->pull(array('db', 'test', 'test')));
    }

    public function testAddPlugin()
    {
        $this->assertTrue($this->config->addPlugin(new \RoundPartner\Conf\Plugin\File(CONFIG_DIR)));
    }

    private function cleanConfigFolder()
    {
        $workingDirectory = CONFIG_DIR;
        if (is_dir($workingDirectory)) {
            $files = scandir($workingDirectory);
            foreach ($files as $file) {
                if (preg_match('/\.ini$/', $file)) {
                    if (!unlink($workingDirectory . '/' . $file)) {
                        throw new \Exception('Failed to unlink config');
                    }
                }
            }
        }
    }
}
