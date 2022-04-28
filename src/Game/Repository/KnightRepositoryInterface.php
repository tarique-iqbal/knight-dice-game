<?php

declare(strict_types=1);

namespace Game\Repository;

use Game\Entity\KnightCircle;

/**
 * Interface KnightRepositoryInterface
 * @package Game\Repository
 */
interface KnightRepositoryInterface
{
    /**
     * @param int $id
     * @param KnightCircle $knightCircle
     * @return void
     */
    public function add(int $id, KnightCircle $knightCircle): void;
}
