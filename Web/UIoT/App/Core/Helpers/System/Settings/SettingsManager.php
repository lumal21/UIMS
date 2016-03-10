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

namespace UIoT\App\Core\Helpers\System\Settings;

use UIoT\App\Data\Interfaces\SettingsInterface;
use UnexpectedValueException;

/**
 * Class SettingsManager
 * @package UIoT\App\Core\Helpers\System\Settings
 */
class SettingsManager
{
    /**
     *
     * Settings model instance
     *
     * @var SettingsInterface
     */
    private $settingModel;

    /**
     *
     * Create settings model instance
     *
     * @param SettingsInterface $settingModel
     */
    public function __construct(SettingsInterface $settingModel)
    {
        $this->settingModel = $settingModel;
    }

    /**
     *
     * Set variable from the model
     *
     * @param string $variableName
     * @param mixed $variableValue
     */
    public function setVariable($variableName, $variableValue)
    {
        if (!property_exists($this->settingModel, $variableName))
            throw new UnexpectedValueException("Setting property $variableName doesn't exists in class " . get_class($this->settingModel));

        $this->settingModel->$variableName = $variableValue;
    }

    /**
     *
     * Get settings model instance
     *
     * @return SettingsInterface
     */
    public function getInstance()
    {
        return $this->settingModel;
    }
}
