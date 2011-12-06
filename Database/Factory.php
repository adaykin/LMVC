<?php

/**
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Database/Factory.php
 * @package    LMVC\Database\Factory
 */

namespace LMVC\Database;

final class Factory
{		
	public static function init($driver, $host, $username = NULL, $password = NULL, $db = NULL)
	{
		switch($driver) {
			case "pdo_mysql":
				return self::constructPDO("mysql:dbname=$db;host=$host", $username, $password);
			break;
			case "pdo_pgsql":
				return self::constructPDO("pgsql:dbname=$db;host=$host", $username, $password);
			break;
			case "pdo_sqlite":
				return self::constructSQLitePDO($host);
			break;
			case "mysql":
				return self::constructMySQL($host, $username, $password, $db);
			break;
			default:
				throw new Exception("Database driver $driver not found");
			break;
		}
	}
	
	public static function constructMySQL($host, $username, $password, $db)
	{
		try {
			return new MySQL($host, $username, $password, $db);
		}
		catch(Exception $e) {
			echo "Error instantiating MySQL database: " . $e->getMessage();
		}	
	}
	
	public static function constructSQLitePDO($dsn)
	{
		try {
			return new \PDO($dsn);
		}
		catch(PDOException $e) {
			echo "Error instantiating Sqlite database: " . $e->getMessage();
		}
	}
	
	public static function constructPDO($dsn, $username = NULL, $password = NULL)
	{
		try {
			return new \PDO($dsn, $username, $password);
		}
		catch(PDOException $e) {
			echo "Error instantiating PDO database: " . $e->getMessage();
		}
	}
}