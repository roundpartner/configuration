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

    public function testCreatePluginAsString()
    {
        $service = \RoundPartner\Conf\PullConfigFactory::create(CONFIG_DIR, ['RoundPartner\Conf\Plugin\File']);
        $this->assertInstanceOf('\RoundPartner\Conf\PullConf', $service);
    }

    public function testCreatePluginAsInstance()
    {
        $instance = new RoundPartner\Conf\Plugin\File();
        $service = \RoundPartner\Conf\PullConfigFactory::create(CONFIG_DIR, [$instance]);
        $this->assertInstanceOf('\RoundPartner\Conf\PullConf', $service);
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

    public function testCreateWithFile()
    {
        $this->setExpectedException('\Exception', 'Unable to create config directory because target is not a directory');
        \RoundPartner\Conf\PullConfigFactory::create(CONFIG_DIR . '/README.md');
    }
}
