<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Service;

use Termyn\SmartReply\Response\Resource\Template;

interface TemplateRenderer
{
    public function render(Template $template): string;
}
