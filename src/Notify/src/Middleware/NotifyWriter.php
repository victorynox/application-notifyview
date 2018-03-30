<?php

namespace rollun\notify\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Log\Writer\WriterInterface;
use Zend\Stdlib\SplPriorityQueue;

class NotifyWriter implements MiddlewareInterface
{

    /** @var SplPriorityQueue */
    protected $writers;

    /**
     * NotifyReceiver constructor.
     * @param SplPriorityQueue $writers
     */
    public function __construct(SplPriorityQueue $writers)
    {
        $this->writers = $writers;
    }

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
        $event = $request->getAttribute(NotifyReceiver::ATTRIBUTE_EVENT);
        /** @var WriterInterface $writer */
        foreach ($this->writers->toArray() as $writer) {
            $writer->write($event);
        }
        $response = $delegate->process($request);
        return $response;
    }
}