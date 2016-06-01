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

namespace UIoT\App\Core\Communication\Methods;

use Httpful\Http;
use UIoT\App\Core\Communication\Parsers\Treaters\ResourceItem;
use UIoT\App\Core\Communication\Requesting\RaiseRequest;
use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Models\Parsers\MethodModel;
use UIoT\App\Helpers\Manipulation\Constants;

/**
 * Class Put
 * @package UIoT\App\Core\Communication\Methods
 */
class Put extends MethodModel
{
    /**
     * Set Put Method
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     *
     * @param array $data
     * @return $this
     */
    public function setData($data)
    {
        if (Constants::get('REQUEST_METHOD') == Http::POST) {
            RaiseRequest::put("{$data['name']}?" . Constants::get('QUERY_STRING') . '&' . http_build_query(Constants::getJson('HTTP_PHP_POST')));
        }

        return parent::setData(RequestParser::parse(ResourceItem::getInstance(), RaiseRequest::get("{$data['name']}?" . Constants::get('QUERY_STRING'))));
    }
}
