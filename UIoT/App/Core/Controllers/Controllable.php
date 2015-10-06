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

namespace UIoT\App\Core\Controllers;

use Httpful\Mime;
use UIoT\App\Core\Communication\Parsers\DataHandler;
use UIoT\App\Core\Communication\Parsers\DataManager;
use UIoT\App\Core\Communication\Requesting\Brain;
use UIoT\App\Core\Communication\Sessions\Indexer as SIndexer;
use UIoT\App\Core\Helpers\Manipulators\Arrays;
use UIoT\App\Data\Models\IController;
use UIoT\App\Exception\Register;

/**
 * Class Controllable
 * @property Brain brain
 * @property array|null c_array
 * @property string c_name
 * @property array|null c_s_array
 * @property IController c_data
 * @property string a_name
 * @package UIoT\App\Core\Controllers
 */
final class Controllable extends IControllable
{
    /**
     * Create an IControllable Instance
     * @param $controller_name
     * @param string $action_name
     */
    function __construct($controller_name, $action_name = 'main')
    {
        /* put abstract controller name */
        $this->c_name = (DataManager::setController($controller_name));

        /* set abstract action name */
        $this->a_name = (DataManager::setAction($action_name));

        /* prepare template */
        DataManager::prepareTemplate();

        /* configure brain to a GET template */
        $this->__brain();

        /* check if is valid the controller */
        $this->__validate();

        /* if is let's do it */
        (!$this->__check()) || $this->__items();
        (!$this->__check()) || $this->__enable();

        /* if not valid finish */
        ($this->__check()) || $this->__problem();
    }

    /**
     * Get IController Actions (Methods)
     */
    private function __items()
    {
        $this->c_s_array = DataHandler::getParserArray();
    }

    /**
     * Get Possible IControllers
     */
    private function __validate()
    {
        $this->c_array = (Arrays::toControllerArray((!SIndexer::keyExists('i_data')) ? (SIndexer::updateKeyIfNeeded('i_data', Brain::getItems())) : (SIndexer::getKeyValue('i_data'))));
    }

    /**
     * Check if is in Array
     * That means, check if the Controller Name exists on IController Array
     */
    private function __check()
    {
        return (in_array($this->c_name, $this->c_array));
    }

    /**
     * Call the IController And Create his Instance
     */
    protected function __enable()
    {
        parent::__enable($this->c_s_array);
    }

    /**
     * Set Brain Template Type
     */
    private function __brain()
    {
        Brain::setTemplate(DataHandler::getParserMethod($this->a_name), Mime::JSON);
    }

    /**
     * Function Only to be called if something wrong happens
     * (Something wrong = controller doesn't exists)
     *
     * @throws \Exception
     */
    private function __problem()
    {
        Register::$global->__message(9001,
            "Stop! That Controller Doesn't Exists!",
            'Details: ',
            [
                'What Happened?' => "You're trying to Call an nonexistent Controller",
                'What Controller?' => "Controller with name: {$this->c_name}",
                'Resolution:' => "Stop trying to call nonexistent controllers.",
                'What Controllers can i Call?' => "You can Call UIoT's Abstract Controllers, and the Built-In Controllers",
                'Are you the developer?' => 'You can open this same error Page with Developer Code, only need put ?de on the Url'
            ]
        );
    }
}