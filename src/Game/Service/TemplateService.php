<?php

declare(strict_types=1);

namespace Game\Service;

/**
 * Class TemplateService
 * @package Game\Service
 */
final class TemplateService implements TemplateServiceInterface
{
    /**
     * @param string $file
     * @param array $data
     */
    public function render(string $file, array $data): void
    {
        $file = $file . '.php';

        extract($data, EXTR_PREFIX_SAME, 'data');

        require($file);
    }
}
