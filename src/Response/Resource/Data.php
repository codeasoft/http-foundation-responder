<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\Resource;

interface Data
{
    public function datalist(): iterable;
}
