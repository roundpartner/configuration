<?php

namespace RoundPartner\Conf;

class PullConfigFactory
{
    /**
     * Create new instance with all plugins loaded
     *
     * @param string $configDirectory
     * @param PluginInterface[] $plugins
     *
     * @return PullConf
     */
    public static function create($configDirectory, $plugins = ['RoundPartner\Conf\Plugin\File', 'RoundPartner\Conf\Plugin\RemoteFile'])
    {
        $service = new PullConf($configDirectory);
        foreach ($plugins as $plugin) {
            if (is_string($plugin)) {
                $service->addPlugin(new $plugin());
            } else {
                $service->addPlugin($plugin);
            }
        }
        return $service;
    }
}
