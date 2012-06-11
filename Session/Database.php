<?php

/**
 * Stores data in a database. In order to use the database create the table using the
 * following SQL code:
 * <code>
 * 
 * </code>
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Session/Database.php
 * @package    LMVC\Session\Database
 */

namespace LMVC\Session;

class Database extends \LMVC\Storage\Database implements ISession
{	
	public function Database($expire = 0, $regen = 0, $options)
	{
		parent::__construct($expire, $regen);
		
		$this->setSessionHandlers();
			
		if($regene != 0 && $_SESSION['regenerate'] - time() < 0) {
			session_regenerate_id();
			$_SESSION['regenerate'] = time() + $regen;
		}
		if($regen != 0 && !isset($_SESSION['regenerate'])) {
			$_SESSION['regenerate'] = time() + $regen;
		}
	}
	
	public function setSessionHandlers()
	{
		session_set_save_handler('&$open',
        	'&$close',
            '&$read',
            '&$write',
            '&$destroy',
            '&$clean');
	}

	public function open()
	{
	    global $_sess_db;
	
	    $db_user = $_SERVER['DB_USER'];
	    $db_pass = $_SERVER['DB_PASS'];
	    $db_host = 'localhost';
	    
	    if ($_sess_db = mysql_connect($db_host, $db_user, $db_pass))
	    {
	        return mysql_select_db('sessions', $_sess_db);
	    }
	    
	    return FALSE;
	}

	public function close()
	{
	    global $_sess_db;
	    
	    return mysql_close($_sess_db);
	}
	
	public function read($id)
	{
	    global $_sess_db;
	
	    $id = mysql_real_escape_string($id);
	
	    $sql = "SELECT data
	            FROM   sessions
	            WHERE  id = '$id'";
	
	    if ($result = mysql_query($sql, $_sess_db))
	    {
	        if (mysql_num_rows($result))
	        {
	            $record = mysql_fetch_assoc($result);
	
	            return $record['data'];
	        }
	    }
	
	    return '';
	}
	
	public function write($id, $data)
	{   
	    global $_sess_db;
	
	    $access = time();
	
	    $id = mysql_real_escape_string($id);
	    $access = mysql_real_escape_string($access);
	    $data = mysql_real_escape_string($data);
	
	    $sql = "REPLACE 
	            INTO    sessions
	            VALUES  ('$id', '$access', '$data')";
	
	    return mysql_query($sql, $_sess_db);
	}
	
	public function destroy($id)
	{
	    global $_sess_db;
	    
	    $id = mysql_real_escape_string($id);
	
	    $sql = "DELETE
	            FROM   sessions
	            WHERE  id = '$id'";
	
	    return mysql_query($sql, $_sess_db);
	}
	
	public function clean($max)
	{
	    global $_sess_db;
	    
	    $old = time() - $max;
	    $old = mysql_real_escape_string($old);
	
	    $sql = "DELETE
	            FROM   sessions
	            WHERE  access < '$old'";
	
	    return mysql_query($sql, $_sess_db);
	}	
}