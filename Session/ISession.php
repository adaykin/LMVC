<?php

/**
 * 
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Storage/Database.php
 * @package    LMVC\Storage\IStorage
 */

namespace LMVC\Session;

interface ISession
{
	public function open();
	
    public function close();
    
    public function read($id);
    
    public function write($id, $data);
    
    public function destroy($id);
    
    public function clean($max);
    
    public function setSessionHandlers();
}
