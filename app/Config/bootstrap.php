<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and Controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/Controllers/', '/next/path/to/Controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */

/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */

/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter . By Default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from Controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'FileLog',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'FileLog',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));
CakePlugin::load('search',array(
    'Post' => array('routes' => true),
    'search' => array('bootstrap' => true),
    'WebmasterTools' => array('bootstrap' => true, 'routes' => true),
));
CakePlugin::load('LogErrors');
App::uses('ErrorCheck','LogErrors.Lib');

CakePlugin::load('Combinator');
//CakePlugin::load('MinifyHtml');

//Configure::write('Dispatcher.filters', array(
//    'AssetDispatcher',
//    'CacheDispatcher'
//));
//CakePlugin::load('AssetCompress', array('bootstrap' => true));
//App::uses('Combinator','Combinator.View.Helper');
/*
 * airbrake configs
 *
 */
//CakePlugin::load('Airbrake-Cake');
//Configure::write('Airbrake-Cake.apiKey', '0fe5a382cc8dacb1083ec2f926f07eeb');
//App::uses('AirbrakeError', 'Airbrake-Cake.Lib');
//Configure::write('Airbrake-Cake.options',array('async'=>true));
    /*
     * options available
     *
    - **timeout** - Defaults to 2, this is how long the service will wait before giving up. This should be set to a sane limit, so as to avoid excessive page times in the event of a failure.
    - **environmentName** - Defaults to 'production'. This can be changed to match the environment that you are working, which will help prevent messy logs, filled with non-production problems.
    - **serverData** - This defaults to the $_SERVER array, but can be overridden with any array of data.
    - **getData** - Defaults to the $_GET array
    - **postData** - Defaults to the $_POST array
    - **sessionData** - Defaults to the $_SESSION array
    - **component** - This is the name of the component or controller that is running.
    - **action** - The name of the action that was called.
    - **projectRoot** - Defaults to the Document Root. May need to change based on the context of your application.
    - **url** - The main URL that was requested.
    - **hostname** - The hostname that was requested.
    - **queue** - Optional - the name of the Resque queue to use.
    - **filters** - Optional - A list of errors to ignore
    - **async**   - Optional - Will asynchronously send exceptions if true
*/
CakePlugin::load('Examples', array('bootstrap' => false, 'routes' => false));

CakePlugin::load('Examples1', array('bootstrap' => false, 'routes' => false));

//CakePlugin::load('Combinator');
//CakePlugin::load('LogErrors', array('bootstrap' => false, 'routes' => false));
