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

namespace UIoT\App\Data\Interfaces\Requesting;

/**
 * Interface RequestInterface
 * @package UIoT\App\Data\Interfaces\Requesting
 */
interface RequestInterface
{
    /**
     * Parse Request Data or Do Request
     *
     * @param mixed $data
     * @return void
     */
    function parse($data);

    /**
     * Check if Job is Done
     *
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     *
     * @return boolean
     */
    function getStatus();

    /**
     * Set Job Status
     *
     * @param boolean $jobStatus
     * @return void
     */
    function setStatus($jobStatus);

    /**
     * Set Response Content
     *
     * @param mixed $responseContent
     * @return void
     */
    function setData($responseContent);

    /**
     * Get Response Content
     *
     * @return mixed
     */
    function getData();
}
