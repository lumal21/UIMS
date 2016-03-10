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

namespace UIoT\App\Data\Models\Settings;

use UIoT\App\Data\Interfaces\SettingsInterface;

/**
 * Class RaiseSettingsModel
 *
 * @package UIoT\App\Data\Models\Settings
 */
final class RaiseSettingsModel implements SettingsInterface
{
    /**
     *
     * Host of raise server
     *
     * @var string
     */
    public $raiseHost = '';
    /**
     *
     * Raise root path
     *
     * @var string
     */
    public $raiseBasePath = '';
    /**
     *
     * Raise server port
     *
     * @var integer
     */
    public $raisePort = 80;
    /**
     *
     * Raise server is using ssl connection
     *
     * @var boolean
     */
    public $raiseSsl = false;

    /**
     *
     * Return Block Name
     *
     * @return string
     */
    public final function getBlockName()
    {
        return 'raise';
    }
}

