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

use Hyperf\ConfigCenter\AbstractDriver;
use Psr\Container\ContainerInterface;

class JhrDriver extends AbstractDriver
{
    protected $driverName = 'jh';

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->client = $container->get(ClientInterface::class);
    }
}
