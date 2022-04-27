<?php

declare(strict_types=1);

namespace Tests\Unit\Service;

use bovigo\vfs\vfsDirectory;
use bovigo\vfs\vfsStream;
use Game\Service\TemplateService;
use PHPUnit\Framework\TestCase;

class TemplateServiceTest extends TestCase
{
    private vfsDirectory $root;

    protected function setUp(): void
    {
        $structure = [
            'var' => [
                'file.php' => 'Hello World!'
            ]
        ];

        $this->root = vfsStream::setup(sys_get_temp_dir(), null, $structure);
    }

    public function testRender(): void
    {
        $this->expectOutputString('Hello World!');

        $templateService = new TemplateService();

        $templateService->render($this->root->url() . '/var/file', []);
    }
}
