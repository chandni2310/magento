<?php 

class Ccc_Order_Block_Adminhtml_Cart extends Mage_Core_Block_Template{
	protected $cart = null;

	public function __construct()
	{
		$this->_controller = 'adminhtml_order';
		$this->_blockGroup = 'order';
		$this->_headerText = $this->__('Cart');
		//$this->setTemplate('order/adminhtml/cart.phtml');
		//parent::__construct();
	}

	public function setCart(Ccc_Order_Model_Cart $cart){
		$this->cart = $cart;
		return $this;
	}

	public function getCart(){
		if(!$this->cart){
			throw new Exception("No cart ");
			
		}
		return $this->cart;
	}
}