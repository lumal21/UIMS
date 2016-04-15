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

namespace UIoT\App\Exception\Template;

use Whoops\Exception\Formatter;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Exception\FrameCollection;

/*
 * Create A PrettyPageHandler Instance
 * (Little Edited)
 */

/**
 * Class Handler
 * Exception Template Handler
 *
 * @package UIoT\App\Exception\Template
 */
class Handler extends PrettyPageHandler
{
    /**
     *
     * Template Helper
     *
     * @var Helper
     */
    private $helper;

    /**
     * Settings
     *
     * @var array
     */
    private $settings = [];

    /**
     * Error Frame List
     *
     * @var array|FrameCollection
     */
    private $frameList = [];

    /**
     * Handler constructor.
     */
    public function __construct()
    {
        $this->setHelper(new Helper);

        parent::__construct();
    }

    /**
     *
     * This Function Override PrettyPageHandler Handler
     * Override @parent handle();
     * This void makes a good Pretty Handling ;)
     *
     * @return integer|null
     */
    public function handle()
    {
        $this->getHelper()->execute($this);
    }

    /**
     *
     * Get Helper
     *
     * @return Helper
     */
    public function getHelper()
    {
        return $this->helper;
    }

    /**
     *
     * Set Helper
     *
     * @param Helper $helper
     */
    public function setHelper(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Set Frame List
     *
     * @param bool $frameArray
     */
    public function setFrameList($frameArray = false)
    {
        $this->frameList = $frameArray ? $this->getInspector()->getFrames() : [];
    }

    /**
     * Get Handler Settings
     *
     * @return array
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set Error Handler Settings
     */
    public function setSettings()
    {
        $this->addSetting('header', $this->getResource('Layouts/header.html.php'));
        $this->addSetting('stylesheet', $this->getResource('Stylesheet/Whoops.css'));
        $this->addSetting('clipboard', $this->getResource('Scripts/Clipboard.js'));
        $this->addSetting('prettify', $this->getResource('Scripts/Prettify.js'));
        $this->addSetting('zepto', $this->getResource('Scripts/Zepto.js'));
        $this->addSetting('javascript', $this->getResource('Scripts/Whoops.js'));
        $this->addSetting('frame_list', $this->getResource('Layouts/frame_list.html.php'));
        $this->addSetting('frame_code', $this->getResource('Layouts/frame_code.html.php'));
        $this->addSetting('env_details', $this->getResource('Layouts/env_details.html.php'));
        $this->addSetting('handlers', $this->getRun()->getHandlers());
        $this->addSetting('name', explode('\\', $this->getInspector()->getExceptionName()));
        $this->addSetting('message', $this->getInspector()->getException()->getMessage());
        $this->addSetting('code', $this->getInspector()->getException()->getCode());
        $this->addSetting('plain_exception', Formatter::formatExceptionPlain($this->getInspector()));
        $this->addSetting('page_title', $this->getPageTitle());
        $this->addSetting('title', $this->getPageTitle());
        $this->addSetting('tables', $this->getDataTables());
        $this->addSetting('frames', $this->getFrames());
        $this->addSetting('has_frames', !!count($this->getFrames()));
        $this->addSetting('handler', $this);
        $this->addSetting('tpl', $this->getHelper());
        return $this->getSettings();
    }

    /**
     * Add a Setting to Handler
     *
     * @param string $settingName
     * @param mixed $settingValue
     */
    public function addSetting($settingName, $settingValue)
    {
        $this->settings[$settingName] = $settingValue;
    }

    /**
     *
     * Get Resource
     *
     * @param string $resource
     * @return string
     */
    public function getResource($resource = '')
    {
        return parent::getResource($resource);
    }

    /**
     * Get Frame List
     *
     * @return array|FrameCollection
     */
    public function getFrames()
    {
        return $this->frameList;
    }
}
