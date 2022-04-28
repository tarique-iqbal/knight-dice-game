<?php

declare(strict_types=1);

namespace Game\Container;

use Game\Handler\ExceptionHandler;
use Game\Repository\KnightRepository;
use Game\Service\ConfigService;
use Game\Service\TemplateService;
use Pimple\Container;

/**
 * Class ContainerFactory
 * @package Game\Container
 */
class ContainerFactory
{
    /**
     * @var array
     */
    private array $config;

    /**
     * ContainerFactory constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return Container
     */
    public function create(): Container
    {
        $container = new Container();

        $container['ConfigService'] = function () {
            return new ConfigService($this->config);
        };

        $container['KnightRepository'] = function () {
            return new KnightRepository();
        };

        $container['TemplateService'] = function () {
            return new TemplateService();
        };

        $container['ExceptionHandler'] = function (Container $c) {
            return new ExceptionHandler(
                $c['ConfigService']
            );
        };

        return $container;
    }
}
