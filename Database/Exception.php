<?php
/**
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @package    LMVC\Database\Exception
 */

namespace LMVC\Database;

include 'Exception.php';

class Exception extends \LMVC\Exception
{
	public function Exception()
	{
		parent::__construct();
	}
}