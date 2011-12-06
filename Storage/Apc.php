<?php

/**
 * Stores data in APC (Alternative PHP Cache). For a detailed look at APC, see
 * @link http://www.php.net/manual/en/ref.apc.php 
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Storage/Apc.php
 * @package    LMVC\Storage\Apc
 */

namespace LMVC\Storage;

class Apc extends Session
{	
	private $expire = 0;
	private $encrypt = FALSE;
	private $validate = array();
	
	public function Apc($expire = 0, array $validate = NULL, $regenerate = 0)
	{
		
	}
	
	public function get($key)
	{
		return apc_fetch($key);
	}
	
	public function set($key, $value, $expire = 0)
	{
		if($expire == 0)
			return apc_store($key, $value);
		else
			return apc_store($key, $value, $expire);
	}
	
	public function remove($key)
	{
		return apc_delete($key);
	}
}