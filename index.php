<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Tuzex\Responder\FlexResponder;
use Tuzex\Responder\Bridge\HttpFoundation\SessionFlashMessagePublisher;
use Tuzex\Responder\Middleware\CreateResponseMiddleware;
use Tuzex\Responder\Middleware\PublishFlashMessagesMiddleware;
use Tuzex\Responder\Response\ContentResponseFactory;
use Tuzex\Responder\Response\FileResponseFactory;
use Tuzex\Responder\Response\JsonResponseFactory;
use Tuzex\Responder\Response\UrlRedirectionResponseFactory;
use Tuzex\Responder\Result\FlashMessage;
use Tuzex\Responder\Result\Payload\PdfFileContent;

require 'vendor/autoload.php';

$flashBag = new FlashBag();
$flashMessagePublisher = new SessionFlashMessagePublisher($flashBag);

$responseMiddleware = new CreateResponseMiddleware(
    new ContentResponseFactory(),
    new FileResponseFactory(),
    new JsonResponseFactory(),
    new UrlRedirectionResponseFactory()
);

$responder = new FlexResponder($responseMiddleware);
$responder->extend(...[
    new PublishFlashMessagesMiddleware($flashMessagePublisher),
]);

$result = PdfFileContent::display('Hello PDF', 'hello.pdf');
$result->addFlashMessage(
    new FlashMessage('success', 'Success!!!')
);

//$result->addHeader(
//    new ContentType(MimeType::HTML),
//    new ContentDisposition('helloWorld.html', ContentDisposition::INLINE),
//);

$response = $responder->process($result);

echo 'XXX';
