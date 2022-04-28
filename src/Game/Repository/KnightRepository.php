<?php

declare(strict_types=1);

namespace Game\Repository;

use Game\Entity\Knight;
use Game\Entity\KnightCircle;

/**
 * Class KnightRepository
 * @package Game\Repository
 */
final class KnightRepository implements KnightRepositoryInterface
{
    /**
     * @param int $id
     * @param KnightCircle $knightCircle
     * @return void
     */
    public function add(int $id, KnightCircle $knightCircle): void
    {
        $knight = new Knight($id, $knightCircle->getHead());

        if (null === $knightCircle->getHead()) {
            $knightCircle->setHead($knight);
            $knight->setNext($knightCircle->getHead());
            $knightCircle->setTail($knight);
        } else {
            $knightCircle->getTail()->setNext($knight);
            $knightCircle->setTail($knight);
        }
    }
}
