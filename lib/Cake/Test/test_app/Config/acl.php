<?php
/*
 * Test App PHP Based Acl Config File
 *
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 *  Licensed under The MIT License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Test.TestApp.Config
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// -------------------------------------
// Roles
// -------------------------------------
$config['roles'] = array(
	'Role/admin'				=> null,
	'Role/data_acquirer'		=> null,
	'Role/accounting'			=> null,
	'Role/database_manager'		=> null,
	'Role/sales'				=> null,
	'Role/data_analyst'			=> 'Role/data_acquirer, Role/database_manager',
	'Role/reports'				=> 'Role/data_analyst',
	// allow inherited roles to be defined as an array or comma separated list
	'Role/manager'				=> array(
		'Role/accounting',
		'Role/sales',
	),
	'Role/accounting_manager'	=> 'Role/accounting',
	// managers
	'User/hardy'				=> 'Role/accounting_manager, Role/reports',
	'User/stan'					=> 'Role/manager',
	// accountants
	'User/peter'				=> 'Role/accounting',
	'User/jeff'					=> 'Role/accounting',
	// admins
	'User/jan'					=> 'Role/admin',
	// database
	'User/db_manager_1'			=> 'Role/database_manager',
	'User/db_manager_2'			=> 'Role/database_manager',
);

//-------------------------------------
// Rules
//-------------------------------------
$config['rules']['allow'] = array(
	'/*' => 'Role/admin',
	'/Controllers/*/manager_*' => 'Role/manager',
	'/Controllers/reports/*' => 'Role/sales',
	'/Controllers/invoices/*' => 'Role/accounting',
	'/Controllers/invoices/edit' => 'User/db_manager_2',
	'/Controllers/db/*' => 'Role/database_manager',
	'/Controllers/*/(add|edit|publish)' => 'User/stan',
	'/Controllers/users/dashboard' => 'Role/default',
	// test for case insensitivity
	'Controllers/Forms/NEW' => 'Role/data_acquirer',
);
$config['rules']['deny'] = array(
	// accountants and sales should not delete anything
	'/Controllers/*/delete' => array(
		'Role/sales',
		'Role/accounting'
	),
	'/Controllers/db/drop' => 'User/db_manager_2',
);
