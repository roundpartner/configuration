<?php

class PullConfTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \RoundPartner\Conf\PullConf
     */
    protected $config;

    public function setUp()
    {
        $testDirectory = '/tmp/configs';

        $this->cleanConfigFolder();
        $this->config = new \RoundPartner\Conf\PullConf(CONFIG_DIR);
        $this->config->addPlugin(new \RoundPartner\Conf\Plugin\File($testDirectory));

        if (!file_exists($testDirectory)) {
            mkdir($testDirectory);
        }
        $data = <<<DATA
[test]
test_key_one='test value two'
test_key_two='test value two'
test_key_three='test value three'
DATA;

        file_put_contents($testDirectory . '/test.ini', $data);
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
