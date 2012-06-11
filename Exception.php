<?php

/**
 * Base class for all exception classes, extends the native PHP exception, and formats
 * the stack trace in a more readable format.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Exception.php
 * @package    LMVC\Exception
 */

namespace LMVC;

class Exception extends \Exception
{
	/**
	 * Format the stack trace nicely
	 */
	public function __toString()
	{
		$msg = array_splice(explode('#', parent::getTraceAsString()), 1);
		$newMsg = "exception: " . $this->getMessage() . " thrown by " . __CLASS__ ;
		$newMsg .= "<table cellspacing='0' cellpadding='4'>";
		$i = 0;
		foreach($msg as $m) {
			if($i % 2 == 0) {
				$newMsg .= "<tr><td style=\"background-color: #009966\">" . $m . "</td></tr>";
			}
			else {
				$newMsg .= "<tr><td style=\"background-color: #0099CC\">" . $m . "</td></tr>";
			}
			$i++;
		}
		
		$newMsg .= "</table>";
		return $newMsg;
	}
}