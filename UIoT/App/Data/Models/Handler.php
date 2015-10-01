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

namespace UIoT\App\Data\Models;

use UIoT\App\Data\Interfaces\Handler as InterfaceHandler;

/**
 * Class Handler
 * @package UIoT\App\Data\Models\Types
 */
class Handler implements InterfaceHandler
{
    protected $content;

    /**
     * @param $request_content
     */
    function __construct($request_content)
    {
        /* nothing coded */
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->content;
    }
}