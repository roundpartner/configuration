<?php

class PullConfTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \RoundPartner\Conf\PullConf
     */
    protected $config;

    public function setUp()
    {
        $this->cleanConfigFolder();
        $this->config = new \RoundPartner\Conf\PullConf();
    }

    public function testGetConfig()
    {
        $this->assertTrue($this->config->pull('test'));
    }

    public function testGetConfigArray()
    {
        $this->assertTrue($this->config->pull(array('db', 'test', 'test')));
    }

    private function cleanConfigFolder()
    {
        $workingDirectory = __DIR__ . '/../../configs';
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
