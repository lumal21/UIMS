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

namespace UIoT\App\Data\Models\Data;

use UIoT\App\Data\Interfaces\Data\LayoutInterface;

/**
 * Class LayoutModel
 * @package UIoT\App\Data\Models\Data
 */
abstract class LayoutModel implements LayoutInterface
{
    /**
     * Define Resources
     *
     * @SuppressWarnings("unused")
     */
    public function getResources()
    {
        /* not implemented */
    }

    /**
     * Define Settings
     *
     * @SuppressWarnings("unused")
     */
    public function configureLayout()
    {
        /* not implemented */
    }

    /**
     * Define Templates
     *
     * @SuppressWarnings("unused")
     */
    public function setTemplates()
    {
        /* not implemented */
    }

    /**
     * Return Layout Code
     *
     * @SuppressWarnings("unused")
     */
    public function showLayout()
    {
        /* not implemented */
    }

    /**
     * Return the Asset Manager
     *
     * @SuppressWarnings("unused")
     */
    public function getAsset()
    {
        /* not implemented */
    }

    /**
     * Get Template Factory
     *
     * @SuppressWarnings("unused")
     */
    public function getTemplate()
    {
        /* not implemented */
    }
}

