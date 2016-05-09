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
    public static function runMethodCollector($resourceData = ['name' => '', 'method' => '', 'arguments' => []])
    {
        $baseCollector = self::getMethodCollector($resourceData['method']);

        $baseCollector->parse($resourceData);

        return $baseCollector->getResponse();
    }

    /**
     * Get a Base Collector
     *
     * @param string $collectorMethod Collector Method
     * @return RequestSingleton Base Collector
     */
    public static function getMethodCollector($collectorMethod)
    {
        $collectorName = DataHandler::getMethodName($collectorMethod);

        $collectorVariable = self::getMethodCollectors()[$collectorName];

        return self::callCollectorStaticMethod($collectorVariable, 'getInstance');
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

    /**
     * Check a treater status and set his response
     *
     * @param RequestSingleton $checkedTreater selected Treater
     * @param RequestSingleton $responseCollector response Collector
     * @return bool if need stop the execution
     */
    public static function getCollectorStatus(RequestSingleton $checkedTreater, RequestSingleton $responseCollector)
    {
        $responseCollector->setResponse($checkedTreater->getResponse());
        return $checkedTreater->getDone();
    }
}
