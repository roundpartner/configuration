<?php

namespace RoundPartner\Conf\Plugin;

use Symfony\Component\Process\Process;

class File implements PluginInterface
{
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
        $process = new Process($command, $workingDirectory);
        $process->run();
        if (!$process->isSuccessful()) {
            return false;
        }

        return true;
    }
}
