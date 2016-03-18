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

namespace UIoT\App\Data\Interfaces;

/**
 * Interface RenderInterface
 * @package UIoT\App\Data\Interfaces
 */
interface RenderInterface
{
    /**
     *
     * RenderInterface constructor.
     *
     * @param $arguments
     *
     * @return null
     */
    function __construct($arguments);

    /**
     * @param $arguments
     *
     * @return mixed
     */
    function setArguments($arguments);

    /**
     * @return mixed
     */
    function show();
}
