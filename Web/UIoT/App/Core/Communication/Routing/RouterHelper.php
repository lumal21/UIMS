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

namespace UIoT\App\Core\Communication\Routing;

use Bramus\Router\Router as IRouter;
use UIoT\App\Core\Communication\Routing\Path\PathFinder;
use UIoT\App\Data\Interfaces\Routing\NodeHandlerInterface;
use UIoT\App\Helpers\Manipulation\Strings;

/**
 * Class RouterHelper
 * @package UIoT\App\Core\Communication\Routing
 */
class RouterHelper
{
    /**
     * @var array
     */
    private static $nodeList = [];

    /**
     * @var IRouter
     */
    private $router = null;

    /**
     * @var PathFinder
     */
    private $pathFinder = null;

    /**
     * Add Node for Router
     *
     * @param string $path
     * @param NodeHandlerInterface $callback
     * @param int $priority
     * @param string $method
     * @param string $group
     */
    public static function addRoute($path, $callback, $priority, $method, $group)
    {
        self::$nodeList[self::getNodeListSize() + 1] =
            ['path' => $path, 'callback' => $callback, 'priority' => $priority, 'method' => Strings::toLower($method), 'group' => $group];
    }

    /**
     * Return Node List Array Size
     *
     * @return integer|double
     */
    private static function getNodeListSize()
    {
        return sizeof(self::getNodeList()) - 1;
    }

    /**
     * Get Node List
     *
     * @return array
     */
    public static function getNodeList()
    {
        return self::$nodeList;
    }

    /**
     * Get Router Instance
     *
     * @return IRouter
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * Set Router Instance
     *
     * @param IRouter $router
     */
    public function setRouter(IRouter $router)
    {
        $this->router = $router;
    }

    /**
     * Add Node for Router
     */
    protected function nodes()
    {
        /* add node item */
        array_map(function ($node) {
            $this->getPathFinder()->getNodeIndexer()->addNode($node);
        }, self::getNodeList());
    }

    /**
     * Get PathFinder Instance
     *
     * @return PathFinder
     */
    public function getPathFinder()
    {
        return $this->pathFinder;
    }

    /**
     * Set PathFinder Instance
     *
     * @param PathFinder $pathFinder
     */
    public function setPathFinder(PathFinder $pathFinder)
    {
        $this->pathFinder = $pathFinder;
    }
}
