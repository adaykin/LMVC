<?php

/**
 * Stores data in memcache, a caching daemon. For a detailed look at memcache, see
 * @link http://php.net/manual/en/book.memcache.php 
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Storage/Memcache.php
 * @package    LMVC\Storage\Memcache
 */

namespace LMVC\Storage;

class Memcache extends Session
{	
	private $memcache = NULL;
	private $cookie = NULL;
	private $id = NULL;
	private $values = array();
	private $expire = 0;
	private $encrypt = FALSE;
	private $validate = array();
	
	public function Memcache($expire = 0, $regenerate = 0)
	{
		$this->memcache = memcache_connect('localhost', 11211); // @todo get real host
		$this->cookie = new Session("Cookie", $expire, NULL, $regenerate);
		$this->id = $this->cookie->getId();
		foreach($validate as $v) {
			if($v == "ua") {
				if(isset($this->memcache->get('ua')))
					$this->validateBrowser($this->memcache->get($this->id, "ua"));
				$this->memcache->set('ua', Client::getUa());
				
			}
			if($v == "ip") {
				if(isset($this->memcache->get('ip')))
					$this->validateIp($this->memcache->get($this->id, "ip"));
				$this->memcache->set('ip', Client::getIp());
			}
		}
		
		if($regenerate != 0 && $this->memcache->get('regenerate') - time() < 0) {
			session_regenerate_id();
			$_SESSION['regenerate'] = time() + $regenerate;
		}
		if($regenerate != 0 && !isset($_SESSION['regenerate'])) {
			$_SESSION['regenerate'] = time() + $regenerate;
		}
	}
	
	public function get($key)
	{
		return memcache_get($this->memcache, $this->id, $key);
	}
	
	public function set($key, $value, $expire = 0)
	{
		if(isset($this->id)) {
			if(memcache_set($this->memcache, $this->id, array($key => $value)))
				return TRUE;
			else
				return FALSE;
		}
		else {
			return FALSE;
		}
	}
	
	public function remove($key)
	{
		return memcache_delete($this->memcache, $this->id, $key);
	}
}