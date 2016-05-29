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

use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
use UIoT\App\Data\Models\Parsers\PropertyObject;
use UIoT\App\Data\Singletons\RequestSingleton;
use UIoT\App\Helpers\Manipulation\Strings;
use UIoT\App\Helpers\Visual\DataTable;
use UIoT\App\Helpers\Visual\Html;

/**
 * Class DataTableHandler
 * @package UIoT\App\Core\Communication\Parsers\Handlers
 */
class DataTableHandler extends RequestSingleton
{
    /**
     * @var RequestSingleton
     */
    protected static $requestInstance = null;

    /**
     * Parse Request Data or Do Request
     *
     * @param mixed $requestContent
     * @return void
     */
    public function parse($requestContent)
    {
        $dataTable = new DataTable($resourcePrettyName = Strings::toCamel($requestContent['resource'], true));

        foreach ($requestContent['keys'] as $property) {
            /** @var $property PropertyObject */
            $dataTable->addLinkInteraction($property->PROP_NAME, "/{$requestContent['resource']}/edit?{$property->PROP_FRIENDLY_NAME}");
            $dataTable->addHeader(Strings::toCamel($property->PROP_FRIENDLY_NAME, true));
        }

        foreach ($requestContent['values'] as $property) {
            $dataTable->addBody($property);
        }

        $htmlContent = new Html();
        $htmlContent->addOnClickButton('button', "Add New $resourcePrettyName", "window.location.href=\"/{$requestContent['resource']}/add/\"", ['class' => 'success', 'id' => '']);

        RequestParserMethods::setCustomResponseDataWithStatus($this, "<div class='large-12 columns'>{$dataTable->showContent()}{$htmlContent->showContent()}</div>", true);
    }
}
