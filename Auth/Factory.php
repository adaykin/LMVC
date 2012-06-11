<?php

/**
 * Performs authentication on users.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Settings.php
 * @package    LMVC\Auth\Factory
 */

namespace LMVC\Auth;

class Factory
{	
	/**
	 * Setup the user info and session parameters.
	 * 
	 */
	public static function init(array $options)
	{
		switch($options['type']) {
			case "db_pdo":
				
			break;
			case "ldap":
				
			break;
			default:
				
			break;
		}
	}
}