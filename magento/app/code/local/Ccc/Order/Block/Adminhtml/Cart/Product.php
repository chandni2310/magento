<?php
class Ccc_Order_Block_Adminhtml_Cart_Product extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{
		# code...
		$this->_blockGroup = 'order';
		$this->_controller = 'adminhtml_cart_product';
		parent::__construct();
	}

	public function getHeaderText()
	{
		# code...
		return 'Add Products';
	}

	


}