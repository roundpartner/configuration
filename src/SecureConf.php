<?php

namespace RoundPartner\Conf;

class SecureConf
{
    /**
     * @var array
     */
    private $config;

    private $pullConf;

    /**
     * SecureConf constructor.
     */
    public function __construct()
    {
        $this->config = array();
    }

    /**
     * @param string $heading
     * @param string $option
     *
     * @return bool
     */
    public function has($heading, $option = null)
    {
        $this->loadConfig($heading);

        if (!array_key_exists($heading, $this->config)) {
            return false;
        }
        if ($option !== null && !array_key_exists($option, $this->config[$heading])) {
            return false;
        }
        return true;
    }

    /**
     * @param string $heading
     * @param string $option
     *
     * @return mixed
     */
    public function get($heading, $option = null)
    {
        $this->loadConfig($heading);

        if (!$this->has($heading, $option)) {
            return null;
        }
        if ($option !== null) {
            return $this->getOption($this->config[$heading], $option);
        }
        return $this->config[$heading];
    }

    /**
     * @param array $config
     * @param string $option
     *
     * @return mixed
     */
    private function getOption($config, $option)
    {
        return $config[$option];
    }

    private function loadConfig($heading)
    {
        $authConfigFile = dirname(__FILE__) . '/../configs/' . $heading . '.ini';
        if (!file_exists($authConfigFile)) {
            $pullConf = new PullConf();
            $pullConf->pull($heading);
        }

        $config = parse_ini_file($authConfigFile, true);
        $this->config[$heading] = $config[$heading];
    }
}
