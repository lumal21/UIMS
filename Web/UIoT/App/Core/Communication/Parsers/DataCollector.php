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
use UIoT\App\Core\Communication\Requesting\RequestParser;
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
     * @param string $name
     * @param string $method
     * @return mixed
     */
    public static function run($name, $method)
    {
        return RequestParser::parse(self::get($method),
            ['name' => $name, 'method' => $method])->getData();
    }

    /**
     * Get a Base Collector
     *
     * @param string $method Collector Method
     * @return RequestSingleton Base Collector
     */
    public static function get($method)
    {
        return self::call(self::getAll()[DataHandler::getName($method)], 'getInstance');
    }

    /**
     * Get Method Collectors
     *
     * @return array
     */
    public static function getAll()
    {
        return self::$methodCollectors;
    }

    /**
     * Call Collector static method.
     *
     * @param string $name
     * @param string $method
     * @return mixed
     */
    public static function call($name, $method)
    {
        return forward_static_call(['UIoT\App\Core\Communication\Parsers\Collectors\\' . $name, $method]);
    }
}
