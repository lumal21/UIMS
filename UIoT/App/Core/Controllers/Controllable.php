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
 * @copyright University of Bras�lia
 */

namespace UIoT\App\Core\Controllers;

use Httpful\Mime;
use UIoT\App\Core\Communication\Parsers\DataHandler;
use UIoT\App\Core\Communication\Parsers\DataManager;
use UIoT\App\Core\Communication\Requesting\Brain;
use UIoT\App\Core\Communication\Sessions\Indexer as SIndexer;
use UIoT\App\Core\Helpers\Manipulators\Arrays;
use UIoT\App\Exception\Register;

/**
 * Class Controllable
 * @property Brain brain
 * @property array|null c_array
 * @property string c_name
 * @property array|null c_s_array
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
    public function __construct($controller_name, $action_name = 'main')
    {
        /* put abstract controller name */
        $this->c_name = (DataManager::setController($controller_name));

        /* set abstract action name */
        $this->a_name = (DataManager::setAction($action_name));

        /* prepare template */
        DataManager::prepareTemplate();

        /* configure brain to a GET template */
        $this->setBrain();

        /* check if is valid the controller */
        $this->validateData();

        /* if is let's do it */
        (!$this->checkData()) || $this->getResources();
        (!$this->checkData()) || $this->enableController();

        /* if not valid finish */
        ($this->checkData()) || $this->throwProblem();
    }

    /**
     * Get IController Actions (Methods)
     */
    private function getResources()
    {
        $this->c_s_array = DataHandler::getParserArray();
    }

    /**
     * Get Possible IControllers
     */
    private function validateData()
    {
        $this->c_array = (Arrays::toControllerArray((!SIndexer::keyExists('i_data')) ? (SIndexer::updateKeyIfNeeded('i_data', Brain::getItems())) : (SIndexer::getKeyValue('i_data'))));
    }

    /**
     * Check if is in Array
     * That means, check if the Controller Name exists on IController Array
     */
    private function checkData()
    {
        return (in_array($this->c_name, $this->c_array));
    }

    /**
     * Call the IController And Create his Instance
     */
    protected function enableController()
    {
        parent::enableController($this->c_s_array);
    }

    /**
     * Set Brain Template Type
     */
    private function setBrain()
    {
        Brain::setTemplate(DataHandler::getParserMethod($this->a_name), Mime::JSON);
    }

    /**
     * Function Only to be called if something wrong happens
     * (Something wrong = controller doesn't exists)
     *
     * @throws \Exception
     */
    private function throwProblem()
    {
        Register::$global->errorMessage(9001,
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