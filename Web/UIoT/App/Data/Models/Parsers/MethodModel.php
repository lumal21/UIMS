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
    protected $response;

    /**
     * @var RequestSingleton Input Collector
     */
    protected $input;

    /**
     * Get Response Collector Rendered Data
     *
     * @return RequestSingleton
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set Response Collector and Treat Data
     *
     * @param mixed|RequestSingleton $response
     *
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get Input Collector
     *
     * @return RequestSingleton
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Set Input Collector
     *
     * @param RequestSingleton $input
     *
     * @return $this
     */
    public function setInput(RequestSingleton $input)
    {
        $this->input = $input;

        return $this;
    }
}
