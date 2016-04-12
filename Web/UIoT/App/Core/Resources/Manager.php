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

use UIoT\App\Core\Communication\Requesting\Raise;

/**
 * Class Manager
 *
 * @package UIoT\App\Core\Resources
 */
final class Manager
{
    /**
     * Resource Name to be verified
     *
     * @var string
     */
    private static $resourceName;

    /**
     * Actual Response Data
     *
     * @var mixed
     */
    private static $actualResponseData;

    /**
     * Set Related Resource
     *
     * @param string $resource_name
     */
    public static function setRelatedResource($resource_name)
    {
        self::$resourceName = $resource_name;
    }

    /**
     * Get Resource Properties
     */
    public static function getResourceProperties()
    {
        return Raise::doRequest('properties?rsrc_id=' . self::getResource()[0]->ID);
    }

    /**
     * Check if Resource is Valid
     */
    public static function getResource()
    {
        return Raise::doRequest('resources?name=' . self::$resourceName);
    }

    /**
     * Get Actual Response
     *
     * @return mixed
     */
    public static function getResponse()
    {
        return self::$actualResponseData;
    }

    /**
     * Set Response
     *
     * @param mixed $actualResponseData
     */
    private static function setResponse($actualResponseData)
    {
        self::$actualResponseData = $actualResponseData;
    }
}