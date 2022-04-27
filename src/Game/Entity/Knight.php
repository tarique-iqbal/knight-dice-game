<?php

declare(strict_types=1);

namespace Game\Entity;

class Knight
{
    private const LIFE_POINTS = 100;

    private const MINIMUM_DICE_POINT = 1;

    private const MAXIMUM_DICE_POINTS = 6;

    private int $id;

    private int $lifePoints;

    private ?Knight $next;

    public function __construct(int $id, ?Knight $first)
    {
        $this->id = $id;
        $this->lifePoints = self::LIFE_POINTS;
        $this->next = $first;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNext(): ?Knight
    {
        return $this->next;
    }

    public function setNext(?Knight $next): void
    {
        $this->next = $next;
    }

    public function throwDice(): int
    {
        return rand(self::MINIMUM_DICE_POINT, self::MAXIMUM_DICE_POINTS);
    }

    public function subtractLifePoints(int $dicePoint): void
    {
        $this->lifePoints -= $dicePoint;
    }

    public function getLifePoints(): int
    {
        return $this->lifePoints;
    }
}
