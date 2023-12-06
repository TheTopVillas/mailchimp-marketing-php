<?php

/**
 * AccountExportsApi
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

class AccountExportsApi
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

    public function listAccountExports($fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->listAccountExportsWithHttpInfo($fields, $exclude_fields, $count, $offset);
        return $response;
    }

    public function listAccountExportsWithHttpInfo($fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->listAccountExportsRequest($fields, $exclude_fields, $count, $offset);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody();
            $content = $responseBody ? $responseBody->getContents() : '';

            try {
                $content = json_decode($content);
            } catch (\Exception $e) {
                $content = $content;
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUrl()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $content
                );
            }

            return $content;

        } catch (ApiException $e) {
            $message = ($e->getResponseBody() instanceof \stdClass) ? $e->getResponseBody()->title : $e->getMessage();
            throw new \Exception($message, $e->getCode(), $e);
        }
    }

    protected function listAccountExportsRequest($fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling AccountExportsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/account-exports';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;
        // query params
        if (is_array($fields)) {
            $queryParams['fields'] = ObjectSerializer::serializeCollection($fields, 'csv');
        } else
        if ($fields !== null) {
            $queryParams['fields'] = ObjectSerializer::toQueryValue($fields);
        }
        // query params
        if (is_array($exclude_fields)) {
            $queryParams['exclude_fields'] = ObjectSerializer::serializeCollection($exclude_fields, 'csv');
        } else
        if ($exclude_fields !== null) {
            $queryParams['exclude_fields'] = ObjectSerializer::toQueryValue($exclude_fields);
        }
        // query params
        if ($count !== null) {
            $queryParams['count'] = ObjectSerializer::toQueryValue($count);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset);
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

    public function createAccountExport($body)
    {
        $response = $this->createAccountExportWithHttpInfo($body);
        return $response;
    }

    public function createAccountExportWithHttpInfo($body)
    {
        $request = $this->createAccountExportRequest($body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody();
            $content = $responseBody ? $responseBody->getContents() : '';

            try {
                $content = json_decode($content);
            } catch (\Exception $e) {
                $content = $content;
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUrl()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $content
                );
            }

            return $content;

        } catch (ApiException $e) {
            $message = ($e->getResponseBody() instanceof \stdClass) ? $e->getResponseBody()->title : $e->getMessage();
            throw new \Exception($message, $e->getCode(), $e);
        }
    }

    protected function createAccountExportRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/account-exports';
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
