<?php

class RemoteFileTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var string
     */
    protected $workingDirectory;

    /**
     * @var \RoundPartner\Conf\Plugin\RemoteFile
     */
    protected $service;
    
    public function setUp()
    {
        $this->workingDirectory = CONFIG_DIR;
        $this->service = new \RoundPartner\Conf\Plugin\RemoteFile();
    }

    public function testGetProcess()
    {
        $process = $this->service->getProcess('test', $this->workingDirectory);
        $this->assertEquals("'scp' 'alice:/opt/roundpartner/library/rp-conf/configs/test.ini' 'test.ini'", $process->getCommandLine());
    }
    
    public function testPullConfig()
    {
        $this->assertTrue($this->service->pullConfig('test', $this->workingDirectory));
    }
}
