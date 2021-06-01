<?php 
class Ccc_Order_Block_Adminhtml_View_Items extends Mage_Adminhtml_Block_Template{
	protected $order = null;
	
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