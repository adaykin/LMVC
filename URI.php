<?php

/**
 * URI manages the uri segments passed in to the URI. Segments follow the pattern:
 * base url/controller/(view)* entity/(param/value)* entity
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/URI.php
 * @package    LMVC\URI
 */

namespace LMVC;

class URI
{
	private static $instance = NULL;
	
	private $uri = '';
	private $uriString = '';
	
	/**
	 * Prevent developers from directly creating a URI object.
	 */
	private function URI()
	{		
	}
    
    /**
     * Return the instance of the class to help use singleton pattern.
     * 
     * @return instance of URI class
     */
    public static function getInstance()
    {
    	if(self::$instance === NULL) {
    		self::$instance = new URI();
    		// Get the URL, and remove malicious characters from it
    		$uriString = self::uriClean(str_replace(BASE_URL, "", "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']));
    		self::$instance->uriString = $uriString;
    		self::$instance->uri = explode("/", $uriString);
    	}
    	
    	return self::$instance;
    }
    
    /**
     * Cleans the uri for possible xss injection attacks by removing bad characters.
     * Modified slightly from code at
     * @link https://svn.liip.ch/repos/public/ext/externalinput/trunk/lx/externalinput/clean.php
     * @access public
     * @static
     * @param string $string URI to clean
     * @return void
     */
    public static function uriClean($string)
    {
    	$string = str_replace(array("&amp;", "&lt;", "&gt;"), array("&amp;amp;", "&amp;lt;", "&amp;gt;"), $string);
    
    	// remove javascript: and vbscript: protocol
    	$string = preg_replace('#([a-z]*)[\x00-\x20\/]*=[\x00-\x20\/]*([\`\'\"]*)[\x00-\x20\/]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iUu', '$1=$2nojavascript...', $string);
    	$string = preg_replace('#([a-z]*)[\x00-\x20\/]*=[\x00-\x20\/]*([\`\'\"]*)[\x00-\x20\/]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iUu', '$1=$2novbscript...', $string);
    	$string = preg_replace('#([a-z]*)[\x00-\x20\/]*=[\x00-\x20\/]*([\`\'\"]*)[\x00-\x20\/]*-moz-binding[\x00-\x20]*:#Uu', '$1=$2nomozbinding...', $string);
    	$string = preg_replace('#([a-z]*)[\x00-\x20\/]*=[\x00-\x20\/]*([\`\'\"]*)[\x00-\x20\/]*data[\x00-\x20]*:#Uu', '$1=$2nodata...', $string);
    
    	return $string;
    }
    
    /**
     * Return the number of URI segments.
     * 
     * @return length of the URI
     */
    public static function getLength()
    {
    	$instance = self::getInstance();
    	return count($instance->uri); 
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
    	
    	$instance = self::getInstance();
        return $instance->uri[$index];
    }
}
