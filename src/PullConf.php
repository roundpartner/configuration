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

        foreach ($configs as $config) {
            $this->pullConfig($config);
        }

        return true;
    }

    private function pullConfig($config)
    {
        if (file_exists($this->workingDirectory . '/' . $config . '.ini')) {
            return true;
        }

        if (file_exists('/opt/roundpartner/library/rp-conf/configs/' . $config . '.ini')) {
            $command = sprintf('cp /opt/roundpartner/library/rp-conf/configs/%s.ini %s.ini', $config, $config);
            $process = new Process($command, $this->workingDirectory);
            $process->run();
            if ($process->isSuccessful()) {
                return true;
            }
        }

        $command = sprintf('scp alice:/opt/roundpartner/library/rp-conf/configs/%s.ini %s.ini', $config, $config);
        $process = new Process($command, $this->workingDirectory);
        try {
            $process->mustRun();
        } catch(\Exception $exception) {
            throw new \Exception('Failed to download configs');
        }
        return true;
    }

}