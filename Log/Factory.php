<?php

/**
 *
 * @author     Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Log/Writer.php
 * @package    LMVC\Log\Writer
 */

namespace LMVC\Log;

final class Factory
{
	private $lw;
	
	public function Factory($type)
	{
		switch($type) {
			case "File":
				$this->lw = new File();
			break;
			case "Database":
				$this->lw = new Database();
			break;
			default:
				throw new Exception("Log type $type not supported");
			break;
		}
	}
}