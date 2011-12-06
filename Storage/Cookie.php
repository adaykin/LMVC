<?php

/**
 * Stores data in a cookie. It is not reccomended to soley rely on a cookie for 
 * storing sessions where security is necessary, as cookies can be modified by the
 * client. Use cookies in conjunction with APC, Memcache, or Database for storage.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Storage/Cookie.php
 * @package    LMVC\Storage\Cookie
 */

namespace LMVC\Storage;

class Cookie extends Session
{ 
	private $key = "YfjEfiSeXfoiEjffe593"; // @todo Let user change this somehow
	private $id = NULL;
	
	public function Cookie($expire = 0, array $validate = NULL, $regenerate = 0)
	{
		// Set the user id at random
		if(!$this->get("id")) {
			$id = mt_rand(). time() . time() . mt_rand();
			$this->id = $id;
			$this->set("id", $id, $expire);	
		}
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function encrypt($text)
	{
		try {
    		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
    		return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $text, MCRYPT_MODE_ECB, $iv)));
		}
		catch(Exception $e) {
			
		}
	}
	
	public function decrypt($text)
    {
    	try {
    		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
        	return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, base64_decode($text), MCRYPT_MODE_ECB, $iv, MCRYPT_RAND));
    	}
    	catch(Exception $e) {
    		
    	}
    }
    
    public function get($key)
    {
    	return isset($this->decrypt($_COOKIE[$key])) ?: FALSE;
    }
    
    public function set($key, $value, $expire = 0)
    {
    	setcookie($key, $this->encrypt($value), $expire);
    }
    
    public function remove($key)
    {
    	unset($_COOKIE[$key]);
    	setcookie($key, "", time() - 3600);
    }
}