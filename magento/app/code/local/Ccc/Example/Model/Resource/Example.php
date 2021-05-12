<?php
class Ccc_Example_Model_Resource_Example extends Mage_Eav_Model_Entity_Abstract
{

	const ENTITY = 'example';
	
	public function __construct()
	{

		$this->setType(self::ENTITY)
			 ->setConnection('core_read', 'core_write');

	   parent::__construct();
    }

}