<?php

/**
 * UIoT CMS
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
 * @app UIoT Content Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Communication\Parsers;

use Httpful\Http;
use UIoT\App\Core\Communication\Requesting\Raise;
use UIoT\App\Data\Models\Collector;
use UIoT\App\Data\Models\Handler;

/**
 * Class DataCollector
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataCollector
{
    /**
     * @var array
     */
    private static $collectors;

    /**
     * Start the Handler
     */
    function __construct()
    {
        $this->startCollectors();
    }

    /**
     * Register Httpful UIoT Data Collectors
     * Methods: GET, POST, PUT, DELETE
     * Default Handlers: Gettable, Postable, Puttable, Deletable
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
    static function startCollectors()
    {
        self::registerCollectors();
    }

    /**
     * Do the REST request
     *
     * @return array|mixed|null|object|string
     */
    static function doRequest()
    {
        return Raise::doRequest(DataManager::getController() . '/');
    }

    /**
     * Return Collector and Handler
     *
     * @param Collector $collector
     * @param string|Handler $handler
     * @return $this
     */
    static function initCollector(Collector $collector, $handler = '')
    {
        return ($collector->passRequest(self::doRequest())->passHandler($handler));
    }

    /**
     * Return all Collectors
     *
     * @return mixed
     */
    public static function getCollectors()
    {
        return self::$collectors;
    }
}