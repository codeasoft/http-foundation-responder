<?php

declare(strict_types=1);

namespace Codea\SmartReply;

use Codea\SmartReply\Response\Resource;
use Symfony\Component\HttpFoundation\Response;

interface Responder
{
    public function process(Resource $resource): Response;
}
