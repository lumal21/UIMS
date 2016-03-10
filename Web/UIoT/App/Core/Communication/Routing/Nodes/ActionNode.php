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

namespace UIoT\App\Core\Communication\Routing\Nodes;

use UIoT\App\Core\Communication\Routing\RenderSelector;
use UIoT\App\Core\Controllers\Commander;
use UIoT\App\Core\Controllers\Indexer;
use UIoT\App\Core\Templates\Render;
use UIoT\App\Data\Models\NodeHandlerModel;
use UIoT\App\Data\Models\NodeModel;

/**
 * Class ModelNode
 * @package UIoT\App\Core\Communication\Routing\Nodes
 */
final class ActionNode extends NodeHandlerModel
{
    /**
     * ControllerNode constructor.
     *
     * @param NodeModel $node
     */
    public function __construct(NodeModel $node = null)
    {
        parent::__construct($node);
    }

    /**
     * Callback Function
     */
    public function call()
    {
        $this->setResult(Indexer::controllerExists($this->getPathValue()[0]));

        $this->setResult(Commander::controllerActionExists($this->getPathValue()[0], $this->getPathValue()[1]));

        $this->getResult() || Commander::showNonExistentActionError($this->getPathValue()[0], $this->getPathValue()[1]);

        !$this->getResult() || $this->setResultContent(RenderSelector::go(new Render(['controller' => $this->getPathValue()[0], 'action' => $this->getPathValue()[1]])));
    }
}
