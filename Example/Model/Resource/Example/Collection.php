<?php
class Ccc_Example_Model_Resource_Example_Collection extends Mage_Catalog_Model_Resource_Collection_Abstract
{
	public function __construct()
	{
		$this->setEntity('example');
		parent::__construct();
		
	}
}