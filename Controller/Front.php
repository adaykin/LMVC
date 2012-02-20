<?php

/**
 * Follows the front controller design pattern. For a detailed look at the pattern
 * see java blueprints 
 * @link http://java.sun.com/blueprints/patterns/MVC-detailed.html 
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Controller/Front.php
 * @package    LMVC\Controller\Front
 */

namespace LMVC\Controller;

include 'URI.php';
use LMVC\URI;

class Front
{
	public static $actionName = "index";
	private static $controller = "index";
	private static $view = "index";
	private static $instance = NULL;
	
	/**
	 * Prevent direct creation of the object.
	 */
	protected function Front()
	{
		
	}

	/**
	 * Returns the controller.
	 * 
	 * @return string The current controller
	 */
	public static function getController()
	{
		return self::$controller;
	}
	
	/**
	 * Returns the view.
	 * 
	 * @return string The current view
	 */
	public static function getView()
	{
		return self::$view;		
	}
	
	/**
	 * Dispatches the main request from the application.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function dispatch()
	{
		// Get the URL, and remove malicious characters from it
		$uriString = self::uriClean(str_replace(BASE_URL, "", "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']));
		// Initialize the url so we can access the various parts of it later on
		URI::setup($uriString);
		self::setController($uriString);
	}
	
	/**
	 * Sets the error controller as the controller and calls the index action of the
	 * error controller.
	 * 
	 * @param int $code
	 */
	public static function setErrorController($code)
	{
		include APP_URL . "/application/controllers/errorController.php";
		$controller = new \errorController();
		if(method_exists($controller, "preDispatch")) {
			$controller->preDispatch();
		}
		if(method_exists($controller, "indexAction")) {
			$controller->indexAction();
		}
		else {
			throw new Exception("Index action not found in error controller");
		}
		if(method_exists($controller, "postDispatch")) {
			$controller->postDispatch();
		}
	}
	
	/**
	 * Routes the request to the proper controller.
	 * 
	 * @access public
	 * @static
	 * @param string $uriString URI to parse for route
	 * @return void
	 */
	public static function setController($uriString)
	{
		error_log("URI1st check: " . URI::get(0));
		// @todo this needs some serious refactoring to be more efficient
		// No controller was specified, so load the index controller
		if(URI::get(0) === "") {
			if(!file_exists(APP_URL . "/application/controllers/indexController.php")) {
				// If the file does not exist there is no error controller so just
				// stop executing the script alltogether
				if(!file_exists(APP_URL . "/application/controllers/errorController.php")) {
					throw new Exception("Unable to locate error controller");
				}
				else {
					self::setErrorController(404);
				}
			}
			else {
				include APP_URL . "/application/controllers/indexController.php";
				
				$controller = new \indexController();
				
				if(method_exists($controller, "preDispatch")) {
					$controller->preDispatch();
				}
				if(method_exists($controller, "indexAction")) {
					$controller->indexAction();
				}
				else {
					if(!file_exists(APP_URL . "/application/controllers/errorController.php")) {
						throw new Exception("Unable to locate error controller");
					}
					else {
						self::setErrorController(404);
					}
				}
				if(method_exists($controller, "postDispatch")) {
					$controller->postDispatch();
				}
			}
		}
		
		// Only the controller name or a controller, and a parameter with value was specified
		else if(URI::getLength() === 1 || URI::getLength() === 3) {
			$uri0 = URI::get(0);
			error_log("URI: $uri0");
			self::$controller = $uri0;
			if(!file_exists(APP_URL . "/application/controllers/" . $uri0 . "Controller.php")) {
				if(!file_exists(APP_URL . "/application/controllers/errorController.php")) {
					include 'Controller/Exception.php';
					throw new Exception("Unable to locate error controller");
				}
				else {
					self::setErrorController(404);
				}
			}
			
			include APP_URL . "/application/controllers/" . $uri0 . "Controller.php";
			
			$className = $uri0 . "Controller";
			$controller = new $className;
			
			if(method_exists($controller, "preDispatch")) {
				$controller->preDispatch();
			}
			if(method_exists($controller, "indexAction")) {
				$controller->indexAction();
			}
			else {
				if(!file_exists(APP_URL . "/application/controllers/errorController.php")) {
					include 'Controller/Exception.php';
					throw new Exception("Unable to locate error controller");
				}
				else {
					self::setErrorController(404);
				}
			}
			if(method_exists($controller, "postDispatch")) {
				$controller->postDispatch();
			}
		}
		
		// A controller and action was specified and possibly get parameters
		else {
			$uri0 = URI::get(0);
			self::$controller = $uri0;
			self::$view = URI::get(1);
			if(!file_exists(APP_URL . "/application/controllers/" . $uri0 . "Controller.php")) {
				if(!file_exists(APP_URL . "/application/controllers/errorController.php")) {
					include 'Controller/Exception.php';
					throw new Exception("Unable to locate error controller");
				}
				else {
					self::setErrorController(404);
				}
			}
			
			include APP_URL . "/application/controllers/" . $uri0 . "Controller.php";

			$className = $uri0 . "Controller";
			$controller = new $className;
			
			if(method_exists($controller, "preDispatch")) {
				$controller->preDispatch();
			}
			$view = self::$view . "Action";
			if(method_exists($controller, $view)) {
				$controller->$view();
			}
			else {
				if(!file_exists(APP_URL . "/application/controllers/errorController.php")) {
					include 'Controller/Exception.php';
					throw new Exception("Unable to locate error controller");
				}
				else {
					self::setErrorController(404);
				}
			}
			if(method_exists($controller, "postDispatch")) {
				$controller->postDispatch();
			}
		}	
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
}