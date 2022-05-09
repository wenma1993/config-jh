<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\ConfigJh;

use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;

class Client implements ClientInterface
{
    /**
     * @var ConfigInterface
     */
    private $config;

    public function __construct(ContainerInterface $container)
    {
        $this->config = $container->get(ConfigInterface::class);
    }

    public function pull(): array
    {
        $config = [];
        $this->config->get("app_name");
        $confUrl = $this->config->get("conf_url");
        $appName =  $this->config->get("app_name");
        $appEnv = $this->config->get("app_env");
        if ($confUrl && function_exists('jhcurl_verify'))
        {
            $http_config_url = $confUrl .'/'. $appName . '/' . $appEnv . '/conf.json';

            $http_config = jhcurl_verify($http_config_url);
            if ($http_config) {
                $hav = \json_decode($http_config, true);
                if (is_array($hav) && $hav)
                {
                    $config = $hav;
                }

            }
        }
        return $config;
    }
}
