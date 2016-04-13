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
        $rawResponse = self::getResource();

        return Raise::doRequest('properties?rsrc_id=' . (is_object($rawResponse) ? $rawResponse : $rawResponse[0]->ID));
    }

    /**
     * Check if Resource is Valid
     */
    public static function getResource()
    {
        $rawResponse = Raise::doRequest('resources?name=' . self::$resourceName);

        return is_object($rawResponse) ? self::$resourceName : $rawResponse;
    }
}