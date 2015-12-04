<?php

/**
 * UIoT CMS
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
 * @app UIoT Content Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @copyright University of Bras�lia
 */

namespace UIoT\App\Core\Communication\Routing\Nodes;

use UIoT\App\Core\Communication\Routing\RenderSelector;
use UIoT\App\Core\Controllers\Commander;
use UIoT\App\Core\Controllers\Indexer;
use UIoT\App\Core\Helpers\Manipulation\Arrays;
use UIoT\App\Core\Helpers\Manipulation\Constants;
use UIoT\App\Core\Helpers\Manipulation\Strings;
use UIoT\App\Core\Templates\Render;
use UIoT\App\Data\Models\NodeHandlerModel;
use UIoT\App\Data\Models\NodeModel;
use UIoT\App\Exception\Register;

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
        $this->setResult(Indexer::controllerExists(Strings::toControllerName($this->getPathValue()[0])));

        $this->setResult(Commander::controllerActionExists($this->getPathValue()[0], $this->getPathValue()[1]) && !Arrays::inArrayAny(Arrays::toResourceName($this->getPathValue()), Constants::returnJsonConstant('RESOURCE_TYPES')));

        $this->getResult() || Register::getRunner()->errorMessage(902,
            "Stop! That Action Doesn't Exists!",
            'Details: ',
            [
                'What Happened?' => "You're trying to Call an nonexistent Action",
                'What Action?' => "Action with name: {$this->getPathValue()[1]}",
                'From the Controller:' => "{$this->getPathValue()[0]}",
                'Resolution:' => "Stop trying to call nonexistent actions.",
                'What Actions can i Call?' => "You can Call UIoT's Abstract Actions (Handlers), and the Built-In Controllers Actions",
                'Are you the developer?' => 'You can open this same error Page with Developer Code, only need put ?de on the Url'
            ]
        );

        !$this->getResult() || RenderSelector::select(RenderSelector::instantiate(new Render(['controller' => Strings::toControllerName($this->getPathValue()[0]), 'action' => Strings::toControllerName($this->getPathValue()[1])])));
    }
}
