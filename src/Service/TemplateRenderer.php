<?php

declare(strict_types=1);

namespace Tuzex\Responder\Service;

use Tuzex\Responder\Response\Resource\Template;

interface TemplateRenderer
{
    public function render(Template $template): string;
}
