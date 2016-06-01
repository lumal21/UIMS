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
use UIoT\App\Core\Communication\Parsers\DataTypes;
use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Models\Parsers\PropertyObject;
use UIoT\App\Data\Singletons\RequestSingleton;
use UIoT\App\Helpers\Manipulation\Strings;
use UIoT\App\Helpers\Visual\Forms;

/**
 * Class EmptyForm
 * @package UIoT\App\Core\Communication\Parsers\Handlers
 */
class EmptyForm extends RequestSingleton
{
    /**
     * @var RequestSingleton
     */
    protected static $requestInstance = null;

    /**
     * Parse Request Data or Do Request
     *
     * @param mixed $data
     * @return void
     */
    public function parse($data)
    {
        $form = new Forms(Strings::toCamel($data['resource'], true), "/{$data['resource']}/add/", Http::POST);

        foreach (DataTypes::removeTypes($data['keys']) as $property) {
            /** @var $property PropertyObject */
            $form->addTextInputWithValue($property->PROP_FRIENDLY_NAME, Strings::toCamel($property->PROP_FRIENDLY_NAME, true),
                [], ['value' => DataTypes::getType($property->PROP_FRIENDLY_NAME)]);
        }

        $form->addButton('submit', 'Add Resource Item');
        $form->addOnClickButton('button', 'Cancel', 'history.back()', ['class' => 'secondary', 'id' => '']);

        RequestParser::setCustomResponse($this, "<div class='large-12 columns'>{$form->showContent()}</div>", true);
    }
}
