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

use UIoT\App\Data\Interfaces\Settings\SettingsInterface;
use UnexpectedValueException;

/**
 * Class Factory
 * @package UIoT\App\Core\Settings
 */
class Factory
{
    /**
     * @var Manager[] Instances
     */
    private static $settings;

    /**
     * Create settings factory
     *
     * @param array $settingsModels
     */
    public static function create(array $settingsModels)
    {
        foreach ($settingsModels as $settingModel) {
            self::add($settingModel);
        }
    }

    /**
     * Add settings manager
     *
     * @param SettingsInterface $settingsInterface
     */
    protected static function add(SettingsInterface $settingsInterface)
    {
        self::$settings[$settingsInterface->getBlockName()] = new Manager($settingsInterface);
    }

    /**
     * Populate settings model
     *
     * @param string $modelName
     * @param array $modelVariables
     */
    public static function populate($modelName, array $modelVariables)
    {
        if (!array_key_exists($modelName, self::$settings)) {
            throw new UnexpectedValueException('This settings model does not exists.');
        }

        foreach ($modelVariables as $variableName => $variableValue) {
            self::$settings[$modelName]->setVar($variableName, $variableValue);
        }
    }

    /**
     * Return settings model
     *
     * @param string $modelName
     * @return SettingsInterface
     */
    public static function get($modelName)
    {
        if (!array_key_exists($modelName, self::$settings)) {
            throw new UnexpectedValueException('This settings model does not exists.');
        }

        return self::$settings[$modelName]->getModel();
    }

    /**
     *
     * Get all settings models
     *
     * @return Manager[]|SettingsInterface[]
     */
    public static function getAll()
    {
        /**
         * @var Manager[] $settingsModelArray
         */
        $settingsModelArray = [];

        foreach (self::$settings as $settingsModelName => $settingsManager) {
            $settingsModelArray[$settingsModelName] = $settingsManager->getModel();
        }

        return $settingsModelArray;
    }
}
