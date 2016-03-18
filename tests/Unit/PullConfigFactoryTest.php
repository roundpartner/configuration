<?php

class PullConfFactoryTest extends PHPUnit_Framework_TestCase
{

    private $testDirectory;

    public function setUp()
    {
        $this->testDirectory = CONFIG_DIR . '/test';
    }

    public function testCreate()
    {
        $this->assertInstanceOf('\RoundPartner\Conf\PullConf', \RoundPartner\Conf\PullConfigFactory::create(CONFIG_DIR));
    }

    public function testCreateWithNewFolder()
    {
        \RoundPartner\Conf\PullConfigFactory::create($this->testDirectory);
        rmdir($this->testDirectory);
    }

    public function testCreateWithInvalidFolder()
    {
        $this->setExpectedException('\Exception', 'Failed to create config directory');
        \RoundPartner\Conf\PullConfigFactory::create($this->testDirectory . '/test');
    }

}
