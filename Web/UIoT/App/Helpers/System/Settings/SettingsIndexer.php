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

namespace UIoT\App\Helpers\System\Settings;

use UIoT\App\Data\Interfaces\SettingsInterface;
use UIoT\App\Data\Models\Settings\ExceptionSettingsModel;
use UIoT\App\Data\Models\Settings\RaiseSettingsModel;
use UIoT\App\Data\Models\Settings\ResourcesSettingsModel;
use UIoT\App\Data\Models\Settings\SecuritySettingsModel;
use UIoT\App\Helpers\Factories\SettingsFactory;
use UIoT\App\Helpers\Manipulation\Constants;

/**
 * Class SettingsIndexer
 *
 * @package UIoT\App\Helpers\System\Settings
 */
final class SettingsIndexer
{
    /**
     * @var object
     */
    private static $settings;

    /**
     * Prepare settings factory
     */
    public static function prepareSettings()
    {
        $settingsModels = [
            new ExceptionSettingsModel,
            new RaiseSettingsModel,
            new ResourcesSettingsModel,
            new SecuritySettingsModel
        ];

        SettingsFactory::create($settingsModels);
    }

    /**
     *
     * Add setting block
     *
     * @param string $settingBlockName
     * @param array $settingsArray
     */
    public static function addSettingsBlock($settingBlockName, array $settingsArray)
    {
        SettingsFactory::populateModel($settingBlockName, $settingsArray);
    }

    /**
     * Register settings
     */
    public static function runSettings()
    {
        self::storeSettings(SettingsFactory::getAllModels());

        self::setSettings();
    }

    /**
     *
     * Store Settings Constant
     *
     * @param SettingsManager[]|SettingsInterface[] $settingVariable
     */
    public static function storeSettings($settingVariable)
    {
        Constants::addJsonConstant
        (
            'SETTINGS',
            $settingVariable,
            JSON_FORCE_OBJECT
        );
    }

    /**
     *
     * Return Specific Setting Variable
     *
     * @param string $settingVariableName
     *
     * @return mixed
     */
    public static function getSetting($settingVariableName = '')
    {
        return self::getSettings()->$settingVariableName;
    }

    /**
     *
     * Return Settings Constants
     *
     * @return object
     */
    public static function getSettings()
    {
        return self::$settings;
    }

    /**
     * Set Settings
     */
    public static function setSettings()
    {
        self::$settings = Constants::returnJsonConstant('SETTINGS');
    }
}
