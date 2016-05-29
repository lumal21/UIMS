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
use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class DataCollector
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataCollector
{
    /**
     * @var array Base Collectors
     */
    private static $methodCollectors = [
        Http::GET => 'GetCollector',
        Http::POST => 'PostCollector',
        Http::PUT => 'PutCollector',
        Http::DELETE => 'DeleteCollector',
    ];

    /**
     * Run Base Collector
     *
     * @param array $resourceData
     * @return string Response Data
     */
    public static function runCollector($resourceData = ['name' => '', 'method' => ''])
    {
        return RequestParserMethods::parseRequest(self::getMethodCollector($resourceData['method']), $resourceData)->getData();
    }

    /**
     * Get a Base Collector
     *
     * @param string $collectorMethod Collector Method
     * @return RequestSingleton Base Collector
     */
    public static function getMethodCollector($collectorMethod)
    {
        return self::callCollectorStaticMethod(self::getMethodCollectors()[DataHandler::getMethodName($collectorMethod)], 'getInstance');
    }

    /**
     * Get Method Collectors
     *
     * @return array
     */
    public static function getMethodCollectors()
    {
        return self::$methodCollectors;
    }

    /**
     * Call Collector static method.
     *
     * @param string $collectorName
     * @param string $collectorMethod
     * @return mixed
     */
    public static function callCollectorStaticMethod($collectorName, $collectorMethod)
    {
        return forward_static_call(["UIoT\\App\\Core\\Communication\\Parsers\\Collectors\\" . $collectorName, $collectorMethod]);
    }
}
