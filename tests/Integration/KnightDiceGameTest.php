<?php

declare(strict_types=1);

namespace Tests\Integration;

use Game\Container\ContainerFactory;
use Game\KnightDiceGame;
use Game\Service\ConfigServiceInterface;
use PHPUnit\Framework\TestCase;

class KnightDiceGameTest extends TestCase
{
    private KnightDiceGame $knightDiceGame;

    private ConfigServiceInterface $configService;

    protected function setUp(): void
    {
        $config = include BASE_DIR . '/config/parameters_test.php';
        $container = (new ContainerFactory($config))->create();

        $this->configService = $container['ConfigService'];
        $this->knightDiceGame = $container['KnightDiceGame'];
    }

    public function testRun()
    {
        $this->expectOutputRegex(
            sprintf(
                '/Winner: Knight [1-9] won the game.%s/',
                PHP_EOL
            )
        );

        $this->knightDiceGame->run(
            $this->configService->getNumberOfPlayers()
        );
    }
}
