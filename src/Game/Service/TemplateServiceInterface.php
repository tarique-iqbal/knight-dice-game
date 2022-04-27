<?php

declare(strict_types=1);

namespace Game\Service;

/**
 * Interface TemplateServiceInterface
 * @package Game\Service
 */
interface TemplateServiceInterface
{
    /**
     * @param string $file
     * @param array $data
     */
    public function render(string $file, array $data): void;
}
