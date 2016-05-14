<?php

/**
 * UIoTuims
 * @version dev-alpha
 *                          88
 *                          ""              ,d
 *                                          88
 *              88       88 88  ,adPPYba, MM88MMM
 *              88       88 88 a8"     "8a  88
 *              88       88 88 8b       d8  88
 *              "8a,   ,a88 88 "8a,   ,a8"  88,
 *               `"YbbdP'Y8 88  `"YbbdP"'   "Y888
 *
 * @project Uniform Internet of Things
 * @app UIoT User-Friendly Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Communication\Requesting;

use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class RequestParserMethods
 * @package UIoT\App\Core\Communication\Requesting
 */
abstract class RequestParserMethods
{
    /**
     * Set Request Response Data ans Set Request Job Status, and return Request
     *
     * @param RequestSingleton $request
     * @param mixed $responseData
     * @param bool $responseStatus
     * @return RequestSingleton
     */
    public static function setCustomResponseDataWithStatus(RequestSingleton $request, $responseData, $responseStatus)
    {
        self::setCustomJobStatus(self::setCustomResponseData($request, $responseData), $responseStatus);

        return $request;
    }

    /**
     * Set Response Job Status by Custom Response Status
     *
     * @param RequestSingleton $response
     * @param bool $responseStatus
     * @return RequestSingleton
     */
    public static function setCustomJobStatus(RequestSingleton $response, $responseStatus)
    {
        $response->setDone($responseStatus);

        return $response;
    }

    /**
     * Set Request Response Data by Custom Response Data, and return Request
     *
     * @param RequestSingleton $request
     * @param mixed $responseData
     * @return RequestSingleton
     */
    public static function setCustomResponseData(RequestSingleton $request, $responseData)
    {
        $request->setResponse($responseData);

        return $request;
    }

    /**
     * Get Request Job Status and return Request
     *
     * @param RequestSingleton $request
     * @return bool
     */
    public static function getJobStatus(RequestSingleton $request)
    {
        return $request->getDone();
    }

    /**
     * Parse Request and set Response Data by Request Response, Set Job Status and return Request
     *
     * @param RequestSingleton $request
     * @param RequestSingleton $response
     * @param mixed $arguments
     * @return RequestSingleton
     */
    public static function parseResponseWithRequestStatus(RequestSingleton $request, RequestSingleton $response, $arguments)
    {
        self::setJobStatus(self::parseResponse($request, $response, $arguments), $response);

        return $request;
    }

    /**
     * Set Response Job Status and return Request
     *
     * @param RequestSingleton $request
     * @param RequestSingleton $response
     * @return RequestSingleton
     */
    public static function setJobStatus(RequestSingleton $request, RequestSingleton $response)
    {
        $response->setDone($request->getDone());

        return $request;
    }

    /**
     * Parse Request with Arguments and Set Response Data by Request Response Data and return Request
     *
     * @param RequestSingleton $request
     * @param RequestSingleton $response
     * @param mixed $arguments
     * @return RequestSingleton
     */
    public static function parseResponse(RequestSingleton $request, RequestSingleton $response, $arguments)
    {
        self::setResponseData(self::parseRequest($request, $arguments), $response);

        return $request;
    }

    /**
     * Set Response data by Request Response Data and return Request
     *
     * @param RequestSingleton $request
     * @param RequestSingleton $response
     * @return RequestSingleton
     */
    public static function setResponseData(RequestSingleton $request, RequestSingleton $response)
    {
        $response->setResponse($request->getResponse());

        return $request;
    }

    /**
     * Parse Request and return Request Instance
     *
     * @param RequestSingleton $request
     * @param mixed $arguments
     * @return RequestSingleton
     */
    public static function parseRequest(RequestSingleton $request, $arguments)
    {
        $request->parse($arguments);

        return $request;
    }

    /**
     * Parse Request and set Response Jobs Status, and return Request
     *
     * @param RequestSingleton $request
     * @param mixed $arguments
     * @param bool $responseStatus
     * @return RequestSingleton
     */
    public static function parseResponseWithStatus(RequestSingleton $request, $arguments, $responseStatus)
    {
        self::setCustomJobStatus(self::parseRequest($request, $arguments), $responseStatus);

        return $request;
    }

    /**
     * Parse Request with Arguments and Set Request Response Data and return Request
     *
     * @param RequestSingleton $request
     * @param mixed $arguments
     * @return RequestSingleton
     */
    public static function parseRequestWithResponse(RequestSingleton $request, $arguments)
    {
        self::setResponseData(self::parseRequest($request, $arguments), $request);

        return $request;
    }
}
