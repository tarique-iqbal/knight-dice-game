<?php

declare(strict_types=1);

namespace Tests\Integration\Service;

use Game\Container\ContainerFactory;
use Game\Entity\Knight;
use Game\Entity\KnightCircle;
use Game\Repository\KnightRepository;
use Game\Service\GamePlayServiceInterface;
use PHPUnit\Framework\TestCase;

class GamePlayServiceTest extends TestCase
{
    private KnightRepository $knightRepository;

    private GamePlayServiceInterface $gamePlayService;

    protected function setUp(): void
    {
        $config = include BASE_DIR . '/config/parameters_test.php';
        $container = (new ContainerFactory($config))->create();

        $this->knightRepository = $container['KnightRepository'];
        $this->gamePlayService = $container['GamePlayService'];
    }

    public function testPlay()
    {
        $numberOfKnights = 9;
        $knightCircle = new KnightCircle();

        $this->addKnight($numberOfKnights, $knightCircle);

        $winner = $this->gamePlayService->play($knightCircle);

        $this->assertInstanceOf(Knight::class, $winner);
    }

    private function addKnight(int $numberOfKnights, KnightCircle $knightCircle): void
    {
        for ($i = 1; $i <= $numberOfKnights; $i++) {
            $this->knightRepository->add($i, $knightCircle);
            $knightCircle->increaseNumberOfKnights();
        }
    }
}
