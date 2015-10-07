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
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Communication\Requesting;

use Httpful\Request;
use Httpful\Response;

/**
 * Class Brain
 * @package UIoT\App\Core\Communication\Requesting
 */
class Brain
{
    /**
     * @var Request
     */
    private static $template;

    /**
     * Get Possible UIoT Abstract Controllers
     *
     * @return mixed
     */
    static function getItems()
    {
        return Raise::doRequest('resource');
    }

    /**
     * Set and Store Initial Template
     *
     * @param Http ::string $method_name
     * @param Mime ::string $mime_type
     */
    static function setTemplate($method_name, $mime_type)
    {
        self::adjustTemplate(self::$template = (Request::init($method_name)->method($method_name)->expects($mime_type)->mime($mime_type)));
    }

    /**
     * Adjust Template to Some Options
     * (This will reset Request::$_template)
     *
     * @param Request $r
     */
    private static function adjustTemplate(Request $r)
    {
        Raise::setTemplate($r);
    }

    /**
     * Set Request Expected Data Type
     * (Only for Adjust)
     *
     * @param $mime_type
     */
    static function setExpectedMimeType($mime_type)
    {
        self::adjustTemplate(self::getTemplate()->expects($mime_type));
    }

    /**
     * Set Request Mime Type Header
     * (Only for Adjust)
     *
     * @param $mime_type
     */
    static function setMimeType($mime_type)
    {
        self::adjustTemplate(self::getTemplate()->mime($mime_type));
    }

    /**
     * Set Request Method
     * (Only for Adjust)
     *
     * @param $method_name
     */
    static function setRequestMethod($method_name)
    {
        self::adjustTemplate(self::getTemplate()->method($method_name));
    }

    /**
     * Set Url to Request
     *
     * @param string $url
     */
    static function setRequestUrl($url)
    {
        self::adjustTemplate(self::getTemplate()->uri($url));
    }

    /**
     * Send Httpful Request
     *
     * @return Response
     */
    static function sendRequest()
    {
        return Request::d(null)->send();
    }

    /**
     * Get Httpful Template
     *
     * @return Request
     */
    private static function getTemplate()
    {
        return self::$template;
    }
}