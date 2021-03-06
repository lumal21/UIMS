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

use UIoT\App\Helpers\Manipulation\Constants as C;

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
C::add('ROOT_FOLDER', __DIR__);

/*
 * UIoTCMS Base Folder
 * That folder is considered the base folder where the CMS lives
 * Example: C:\my folder\apache\www\some folder\ (That is the Application BASE folder)
 * Observation: Base folder it's the same place where Index.php is
 */
C::add('BASE_FOLDER', basename(str_replace('UIoT', '', __DIR__)));

/*
 * Global MVC Constants
 * Resource Folder Name
 */
C::add('RESOURCE_FOLDER_NAME', 'Resources');

/*
 * Global MVC Constants
 * Resource Cache Folder Name
 */
C::add('RESOURCE_CACHE_FOLDER_NAME', 'Cache');

/*
 * UIoTCMS Resources Folder
 * Here is configured the folder where Resources Alive
 * You can change the Resource folder if you want
 * But must set the New Path here.
 *  Warning: Vendor folder location, CAN'T be changed!
 */
C::add('RESOURCE_FOLDER', (C::get('ROOT_FOLDER') . '/' . C::get('RESOURCE_FOLDER_NAME') . '/'));

/*
 * Global MVC Constants
 * Resource Cache Folder
 */
C::add('RESOURCE_CACHE_FOLDER', C::get('RESOURCE_FOLDER') . C::get('RESOURCE_CACHE_FOLDER_NAME') . '/');

/**
 * Server Constants
 */

/*
 * Global Variable (Server Variable)
 * Request URL
 */
C::add('REQUEST_URL', $_SERVER['REQUEST_URI']);

/*
 * Global Variable (Server Variable)
 * Script Name
 */
C::add('SCRIPT_NAME', $_SERVER['SCRIPT_NAME']);

/*
 * Global Variable (Server Variable)
 * Query String
 */
C::add('QUERY_STRING', $_SERVER['QUERY_STRING']);

/*
 * Global Variable (Request Variable)
 * Post Method
 */
C::addJson('HTTP_PHP_POST', $_POST);

/*
 * Global Variable (Server Variable)
 * PhP Self
 */
C::add('PHP_SELF', $_SERVER['PHP_SELF']);

/*
 * Global Variable (Server Variable)
 * Requested Method
 */
C::add('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);

/*
 * Global Variable (Server Variable)
 * Server
 */
C::addJson('SERVER_WEB', $_SERVER);

/**
 * MVC Constants
 */

/*
 * Global MVC Constants
 * Default View
 */
C::add('DEFAULT_CONTROLLER', 'Login');

/*
 * Global MVC Constants
 * Default View Action (Default Layout)
 */
C::add('DEFAULT_ACTION', 'Main');
