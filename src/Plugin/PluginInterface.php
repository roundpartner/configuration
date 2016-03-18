<?php

namespace RoundPartner\Conf\Plugin;

interface PluginInterface
{
    /**
     * @param string $config
     * @param string $workingDirectory
     *
     * @return bool
     */
    public function pullConfig($config, $workingDirectory);
}
