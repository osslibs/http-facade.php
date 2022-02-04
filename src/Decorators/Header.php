<?php

namespace osslibs\HTTP\Facade\Decorators;

use osslibs\HTTP\HttpClient;
use osslibs\HTTP\HttpRequest;
use osslibs\HTTP\HttpResponse;

class Header implements HttpClient
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $value;

    /**
     * @var HttpClient
     */
    private $client;

    public function __construct(string $key, string $value, HttpClient $client)
    {
        $this->key = $key;
        $this->value = $value;
        $this->client = $client;
    }

    public function send(HttpRequest $request): HttpResponse
    {
        $headers = $request->headers();
        $headers[] = [$this->key, $this->value];
        return $this->client->request(new HttpRequest($request->method(), $request->uri(), $headers, $request->data()));
    }
}
