<?php

/**
 * Event dispatching. Borrows some from symfony events 
 * @link http://symfony-project.org.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Event/Dispatcher.php
 * @package    LMVC\Event\Dispatcher
 */

namespace LMVC\Event;

class Dispatcher
{
	private $listeners = array();
	
	public function Dispatcher()
	{
		
	}
	
	public function attach(Source $e)
	{
		$this->listeners[$e] = $e;
	}
	
	public function detach(Source $e)
	{
		unset($this->listeners[$e]);
	}
	
	public function notify(Source $e)
	{
		foreach($this->listeners as $l) {
            call_user_func($l, $e);
        }
	}
	
	public function length()
	{
		return count($this->listeners);
	}
}