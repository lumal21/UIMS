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

namespace UIoT\App\Data\Models;

use UIoT\App\Data\Interfaces\HandlerInterface;

/**
 * Class HandlerModel
 * @package UIoT\App\Data\Models
 */
class HandlerModel implements HandlerInterface
{
    protected $content;

    /**
     * HandlerModel constructor.
     * @param $request_content
     */
    public function __construct($request_content)
    {
        $this->content .= '<pre>';
        $this->content .= print_r($request_content, true);
        $this->content .= '</pre>';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->content;
    }
}
