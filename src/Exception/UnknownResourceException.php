<?php

declare(strict_types=1);

namespace Tuzex\Responder\Exception;

use RuntimeException;
use Tuzex\Responder\Response\Resource;

final class UnknownResourceException extends RuntimeException
{
    public function __construct(Resource $resource)
    {
        parent::__construct(
            sprintf('Resource "%s" does not accept any response factory.', $resource::class)
        );
    }
}
