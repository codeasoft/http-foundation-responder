<?php

declare(strict_types=1);

namespace Codea\Responder\Service;

use Codea\Responder\Response\Resource\Template;

interface TemplateRenderer
{
    public function render(Template $template): string;
}
