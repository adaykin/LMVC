<?php

/**
 * Factory class for storage data.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Storage/Factory.php
 * @package    LMVC\Storage\AbstractStorage
 */

namespace LMVC\Storage;

abstract class AbstractStorage
{
	private $expire = 0;
	private $regenerate = 0;
	
	public function AbstractStorage($expire = 0, $regenerate = 0)
	{
		$this->expire = $expire;
		$this->regenerate = $regenerate;
	}
}