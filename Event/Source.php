<?php

/**
 * Event source. Borrows some from symfony events 
 * @link http://symfony-project.org.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Event/Source.php
 * @package    LMVC\Event\Source
 */

namespace LMVC\Event;

class Source
{
	private $name = "";
	
	public function Source($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $this->name;
	}
}