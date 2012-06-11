<?php

/**
 * Load 3rd party libraries located in the directory LMVC\Vendor
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Loader.php
 * @package    LMVC\Loader
 */

namespace LMVC;

class Loader
{
	/**
	 * Prevent developers from directly creating a Loader object.
	 */
	private function Loader()
	{	
	}
	
	/**
	 * Loads a file located in the vendor directory.
	 * 
	 * @param String $name
	 */
	public static function loadVendor($name)
	{
		if(!file_exists(APP_URL . DIRECTORY_SEPARATOR . "Vendor" . DIRECTORY_SEPARATOR . $name)) {
			throw new Exception("Failed to load $name");
		}
		
		include APP_URL . DIRECTORY_SEPARATOR . "Vendor" . DIRECTORY_SEPARATOR . $name;
	}
	
	/**
	 * 
	 * 
	 * @param String $name
	 */
	public static function loadModel($name)
	{
		if(!file_exists(APP_URL . DIRECTORY_SEPARATOR . "application" . DIRECTORY_SEPARATOR . "models" . DIRECTORY_SEPARATOR . $name)) {
			throw new Exception("Failed to load $name");
		}
		
		include APP_URL . DIRECTORY_SEPARATOR . "application" . DIRECTORY_SEPARATOR . "models" . DIRECTORY_SEPARATOR . $name;
	}
}