<?php

namespace RoundPartner\Conf;

use RoundPartner\Conf\Plugin\File;
use RoundPartner\Conf\Plugin\RemoteFile;

class PullConfigFactory
{
    /**
     * Create new instance with all plugins loaded
     *
     * @param string $configDirectory
     *
     * @return PullConf
     */
    public static function create($configDirectory)
    {
        $service = new PullConf($configDirectory);
        $service->addPlugin(new File());
        $service->addPlugin(new RemoteFile());
        return $service;
    }
}
