<?php

declare(strict_types=1);

namespace Tests\Unit\Service;

use Game\Service\ConfigService;
use PHPUnit\Framework\TestCase;

class ConfigServiceTest extends TestCase
{
    protected array $config;

    protected ConfigService $configService;

    protected function setUp(): void
    {
        $this->config = include BASE_DIR . '/config/parameters.php';
        $this->configService = new ConfigService($this->config);
    }

    public function testDisplayEachStep(): void
    {
        $numberOfPlayers = $this->configService->getNumberOfPlayers();
        $expectedNumberOfPlayers = $this->config['number_of_players'];

        $this->assertSame($expectedNumberOfPlayers, $numberOfPlayers);
    }

    public function testGetErrorLogFile(): void
    {
        $logFile = $this->configService->getErrorLogFile();
        $expectedLogFile = BASE_DIR
            . '/' . $this->config['error_log']['directory']
            . '/' . $this->config['error_log']['file_name'];

        $this->assertSame($expectedLogFile, $logFile);
    }
}
