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
    private static $_registry = NULL;

	/**
	 * Prevent developers from directly creating a Registry object.
	 */
	private function Registry()
	{		
	}
	
    public static function getInstance()
    {
        if (self::$_registry === NULL) {
            self::init();
        }

        return self::$_registry;
    }

    public static function setInstance(Registry $registry)
    {
        if (self::$_registry !== NULL) {
            throw new Exception('Registry is already initialized');
        }

        self::$_registry = $registry;
    }

    protected static function init()
    {
        self::setInstance(new Registry());
    }

    public static function _unsetInstance()
    {
        self::$_registry = NULL;
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
        if (self::$_registry === null) {
            return false;
        }
        return self::$_registry->offsetExists($index);
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

