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

namespace UIoT\App\Data\Models\Nodes;

use UIoT\App\Core\Communication\Parsers\DataHandler;
use UIoT\App\Core\Communication\Routing\Handler;
use UIoT\App\Core\Controllers\Factory;
use UIoT\App\Core\Resources\Render;
use UIoT\App\Data\Models\Routing\NodeHandlerModel;
use UIoT\App\Helpers\Manipulation\Arrays;

/**
 * Class ResourceActionPageNode
 * @package UIoT\App\Data\Models\Nodes
 */
final class ResourceActionNode extends NodeHandlerModel
{
    /**
     * Callback Function
     */
    public function call()
    {
        $this->setStatus(Arrays::inArray($this->getPath()[1], array_keys(DataHandler::getMethods())) && !Factory::exists($this->getPath()[0]));

        !$this->getStatus() || $this->setData(Handler::go(new Render($this->getPath()[0], $this->getPath()[1])));
    }
}
