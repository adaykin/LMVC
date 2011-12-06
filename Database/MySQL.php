<?php

/**
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Database/MySQL.php
 * @package    LMVC\Database\MySQL
 */

namespace LMVC\Database;

class MySQL implements IDriver
{
	private $sql = "";
	
	public function MySQL($host, $username, $password, $db)
	{
		mysql_connect($host, $username, $password);
		mysql_selectdb($db);
	}
    
    public function query($sql)
    {
    	
    }
	
	public function prepare()
	{
		
	}
	
	public function quote($sql)
	{
		$this->sql = mysql_real_escape_string($sql);
	}
	
	public function execute()
	{
		
	}
	
	public function fetchAll($type)
	{
		
	}
	
	public function fetch()
	{
		
	}
}