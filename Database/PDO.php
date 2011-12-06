<?php

/**
 * Access to PHP's built in PDO class.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Database/PDO.php
 * @package    LMVC\Database\PDO
 */

namespace LMVC\Database;

class PDO extends \PDO
{	
	private static $instance = NULL;
	
	public function PDO($dsn, $username = NULL, $password = NULL)
	{
		try {
			parent::__construct($dsn, $username, $password);
		}
		catch(PDOException $e) {
			echo "Exception: " . $e->getMessage();
		}
	}
	
	public static function setup($dsn, $username = NULL, $password = NULL)
	{
		self::$instance = new PDO($dsn, $username, $password);	
	}
}