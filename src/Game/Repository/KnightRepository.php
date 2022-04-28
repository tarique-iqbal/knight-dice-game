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

    /**
     * @param int $id
     * @param KnightCircle $knightCircle
     * @return void
     */
    public function remove(int $id, KnightCircle $knightCircle): void
    {
        $knight = $knightCircle->getHead();
        $deadKnight = null;
        $previous = null;

        while (null !== $knight) {
            if ($knight->getId() === $id) {
                $deadKnight = $knight;
            } else {
                $previous = $knight;
            }

            $knight = $knight->getNext();
            if ($knight === $knightCircle->getHead()) {
                $knight = null;
            }

            if (null !== $deadKnight) {
                if ($knightCircle->getHead() === $deadKnight) {
                    if ($knightCircle->getTail() === $knightCircle->getHead()) {
                        $knightCircle->setTail(null);
                    }
                    $knightCircle->setHead($knight);
                } elseif ($knightCircle->getTail() === $deadKnight) {
                    $knightCircle->setTail($previous);
                } elseif (null !== $previous) {
                    $previous->setNext($knight);
                }

                if ($knightCircle->getTail() !== null) {
                    $knightCircle->getTail()->setNext($knightCircle->getHead());
                }

                $knight = null;
            }
        }

        if (null === $deadKnight) {
            throw new \InvalidArgumentException(
                sprintf('Knight %s is not found to remove.', $id)
            );
        }
    }
}
