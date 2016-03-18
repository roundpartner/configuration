<?php

namespace RoundPartner\Conf\Plugin;

class File implements PluginInterface
{

    /**
     * @var string
     */
    protected $processRunner;

    /**
     * File constructor.
     *
     * @param string $processRunner
     */
    public function __construct($processRunner = 'Symfony\Component\Process\Process')
    {
        $this->processRunner = $processRunner;
    }

    /**
     * @param string $config
     * @param string $workingDirectory
     *
     * @return bool
     */
    public function pullConfig($config, $workingDirectory)
    {
        if (!file_exists('/opt/roundpartner/library/rp-conf/configs/' . $config . '.ini')) {
            return false;
        }

        $command = sprintf('cp /opt/roundpartner/library/rp-conf/configs/%s.ini %s.ini', $config, $config);

        return $this->callProcess($command, $workingDirectory);
    }

    /**
     * @param string $command
     * @param string $workingDirectory
     *
     * @return bool
     */
    private function callProcess($command, $workingDirectory)
    {
        $process = new $this->processRunner($command, $workingDirectory);
        $process->run();
        if (!$process->isSuccessful()) {
            return false;
        }

        return true;
    }
}
