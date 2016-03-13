<?php

namespace RoundPartner\Conf;

class PullConf
{

    public function pull($configs)
    {
        if (is_string($configs)) {
            $configs = [$configs];
        }

        $directory = __DIR__ . '/../configs';

        if (!file_exists($directory)) {
            mkdir($directory);
        }
        file_put_contents($directory . '/auth.ini', "[test]\ntest_key_one='test value two'\ntest_key_two='test value two'\ntest_key_three='test value three'");

        return true;
    }
}