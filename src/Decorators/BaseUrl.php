<?php

namespace osslibs\HTTP\Facade\Decorators;

use osslibs\HTTP\HttpClient;
use osslibs\HTTP\HttpRequest;
use osslibs\HTTP\HttpResponse;
use osslibs\HTTP\URL;
use function osslibs\URI\uri;

class BaseUrl implements HttpClient
{
    /**
     * @var URL
     */
    private $uri;

    /**
     * @var HttpClient
     */
    private $client;

    public function __construct(string $uri, HttpClient $client)
    {
        $this->uri = uri($uri);
        $this->client = $client;
    }

    public function send(HttpRequest $request): HttpResponse
    {
        $uri = (string)$this->uri->merge($request->uri());
        return $this->client->request(new HttpRequest($request->method(), $uri, $request->headers(), $request->data()));
    }
}
