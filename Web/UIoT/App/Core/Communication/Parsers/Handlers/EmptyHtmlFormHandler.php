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

use UIoT\App\Core\Communication\Parsers\DataHandler;
use UIoT\App\Data\Singletons\RequestSingleton;
use UIoT\App\Helpers\Manipulation\Strings;
use UIoT\App\Helpers\Visual\Forms;

/**
 * Class EmptyHtmlFormHandler
 * @package UIoT\App\Core\Communication\Parsers\Handlers
 */
class EmptyHtmlFormHandler extends RequestSingleton
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
        $formHandler = new Forms(Strings::toCamel($requestContent['resource'], true));

        foreach($requestContent['values'] as $itemObject) {
            $itemDetails = array_slice($requestContent['keys'], 0, 2);

            $formHandler->addHeader("ID: {$itemObject->{$itemDetails[0]->PROP_NAME}}", "Name: {$itemObject->{$itemDetails[1]->PROP_NAME}}");

            foreach($requestContent['keys'] as $propertyObject) {
                $formHandler->addTextInput($propertyObject->PROP_FRIENDLY_NAME, Strings::toCamel($propertyObject->PROP_FRIENDLY_NAME, true));
            }
        }

        $formHandler->addButton('Save', 'submit', 'Save Edited Data');

        $formHandler->addOnClickButton('Cancel', 'button', 'Cancel', 'history.back()', ['class' => 'secondary', 'id' => '']);

        DataHandler::setHandlerData($this, "<div class='large-12 columns'>{$formHandler->showContent()}</div>", true);
    }
}
