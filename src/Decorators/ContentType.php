<?php

namespace osslibs\HTTP\Facade\Decorators;

use osslibs\HTTP\HttpClient;
use osslibs\HTTP\HttpRequest;
use osslibs\HTTP\HttpResponse;

class ContentType implements HttpClient
{
    public function send(HttpRequest $request): HttpResponse
    {
    }
}