<?php

/**
 *
 * @author     Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @abstract
 * @link       http://trac.andydaykin.com/browser/Controller/Action.php
 * @package    LMVC\Controller\Action
 */

namespace LMVC\Controller;

abstract class Action
{
	private $content = "";
	private $layout = "Layout";
	
	/**
	 * Parses the variables passed in and puts the contents of the view into 
	 * $content.
	 * 
	 * @param array $pageInfo
	 * @param string $page
	 */
	public function renderView(array $pageInfo = NULL, $page = "")
	{
		// Start the output buffering, use gzip if available
		//if(!ob_start('ob_gzhandler'))
		ob_start();		

		if(is_array($pageInfo)) {
			foreach($pageInfo as $k => $v) {
				$$k = $v;
			}
		}
		
		// Find the view
		if($page === "") {
			$controller = Front::getController();
			$view = Front::getView();
			if(!file_exists(APP_URL . "/application/views/$controller/$view" . ".phtml")) {
				throw new Exception("View $page not found");
			}
			include APP_URL . "/application/views/$controller/$view" . ".phtml";
		}
		else {
			if(!file_exists(APP_URL . "/application/views/$page" . ".phtml")) {
				throw new Exception("View $page not found");
			}
			include APP_URL . "/application/views/$page" . ".phtml";
		}
		
		// Put the view content into the layout's variable
		$this->content = ob_get_contents();
		ob_end_clean();
	}
	
	/**
	 * Parses the variables passed in and puts the contents of the layout into 
	 * $content.
	 * 
	 * @param array $pageInfo
	 */
	public function renderLayout(array $pageInfo)
	{
		// Start the output buffering, use gzip if available
		//if(!ob_start('ob_gzhandler'))
		ob_start();

		$content = $this->content;

		foreach($pageInfo as $k => $v) {
			$$k = $v;
		}

		// Find the layout
		if(!file_exists(APP_URL . "/application/layouts/$this->layout" . ".php")) {
			throw new Exception("Layout $this->layout was not found");
		}
		include APP_URL . "/application/layouts/" . $this->layout . ".php";
		
		// Send the output to the browser
		ob_flush();
	}
	
	/**
	 * Sets the layout.
	 * @param string $layout
	 */
	public function setLayout($layout)
	{
		$this->layout = $layout;
	}
	
	/**
	 * Get the layout.
	 * @return string $layout
	 */
	public function getLayout()
	{
		return $this->layout;
	}
}
