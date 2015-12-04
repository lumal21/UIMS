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

use UIoT\App\Data\Models\NodeHandlerModel;
use UIoT\App\Data\Models\NodeModel;
use UIoT\App\Exception\Register;

/**
 * Class NotFoundNode
 * @package UIoT\App\Core\Communication\Routing\Nodes
 */
class NotFoundNode extends NodeHandlerModel
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
        Register::getRunner()->errorMessage(906,
            "404!",
            'Details: ',
            [
                'What Happened?' => "Sorry but this Page was not encountered.",
                'Solution:' => "Go Back to Home Page.",
                'Are you the developer?' => 'You can open this same error Page with Developer Code, only need put ?de on the Url'
            ]
        );
    }
}
