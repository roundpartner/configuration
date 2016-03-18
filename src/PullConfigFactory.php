<?php

namespace RoundPartner\Conf;

use RoundPartner\Conf\Plugin\File;
use RoundPartner\Conf\Plugin\RemoteFile;

class PullConfigFactory
{
    /**
     * Create new instance with all plugins loaded
     *
     * @return PullConf
     */
    public static function create()
    {
        $service = new PullConf();
        $service->addPlugin(new File());
        $service->addPlugin(new RemoteFile());
        return $service;
    }
}