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

use UIoT\App\Core\Helpers\Manipulation\Constants as C;

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
 * Global MVC Constants
 * Resource Folder Name
 */
C::addConstant('RESOURCE_FOLDER_NAME', 'Resources');

/*
 * Global MVC Constants
 * Resource Cache Folder Name
 */
C::addConstant('RESOURCE_CACHE_FOLDER_NAME', 'Cache');

/*
 * UIoTCMS Resources Folder
 * Here is configured the folder where Resources Alive
 * You can change the Resource folder if you want
 * But must set the New Path here.
 *  Warning: Vendor folder location, CAN'T be changed!
 */
C::addConstant('RESOURCE_FOLDER', (C::returnConstant('ROOT_FOLDER') . '/' . C::returnConstant('RESOURCE_FOLDER_NAME') . '/'));

/*
 * Global MVC Constants
 * Resource Cache Folder
 */
C::addConstant('RESOURCE_CACHE_FOLDER', C::returnConstant('RESOURCE_FOLDER') . C::returnConstant('RESOURCE_CACHE_FOLDER_NAME') . '/');

/**
 * Server Constants
 */

/*
 * Global Variable (Server Variable)
 * Request URL
 */
C::addConstant('REQUEST_URL', $_SERVER['REQUEST_URI']);

/*
 * Global Variable (Server Variable)
 * Script Name
 */
C::addConstant('SCRIPT_NAME', $_SERVER['SCRIPT_NAME']);

/*
 * Global Variable (Server Variable)
 * Query String
 */
C::addConstant('QUERY_STRING', $_SERVER['QUERY_STRING']);

/*
 * Global Variable (Request Variable)
 * Post Method
 */
C::addJsonConstant('HTTP_PHP_POST', $_POST);

/*
 * Global Variable (Server Variable)
 * PhP Self
 */
C::addConstant('PHP_SELF', $_SERVER['PHP_SELF']);

/*
 * Global Variable (Server Variable)
 * Server
 */
C::addJsonConstant('SERVER_WEB', $_SERVER);

/**
 * MVC Constants
 */

/*
 * Global MVC Constants
 * Default View
 */
C::addConstant('DEFAULT_CONTROLLER', 'None');

/*
 * Global MVC Constants
 * Default View Action (Default Layout)
 */
C::addConstant('DEFAULT_CONTROLLER_ACTION', 'Main');
