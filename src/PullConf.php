<?php

namespace RoundPartner\Conf;

use Symfony\Component\Process\Process;

class PullConf
{

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

        $configString = '';
        foreach ($configs as $config) {
            $configString.=$this->pullConfig($config);
            $configString.="\n";
        }

        file_put_contents($this->workingDirectory . '/auth.ini', $configString);

        return true;
    }

    private function pullConfig($config)
    {
        if (file_exists($this->workingDirectory . '/' . $config . '.ini')) {
            return file_get_contents($this->workingDirectory . '/' . $config . '.ini');
        }

        $command = sprintf('scp alice:/opt/roundpartner/library/rp-conf/configs/%s.ini %s.ini', $config, $config);
        $process = new Process($command, $this->workingDirectory);
        try {
            $process->mustRun();
        } catch(\Exception $exception) {
            throw new \Exception('Failed to download configs');
        }
        return file_get_contents($this->workingDirectory . '/' . $config . '.ini');
    }

}