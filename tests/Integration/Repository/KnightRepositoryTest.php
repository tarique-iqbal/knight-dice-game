<?php

declare(strict_types=1);

namespace Tests\Integration\Repository;

use Game\Container\ContainerFactory;
use Game\Entity\KnightCircle;
use Game\Repository\KnightRepository;
use PHPUnit\Framework\TestCase;

class KnightRepositoryTest extends TestCase
{
    private KnightRepository $knightRepository;

    protected function setUp(): void
    {
        $config = include BASE_DIR . '/config/parameters_test.php';
        $container = (new ContainerFactory($config))->create();

        $this->knightRepository = $container['KnightRepository'];
    }

    public function testAdd()
    {
        $numberOfKnights = 10;
        $knightCircle = new KnightCircle();

        $this->addKnight($numberOfKnights, $knightCircle);
        $count = $this->countKnight($knightCircle);

        $this->assertSame($numberOfKnights, $count);
    }

    private function addKnight(int $numberOfKnights, KnightCircle $knightCircle): void
    {
        for ($i = 1; $i <= $numberOfKnights; $i++) {
            $this->knightRepository->add($i, $knightCircle);
        }
    }

    private function countKnight(KnightCircle $knightCircle): int
    {
        $knight = $knightCircle->getHead()->getNext();
        $count = 1;
        while ($knight !== $knightCircle->getHead()) {
            $count += 1;
            $knight = $knight->getNext();
        }

        return $count;
    }
}
