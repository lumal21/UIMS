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

use Httpful\Response;

/**
 * Class Data
 * @package UIoT\App\Core\Communication\Requesting
 */
final class Data
{
    /**
     * @var Response
     */
    public $data;

    /**
     * Do a Request
     *
     * @param string $url
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    function __construct($url)
    {
        Brain::setRequestUrl($url);

        $this->data = Brain::sendRequest();
    }

    /**
     * Get HttpFul Request Data
     *
     * @param string $var
     * @return Response
     */
    function __get($var)
    {
        /* this switch is for closure calls (get abstract variables) */
        switch ($var):
            default:
            case 'body':
                return @$this->data->body;
            case 'header':
                return @$this->data->headers;
        endswitch;
    }

    /**
     * Call Abstract Data Validation
     *
     * @param string $name
     * @param mixed $arguments
     * @return mixed
     */
    function __call($name, $arguments)
    {
        /* this switch is for closure calls (get abstract methods) */
        switch ($name):
            case 'from_json':
                return json_decode($this->$arguments[0], @$arguments[1]);
            case 'to_json':
                return json_encode(@$this->$arguments[0]);
            case 'get_data':
            default:
                return @$this->$arguments[0];
        endswitch;
    }
}