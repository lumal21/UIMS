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
 * Class ResourceItem
 * @package UIoT\App\Core\Communication\Parsers\Treaters
 *
 * @SuppressWarnings(PHPMD)
 */
class ResourceItem extends RequestSingleton
{
    /**
     * Parse a Resource Item
     *
     * @param array $data
     * @return void
     */
    public function parse($data)
    {
        if (is_object($data)) {
            RequestParser::parseRequest(RaiseCode::getInstance(), $this,
                DataTreater::generateCode($data,
                    [
                        'code' => '404',
                        'message' => 'The requested resource item isn\'t a registered RAISE resource item.'
                    ]));
        } else {
            RequestParser::setCustomData($this, $data);
        }
    }
}
