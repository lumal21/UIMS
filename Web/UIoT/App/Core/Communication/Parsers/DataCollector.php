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
use UIoT\App\Data\Models\Parsers\CollectorModel;
use UIoT\App\Data\Models\Parsers\HandlerModel;

/**
 * Class DataCollector
 * Manages all Data Collection and Filtering/Rendering from Requests
 *
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataCollector
{
    /**
     *
     * Array of Collectors
     *
     * @var array
     */
    private static $collectors;

    /**
     *
     * Start the Handler
     *
     * DataCollector constructor.
     */
    public function __construct()
    {
        $this->startCollectors();
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
     * Start Indexing all Collectors
     * Start the Handler, and register everything
     */
    public static function startCollectors()
    {
        self::registerCollectors();
    }

    /**
     *
     * Do the REST request
     *
     * @return array|mixed|null|object|string
     */
    public static function doRequest()
    {
        return Manager::getResourceProperties();
    }

    /**
     *
     * Return Collector and Handler
     *
     * @param CollectorModel|null $collector
     * @param string|HandlerModel $handler
     *
     * @return mixed|null
     */
    public static function initCollector(CollectorModel $collector = null, $handler = '')
    {
        return $collector->passRequest(self::doRequest())->passHandler($handler);
    }

    /**
     *
     * Return all Collectors
     *
     * @return array
     */
    public static function getCollectors()
    {
        return self::$collectors;
    }
}
