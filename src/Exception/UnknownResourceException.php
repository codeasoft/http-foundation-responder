<?php

declare(strict_types=1);

namespace Codea\SmartReply\Exception;

use Codea\SmartReply\Response\Resource;
use RuntimeException;

final class UnknownResourceException extends RuntimeException
{
    public function __construct(Resource $resource)
    {
        parent::__construct(
            sprintf('Resource "%s" does not accept any response factory.', $resource::class)
        );
    }
}
