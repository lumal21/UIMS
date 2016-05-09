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
use UIoT\App\Exception\Manager;

/**
 * Class Router
 *
 * @property mixed resource_url
 * @property mixed controller
 * @property mixed action
 * @package UIoT\App\Core\Communication\Routing
 */
final class Router extends RouterAccessor
{
    /**
     * Start's Router Procedure
     *
     * Router constructor.
     */
    public function __construct()
    {
        /* create router instance */
        $this->mount();

        /* set all nodes */
        $this->nodes();

        /* execute router */
        $this->exec();
    }

    /**
     * Prepare Router
     */
    private function prepare()
    {
        /* serialize call backs */
        $this->getPathFinder()->serializeCallBacks($this->getPathFinder()->getNodeIndexer()->getNodes());

        /* mount router */
        $this->getPathFinder()->mountRouter($this->getRouter());

        /* set 404 Callback Node */
        $this->getRouter()->set404(function() {
            Manager::throwError(906, "404!", 'Details: ', [
                'What Happened?' => "Sorry but this Page was not encountered.",
                'Solution:' => "Go Back to Home Page."
            ]);
        });
    }

    /**
     * Mount Router Instance and Path Finder Instance
     */
    private function mount()
    {
        /* set router */
        $this->setRouter(new IRouter);

        /* set path finder */
        $this->setPathFinder(new PathFinder);
    }

    /**
     * Run the Router
     */
    private function run()
    {
        $this->getRouter()->run([$this, 'performRouterUpdate']);
    }

    /**
     * Execute the Router
     */
    protected function exec()
    {
        /* sort all nodes */
        $this->getPathFinder()->getNodeIndexer()->sort();

        /* prepare route */
        $this->prepare();

        /* run the router */
        $this->run();
    }

    /**
     * Validate the Router Run
     */
    public function performRouterUpdate()
    {
        /* check if need perform router update */
        if(!empty($this->getPathFinder()->getNodeIndexer()->getNodesThatMatched()) ||
            empty($this->getPathFinder()->getNodeIndexer()->getNodesWithPathValue())
        ) {
            return;
        }

        $this->performCoreUpdate();

        $this->setRouter(new IRouter);

        $this->exec();
    }

    /**
     * Perform NodeIndexer Core Update
     */
    protected function performCoreUpdate()
    {
        array_map([$this->getPathFinder()->getNodeIndexer(), 'performCoreUpdate'],
            $this->getPathFinder()->getNodeIndexer()->getNodesWithPathValue());
    }
}
