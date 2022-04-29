<?php

declare(strict_types=1);

namespace Game\Service;

use Game\Entity\Knight;
use Game\Entity\KnightCircle;

/**
 * Interface GamePlayServiceInterface
 * @package Game\Service
 */
interface GamePlayServiceInterface
{
    /**
     * @param KnightCircle $knightCircle
     * @return Knight
     */
    public function play(KnightCircle $knightCircle): Knight;
}
