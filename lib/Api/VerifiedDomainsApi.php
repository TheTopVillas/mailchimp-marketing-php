<?php

/**
 * VerifiedDomainsApi
 * PHP version 5
 *
 * @category Class
 * @package  MailchimpMarketing
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Mailchimp Marketing API
 *
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 3.0.80
 * Contact: apihelp@mailchimp.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.12
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace MailchimpMarketing\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\json_decode as json_decode;

use MailchimpMarketing\ApiException;
use MailchimpMarketing\Configuration;
use MailchimpMarketing\HeaderSelector;
use MailchimpMarketing\ObjectSerializer;

class VerifiedDomainsApi
{
    protected $client;
    protected $config;
    protected $headerSelector;

    public function __construct(Configuration $config = null)
    {
        $this->client = new Client([
            'defaults' => [
                'timeout' => 120.0
            ]
        ]);
        $this->headerSelector = new HeaderSelector();
        $this->config = $config ?: new Configuration();
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function createVerifiedDomain($body)
    {
        $response = $this->createVerifiedDomainWithHttpInfo($body);
        return $response;
    }

    public function createVerifiedDomainWithHttpInfo($body)
    {
        $request = $this->createVerifiedDomainRequest($body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUrl()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function createVerifiedDomainRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/verified-domains';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new \GuzzleHttp\Post\MultipartBody($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode($formParams);

            } else {
                $httpBody = \GuzzleHttp\Query::fromString($formParams);
            }
        }

        if (!$httpBody instanceof \GuzzleHttp\Stream\StreamInterface) {
            $httpBody = \GuzzleHttp\Stream\Stream::factory($httpBody);
        }

        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        $request = new \GuzzleHttp\Message\Request('POST', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''));
        $request->addHeaders($headers);
        $request->setBody($httpBody);

        return $request;
    }

    public function deleteDomain($domain_name)
    {
        $this->deleteDomainWithHttpInfo($domain_name);
    }

    public function deleteDomainWithHttpInfo($domain_name)
    {
        $request = $this->deleteDomainRequest($domain_name);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUrl()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function deleteDomainRequest($domain_name)
    {
        // verify the required parameter 'domain_name' is set
        if ($domain_name === null || (is_array($domain_name) && count($domain_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_name when calling '
            );
        }

        $resourcePath = '/verified-domains/{domain_name}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($domain_name !== null) {
            $resourcePath = str_replace(
                '{' . 'domain_name' . '}',
                ObjectSerializer::toPathValue($domain_name),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new \GuzzleHttp\Post\MultipartBody($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode($formParams);

            } else {
                $httpBody = \GuzzleHttp\Query::fromString($formParams);
            }
        }

        if (!$httpBody instanceof \GuzzleHttp\Stream\StreamInterface) {
            $httpBody = \GuzzleHttp\Stream\Stream::factory($httpBody);
        }

        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        $request = new \GuzzleHttp\Message\Request('DELETE', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''));
        $request->addHeaders($headers);
        $request->setBody($httpBody);

        return $request;
    }

    public function getDomain($domain_name)
    {
        $response = $this->getDomainWithHttpInfo($domain_name);
        return $response;
    }

    public function getDomainWithHttpInfo($domain_name)
    {
        $request = $this->getDomainRequest($domain_name);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUrl()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function getDomainRequest($domain_name)
    {
        // verify the required parameter 'domain_name' is set
        if ($domain_name === null || (is_array($domain_name) && count($domain_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_name when calling '
            );
        }

        $resourcePath = '/verified-domains/{domain_name}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($domain_name !== null) {
            $resourcePath = str_replace(
                '{' . 'domain_name' . '}',
                ObjectSerializer::toPathValue($domain_name),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new \GuzzleHttp\Post\MultipartBody($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode($formParams);

            } else {
                $httpBody = \GuzzleHttp\Query::fromString($formParams);
            }
        }

        if (!$httpBody instanceof \GuzzleHttp\Stream\StreamInterface) {
            $httpBody = \GuzzleHttp\Stream\Stream::factory($httpBody);
        }

        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        $request = new \GuzzleHttp\Message\Request('GET', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''));
        $request->addHeaders($headers);
        $request->setBody($httpBody);

        return $request;
    }

    public function getVerifiedDomainsAll()
    {
        $response = $this->getVerifiedDomainsAllWithHttpInfo();
        return $response;
    }

    public function getVerifiedDomainsAllWithHttpInfo()
    {
        $request = $this->getVerifiedDomainsAllRequest();

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUrl()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function getVerifiedDomainsAllRequest()
    {

        $resourcePath = '/verified-domains';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new \GuzzleHttp\Post\MultipartBody($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode($formParams);

            } else {
                $httpBody = \GuzzleHttp\Query::fromString($formParams);
            }
        }

        if (!$httpBody instanceof \GuzzleHttp\Stream\StreamInterface) {
            $httpBody = \GuzzleHttp\Stream\Stream::factory($httpBody);
        }

        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        $request = new \GuzzleHttp\Message\Request('GET', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''));
        $request->addHeaders($headers);
        $request->setBody($httpBody);

        return $request;
    }

    public function submitDomainVerification($domain_name, $body)
    {
        $response = $this->submitDomainVerificationWithHttpInfo($domain_name, $body);
        return $response;
    }

    public function submitDomainVerificationWithHttpInfo($domain_name, $body)
    {
        $request = $this->submitDomainVerificationRequest($domain_name, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUrl()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function submitDomainVerificationRequest($domain_name, $body)
    {
        // verify the required parameter 'domain_name' is set
        if ($domain_name === null || (is_array($domain_name) && count($domain_name) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $domain_name when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/verified-domains/{domain_name}/actions/verify';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($domain_name !== null) {
            $resourcePath = str_replace(
                '{' . 'domain_name' . '}',
                ObjectSerializer::toPathValue($domain_name),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new \GuzzleHttp\Post\MultipartBody($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = json_encode($formParams);

            } else {
                $httpBody = \GuzzleHttp\Query::fromString($formParams);
            }
        }

        if (!$httpBody instanceof \GuzzleHttp\Stream\StreamInterface) {
            $httpBody = \GuzzleHttp\Stream\Stream::factory($httpBody);
        }

        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        $request = new \GuzzleHttp\Message\Request('POST', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''));
        $request->addHeaders($headers);
        $request->setBody($httpBody);

        return $request;
    }

    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options['debug'] = fopen($this->config->getDebugFile(), 'a');
            if (!$options['debug']) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        if ($this->config->getTimeout()) {
            $options['timeout'] = $this->config->getTimeout();
        }

        return $options;
    }
}
