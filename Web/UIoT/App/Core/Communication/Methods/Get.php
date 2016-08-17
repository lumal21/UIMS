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

use UIoT\App\Core\Communication\Parsers\Treaters\ResourceId;
use UIoT\App\Core\Communication\Parsers\Treaters\ResourceProperties;
use UIoT\App\Core\Communication\Requesting\RaiseRequest;
use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Models\Parsers\MethodModel;

/**
 * Class Get
 * @package UIoT\App\Core\Communication\Methods
 */
class Get extends MethodModel
{
    /**
     * Set Get Method
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     *
     * @param array $data
     * @return $this
     */
    public function setData($data)
    {
        $resId = RequestParser::parse(ResourceId::getInstance(),
            RaiseRequest::get("resources?token={$this->getToken()}&friendly_name={$data['name']}"));

        if (RequestParser::checkResponse($resId, $this->getInput())) {
            return parent::setData($resId);
        }

        $resProp = RequestParser::parse(ResourceProperties::getInstance(),
            RaiseRequest::get("properties?token={$this->getToken()}&resource_id={$resId->getData()}"));

        return parent::setData($resProp);
    }
}
