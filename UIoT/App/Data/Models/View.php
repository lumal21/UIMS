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
 * @copyright University of Brasília
 */

namespace UIoT\App\Data\Models;

use ReflectionClass;
use UIoT\App\Core\Layouts\Indexer as LIndexer;
use UIoT\App\Data\Interfaces\View as InterfaceView;

/**
 * Class View
 * @property string view
 * @property string vname
 * @package UIoT\App\Data\Models\Types
 */
class View implements InterfaceView
{
    /**
     * Start View
     */
    function __construct()
    {
        $this->__name();
        $this->__layout();
        $this->__show();
    }

    /**
     * Set Abstract Name
     */
    function __name()
    {
        $this->vname = (new ReflectionClass(self::class))->getShortName();
    }

    /**
     * Set Layout
     */
    function __layout()
    {
        LIndexer::addLayout($this->vname, $this->vname);
    }

    /**
     * Show Layout
     */
    function __show()
    {
        LIndexer::getLayout($this->vname);
    }
}