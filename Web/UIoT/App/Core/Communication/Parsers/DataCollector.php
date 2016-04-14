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
     * Start the Handler
     *
     * DataCollector constructor.
     */
    public function __construct()
    {
        $this->registerCollectors();
    }

    /**
     * Register Httpful UIoT Data Collectors
     * Methods: GET, POST, PUT, DELETE
     * Default Collectors: GetCollector, PostCollector, PutCollector, DeleteCollector
     */
    private static function registerCollectors()
    {
        self::$collectors = [
            Http::GET => new Collectors\GetCollector(),
            Http::POST => new Collectors\PostCollector(),
            Http::PUT => new Collectors\PutCollector(),
            Http::DELETE => new Collectors\DeleteCollector(),
        ];
    }

    /**
     *
     * Return all Collectors
     *
     * @param RequestSingleton $requestedSingleton
     *
     * @return RequestSingleton
     */
    public static function getCollector(RequestSingleton $requestedSingleton)
    {
        return $requestedSingleton::getInstance();
    }
}
