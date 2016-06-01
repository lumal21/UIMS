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

namespace UIoT\App\Core\Communication\Parsers\Handlers;

use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Singletons\RequestSingleton;
use UIoT\App\Helpers\Visual\Html;

/**
 * Class RaiseCode
 * @package UIoT\App\Core\Communication\Parsers\Handlers
 */
class RaiseCode extends RequestSingleton
{
    /**
     * Create a RAISE Code
     *
     * @param mixed $data
     * @return void
     */
    public function parse($data)
    {
        $html = new Html();
        $html->addTextCallout("Response Code (#{$data->code})", $data->message);
        RequestParser::setCustomResponse($this, "<div class='large-12 columns'>{$html->showContent()}</div>", true);
    }
}
