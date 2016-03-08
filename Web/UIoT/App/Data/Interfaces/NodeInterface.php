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
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Data\Interfaces;

/**
 * Interface NodeInterface
 * @package UIoT\App\Data\Interfaces
 */
interface NodeInterface
{
    /**
     * NodeInterface constructor.
     * @param $node_id
     * @param $path
     * @param $callback
     * @param $priority
     * @param $method
     * @param $group
     */
    public function __construct($node_id, $path, $callback, $priority, $method, $group);

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
    public function getCallback();

    /**
     * @param $callback
     * @return mixed
     */
    public function setCallback($callback);

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
     * @param $node_group
     * @return mixed
     */
    public function setNodeGroup($node_group);
}
