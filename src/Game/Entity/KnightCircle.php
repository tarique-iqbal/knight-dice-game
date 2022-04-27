<?php

declare(strict_types=1);

namespace Game\Entity;

class KnightCircle
{
    private ?Knight $head;

    private ?Knight $tail;

    private int $numberOfKnights;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
        $this->numberOfKnights = 0;
    }

    public function getHead(): ?Knight
    {
        return $this->head;
    }

    public function setHead(?Knight $head): void
    {
        $this->head = $head;
    }

    public function getTail(): ?Knight
    {
        return $this->tail;
    }

    public function setTail(?Knight $tail): void
    {
        $this->tail = $tail;
    }

    public function getNumberOfKnights(): int
    {
        return $this->numberOfKnights;
    }

    public function increaseNumberOfKnights(): void
    {
        $this->numberOfKnights += 1;
    }

    public function decreaseNumberOfKnights(): void
    {
        $this->numberOfKnights -= 1;
    }
}
