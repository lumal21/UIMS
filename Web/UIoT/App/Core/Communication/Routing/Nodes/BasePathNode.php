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
use UIoT\App\Core\Templates\Render;
use UIoT\App\Data\Models\Routing\NodeHandlerModel;
use UIoT\App\Data\Models\Routing\NodeModel;
use UIoT\App\Helpers\Manipulation\Constants;

/**
 * Class BasePathNode
 * @package UIoT\App\Core\Communication\Routing\Nodes
 */
final class BasePathNode extends NodeHandlerModel
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
     *
     * @return boolean|null
     */
    public function call()
    {
        $this->setResultContent(RenderSelector::go(new Render(['controller' => Constants::returnConstant('DEFAULT_CONTROLLER'), 'action' => Constants::returnConstant('DEFAULT_CONTROLLER_ACTION')])));
    }
}
