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
        $formHandler = new Forms(Strings::toCamel($requestContent['resource'], true), '/' . $requestContent['resource'] . '/add/', 'POST');

        if(isset($requestContent['arguments']['received_post_constructor'])) {
            $formHandler->addTextCallout('Received Post', 'The CMS received a POST requested. As we at BETA stage, you cannot get the 
            content of the POST. Futurely you will be able to see directly the POST content.', ['class' => 'warning', 'id' => '']);
        }

        foreach($requestContent['keys'] as $propertyObject) {
            $formHandler->addTextInput($propertyObject->PROP_FRIENDLY_NAME, Strings::toCamel($propertyObject->PROP_FRIENDLY_NAME, true));
        }

        $formHandler->addButton('Add', 'submit', 'Add Resource Item');

        $formHandler->addOnClickButton('Cancel', 'button', 'Cancel', 'history.back()', ['class' => 'secondary', 'id' => '']);

        DataHandler::setHandlerData($this, "<div class='large-12 columns'>{$formHandler->showContent()}</div>", true);
    }
}
