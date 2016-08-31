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

namespace UIoT\App\Core\Communication\Parsers\Treaters;

use UIoT\App\Core\Communication\Parsers\DataTreater;
use UIoT\App\Core\Communication\Parsers\Handlers\RaiseCode;
use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class ResourceObject
 * @package UIoT\App\Core\Communication\Parsers\Treaters
 */
class ResourceObject extends RequestSingleton
{
    /**
     * Parse a Resource Object
     *
     * @param mixed $data
     * @return void
     */
    public function parse($data)
    {
        if (is_object($data) || (is_array($data) && sizeof($data) == 0)) {
            RequestParser::parseRequest(RaiseCode::getInstance(), $this,
                property_exists($data, 'code') ? $data : DataTreater::generateCode($data,
                    ['code' => '400', 'message' => 'Invalid Resource Requested to RAISe']));
        }
    }
}
