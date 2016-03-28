<?php

namespace RoundPartner\Conf;

class SecureConf
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var string
     */
    private $configDirectory;

    /**
     * SecureConf constructor.
     */
    public function __construct()
    {
        $this->configDirectory = dirname(__FILE__) . '/../configs';
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
        if (!$this->loadConfig($heading)
            || !array_key_exists($heading, $this->config)
        ) {
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

    /**
     * @param string $heading
     *
     * @return bool
     */
    private function loadConfig($heading)
    {
        $authConfigFile = $this->configDirectory . '/' . $heading . '.ini';
        if (!file_exists($authConfigFile)) {
            $pullConf = PullConfigFactory::create($this->configDirectory);
            try {
                $pullConf->pull($heading);
            } catch (\Exception $exception) {
                // @todo should we log this error
                return false;
            }
        }

        $config = parse_ini_file($authConfigFile, true);
        $this->config[$heading] = $config[$heading];

        return true;
    }
}
