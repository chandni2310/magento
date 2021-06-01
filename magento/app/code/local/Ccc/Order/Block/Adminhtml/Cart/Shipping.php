<?php 
class Ccc_Order_Block_Adminhtml_Cart_Shipping extends Mage_Adminhtml_Block_Template{

	public function getShippingMethods(){
		$shippingMethods = Mage::getSingleton('shipping/config')->getActiveCarriers();
		return $shippingMethods;
	}

	public function getCart(){
		$customerId = Mage::getModel('order/session')->getCustomerId();
        $cart = Mage::getSingleton('order/cart')->load($customerId,'customer_id');
        return $cart;
	}
}