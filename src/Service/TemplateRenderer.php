<?php

declare(strict_types=1);

namespace Codea\SmartReply\Service;

use Codea\SmartReply\Response\Resource\Template;

interface TemplateRenderer
{
    public function render(Template $template): string;
}
