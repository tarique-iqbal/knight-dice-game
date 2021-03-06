<?php

declare(strict_types=1);

namespace Game\Handler;

use Game\Service\ConfigServiceInterface;

/**
 * Class ExceptionHandler
 * @package Game\Handler
 */
class ExceptionHandler
{
    /**
     * @var ConfigServiceInterface
     */
    private ConfigServiceInterface $configService;

    /**
     * ExceptionHandler constructor.
     * @param ConfigServiceInterface $configService
     */
    public function __construct(ConfigServiceInterface $configService)
    {
        $this->configService = $configService;
    }

    /**
     * @param \Throwable $e
     */
    public function report(\Throwable $e): void
    {
        $message = $e->getMessage() . ' | File:' . $e->getFile() . ' | Line:' . $e->getLine();
        $logFile = $this->configService->getErrorLogFile();

        error_log($message . PHP_EOL, 3, $logFile);

        echo 'Exception occurred! Please check errors log file.' . PHP_EOL;
    }
}
