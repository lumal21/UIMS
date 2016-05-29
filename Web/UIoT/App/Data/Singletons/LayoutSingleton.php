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

namespace UIoT\App\Data\Singletons;

use UIoT\App\Core\Assets\Factory as AssetFactory;
use UIoT\App\Core\Templates\Factory as TemplateFactory;
use UIoT\App\Data\Models\Data\LayoutModel;

/**
 * Class LayoutSingleton
 * @package UIoT\App\Data\Singletons
 */
class LayoutSingleton extends LayoutModel
{
    /**
     * @var LayoutModel
     */
    protected static $layoutInstance = null;

    /**
     * @var AssetFactory Instance
     */
    protected $assetFactory;

    /**
     * @var TemplateFactory Instance
     */
    protected $templateFactory;

    /**
     * Abstract and Singleton Protection
     */
    protected function __construct()
    {
        /* singleton */
    }

    /**
     * Execute Layout and Return Rendered Layout
     *
     * @return mixed|void
     */
    public static function executeLayout()
    {
        static::getInstance()->getResources();

        static::getInstance()->configureLayout();

        static::getInstance()->setTemplates();

        return static::getInstance()->showLayout();
    }

    /**
     * Return Instance of Layout
     *
     * @return LayoutModel|mixed
     */
    public static function getInstance()
    {
        if (null === self::$layoutInstance) {
            self::$layoutInstance = new static;
        }

        return self::$layoutInstance;
    }

    /**
     * Execute Layout and Register Resources
     */
    public static function callResource()
    {
        static::getInstance()->getResources();
    }

    /**
     * Get Asset Manager
     *
     * @return AssetFactory
     */
    public function getAssetFactory()
    {
        if (null === $this->assetFactory) {
            $this->assetFactory = new AssetFactory;
        }

        return $this->assetFactory;
    }

    /**
     * Get Template Factory
     *
     * @return TemplateFactory
     */
    public function getTemplateFactory()
    {
        if (null === $this->templateFactory) {
            $this->templateFactory = new TemplateFactory;
        }

        return $this->templateFactory;
    }

    /**
     * Abstract and Singleton Protection
     */
    protected function __clone()
    {
        /* singleton */
    }

    /**
     * Abstract and Singleton Protection
     */
    protected function __wakeup()
    {
        /* singleton */
    }
}
