<?php

declare(strict_types=1);

namespace Tuzex\Responder\Exception;

use RuntimeException;
use Tuzex\Responder\Response\ResponseResource;

final class UnknownResponseResourceException extends RuntimeException
{
    public function __construct(ResponseResource $responseResource)
    {
        parent::__construct(
            sprintf('Response resource "%s" does not accept any response factory.', $responseResource::class)
        );
    }
}
