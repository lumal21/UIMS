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
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Core\Helpers\Factories;

use UIoT\App\Core\Helpers\System\Settings\SettingsManager;
use UIoT\App\Data\Interfaces\SettingsInterface;
use UnexpectedValueException;

/**
 * Class SettingsFactory
 * @package UIoT\App\Core\Helpers\Factories
 */
class SettingsFactory
{
    /**
     *
     * Array of settings manager
     *
     * @var SettingsManager[]
     */
    private static $settingsModels;

    /**
     *
     * Create settings factory
     *
     * @param array $settingsInterfaceList
     */
    public static function create(array $settingsInterfaceList)
    {
        foreach ($settingsInterfaceList as $settingInterface)
            self::addModel($settingInterface);
    }

    /**
     *
     * Add settings manager
     *
     * @param SettingsInterface $settingsInterface
     */
    protected static function addModel(SettingsInterface $settingsInterface)
    {
        self::$settingsModels[$settingsInterface->getBlockName()] = new SettingsManager($settingsInterface);
    }

    /**
     *
     * Populate settings model
     *
     * @param string $modelName
     * @param array $modelValues
     */
    public static function populateModel($modelName, array $modelValues)
    {
        if (!array_key_exists($modelName, self::$settingsModels))
            throw new UnexpectedValueException('This settings model does not exists.');

        foreach ($modelValues as $variableKey => $variableValue)
            self::$settingsModels[$modelName]->setVariable($variableKey, $variableValue);
    }

    /**
     *
     * Return settings model
     *
     * @param string $modelName
     * @return SettingsInterface
     */
    public static function getModel($modelName)
    {
        if (!array_key_exists($modelName, self::$settingsModels))
            throw new UnexpectedValueException('This settings model does not exists.');

        return self::$settingsModels[$modelName]->getInstance();
    }

    /**
     *
     * Get all settings models
     *
     * @return SettingsManager[]
     */
    public static function getAllModels()
    {
        /**
         * @var SettingsManager[] $settingsModelArray
         */
        $settingsModelArray = [];

        foreach (self::$settingsModels as $settingsModelName => $settingsManager)
            $settingsModelArray[$settingsModelName] = $settingsManager->getInstance();

        return $settingsModelArray;
    }
}
