<?php

/**
 * URI manages the uri segments passed in to the URI. Segments follow the pattern:
 * base url/controller/(view)* entity/(param/value)* entity
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/URI.php
 * @package    LMVC\URI
 */

namespace LMVC;

class URI
{
	private static $uri = NULL;
	private static $instance = NULL;
	
	/**
	 * Prevent developers from directly creating a URI object.
	 */
	private function URI()
	{		
	}

	/**
	 * Setup the singleton design by initializing the URI and splitting it into an
	 * array delimited by /'s.
	 * 
	 * @static
	 * @param String $uriString
	 */
    public static function setup($uriString)
    {
    	error_log($uriString);
        if(self::$instance !== NULL) {
        	include 'Exception.php';
            throw new Exception('URI is already initialized');
        }
        
        self::$instance = new URI();
        
        self::$uri = explode("/", $uriString);
    }
    
    /**
     * Return the instance of the class to help use singleton pattern.
     * 
     * @return instance of URI class
     */
    public static function getInstance()
    {
    	if(self::$instance === NULL) {
    		include 'Exception.php';
    		throw new Exception("URI was not initialized");
    	}
    	
    	return self::$instance;
    }
    
    /**
     * Return the number of URI segments.
     * 
     * @return length of the URI
     */
    public static function getLength()
    {
    	if(self::$uri === NULL) {
    		include 'Exception.php';
    		throw new Exception('URI has not been initialized yet');	
    	}
    	
    	$instance = self::getInstance();
    	return $instance->length(); 
    }
    
    /**
     * Return the number of URI segments.
     * 
     * @return length of the URI
     */
    public function length()
    {
    	return count(self::$uri);
    }
    
    /**
     * Return the URI segment at the given index.
     * 
     * @param Integer $index
     */
    public static function get($index)
    {
    	if(filter_var($index, FILTER_VALIDATE_INT) === false) {
    		include 'Exception.php';
            throw new Exception('You must supply an integer index for the URI segment');
    	}
    	
    	if(self::$instance === NULL) {
    		include 'Exception.php';
    		throw new Exception('URI has not been initialized yet');	
    	}
    	
    	$instance = self::getInstance();
        return $instance->getAt($index);
    }
    
    /**
     * Get the URI segment at a given index.
     * 
     * @param Integer $index
     */
    public function getAt($index)
    {
    	return self::$uri[$index];
    }
}
