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

use UIoT\App\Core\Communication\Methods\Post as PostMethod;
use UIoT\App\Helpers\Manipulation\Arrays;
use UIoT\App\Helpers\Manipulation\Constants;
use UIoT\App\Helpers\Manipulation\Strings;

/*
 * Post Helper
 * POST => PhP $_POST
 */

/**
 * Class Post
 * @package UIoT\App\Helpers\Methods
 */
class Post
{
    /**
     * @var object
     */
    private static $data;

    /**
     * Receive Post Data
     *
     * @return array
     */
    public static function receivePostData()
    {
        /* define array */
        $post = [];

        /* put query string into $GET */
        foreach (Constants::returnJsonConstant('HTTP_PHP_POST') as $key => $value)
            Arrays::addOnHttpMethod(Strings::sanitizeString($key), Strings::sanitizeString($value), (new PostMethod), $post);

        return $post;
    }

    /**
     * Store Post Data
     *
     * @param string|array|object $data
     */
    public static function storePostData($data)
    {
        Constants::addSerializedConstant('POST_WEB', $data);
    }

    /**
     * Return All Post Data
     *
     * @return object
     */
    public static function returnPostData()
    {
        return !self::$data ? (self::$data = Constants::returnSerializedConstant('POST_WEB')) : self::$data;
    }

    /**
     * Return Specific Post Data
     *
     * @param string $variable_name
     * @return mixed
     */
    public static function returnPostVariable($variable_name = '')
    {
        return isset(self::returnPostData()[$variable_name]) ? self::returnPostData()[$variable_name]->getData() : '';
    }
}