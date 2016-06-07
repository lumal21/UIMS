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

use UIoT\App\Core\Communication\Routing\Handler;
use UIoT\App\Core\Controllers\Render;
use UIoT\App\Data\Models\Routing\NodeHandlerModel;
use UIoT\App\Helpers\Manipulation\Constants;

/**
 * Class BasePathNode
 * @package UIoT\App\Data\Models\Nodes
 *
 * @SuppressWarnings(PHPMD)
 */
final class BasePathNode extends NodeHandlerModel
{
    /**
     * Callback Function
     */
    public function call()
    {
        $this->setData(Handler::show(new Render(Constants::get('DEFAULT_CONTROLLER'), Constants::get('DEFAULT_ACTION'))));
    }
}
