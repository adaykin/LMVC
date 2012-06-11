<?php

/**
 * Stores data in the native sessions. For more information see
 * @link http://www.php.net/manual/en/book.session.php
 * 
 * Currently this class will not work b/c of
 * @link http://bugs.php.net/bug.php?id=49867
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Storage/Native.php
 * @package    LMVC\Storage\Native
 */

namespace LMVC\Storage;

class Native extends Session
{	
	public function Native($expire = 0, array $validate = NULL, $regenerate = 0)
	{
		session_start();
		session_set_cookie_params($expire);
		foreach($validate as $v) {
			if($v == "ua") {
				if(isset($_SESSION['ua']))
					$this->validateBrowser($_SESSION['ua']);
				$_SESSION['ua'] = Client::getUa();
			}
			if($v == "ip") {
				if(isset($_SESSION['ua']))
					$this->validateIp($_SESSION['ip']);
				$_SESSION['ip'] = Client::getIp();
			}
		}
		
		if($regenerate != 0 && $_SESSION['regenerate'] - time() < 0) {
			session_regenerate_id();
			$_SESSION['regenerate'] = time() + $regenerate;
		}
		if($regenerate != 0 && !isset($_SESSION['regenerate'])) {
			$_SESSION['regenerate'] = time() + $regenerate;
		}
	}
	
	public function get($key)
	{
		return isset($_SESSION[$key]) ?: FALSE;
	}

	public function set($key, $value, $expire = 0)
	{
		$_SESSION[$key] = $value;
	}
	
	public function remove($key)
	{
		unset($_SESSION[$key]);
	}
}