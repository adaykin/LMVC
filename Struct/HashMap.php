<?php

/**
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       
 * @package    LMVC\Struct\HashMap
 */

namespace LMVC\Struct;

class HashMap
{
	private $items = array();
	private $index;
	
	public function HashMap()
	{
		
	}
	
	public function member($val)
	{
		if($this->items[sha1($val)] === $val) {
			return true;
		}
		
		return false;
	}
	
	public function retrieve($val)
	{
		$hash = sha1($val);
		if($this->items[$hash] === $val) {
			return $this->items[$hash];
		}
		return -1;
	}
	
	public function insert($val)
	{
		// Check to see if $val is present
		$h = sha1($val);
		if($this->items[h] === $val)
			return;
		
		array_push($this->items, $val);
		$this->index++;
	}
	
	public function delete($val)
	{
		$h = sha1($val);
		if($this->items[$h] == NULL) {
			print("NULLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL");
			return;
		}
		if($this->items[$h] === $val) {
			print("FOUND!!!!!!!!!!!!!!!!!!!!!!!!!!");
			$this->items[$h] = "DELETED";
			// Decrement the number of items to get the correct length
			$this->items--;
		}
	}
}
