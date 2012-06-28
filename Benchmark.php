<?php

/**
 * Places markers at spots in code, and keeps track of markers in an array.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Benchmark.php
 * @package    LMVC\Benchmark
 */

namespace LMVC;

class Benchmark
{
	private $markers = array();
	public static $instance = NULL;
	
	/**
	 * Prevent developers from directly creating a Benchmark object.
	 */
	private function Benchmark()
	{		
	}
	
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Benchmark();
        }

        return self::$instance;
    }

    public static function _unsetInstance()
    {
        self::$instance = null;
    }
	
	/**
	 * 
	 */
	public function setMarker()
	{
		$time = microtime();
		array_push($this->markers, $time);
	}
	
	/**
	 * 
	 */
	public function getMarker($i)
	{
		return $this->markers[$i];
	}
	
	/**
	 * 
	 */
	public function getAllMarkers()
	{
		return $this->markers;
	}
	
	/**
	 * 
	 * @param unknown_type $start
	 * @param unknown_type $end
	 */
	public function getMarkersFrom($start, $end = 0)
	{
		if($end == 0) {
			return array_slice($this->markers, $start);
		}
		else {
			return array_slice($this->markers, $start, $start + $end);
		}
	}
}