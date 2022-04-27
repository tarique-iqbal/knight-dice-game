<?php

declare(strict_types=1);

namespace Game\Service;

/**
 * Interface ConfigServiceInterface
 * @package Game\Service
 */
interface ConfigServiceInterface
{
    /**
     * @return int
     */
    public function getNumberOfPlayers(): int;

    /**
     * @return string
     */
    public function getErrorLogFile(): string;
}
