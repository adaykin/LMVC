<?php

/**
 * Keeps track of client information such as user agent, ip.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Client.php
 * @package    LMVC\Client
 */

namespace LMVC;

class Client
{
	private static $instance = NULL;
	private $ip = NULL;
	private $ua = NULL;
	private $browserList = array('Firefox', 'MSIE', 'Chrome', 'Opera', 'Safari'); // @todo Get opera working, and get mobile ua's.
	
	/**
	 * Prevent developers from directly creating a Client object.
	 */
	private function Client()
	{		
	}
	
	public static function getInstance()
	{
		if(self::$instance === NULL) {
			self::init();
		}
		
		return self::$instance;
	}
	
	public static function init()
	{
		if(self::$instance != NULL) {
			throw new Exception("Client is already initialized");
		}
		
		self::$instance = new Client();	
	}
	
	public static function getIp()
	{
		$instance = self::getInstance();
		
		if($instance->ip) {
			return $instance->ip;
		}
		else {
			return $instance->findIp();
		}
	}
	
	public function findIp()
	{
		if(isset($_SERVER['REMOTE_ADDR'])) {
			// Validate IPv4
			if(preg_match('/^((?:25[0-5]|2[0-4]\d|[01]?\d?\d).){3}(?:25[0-5]|2[0-4]\d|[01]?\d?\d)$/', $_SERVER['REMOTE_ADDR'])) {
				$this->ip = $_SERVER['REMOTE_ADDR'];
				return $_SERVER['REMOTE_ADDR'];
			}
			else {
				$this->ip = "0.0.0.0";
				return "0.0.0.0";
			}
		}
		else {
			$this->ip = "0.0.0.0";
			return "0.0.0.0";
		}
	}
	
	public static function getUa()
	{
		$instance = self::getInstance();
		
		if($instance->ua) {
			return $instance->ua;
		}
		else {
			return $instance->findUa();
		}
	}
	
	public function findUa()
	{
		foreach($this->browserList as $b) {
			if(strpos($_SERVER['HTTP_USER_AGENT'], $b) != FALSE) {
				$this->ua = $b;
				return $this->ua;
			}	
		}
		
		return NULL;
	}
}