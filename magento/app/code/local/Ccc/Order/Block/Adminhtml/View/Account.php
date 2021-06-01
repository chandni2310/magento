<?php
class Ccc_Order_Block_Adminhtml_View_Account extends Mage_Adminhtml_Block_Template{

	public function getAccountDetails(){
		$customerId = Mage::getModel('order/session')->getCustomerId();
		$customer = Mage::getModel('customer/customer')->load($customerId);
		return $customer;
	}
}