<?php

/**
 * Implements a rest client architecture to make requests using curl.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2012 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       https://github.com/adaykin/LMVC/Services/Rest.php
 * @package    LMVC\Service\Rest
 */

namespace LMVC\Service;

class Rest
{
	public function post($url, array $data = NULL)
	{
		$curl = curl_init($url);
       	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       	curl_setopt($curl, CURLOPT_POST, true);
       	if($data != NULL)
       		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
       	$curl_response = curl_exec($curl);
       	curl_close($curl);
		return $curl_response;		
	}
	
	public function get($url, array $data = NULL)
	{
		$curl = curl_init($url);
       	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       	curl_setopt($curl, CURLOPT_HTTPGET, true);
       	if($data != NULL)
       		curl_setopt($curl, CURLOPT_GETFIELDS, $data);
       	$curl_response = curl_exec($curl);
       	curl_close($curl);
		return $curl_response;		
	}
}