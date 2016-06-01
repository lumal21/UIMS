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

use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class ResourceId
 * @package UIoT\App\Core\Communication\Parsers\Treaters
 */
class ResourceId extends RequestSingleton
{
    /**
     * Parse a Resource Id
     *
     * @param mixed $data
     * @return void
     */
    public function parse($data)
    {
        if (!is_array($data)) {
            RequestParser::parseRequest(ResourceObject::getInstance(), $this, $data);
        } elseif (property_exists($data[0], 'ID')) {
            RequestParser::setCustomData($this, $data[0]->ID);
        }
    }
}
