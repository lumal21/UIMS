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

use UIoT\App\Core\Assets\AssetRender;
use UIoT\App\Core\Communication\Routing\RenderSelector;
use UIoT\App\Core\Layouts\Factory;
use UIoT\App\Data\Models\Routing\NodeHandlerModel;
use UIoT\App\Helpers\Manipulation\Constants;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class AssetFileNode
 * @package UIoT\App\Data\Models\Nodes
 */
class AssetFileNode extends NodeHandlerModel
{
    /**
     * Callback Function
     */
    public function call()
    {
        $this->setResult(Factory::layoutExists($this->getPathValue()[0]));

        $this->setResult(Strings::isEqual($this->getPathValue()[1], Constants::returnConstant('RESOURCE_FOLDER_NAME')));

        !$this->getResult() ||
        $this->setResultContent(RenderSelector::go(new AssetRender(['layout' => $this->getPathValue()[0],
            'asset' => $this->getPathValue()[2]]))
        );
    }
}
