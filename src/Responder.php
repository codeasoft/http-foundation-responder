<?php

declare(strict_types=1);

namespace Termyn\SmartReply;

use Symfony\Component\HttpFoundation\Response;
use Termyn\SmartReply\Response\Resource;

interface Responder
{
    public function process(Resource $resource): Response;
}
