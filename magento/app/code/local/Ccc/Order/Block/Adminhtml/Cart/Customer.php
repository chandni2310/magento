<?php 

class Ccc_Order_Block_Adminhtml_Cart_Customer extends Mage_Core_Block_Template{

	public function __construct()
	{
		$this->_controller = 'adminhtml_cart';
		$this->_blockGroup = 'order';
		$this->_headerText = $this->__('Cart');
		$this->setTemplate('order/adminhtml/cart/customer.phtml');
		parent::__construct();
	}

	public function getCustomer(){
		//echo '<pre>';
		$customerCollection = Mage::getModel('customer/customer')
	    ->getCollection()
	   	->addAttributeToSelect('firstname',inner)
	    ->addAttributeToSelect('lastname',inner);
	    return $customerCollection;
	
	}

	public function getSelectedCustomer(){
		$customer = Mage::getSingleton('order/session')->getCustomerId();
		return $customer;
	}
}