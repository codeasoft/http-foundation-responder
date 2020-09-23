<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Service;

interface TemplateRenderer
{
    public function render(string $name, array $parameters): string;
}
