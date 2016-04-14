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
use UIoT\App\Core\Communication\Parsers\Collectors\DeleteCollector;
use UIoT\App\Core\Communication\Parsers\Collectors\GetCollector;
use UIoT\App\Core\Communication\Parsers\Collectors\PostCollector;
use UIoT\App\Core\Communication\Parsers\Collectors\PutCollector;
use UIoT\App\Core\Resources\Manager;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class DataCollector
 *
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataCollector
{
    /**
     * Array of Collectors
     *
     * @var array
     */
    private static $collectors;

    /**
     * Do the REST request
     *
     * @return array|mixed|null|object|string
     */
    public static function doRequest()
    {
        return Manager::getResourceProperties();
    }

    /**
     * Set Base Data Collectors
     */
    public function __construct()
    {
        self::$collectors = [
            Http::GET => GetCollector::getInstance(),
            Http::POST => PostCollector::getInstance(),
            Http::PUT => PutCollector::getInstance(),
            Http::DELETE => DeleteCollector::getInstance(),
        ];
    }

    /**
     * Return a specific data collector
     *
     * @param RequestSingleton $requestedCollector
     *
     * @return RequestSingleton
     */
    public static function getCollector(RequestSingleton $requestedCollector)
    {
        return $requestedCollector;
    }

    /**
     * Get a Base Collector
     *
     * @param string $collectorMethod
     *
     * @return RequestSingleton
     */
    public static function getBaseCollector($collectorMethod)
    {
        return self::$collectors[$collectorMethod];
    }

    /**
     * Get Collectors
     *
     * @return array
     */
    public static function getCollectors()
    {
        return self::$collectors;
    }
}
