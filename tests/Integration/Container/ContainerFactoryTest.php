<?php

declare(strict_types=1);

namespace Tests\Integration\Container;

use Game\Container\ContainerFactory;
use Game\Handler\ExceptionHandler;
use Game\Service\ConfigService;
use Game\Service\TemplateService;
use PHPUnit\Framework\TestCase;
use Pimple\Container;

class ContainerFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $config = include BASE_DIR . '/config/parameters_test.php';

        $container = (new ContainerFactory($config))->create();

        $this->assertInstanceOf(Container::class, $container);
        $this->assertInstanceOf(ConfigService::class, $container['ConfigService']);
        $this->assertInstanceOf(TemplateService::class, $container['TemplateService']);
        $this->assertInstanceOf(ExceptionHandler::class, $container['ExceptionHandler']);
    }
}
