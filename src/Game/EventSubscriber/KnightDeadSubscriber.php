<?php

declare(strict_types=1);

namespace Game\EventSubscriber;

use Game\Event\KnightDeadEvent;
use Game\Repository\KnightRepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class KnightDeadSubscriber
 * @package Game\EventSubscriber
 */
class KnightDeadSubscriber implements EventSubscriberInterface
{
    /**
     * @var KnightRepositoryInterface
     */
    private KnightRepositoryInterface $knightRepository;

    /**
     * @param KnightRepositoryInterface $knightRepository
     */
    public function __construct(KnightRepositoryInterface $knightRepository)
    {
        $this->knightRepository = $knightRepository;
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KnightDeadEvent::NAME => [
                ['removeKnight', 9],
                ['decreaseNumberOfKnights', 8]
            ],
        ];
    }

    /**
     * @param KnightDeadEvent $event
     * @return void
     */
    public function removeKnight(KnightDeadEvent $event): void
    {
        $id = $event->getKnightId();
        $knightCircle = $event->getKnightCircle();

        $this->knightRepository->remove($id, $knightCircle);
    }

    /**
     * @param KnightDeadEvent $event
     * @return void
     */
    public function decreaseNumberOfKnights(KnightDeadEvent $event): void
    {
        $knightCircle = $event->getKnightCircle();

        $knightCircle->decreaseNumberOfKnights();
    }
}
