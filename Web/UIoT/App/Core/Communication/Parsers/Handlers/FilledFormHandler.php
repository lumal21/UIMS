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

use Httpful\Http;
use UIoT\App\Core\Communication\Requesting\RequestParserMethods;
use UIoT\App\Data\Models\Parsers\PropertyObject;
use UIoT\App\Data\Singletons\RequestSingleton;
use UIoT\App\Helpers\Manipulation\DataTypes;
use UIoT\App\Helpers\Manipulation\Strings;
use UIoT\App\Helpers\Visual\Forms;

/**
 * Class FilledFormHandler
 * @package UIoT\App\Core\Communication\Parsers\Handlers
 */
class FilledFormHandler extends RequestSingleton
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
        $formHandler = new Forms(Strings::toCamel($requestContent['resource'], true), "/{$requestContent['resource']}/edit?id={$requestContent['values'][0]->ID}", Http::POST);
        $formHandler->addHeader("ID: {$requestContent['values'][0]->ID}");

        foreach (DataTypes::removeDisabledTypes($requestContent['keys']) as $property) {
            /** @var $property PropertyObject */
            $formHandler->addTextInputWithValue($property->PROP_FRIENDLY_NAME, Strings::toCamel($property->PROP_FRIENDLY_NAME, true), [], ['value' => $requestContent['values'][0]->{$property->PROP_NAME}]);
        }

        $formHandler->addButton('submit', 'Save Edited Data');
        $formHandler->addOnClickButton('button', 'Cancel', 'history.back()', ['class' => 'secondary', 'id' => '']);

        RequestParserMethods::setCustomResponseDataWithStatus($this, "<div class='large-12 columns'>{$formHandler->showContent()}</div>", true);
    }
}
