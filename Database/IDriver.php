<?php

namespace LMVC\Database;

interface IDriver
{
	public function getInstance();
	
	public function query($sql);
	
	public function prepare();
	
	public function quote();
	
	public function execute();
	
	public function fetchAll($type);
	
	public function fetch();
}