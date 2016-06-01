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

use stdClass;

/**
 * Class DataTreater
 * @package UIoT\App\Core\Communication\Parsers
 */
class DataTreater
{
    /**
     * Set Response Code for Treaters
     *
     * @param mixed $requestedContent
     * @param array $arguments
     * @return mixed|stdClass
     */
    public static function generateCode($requestedContent, $arguments = [])
    {
        if (!property_exists($requestedContent, 'code') || !property_exists($requestedContent, 'message')) {
            $requestedContent = new stdClass();
            $requestedContent->code = $arguments['code'];
            $requestedContent->message = $arguments['message'];
        }

        return $requestedContent;
    }
}
