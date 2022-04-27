<?php

declare(strict_types=1);

namespace Tests\Unit\Handler;

use bovigo\vfs\vfsDirectory;
use bovigo\vfs\vfsStream;
use Game\Handler\ExceptionHandler;
use Game\Service\ConfigServiceInterface;
use PHPUnit\Framework\TestCase;

class ExceptionHandlerTest extends TestCase
{
    private vfsDirectory $root;

    protected function setUp(): void
    {
        $structure = [
            'logs' => [
                'errors.log' => ''
            ]
        ];

        $this->root = vfsStream::setup(sys_get_temp_dir(), null, $structure);
    }

    public function testReport(): void
    {
        $this->setOutputCallback(function () {
        });

        $configService = $this
            ->getMockBuilder(ConfigServiceInterface::class)
            ->getMock();
        $configService->method('getErrorLogFile')->willReturn(
            $this->root->url() . '/logs/errors.log'
        );

        $message = 'Exception message to write in log file.';

        (new ExceptionHandler($configService))->report(new \Exception($message));

        $this->assertTrue($this->root->hasChild('logs/errors.log'));
        $this->assertStringContainsString(
            $message,
            $this->root->getChild('logs/errors.log')->getContent()
        );
    }
}
