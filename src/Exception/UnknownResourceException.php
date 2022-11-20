<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Exception;

use RuntimeException;
use Termyn\SmartReply\Response\Resource;

final class UnknownResourceException extends RuntimeException
{
    public function __construct(Resource $resource)
    {
        parent::__construct(
            sprintf('Resource "%s" does not accept any response factory.', $resource::class)
        );
    }
}
