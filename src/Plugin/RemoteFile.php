<?php

namespace RoundPartner\Conf\Plugin;

use Symfony\Component\Process\Process;

class RemoteFile implements PluginInterface
{

    /**
     * @param string $config
     * @param string $workingDirectory
     *
     * @return bool
     */
    public function pullConfig($config, $workingDirectory)
    {
        $command = sprintf('scp alice:/opt/roundpartner/library/rp-conf/configs/%s.ini %s.ini', $config, $config);
        $process = new Process($command, $workingDirectory);
        $process->run();
        if (!$process->isSuccessful()) {
            return false;
        }

        return true;
    }
}
