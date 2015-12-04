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

namespace UIoT\App\Core\Communication\Routing;

use Bramus\Router\Router as IRouter;
use UIoT\App\Core\Communication\Routing\Path\PathFinder;

/**
 * Class RouterAccessor
 * @package UIoT\App\Core\Communication\Routing
 */
class RouterAccessor
{
    /**
     * Node List
     *
     * @var array
     */
    protected static $node_list = [];
    /**
     * Router Instance
     *
     * @var IRouter
     */
    protected $router = null;
    /**
     * PathFinder Instance
     *
     * @var PathFinder
     */
    protected $pathFinder = null;

    /**
     * Add Node for Router
     *
     * @param string $path
     * @param $callback
     * @param int $priority
     * @param string $method
     * @param string $group
     */
    public static function addRoute($path, $callback, $priority, $method, $group)
    {
        self::$node_list[self::getNodeListSize() + 1] = ['path' => $path, 'callback' => $callback, 'priority' => $priority, 'method' => $method, 'group' => $group];
    }

    /**
     * Return Node List Array Size
     *
     * @return int
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
        return self::$node_list;
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
