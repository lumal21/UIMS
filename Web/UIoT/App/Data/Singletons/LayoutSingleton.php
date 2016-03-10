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

namespace UIoT\App\Data\Singletons;

use UIoT\App\Data\Models\LayoutModel;

/**
 * Class LayoutSingleton
 *
 * @package UIoT\App\Data\Models\Types
 */
class LayoutSingleton extends LayoutModel
{
    /**
     *
     * Layout Model Instance
     *
     * @var LayoutModel
     */
    protected static $layoutInstance = null;

    /**
     *
     * Abstract and Singleton Protection
     */
    protected function __construct()
    {
        /* not implemented */
    }

    /**
     *
     * Execute Layout and Return Rendered Layout
     *
     * @return mixed|void
     */
    public static function __run()
    {
        static::getInstance()->__resources();

        static::getInstance()->__configuration();

        static::getInstance()->__templates();

        return static::getInstance()->__show();
    }

    /**
     *
     * Return Instance of Layout
     *
     * @return LayoutModel|mixed
     */
    public static function getInstance()
    {
        if (null === self::$layoutInstance)
            self::$layoutInstance = new static;

        return self::$layoutInstance;
    }

    /**
     * Execute Layout and Register Resources
     *
     * @return mixed|void
     */
    public static function __res()
    {
        return static::getInstance()->__resources();
    }

    /**
     *
     * Abstract and Singleton Protection
     */
    protected function __clone()
    {
        /* not implemented */
    }

    /**
     *
     * Abstract and Singleton Protection
     */
    protected function __wakeup()
    {
        /* not implemented */
    }
}
