<?php

namespace RoundPartner\Conf;

use RoundPartner\Conf\Plugin\File;
use RoundPartner\Conf\Plugin\RemoteFile;
use Symfony\Component\Process\Process;

class PullConf
{

    /**
     * @var string
     */
    protected $workingDirectory;

    public function __construct()
    {
        $this->workingDirectory = __DIR__ . '/../configs';

        if (!file_exists($this->workingDirectory)) {
            if (!mkdir($this->workingDirectory)) {
                throw new \Exception('Failed to create config directory.');
            }
        }

        // realpath has to be run once the folder has been created
        $this->workingDirectory = realpath($this->workingDirectory);

        if (!is_dir($this->workingDirectory)) {
            throw new \Exception('Unable to create config directory because target is not a directory.');
        }
    }

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

        $plugin = new File();
        if ($plugin->pullConfig($config, $this->workingDirectory)) {
            return true;
        }

        $plugin = new RemoteFile();
        if ($plugin->pullConfig($config, $this->workingDirectory)) {
            return true;
        }

        // @todo: change this to return bool
        throw new \Exception('Failed to download configs');
    }
}
