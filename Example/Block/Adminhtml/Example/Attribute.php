<?php

class Ccc_Example_Block_Adminhtml_Example_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
    	$this->_blockGroup = 'example';
        $this->_controller = 'adminhtml_example_attribute';
        $this->_headerText = Mage::helper('example')->__('Manage Attributes');
        $this->_addButtonLabel = Mage::helper('example')->__('Add New Attribute');
        parent::__construct();
    }

}
