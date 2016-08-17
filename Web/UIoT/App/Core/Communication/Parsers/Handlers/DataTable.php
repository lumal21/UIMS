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

use UIoT\App\Core\Communication\Requesting\RequestParser;
use UIoT\App\Data\Models\Parsers\PropertyObject;
use UIoT\App\Data\Singletons\RequestSingleton;
use UIoT\App\Helpers\Manipulation\Strings;
use UIoT\App\Helpers\Visual\DataTable as DataTableHelper;
use UIoT\App\Helpers\Visual\Html;

/**
 * Class DataTable
 * @package UIoT\App\Core\Communication\Parsers\Handlers
 */
class DataTable extends RequestSingleton
{
    /**
     * Create a Data Table
     *
     * @param mixed $data
     * @return void
     */
    public function parse($data)
    {
        $table = new DataTableHelper($resFriendly = Strings::toCamel($data['resource'], true));

        foreach ($data['keys'] as $property) {
            /** @var $property PropertyObject */
            $table->addLinkInteraction($property->friendly_name,
                "/{$data['resource']}/edit?{$property->friendly_name}");
            $table->addHeader(Strings::toCamel($property->friendly_name, true));
        }

        foreach ($data['values'] as $property) {
            $table->addBody($property);
        }

        $html = new Html();
        $html->addOnClickButton('button', "Add New $resFriendly", "window.location.href=\"/{$data['resource']}/add/\"",
            ['class' => 'success', 'id' => '']);

        RequestParser::setCustomResponse($this,
            "<div class='large-12 columns'>{$table->showContent()}{$html->showContent()}</div>", true);
    }
}
