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

use UIoT\App\Data\Interfaces\Parsers\HandlerInterface;

/**
 * Class HandlerModel
 *
 * @package UIoT\App\Data\Models
 */
class HandlerModel implements HandlerInterface
{
    /**
     * Handled Content
     *
     * @var mixed
     */
    protected $content;

    /**
     * Handle Request
     *
     * @param $request_content
     */
    public function handleRequest($request_content)
    {
        $this->content = $request_content;
    }

    /**
     * Return Content
     *
     * @return string
     */
    public function returnResponse()
    {
        return $this->content;
    }
}
