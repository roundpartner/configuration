<?php

namespace RoundPartner\Conf;

class Service
{

    /**
     * @var SecureConf
     */
    private static $instance;

    /**
     * @param string $heading
     * @param string $option
     *
     * @return bool
     */
    public static function has($heading, $option = null)
    {
        return self::getInstance()->has($heading, $option);
    }

    /**
     * @param string $heading
     * @param string $option
     *
     * @return mixed
     */
    public static function get($heading, $option = null)
    {
        return self::getInstance()->get($heading, $option);
    }

    /**
     * @return SecureConf
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new SecureConf();
        }
        return self::$instance;
    }
}