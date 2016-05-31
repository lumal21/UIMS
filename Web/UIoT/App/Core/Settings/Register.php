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

namespace UIoT\App\Core\Settings;

use UIoT\App\Data\Models\Settings\AssetsSettingsModel;
use UIoT\App\Data\Models\Settings\ExceptionSettingsModel;
use UIoT\App\Data\Models\Settings\RaiseSettingsModel;
use UIoT\App\Data\Models\Settings\SecuritySettingsModel;
use UIoT\App\Helpers\Manipulation\Constants;

/**
 * Class SettingsIndexer
 * @package UIoT\App\Core\Settings
 */
final class Register
{
    /**
     * Prepare settings factory
     */
    public static function prepareSettings()
    {
        $settingsModels = [
            new ExceptionSettingsModel,
            new RaiseSettingsModel,
            new AssetsSettingsModel,
            new SecuritySettingsModel
        ];

        Factory::create($settingsModels);
    }

    /**
     * Add setting block
     *
     * @param string $settingBlockName
     * @param array $settingsArray
     */
    public static function addSettingsBlock($settingBlockName, array $settingsArray)
    {
        Factory::populateModel($settingBlockName, $settingsArray);
    }

    /**
     * Store Settings Constant
     */
    public static function storeSettings()
    {
        Constants::addJson
        (
            'SETTINGS',
            Factory::getAllModels(),
            JSON_FORCE_OBJECT
        );
    }

    /**
     * Return Specific Setting Variable
     *
     * @param string $settingVariableName
     * @return mixed
     */
    public static function get($settingVariableName = '')
    {
        return self::getSettings()->$settingVariableName;
    }

    /**
     * Return Settings Constants
     *
     * @return object
     */
    public static function getSettings()
    {
        return Constants::getJson('SETTINGS');
    }
}
