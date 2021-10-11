<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\ResponseResource;

interface Responder
{
    public function process(ResponseResource $responseResource): Response;
}
