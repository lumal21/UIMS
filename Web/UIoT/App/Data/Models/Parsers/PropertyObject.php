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

namespace UIoT\App\Data\Models\Parsers;

/**
 * Class PropertyObject
 * @package UIoT\App\Data\Models\Parsers
 */
class PropertyObject
{
    /**
     * @var int Property Id
     *
     * @SuppressWarnings(PHPMD.CamelCasePropertyName)
     */
    public $ID = 0;

    /**
     * @var int Resource Id
     *
     * @SuppressWarnings(PHPMD.CamelCasePropertyName)
     */
    public $RSRC_ID = 0;

    /**
     * @var string Property Name
     *
     * @SuppressWarnings(PHPMD.CamelCasePropertyName)
     */
    public $PROP_NAME = '';

    /**
     * @var string Property Friendly Name
     *
     * @SuppressWarnings(PHPMD.CamelCasePropertyName)
     */
    public $PROP_FRIENDLY_NAME = '';
}
