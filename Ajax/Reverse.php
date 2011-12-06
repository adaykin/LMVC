<?php

/**
 * 
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Ajax/Reverse.php
 * @package    LMVC\Ajax\Reverse
 */

namespace LMVC\Ajax;

class Reverse
{	
	private $increment = 0;
	private $callback = NULL;
	private $obj = NULL;
	private $params = NULL;
	private $condition = FALSE;
	
	public function Reverse($increment, $callback, $obj, $params = NULL, $condition = FALSE)
	{
		$this->increment = $increment;
		$this->callback = $callback;
		$this->obj = $obj;
		$this->params = $params;
		$this->condition = $condition;
	}
	
	public function run()
	{
		$i = 0;
		while(true) {
			usleep(50000);//sleep($this->increment);
			//call_user_method($this->callback, $this->obj, $this->params);
			
		}
		$this->send();	
	}
	
	public function send()
	{
		ob_start();
		echo "hello world";
		ob_flush();
		flush();
	}
}