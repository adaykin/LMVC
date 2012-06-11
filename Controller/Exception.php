<?php
/**
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Controller/Exception.php
 * @package    LMVC\Controller\Exception
 */

namespace LMVC\Controller;

include 'Exception.php';

class Exception extends \LMVC\Exception
{
	public function Exception()
	{
		parent::__construct();
	}
}