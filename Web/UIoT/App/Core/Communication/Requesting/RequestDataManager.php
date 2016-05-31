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

namespace UIoT\App\Core\Communication\Requesting;

use Httpful\Response;

/**
 * Class RequestDataManager
 * @package UIoT\App\Core\Communication\Requesting
 *
 * @method mixed from_json($string)
 * @method mixed to_json($string)
 * @method mixed get_data($string)
 */
final class RequestDataManager
{
    /** @var Response */
    private $data;

    /**
     * Data constructor.
     *
     * @param string $url
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function __construct($url)
    {
        RequestTemplateManager::setRequestUrl($url);

        $this->data = RequestTemplateManager::sendRequest();
    }

    /**
     * Get HttpFul Request Data
     *
     * @param string $var
     * @return array|Response\Headers|object|string
     */
    public function __get($var = '')
    {
        /* this switch is for closure calls (get abstract variables) */
        switch($var) {
            case 'header':
                return $this->data->headers;
            case 'body':
            default:
                return $this->data->body;
        }
    }

    /**
     * Call Abstract Data Validation
     *
     * @param string $name
     * @param array $arguments
     * @return array|Response\Headers|mixed|object|string
     */
    public function __call($name = '', $arguments = ['', ''])
    {
        /* this switch is for closure calls (get abstract methods) */
        switch($name) {
            case 'from_json':
                return json_decode($this->$arguments[0], $arguments[1]);
            case 'to_json':
                return json_encode($this->$arguments[0]);
            case 'get_data':
            default:
                return $this->$arguments[0];
        }
    }
}
