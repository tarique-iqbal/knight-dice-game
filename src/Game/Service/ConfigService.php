<?php

declare(strict_types=1);

namespace Game\Service;

/**
 * Class ConfigService
 * @package Game\Service
 */
final class ConfigService implements ConfigServiceInterface
{
    /**
     * @var array
     */
    private array $config = [];

    /**
     * ConfigService constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return int
     */
    public function getNumberOfPlayers(): int
    {
        return $this->config['number_of_players'];
    }

    /**
     * @return string
     */
    public function getErrorLogFile(): string
    {
        return BASE_DIR
            . '/' . $this->config['error_log']['directory']
            . '/' . $this->config['error_log']['file_name'];
    }
}
