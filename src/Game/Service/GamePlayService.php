<?php

declare(strict_types=1);

namespace Game\Service;

use Game\Entity\Knight;
use Game\Entity\KnightCircle;
use Game\Event\KnightDeadEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class GamePlayService
 * @package Game\Service
 */
final class GamePlayService implements GamePlayServiceInterface
{
    private const LAST_KNIGHT_ALIVE = 1;

    private const DEAD_POINT = 0;

    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $eventDispatcher;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param KnightCircle $knightCircle
     * @return Knight
     */
    public function play(KnightCircle $knightCircle): Knight
    {
        $knight = $knightCircle->getHead();

        while ($knightCircle->getNumberOfKnights() > self::LAST_KNIGHT_ALIVE) {
            $dicePoint = $knight->throwDice();
            $knight->getNext()->subtractLifePoints($dicePoint);

            if ($knight->getNext()->getLifePoints() <= self::DEAD_POINT) {
                $knightDeadEvent = new KnightDeadEvent($knight->getNext()->getId(), $knightCircle);
                $this->eventDispatcher->dispatch($knightDeadEvent, KnightDeadEvent::NAME);
            }

            $knight = $knight->getNext();
        }

        if (
            null !== $knightCircle->getHead() &&
            $knightCircle->getTail() === $knightCircle->getHead()
        ) {
            return $knightCircle->getHead();
        } else {
            throw new \LogicException('Game has unexpected end result!');
        }
    }
}
