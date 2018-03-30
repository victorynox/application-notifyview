<?php

namespace rollun\WebUi\notify\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use rollun\actionrender\Renderer\AbstractRenderer;

class NotifyView implements MiddlewareInterface
{

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
        $responseData = [
            "title" => "Нотификации",
            "dataStoreName" => "notifyStore"
        ];
        $request = $request->withAttribute(AbstractRenderer::RESPONSE_DATA, $responseData);
        $response = $delegate->process($request);
        return $response;
    }
}