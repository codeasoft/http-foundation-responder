<?php

declare(strict_types=1);

namespace Tuzex\Responder\Service;

interface TemplateRenderer
{
    public function render(string $name, array $parameters): string;
}
