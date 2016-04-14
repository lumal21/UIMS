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

use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class RaiseCodeMessageHandler
 *
 * @package UIoT\App\Core\Communication\Parsers\Handlers
 */
class RaiseCodeMessageHandler extends RequestSingleton
{
    /**
     * Controller Model Instance
     *
     * @var RequestSingleton
     */
    protected static $requestInstance = null;

    /**
     * Parse Request Data or Do Request
     *
     * @param mixed $requestContent
     *
     * @return void
     */
    public function parse($requestContent)
    {
        $responseContentRaw =
            '<div class="callout">' .
            '<h5>Raise (#' . $requestContent->code . ')</h5>' .
            '<p>' . $requestContent->message . '</p>' .
            '</div>';

        $this->setResponse($responseContentRaw);

        $this->setDone(true);
    }
}
