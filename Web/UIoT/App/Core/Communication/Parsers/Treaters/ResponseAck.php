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
use UIoT\App\Helpers\Manipulation\Constants;

/**
 * Class ResponseAck
 * @package UIoT\App\Core\Communication\Parsers\Treaters
 */
class ResponseAck extends RequestSingleton
{
    /**
     * Parse a Response Acknowledge
     *
     * @param mixed $data
     * @return void
     */
    public function parse($data)
    {
        if (is_bool($data)) {
            RequestParser::parseRequest(RaiseCode::getInstance(), $this,
                DataTreater::generateCode($data,
                    ['code' => '200', 'message' => 'RAISE received the sent data. Operation Method: ' . Constants::get('REQUEST_METHOD')]));
        } elseif (is_object($data)) {
            RequestParser::parseRequest(ResourceObject::getInstance(), $this, $data);
        }
    }
}
