<?php

/**
 * Stores data in a database.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Storage/Database.php
 * @package    LMVC\Storage\Database
 */

namespace LMVC\Storage;

class Database extends AbstractStorage
{	
	
	public function Database($expire = 0, $regenerate = 0, array $options = null)
	{	
		parent::__construct($expire, $regenerate, $options);
	}
	
	public function setOptions()
	{
		
	}
}