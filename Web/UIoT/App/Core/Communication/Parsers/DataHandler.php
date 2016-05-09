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

namespace UIoT\App\Core\Communication\Parsers;

use Httpful\Http;
use InvalidArgumentException;
use UIoT\App\Data\Singletons\RequestSingleton;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class DataHandler - Manages the Handling of the Specific Data of Each Type
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataHandler
{
    /**
     * @var array Method Handlers aka Layouts
     */
    private static $methodHandlers = [
        'Main' => Http::GET,
        'Add' => Http::POST,
        'Edit' => Http::PUT,
        'Delete' => Http::DELETE,
    ];

    /**
     * Set Collector Handler response
     *
     * @param RequestSingleton $handler Response Handler
     * @param RequestSingleton $collector Response Collector
     * @param mixed $arguments Handler Arguments
     */
    public static function setHandlerResponseStatus(RequestSingleton $handler, RequestSingleton $collector, $arguments)
    {
        $handler->parse($arguments);
        $collector->setResponse($handler->getResponse());
        $collector->setDone($handler->getDone());
    }

    /**
     * Set Handler Data
     *
     * @param RequestSingleton $handler
     * @param mixed $response
     * @param bool $status
     */
    public static function setHandlerData(RequestSingleton $handler, $response, $status)
    {
        $handler->setResponse($response);
        $handler->setDone($status);
    }

    /**
     * Get Method Handler
     *
     * @param string $methodHandler
     * @return mixed
     */
    public static function getMethodName($methodHandler)
    {
        if(!array_key_exists(Strings::toCamel($methodHandler), self::getMethodHandlers())) {
            throw new InvalidArgumentException('Invalid Raise Method', '404');
        }

        return self::getMethodHandlers()[Strings::toCamel($methodHandler)];
    }

    /**
     * Get Method Layouts
     *
     * @return array
     */
    public static function getMethodHandlers()
    {
        return self::$methodHandlers;
    }
}
