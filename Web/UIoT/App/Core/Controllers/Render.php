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

namespace UIoT\App\Core\Controllers;

use UIoT\App\Core\Layouts\Factory as LayoutFactory;
use UIoT\App\Data\Models\Data\RenderModel;

/**
 * Class Render
 * @package UIoT\App\Core\Templates
 */
final class Render extends RenderModel
{
    /**
     * Show Rendered Content
     *
     * @return mixed
     */
    public function showContent()
    {
        $layout = LayoutFactory::get($this->className);

        $layout->getTemplate()->setVar('{{resource_content}}', Factory::getAction($this->className, $this->classMethod));

        return $layout->execute();
    }
}
