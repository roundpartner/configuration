<?php

class RemoteFileTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var string
     */
    protected $workingDirectory;

    /**
     * @var string
     */
    protected $testDirectory;

    /**
     * @var \RoundPartner\Conf\Plugin\RemoteFile
     */
    protected $service;

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

        $this->workingDirectory = CONFIG_DIR;
        $this->service = new \RoundPartner\Conf\Plugin\RemoteFile($this->testDirectory);
    }

    public function testGetProcess()
    {
        $process = $this->service->getProcess('test', $this->workingDirectory);
        $this->assertEquals("'scp' '/tmp/configs/test.ini' 'test.ini'", $process->getCommandLine());
    }

    public function testPullConfig()
    {
        $this->assertTrue($this->service->pullConfig('test', $this->workingDirectory));
    }
}
