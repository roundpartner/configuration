<?php

class SecureConfTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \RoundPartner\Conf\SecureConf
     */
    protected $instance;

    public function setUp()
    {
        $this->instance = new \RoundPartner\Conf\SecureConf();
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

    public function testGet()
    {
        $this->assertNotEmpty($this->instance->get('test'));
    }

    public function testGetItem()
    {
        $this->assertEquals('test value two', $this->instance->get('test', 'test_key_two'));
    }

}