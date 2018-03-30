<?php

namespace rollun\notify\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Log\Writer\WriterInterface;
use Zend\Stdlib\SplPriorityQueue;

class NotifyReceiver implements MiddlewareInterface
{
   const ATTRIBUTE_EVENT = "event";

    /**
     * Process an incoming server request and return a response, optionally delegating
     * to the next middleware component to create the response.
     *
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        if ($request->getMethod() === "POST") {
            $contentType = $request->getHeaderLine("Content-Type");
            if ($contentType == "application/octet-stream") {
                $base64Data = $request->getBody()->getContents();
                $serializedEvent = base64_decode($base64Data);
                $event = unserialize($serializedEvent);
                $request = $request->withAttribute(static::ATTRIBUTE_EVENT, $event);
            }
        }
        $response = $delegate->process($request);
        return $response;
    }
}