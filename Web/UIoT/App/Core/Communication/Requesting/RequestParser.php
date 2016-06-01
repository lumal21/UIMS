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
 * Class RequestParser
 * @package UIoT\App\Core\Communication\Requesting
 */
abstract class RequestParser
{
    /**
     * Set Request Response Data ans Set Request Job Status, and return Request
     *
     * @param RequestSingleton $request
     * @param mixed $responseData
     * @param bool $responseStatus
     * @return RequestSingleton
     */
    public static function setCustomResponse(RequestSingleton $request, $responseData, $responseStatus)
    {
        self::setCustomStatus(self::setCustomData($request, $responseData), $responseStatus);

        return $request;
    }

    /**
     * Set Response Job Status by Custom Response Status
     *
     * @param RequestSingleton $response
     * @param bool $responseStatus
     * @return RequestSingleton
     */
    public static function setCustomStatus(RequestSingleton $response, $responseStatus)
    {
        $response->setStatus($responseStatus);

        return $response;
    }

    /**
     * Set Request Response Data by Custom Response Data, and return Request
     *
     * @param RequestSingleton $request
     * @param mixed $responseData
     * @return RequestSingleton
     */
    public static function setCustomData(RequestSingleton $request, $responseData)
    {
        $request->setData($responseData);

        return $request;
    }

    /**
     * Get Request Job Status and return Request
     *
     * @param RequestSingleton $request
     * @return bool
     */
    public static function getStatus(RequestSingleton $request)
    {
        return $request->getStatus();
    }

    /**
     * Get Job Status and Append Response Data if exists
     *
     * @param RequestSingleton $request
     * @param RequestSingleton $response
     * @return bool
     */
    public static function checkResponse(RequestSingleton $request, RequestSingleton $response)
    {
        self::setData($request, $response);

        return $request->getStatus();
    }

    /**
     * Set Response data by Request Response Data and return Request
     *
     * @param RequestSingleton $request
     * @param RequestSingleton $response
     * @return RequestSingleton
     */
    public static function setData(RequestSingleton $request, RequestSingleton $response)
    {
        $response->setData($request->getData());

        return $request;
    }

    /**
     * Parse Request and set Response Data by Request Response, Set Job Status and return Request
     *
     * @param RequestSingleton $request
     * @param RequestSingleton $response
     * @param mixed $arguments
     * @return RequestSingleton
     */
    public static function parseRequest(RequestSingleton $request, RequestSingleton $response, $arguments)
    {
        self::setData(self::parseResponse($request, $response, $arguments), $response);

        self::setStatus($request, $response);

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
        self::setData(self::parse($request, $arguments), $response);

        return $request;
    }

    /**
     * Parse Request and return Request Instance
     *
     * @param RequestSingleton $request
     * @param mixed $arguments
     * @return RequestSingleton
     */
    public static function parse(RequestSingleton $request, $arguments = null)
    {
        $request->parse($arguments);

        return $request;
    }

    /**
     * Set Response Job Status and return Request
     *
     * @param RequestSingleton $request
     * @param RequestSingleton $response
     * @return RequestSingleton
     */
    public static function setStatus(RequestSingleton $request, RequestSingleton $response)
    {
        $response->setStatus($request->getStatus());

        return $request;
    }

    /**
     * Parse Request with Arguments and Set Request Response Data and return Request
     *
     * @param RequestSingleton $request
     * @param mixed $arguments
     * @return RequestSingleton
     */
    public static function parseData(RequestSingleton $request, $arguments)
    {
        self::setData(self::parse($request, $arguments), $request);

        return $request;
    }
}
