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
use UIoT\App\Core\Layouts\Factory;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class DataHandler - Manages the Handling of the Specific Data of Each Type
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataHandler
{
    /**
     * @var array
     */
    private static $names = [];

    /**
     * @var array
     */
    private static $layouts = [];

    /**
     * Set Layouts and Names
     */
    public function __construct()
    {
        self::$names = [
            Http::GET => 'Main',
            Http::POST => 'Add',
            Http::PUT => 'Edit',
            Http::DELETE => 'Remove',
        ];

        self::$layouts = [
            Http::GET => Factory::addLayout(self::$names[Http::GET]),
            Http::POST => Factory::addLayout(self::$names[Http::POST]),
            Http::PUT => Factory::addLayout(self::$names[Http::PUT]),
            Http::DELETE => Factory::addLayout(self::$names[Http::DELETE]),
        ];
    }

    /**
     * Set Collector Handler response
     *
     * @param RequestSingleton $handler Response Handler
     * @param RequestSingleton $collector Response Collector
     * @param mixed $arguments Handler Arguments
     */
    public static function setHandlerResponse(RequestSingleton $handler, RequestSingleton $collector, $arguments)
    {
        $localHandler = $handler::getInstance();
        $localHandler->parse($arguments);

        $collector->setResponse($handler->getResponse());
    }

    /**
     * Get Names
     *
     * @return array
     */
    public static function getNames()
    {
        return self::$names;
    }

    /**
     * Return a specific data handler
     *
     * @param RequestSingleton $requestedHandler
     * @return RequestSingleton
     */
    public static function getHandler(RequestSingleton $requestedHandler)
    {
        return $requestedHandler;
    }

    /**
     * Get Layouts
     *
     * @return array
     */
    public static function getLayouts()
    {
        return self::$layouts;
    }
}
