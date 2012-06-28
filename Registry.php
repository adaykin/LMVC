<?php

/**
 * Class acts as a set of keys and values to store data. Borrows heavily from Zend
 * Framework's registry class. @link http://framework.zend.com
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Registry.php
 * @package    LMVC\Registry
 */

namespace LMVC;

class Registry extends \ArrayObject
{
    private static $instance = NULL;

	/**
	 * Prevent developers from directly creating a Registry object.
	 */
	private function Registry()
	{		
	}
	
    public static function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new Registry();
        }

        return self::$instance;
    }

    public static function _unsetInstance()
    {
        self::$instance = NULL;
    }

    public static function get($index)
    {
        $instance = self::getInstance();

        if(!$instance->offsetExists($index)) {
            throw new Exception("No entry is registered for key '$index'");
        }

        return $instance->offsetGet($index);
    }

    public static function set($index, $value)
    {
        $instance = self::getInstance();
        $instance->offsetSet($index, $value);
    }
    
	public static function setMultiple(array $keyVal)
    {
    	$instance = self::getInstance();
    	foreach($keyVal as $key => $value) {
    		$instance->offsetSet($key, $value);
    	}
    }

    public static function isRegistered($index)
    {
        if (self::$instance === null) {
            return false;
        }
        return self::$instance->offsetExists($index);
    }

    public function __construct($array = array(), $flags = parent::ARRAY_AS_PROPS)
    {
        parent::__construct($array, $flags);
    }
	
    public function offsetExists($index)
    {
        return array_key_exists($index, $this);
    }
}

