<?php

/**
 *
 * @author     Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Log/IWriter.php
 * @interface
 * @package    LMVC\Log\IWriter
 */

namespace LMVC\Log;

interface IWriter
{
	public function log() { }
	
	public function clearLog() { }
	
	public function deleteLog($id) { }
}