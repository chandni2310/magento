<?php
class Ccc_Order_Block_Adminhtml_Cart_Payment extends Mage_Adminhtml_Block_Template{
	public function getPaymentMethods(){
		$allActivePaymentMethods = Mage::getModel('payment/config')->getActiveMethods();
		return $allActivePaymentMethods;
	}

	public function getCart(){
		$customerId = Mage::getModel('order/session')->getCustomerId();
        $cart = Mage::getSingleton('order/cart')->load($customerId,'customer_id');
        return $cart;
	}
}