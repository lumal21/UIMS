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

namespace UIoT\App\Core\Resources;

use UIoT\App\Core\Communication\Parsers\DataCollector;
use UIoT\App\Core\Layouts\Factory;
use UIoT\App\Data\Interfaces\Parsers\RenderInterface;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class Render
 * @package UIoT\App\Core\Templates
 */
final class Render implements RenderInterface
{
    /**
     * @var string Resource Name
     */
    private $resourceName;

    /**
     * @var string Requested Method
     */
    private $resourceMethod;

    /**
     * Init Template (Layout/Controller/View) Handler
     *
     * @param array $arguments
     */
    public function __construct($arguments = [])
    {
        $this->resourceName = Strings::toLower($arguments['class']);
        $this->resourceMethod = Strings::toLower($arguments['method']);
    }

    /**
     * Show Rendered Content
     *
     * @return mixed
     */
    public function showContent()
    {
        $layout = Factory::get($this->resourceMethod);

        $layout->getTemplateFactory()->addVariable('{{resource_content}}',
            DataCollector::runCollector($this->resourceName, $this->resourceMethod));

        return $layout->executeLayout();
    }
}
