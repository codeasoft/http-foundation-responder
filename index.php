<?php

declare(strict_types=1);

use Tuzex\Symfony\Responder\Bridge\Symfony\Response\ResponseFactory;
use Tuzex\Symfony\Responder\Http\Header\ContentDisposition;
use Tuzex\Symfony\Responder\Http\Header\ContentType;
use Tuzex\Symfony\Responder\Http\MimeType;
use Tuzex\Symfony\Responder\Http\StatusCode;
use Tuzex\Symfony\Responder\Middleware\TransformResultMiddleware;
use Tuzex\Symfony\Responder\Middlewares;
use Tuzex\Symfony\Responder\Result\HttpConfigs;
use Tuzex\Symfony\Responder\Result\Payload\PlainText;
use Tuzex\Symfony\Responder\Result\Payload\PlainTextTransformer;
use Tuzex\Symfony\Responder\Responder;

include_once __DIR__.'/vendor/autoload.php';

$middlewares = new Middlewares(
    new TransformResultMiddleware([
        new PlainTextTransformer(new ResponseFactory()),
    ])
);

$responder = new Responder($middlewares);

$result = PlainText::init('Hello World!', StatusCode::FOUND);
$result->mountHeader(
    new ContentType(MimeType::JSON)
);

dump($result);
$response = $responder->reply($result);
dump($response);
