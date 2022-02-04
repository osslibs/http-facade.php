<?php

namespace osslibs\HTTP\Facade;

use osslibs\HTTP\HttpClient;
use osslibs\HTTP\Curl\CurlHttpClient;
use osslibs\HTTP\Facade\Decorators\BaseUrl;
use osslibs\HTTP\Facade\Decorators\Header;

class HttpClientFacade implements HttpClient
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @param HttpClient|null $client
     */
    public function __construct(HttpClient $client = null)
    {
        $this->client = $client ?? new CurlHttpClient();
    }

    /**
     * @param string $url
     * @return HttpClientFacade
     */
    public function baseUrl(string $url): HttpClientFacade
    {
        return new HttpClientFacade(new BaseUrl($url, $this->client));
    }

    /**
     * @param string $key
     * @param string $value
     * @return HttpClientFacade
     */
    public function header(string $key, string $value): HttpClientFacade
    {
        return new HttpClientFacade(new Header($key, $value, $this->client));
    }

    /**
     * @param string $userAgent
     * @return HttpClientFacade
     */
    public function userAgent(string $userAgent): HttpClientFacade
    {
        return $this->header('User-Agent', $userAgent);
    }

    /**
     * @param string $contentType
     * @return HttpClientFacade
     */
    public function contentType(string $contentType): HttpClientFacade
    {
        return $this->header('Content-Type', $contentType);
    }

    /**
     * @param string $jwtToken
     * @return HttpClientFacade
     */
    public function jwtToken(string $jwtToken): HttpClientFacade
    {
        return $this->header('Authorization', "Bearer {$jwtToken}");
    }

    /**
     * @param HttpRequest $request
     * @return HttpResponse
     * @throws RequestHttpException
     * @throws ServerHttpException
     */
    public function send(HttpRequest $request): HttpResponse
    {
        return $this->client->request($request);
    }

    /**
     * @param string $url
     * @param array $headers
     * @return HttpResponse
     * @throws RequestHttpException
     * @throws ServerHttpException
     */
    public function get(string $url, array $headers = []): HttpResponse
    {
        return $this->send(new HttpRequest('GET', $url, $headers));
    }

    /**
     * @param string $url
     * @param string|null $body
     * @param array $headers
     * @return HttpResponse
     * @throws RequestHttpException
     * @throws ServerHttpException
     */
    public function put(string $url, string $body = null, array $headers = []): HttpResponse
    {
        return $this->send(new HttpRequest('PUT', $url, $headers, $body));
    }

    /**
     * @param string $url
     * @param string|null $body
     * @param array $headers
     * @return HttpResponse
     * @throws RequestHttpException
     * @throws ServerHttpException
     */
    public function post(string $url, string $body = null, array $headers = []): HttpResponse
    {
        return $this->send(new HttpRequest('POST', $url, $headers, $body));
    }

    /**
     * @param string $url
     * @param array $headers
     * @return HttpResponse
     * @throws RequestHttpException
     * @throws ServerHttpException
     */
    public function delete(string $url, array $headers = []): HttpResponse
    {
        return $this->send(new HttpRequest('DELETE', $url, $headers));
    }
}
