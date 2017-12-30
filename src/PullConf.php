<?php

namespace RoundPartner\Conf;

use RoundPartner\Conf\Plugin\PluginInterface;

class PullConf
{

    /**
     * @var PluginInterface[]
     */
    protected $plugins;

    /**
     * @var string
     */
    protected $workingDirectory;

    /**
     * PullConf constructor.
     *
     * @param string $workingDirectory
     * @throws \Exception
     */
    public function __construct($workingDirectory)
    {
        $this->workingDirectory = $workingDirectory;

        if (!file_exists($this->workingDirectory)) {
            $directory = dirname($this->workingDirectory);
            if (!is_writable($directory) || !mkdir($this->workingDirectory)) {
                throw new \Exception('Failed to create config directory.');
            }
        }

        // real path has to be run once the folder has been created
        $this->workingDirectory = realpath($this->workingDirectory);

        if (!is_dir($this->workingDirectory)) {
            throw new \Exception('Unable to create config directory because target is not a directory.');
        }

        $this->plugins = array();
    }

    /**
     * @param string[] $configs
     *
     * @return bool
     * @throws \Exception
     */
    public function pull($configs)
    {
        if (is_string($configs)) {
            $configs = [$configs];
        }

        foreach ($configs as $config) {
            $this->pullConfig($config);
        }

        return true;
    }

    /**
     * @param string $config
     *
     * @return bool
     * @throws \Exception
     */
    private function pullConfig($config)
    {
        if (file_exists($this->workingDirectory . '/' . $config . '.ini')) {
            return true;
        }

        foreach ($this->plugins as $plugin) {
            if ($plugin->pullConfig($config, $this->workingDirectory)) {
                return true;
            }
        }

        // @todo: change this to return bool
        throw new \Exception('Failed to download configs');
    }

    /**
     * @param PluginInterface $plugin
     *
     * @return bool
     */
    public function addPlugin(PluginInterface $plugin)
    {
        $this->plugins[get_class($plugin)] = $plugin;
        return true;
    }
}
