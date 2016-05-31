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
use UIoT\App\Data\Interfaces\Parsers\RenderInterface;

/**
 * Class Render
 * @package UIoT\App\Core\Templates
 */
final class Render implements RenderInterface
{
    /**
     * @var string Controller Name
     */
    private $controllerName;

    /**
     * @var string Controller Action
     */
    private $controllerAction;

    /**
     * Init Template (Layout/Controller/View) Handler
     *
     * @param array $arguments
     */
    public function __construct($arguments = [])
    {
        $this->setArguments($arguments);
    }

    /**
     * Set Arguments
     *
     * @param array $arguments
     * @return void
     */
    public function setArguments($arguments = [])
    {
        $this->controllerName = $arguments['controller'];
        $this->controllerAction = $arguments['action'];
    }

    /**
     * Show Template Content
     * If is to show the View, echoes the View Content with Controller Content, if not Only echoes Controller Content
     */
    public function showContent()
    {
        $layout = LayoutFactory::get($this->controllerName);

        $layout->getTemplateFactory()->addVariable('{{resource_content}}',
            Factory::getAction($this->controllerName, $this->controllerAction));

        return $layout->executeLayout();
    }
}
