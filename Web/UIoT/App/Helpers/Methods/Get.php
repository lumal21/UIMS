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

namespace UIoT\App\Helpers\Methods;

use UIoT\App\Helpers\Manipulation\Constants;

/*
 * Get Helper
 * GET => Query String (REST Query String as Http Get Method)
 */

/**
 * Class Get
 * @package UIoT\App\Helpers\Methods
 */
class Get
{
    /**
     * @var object
     */
    private static $data;

    /**
     * Receive Get Data
     *
     * @return array
     */
    public static function receiveGetData()
    {
        return [];
    }

    /**
     * Store Get Data
     *
     * @param string|array|object $data
     */
    public static function storeGetData($data)
    {
        Constants::addSerializedConstant('GET_WEB', $data);
    }

    /**
     * Return Specific Get Data
     *
     * @param string $variable_name
     * @return mixed
     */
    public static function returnGetVariable($variable_name = '')
    {
        return isset(self::returnGetData()[$variable_name]) ? self::returnGetData()[$variable_name]->getData() : '';
    }

    /**
     * Return All Get Data
     *
     * @return object
     */
    public static function returnGetData()
    {
        return !self::$data ? (self::$data = Constants::returnSerializedConstant('GET_WEB')) : self::$data;
    }
}
