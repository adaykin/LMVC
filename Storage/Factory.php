<?php

/**
 * Factory class for storage data.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Storage/Factory.php
 * @package    LMVC\Storage\Factory
 */

namespace LMVC\Storage;

final class Factory
{
	private $expire = 0;
	private static $instance = NULL;

	public static function init($type, $expire = 0, $regen = 0, array $options)
	{
		if(self::$instance === NULL) {
			self::$instance = new $type($expire, $regen, $options);
		}
		else {
			throw new Exception("Session is already initialized");
		}
	}
}