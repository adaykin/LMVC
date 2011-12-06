<?php

/**
 * Factory class for session data.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Storage/Factory.php
 * @package    LMVC\Session\Factory
 */

namespace LMVC\Session;

use LMVC\Client,
	LMVC\Storage\Factory as StorageFactory;

final class Factory
{
	public static function init(array $options)
	{
		$session = NULL;

		if(isset($options["type"])) {
			switch($options["type"]) {
				case "Apc":
					
				break;
				case "Memcache":
					
				break;
				case "Database":
					$session = new Database($options['expire'], $options['regen'], $options['options']); 
				break;
				case "Native":
					
				break;
				default:
					throw new Exception("Unsupported session type of ". $options['type'] . " supplied");
				break;
			}
		}
		else {
			throw new Exception("Session type not defined");
		}
		
		return $session;
	}
	
	public function validateBrowser($storeUa)
	{
		$browser = Client::getUa();
		if($browser === $storeUa) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	
	public function validateIp($storeIp)
	{
		$ip = Client::getIp();
		if($ip != "0.0.0.0" && $ip === $storeIp) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
}