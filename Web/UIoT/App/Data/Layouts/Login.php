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

namespace UIoT\App\Data\Layouts;

use UIoT\App\Data\Singletons\LayoutSingleton;
use UIoT\App\Helpers\Visual\Pages;

/**
 * Class Login
 * @package UIoT\App\Data\Layouts
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class Login extends LayoutSingleton
{
    /**
     * Set Resources
     */
    public function getResources()
    {
        $this->getAsset()->add('Background', 'Default', 'Images/6.jpg');
        $this->getAsset()->add('Logo', 'Default', 'Images/Uiot_final.svg');
        $this->getAsset()->add('FoundationOld', 'Default', 'Stylesheet/Foundation.old.css');
        $this->getAsset()->add('MainStyle', 'Default', 'Stylesheet/Styles.css');
        $this->getAsset()->add('Foundation', 'Vendor', 'Bower/foundation-sites/dist/foundation.css');

        $this->getAsset()->add('Ring', 'Login', 'Images/Ring.gif');

        $this->getAsset()->add('Jquery', 'Vendor', 'Bower/jquery/dist/jquery.js');
        $this->getAsset()->add('FoundationJs', 'Vendor', 'Bower/foundation-sites/dist/foundation.min.js');
        $this->getAsset()->add('FoundationCore', 'Vendor', 'Bower/foundation-sites/js/foundation.core.js');
        $this->getAsset()->add('FoundationAbide', 'Vendor', 'Bower/foundation-sites/js/foundation.abide.js');
    }

    /**
     * Set Configuration
     */
    public function configureLayout()
    {
        Pages::setTitle('Login at UIoT');
    }

    /**
     * Set Templates
     */
    public function setTemplates()
    {
        $this->getTemplate()->setPath('Login');
        $this->getTemplate()->add('Layouts/Login.php');
    }

    /**
     * Return Template
     *
     * @return null|mixed|string
     */
    public function showLayout()
    {
        return $this->getTemplate()->get();
    }
}
