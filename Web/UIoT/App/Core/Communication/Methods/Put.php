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
use UIoT\App\Core\Communication\Parsers\Treaters\SpecificResourceItemTreater;
use UIoT\App\Core\Communication\Requesting\RaiseRequestManager;
use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
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
     * @param array $resourceData
     * @return $this|void
     */
    public function setResponse($resourceData)
    {
        if (Constants::returnConstant('REQUEST_METHOD') == Http::POST) {
            RaiseRequestManager::doPutRequest("{$resourceData['name']}?" . Constants::returnConstant('QUERY_STRING') . '&' . http_build_query(Constants::returnJsonConstant('HTTP_PHP_POST')));
        }

        return parent::setResponse(RequestParserMethods::parseRequest(SpecificResourceItemTreater::getInstance(), RaiseRequestManager::doGetRequest("{$resourceData['name']}?" . Constants::returnConstant('QUERY_STRING'))));
    }
}
