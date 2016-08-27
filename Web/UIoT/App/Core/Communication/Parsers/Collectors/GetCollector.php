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
use UIoT\App\Core\Communication\Parsers\Handlers\DataTable;
use UIoT\App\Core\Communication\Requesting\RaiseRequest;
use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Models\Parsers\PropertyObject;
use UIoT\App\Data\Singletons\RequestSingleton;

/**
 * Class GetCollector
 * @package UIoT\App\Core\Communication\Parsers\Collectors
 */
class GetCollector extends RequestSingleton
{
    /**
     * Parse a GET Request
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     *
     * @param array $data
     * @return void
     */
    public function parse($data)
    {
        $get = (new Get)->setInput($this)->setData($data);

        if (RequestParser::checkResponse($get->getResponse(), $this)) {
            return;
        }

        RequestParser::parseRequest(DataTable::getInstance(), $this, [
            'resource' => $data['name'],
            'keys' => array_map(function ($property) {
                /** @var $property PropertyObject */
                return $property->friendly_name;
            }, array_filter($get->getResponse()->getData(), function ($property) {
                /** @var $property PropertyObject */
                return $property->optionality == '0' || $property->friendly_name == 'id';
            })),
            'values' => RaiseRequest::get("{$data['name']}?token={$this->getToken()}")
        ]);
    }
}
