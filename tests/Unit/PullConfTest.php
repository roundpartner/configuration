<?php

class PullConfTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \RoundPartner\Conf\PullConf
     */
    protected $config;

    public function setUp()
    {
        $workingDirectory = __DIR__ . '/../../configs';
        $process = new \Symfony\Component\Process\Process('rm -rf configs', dirname($workingDirectory));
        $process->run();

        $this->config = new \RoundPartner\Conf\PullConf();
    }

    public function testGetConfig()
    {
        $this->assertTrue($this->config->pull('test'));
    }

    public function testGetConfigArray()
    {
        $this->assertTrue($this->config->pull(array('db', 'test')));
    }

}