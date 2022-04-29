<?php

declare(strict_types=1);

namespace Game\Container;

use Game\EventSubscriber\KnightDeadSubscriber;
use Game\Handler\ExceptionHandler;
use Game\KnightDiceGame;
use Game\Repository\KnightRepository;
use Game\Service\ConfigService;
use Game\Service\GamePlayService;
use Game\Service\TemplateService;
use Pimple\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;

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

        $container['EventDispatcher'] = function () {
            return new EventDispatcher();
        };

        $container['EventDispatcher']->addSubscriber(
            new KnightDeadSubscriber(
                $container['KnightRepository']
            )
        );

        $container['GamePlayService'] = function (Container $c) {
            return new GamePlayService(
                $c['EventDispatcher']
            );
        };

        $container['TemplateService'] = function () {
            return new TemplateService();
        };

        $container['KnightDiceGame'] = function (Container $c) {
            return new KnightDiceGame(
                $c['KnightRepository'],
                $c['GamePlayService'],
                $c['TemplateService']
            );
        };

        $container['ExceptionHandler'] = function (Container $c) {
            return new ExceptionHandler(
                $c['ConfigService']
            );
        };

        return $container;
    }
}
