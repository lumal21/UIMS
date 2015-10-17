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
 * @copyright University of Bras�lia
 */

namespace UIoT\App\Exception;

use UIoT\App\Core\Helpers\Manipulators\Settings;

/**
 * Class Manager
 * @package UIoT\App\Exception
 */
final class Manager
{
    /**
     * Create Instance of Everything
     */
    public function __construct()
    {
        $this->setClasses();
        $this->setSettings();
        $this->registerHandler();
    }

    /**
     * Set Classes
     */
    private function setClasses()
    {
        Register::setHandler(new Handler);
        Register::setRunner(new Runner);
    }

    /**
     * Set Page Handler Settings
     */
    private function setSettings()
    {
        Register::setErrorLevels(Settings::getSetting('exceptions')->error_reporting_levels);
        Register::addResourcePath(RESOURCE_FOLDER . (Settings::getSetting('exceptions')->error_resource_folder) . '/');
        Register::setPageTitle(Settings::getSetting('exceptions')->error_page_title);
    }

    /**
     * Register Page Handler
     */
    private function registerHandler()
    {
        Register::pushHandler();
        Register::registerHandler();
    }
}