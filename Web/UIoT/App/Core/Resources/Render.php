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
     * @var array Path Arguments
     */
    private $resourceArguments = [];

    /**
     * @var string Other Data
     */
    private static $resourceData;

    /**
     * Init Template (Layout/Controller/View) Handler
     *
     * @param array $arguments
     */
    public function __construct($arguments = [])
    {
        $this->setArguments($arguments);
        $this->setControllerData();
    }

    /**
     * Set Arguments
     *
     * @param array $arguments
     * @return void
     */
    public function setArguments($arguments = [])
    {
        $this->resourceName = $arguments['resource'];
        $this->resourceMethod = $arguments['method'];
        $this->resourceArguments = $arguments['arguments'];
    }

    /**
     * Set Controller Data
     */
    private function setControllerData()
    {
        self::$resourceData = DataCollector::runCollector([
            'name' => Strings::toLower($this->resourceName),
            'method' => Strings::toLower($this->resourceMethod),
            'arguments' => $this->resourceArguments]);
    }

    /**
     * Return Controller Data
     *
     * @return string
     */
    public static function getControllerData()
    {
        return self::$resourceData;
    }

    /**
     * Show Rendered Content
     *
     * @return mixed
     */
    public function showContent()
    {
        Factory::addLayout($this->resourceMethod);

        return Factory::getLayout($this->resourceMethod);
    }
}
