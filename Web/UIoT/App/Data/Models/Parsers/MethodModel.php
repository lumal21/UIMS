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

namespace UIoT\App\Data\Models\Parsers;

use UIoT\App\Data\Interfaces\Parsers\MethodInterface;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class MethodModel
 * @package UIoT\App\Data\Models
 */
class MethodModel implements MethodInterface
{
    /**
     * @var RequestSingleton Response Collector
     */
    protected $responseCollector;

    /**
     * @var RequestSingleton Input Collector
     */
    protected $receivedCollector;

    /**
     * Get Data
     *
     * @return RequestSingleton
     */
    public function getResponseCollector()
    {
        return $this->responseCollector;
    }

    /**
     * Set Data
     *
     * @param array $responseCollector
     *
     * @return $this
     */
    public function setResponseCollector(array $responseCollector)
    {
        $this->responseCollector = RequestSingleton::getInstance();

        return $this;
    }

    /**
     * Get Collector
     *
     * @return RequestSingleton
     */
    public function getReceivedCollector()
    {
        return $this->receivedCollector;
    }

    /**
     * Set Collector
     *
     * @param RequestSingleton $receivedCollector
     *
     * @return $this
     */
    public function setReceivedCollector(RequestSingleton $receivedCollector)
    {
        $this->receivedCollector = $receivedCollector;

        return $this;
    }
}
