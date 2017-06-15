<?php

namespace RoundPartner\Conf\Plugin;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class RemoteFile implements PluginInterface
{
    const REMOTE_CONFIG_PATH = 'alice:/opt/roundpartner/library/rp-conf/configs';
    const CONFIG_SUFFIX = '.ini';
    const COMMAND_PREFIX = 'scp';

    /**
     * @var string
     */
    protected $remoteDirectory;

    /**
     * @param string $remoteDirectory
     */
    public function __construct($remoteDirectory = self::REMOTE_CONFIG_PATH)
    {
        $this->remoteDirectory = $remoteDirectory;
    }

    /**
     * @param string $config
     * @param string $workingDirectory
     *
     * @return bool
     */
    public function pullConfig($config, $workingDirectory)
    {
        if (!is_dir($workingDirectory)) {
            return false;
        }
        $process = $this->getProcess($config, $workingDirectory);
        $process->run();
        if (!$process->isSuccessful()) {
            return false;
        }

        return true;
    }

    /**
     * @param string $config
     * @param string $workingDirectory
     *
     * @return Process
     */
    public function getProcess($config, $workingDirectory)
    {
        $builder = new ProcessBuilder();
        $arguments = [
            $this->remoteDirectory . '/' . $config . self::CONFIG_SUFFIX,
            $config . self::CONFIG_SUFFIX
        ];

        return $builder
            ->setWorkingDirectory($workingDirectory)
            ->setPrefix(self::COMMAND_PREFIX)
            ->setArguments($arguments)
            ->getProcess();
    }
}
