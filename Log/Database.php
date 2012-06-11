<?php

/**
 * Logs entries into a database. The MySQL create table for the log should look like:
 * 
 * CREATE TABLE `log` (
 * `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 * `level` TINYINT NOT NULL COMMENT '0 - 10 ',
 * `message` TEXT NOT NULL ,
 * `ua` VARCHAR( 20 ) NOT NULL ,
 * `ip` VARCHAR( 23 ) NOT NULL
 *  ) ENGINE = InnoDB;
 * 
 * @author     Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Log/Database.php
 * @package    LMVC\Log\Database
 */

namespace LMVC\Log;

use LMVC\Client;
use LMVC\Db;

class Database extends Writer implements IWriter
{
	private $db = NULL;
	
	public function log($message, $level = 0)
	{
		$ua = Client::getUA();
		$ip = Client::getIp();
		$this->db->query("INSERT INTO log VALUES(?, ?, ?, ?)", array($level, $message, $ua, $ip));
	}
	
	public function clearLog()
	{
		$this->db->query("TRUNCATE TABLE log");
	}
	
	public function deleteLog($id)
	{
		$this->db->query("DELETE FROM log WHERE id=?", $id);
	}
}