<?php

declare(strict_types=1);

namespace Game\Event;

use Game\Entity\KnightCircle;
use Symfony\Contracts\EventDispatcher\Event;

class KnightDeadEvent extends Event
{
    public const NAME = 'knight.dead';

    protected int $knightId;

    protected KnightCircle $knightCircle;

    public function __construct(int $knightId, KnightCircle $knightCircle)
    {
        $this->knightId = $knightId;
        $this->knightCircle = $knightCircle;
    }

    public function getKnightId(): int
    {
        return $this->knightId;
    }

    public function getKnightCircle(): KnightCircle
    {
        return $this->knightCircle;
    }
}
