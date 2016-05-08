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

use UIoT\App\Core\Communication\Routing\RenderSelector;
use UIoT\App\Core\Controllers\Factory;
use UIoT\App\Core\Resources\Render;
use UIoT\App\Data\Models\Routing\NodeHandlerModel;

/**
 * Class ResourceActionNode
 * @package UIoT\App\Data\Models\Nodes
 */
final class ResourceActionNode extends NodeHandlerModel
{
    /**
     * Callback Function
     */
    public function call()
    {
        $this->setResult(!Factory::controllerExists($this->getPathValue()[0]));

        $this->setResult(!Factory::controllerActionExists($this->getPathValue()[0], $this->getPathValue()[1]));

        !$this->getResult() || $this->setResultContent(RenderSelector::go(new Render([
            'resource' => $this->getPathValue()[0],
            'method' => $this->getPathValue()[1]]))
        );
    }
}
