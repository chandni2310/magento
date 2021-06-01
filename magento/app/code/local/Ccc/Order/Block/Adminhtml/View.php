<?php 

class Ccc_Order_Block_Adminhtml_View extends Mage_Adminhtml_Block_Template{
	protected $order = null;

	public function __construct()
	{
		$this->_controller = 'adminhtml_view';
		$this->_blockGroup = 'order';
		$this->_headerText = $this->__('Cart');
		//$this->setTemplate('order/adminhtml/cart.phtml');
		//parent::__construct();
	}

	public function setOrder(Ccc_Order_Model_Order $order){
		$this->order = $order;
		return $this;
	}

	public function getOrder(){
		if(!$this->order){
			throw new Exception("Order id not found ");
			
		}
		return $this->order;
	}
}