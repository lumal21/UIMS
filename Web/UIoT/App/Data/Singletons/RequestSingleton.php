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

namespace UIoT\App\Data\Singletons;

use UIoT\App\Data\Models\Requesting\RequestModel;

/**
 * Class RequestSingleton
 * @package UIoT\App\Data\Singletons
 */
class RequestSingleton extends RequestModel
{
    /**
     * @var RequestSingleton
     */
    protected static $requestInstance = null;

    /**
     * Return Instance of Controller
     *
     * @return RequestSingleton
     */
    public static function getInstance()
    {
        if (null === static::$requestInstance) {
            static::$requestInstance = new static;
        }

        return static::$requestInstance;
    }
}
