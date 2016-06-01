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

namespace UIoT\App\Core\Communication\Parsers\Collectors;


use UIoT\App\Core\Communication\Methods\Get;
use UIoT\App\Core\Communication\Methods\Put;
use UIoT\App\Core\Communication\Parsers\Handlers\FilledForm;
use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class PutCollector
 * @package UIoT\App\Core\Communication\Parsers\Collectors
 */
class PutCollector extends RequestSingleton
{
    /**
     * @var RequestSingleton
     */
    protected static $requestInstance = null;

    /**
     * Parse Request Data or Do Request
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     *
     * @param array $resourceData
     * @return void
     */
    public function parse($resourceData)
    {
        $get = (new Get)->setInput($this)->setData($resourceData);
        $put = (new Put)->setInput($this)->setData($resourceData);

        if (RequestParser::checkResponse($put->getResponse(), $this))
            return;

        RequestParser::parseRequest(FilledForm::getInstance(), $this, [
            'resource' => $resourceData['name'], 'keys' => $get->getResponse()->getData(),
            'values' => $put->getResponse()->getData()]);
    }
}
