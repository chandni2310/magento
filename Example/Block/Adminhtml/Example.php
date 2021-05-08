<?php
class Ccc_Example_Block_Adminhtml_Example extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'example';
        $this->_controller = 'adminhtml_example';
        $this->_headerText = $this->__('Example Grid');
        parent::__construct();
    }
}
