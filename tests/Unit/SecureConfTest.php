<?php

class SecureConfTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \RoundPartner\Conf\SecureConf
     */
    protected $instance;

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

        $plugins = array(
            new \RoundPartner\Conf\Plugin\File($this->testDirectory)
        );
        $this->instance = new \RoundPartner\Conf\SecureConf($plugins);
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('RoundPartner\Conf\SecureConf', $this->instance);
    }

    public function testHas()
    {
        $this->assertTrue($this->instance->has('test'));
    }

    public function testHasItem()
    {
        $this->assertTrue($this->instance->has('test', 'test_key_one'));
    }

    public function testHasNotKey()
    {
        $this->assertFalse($this->instance->has('missing'));
    }

    public function testHasNotItem()
    {
        $this->assertFalse($this->instance->has('test', 'test_key_four'));
    }

    public function testGet()
    {
        $this->assertNotEmpty($this->instance->get('test'));
    }

    public function testGetItem()
    {
        $this->assertEquals('test value two', $this->instance->get('test', 'test_key_two'));
    }

    public function testGetItemNotAvailable()
    {
        $this->assertNull($this->instance->get('test', 'test_key_four'));
    }

    public function testGetItemMissingConfig()
    {
        $this->assertNull($this->instance->get('missing', 'test_key_four'));
    }
}
