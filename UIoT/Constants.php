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

/*  License
 *  <UIoT CMS is the default content management system of uiot's
 *  architecture and environment of the client-side.>
    Copyright (C) <2015>  <University of Bras�lia>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace UIoT;

use UIoT\App\Core\Helpers\Manipulators\Constants as C;

/**
 * This file is where you register all Public Constants
 */

/**
 * Folders Constants
 */

/*
 * UIoTCMS Root Folder
 * That folder is considered as the folder where is the folder /UIoT
 * Example: C:\my folder\apache\htdocs\some folder\UIoT\ (That is the Application ROOT Folder)
 */
C::addConstant('ROOT_FOLDER', __DIR__);

/*
 * UIoTCMS Base Folder
 * That folder is considered the base folder where the CMS lives
 * Example: C:\my folder\apache\www\some folder\ (That is the Application BASE folder)
 * Observation: Base folder it's the same place where Index.php is
 */
C::addConstant('BASE_FOLDER', basename(str_replace('UIoT', '', __DIR__)));

/*
 * UIoTCMS Resources Folder
 * Here is configured the folder where Resources Alive
 * You can change the Resource folder if you want
 * But must set the New Path here.
 *  Warning: Vendor folder location, CAN'T be changed!
 */
C::addConstant('RESOURCE_FOLDER', (C::returnConstant('ROOT_FOLDER') . '/Resources/'));

/**
 * Registering Constants
 */

/*
 * UIoTCMS Resource Types
 * That namings is to set, what type of sub-resource folders is valid
 * Example:
 *  1. Root Resource folder: Resources/
 *  2. Controller Resource Folder: Resources/Main {is an example,} (the valid name is only Main)
 *  3. Resource Folder Type: Images/
 *  4. This will be a valid resource sub-folder, because is listed in this array
 * Example:
 *  http://mysite.com:port/cms-folder/controller-name/images/my/file/path/my/file.extension
 *  That's a valid url, remember the only part that is validated is:
 *      1. controller-name
 *      2. images (resource type)
 *      3. /my/file..../file.extension
 * Example 2:
 *  http://mysite.com:port/cms-folder/controller-name/my-ass/my/file/path/my/file.extension
 *  That's not a valid url, remember the only part that is validated is:
 *      1. controller-name
 *      2. my-ass (resource type)
 *      3. /my/file..../file.extension
 *  And my-ass is not an resource-type listed here.
 */
C::addJsonConstant('RESOURCE_TYPES', [
        '',
        'Images',
        'Fonts',
        'Less',
        'Scripts',
        'Scss',
        'Stylesheet'
    ]
);

/*
 * @warning it's important register here
 * Here is register all LAYOUT's names, used by UIoT Router
 * Remember: This are the Public Layouts used in the Router.
 * That not means that every Layout must be added here.
 *  Explaining:
 *      1. If you have a Layout called "my-layout"
 *      2. in the Layout Class is defined the Resource directory as (example) "Edit"
 *      3. Are added Resource from that Resource Folder like: images,css,etc.
 *      4. In the Template HTML File will be something like:
 *      <image src="Edit/Stylesheet/MyCSS.css"/>
 *      5. That means that The "Edit" Layout Resources are Called, Soo you can extend the Layout and Overwrite.
 *      6. That is good, because you have the option to not set every Layout as PUBLIC.
 *      Only the listed Layouts here, his resources are accessible.
 * Observation:
 *  If you added Resources in your Layout named "My-Layout", and try to access him
 *  The page is Called, Remember that the Layout name doesn't need be the same as the Controller Name,
 *  You can have a controller called "my-controller", and layout called "my-layout",
 *  You set what Layout the Controller Loads.
 *  Remember, if the Layout isn't registered in this array,
 *  the layout resources will not be accessible.
 *  ANYWAY: the layout is accessible! because the controller need render layout.
 *  BUT: if you try something like: <image src="My-Layout/Stylesheet/MyCSS.css"/>
 *  will not work.
 *  Remember: The RESOURCE FOLDER doesn't need have the same NAME of LAYOUT NAME.
 *  An RESOURCE folder is only folders where is "stored" resource files.
 *  Any LAYOUT can call ANY resource folder. And you can add multiple RESOURCE folders.
 *  But remember: The Layout REGISTER the resources FOLDERS.
 *  And to the RESOURCES from that LAYOUT be accessible you need REGISTER the LAYOUT in this ARRAY.
 */
C::addJsonConstant('PREDEFINED_LAYOUTS', [
        '',
        'Add',
        'Edit',
        'Login',
        'Main',
        'Remove'
    ]
);

/**
 * Server Constants
 */

/*
 * Global Variable (Server Variable)
 * Request URL
 */
C::addConstant('REQUEST_URL', @$_SERVER['REQUEST_URI']);

/*
 * Global Variable (Server Variable)
 * Script Name
 */
C::addConstant('SCRIPT_NAME', @$_SERVER['SCRIPT_NAME']);

/*
 * Global Variable (Server Variable)
 * Query String
 */
C::addConstant('QUERY_STRING', @$_SERVER['QUERY_STRING']);

/*
 * Global Variable (Request Variable)
 * Post Method
 */
C::addJsonConstant('HTTP_PHP_POST', @$_POST);

/*
 * Global Variable (Server Variable)
 * PhP Self
 */
C::addConstant('PHP_SELF', @$_SERVER['PHP_SELF']);

/*
 * Global Variable (Server Variable)
 * Server
 */
C::addJsonConstant('SERVER_WEB', @$_SERVER);

/**
 * MVC Constants
 */

/*
 * Global MVC Constants
 * Default View
 */
C::addConstant('DEFAULT_VIEW', 'None');

/*
 * Global MVC Constants
 * Default Controller
 */
C::addConstant('DEFAULT_CONTROLLER', 'None');

/*
 * Global MVC Constants
 * Default View Action (Default Layout)
 */
C::addConstant('DEFAULT_VIEW_ACTION', 'Main');