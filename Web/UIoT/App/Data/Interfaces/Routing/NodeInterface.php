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

namespace UIoT\App\Data\Interfaces\Routing;

/**
 * Interface NodeInterface
 * @package UIoT\App\Data\Interfaces\Routing
 */
interface NodeInterface
{
    /**
     * NodeInterface constructor.
     *
     * @param $nodeId
     * @param $path
     * @param $callBack
     * @param $priority
     * @param $method
     * @param $group
     */
    public function __construct($nodeId, $path, $callBack, $priority, $method, $group);

    /**
     * @return mixed
     */
    public function isAbsolute();

    /**
     * @return mixed
     */
    public function getPath();

    /**
     * @param $path
     * @return mixed
     */
    public function setPath($path);

    /**
     * @return mixed
     */
    public function getCallBack();

    /**
     * @param $callBack
     * @return mixed
     */
    public function setCallBack($callBack);

    /**
     * @return mixed
     */
    public function getMethod();

    /**
     * @param $method
     * @return mixed
     */
    public function setMethod($method);

    /**
     * @return mixed
     */
    public function getPriority();

    /**
     * @param $priority
     * @return mixed
     */
    public function setPriority($priority);

    /**
     * @return mixed
     */
    public function getNodeGroup();

    /**
     * @param $nodeGroup
     * @return mixed
     */
    public function setNodeGroup($nodeGroup);
}
