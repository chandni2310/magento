<?php
class Ccc_Order_Block_Adminhtml_Cart_Total extends Mage_Adminhtml_Block_Template{
	public function getCart(){

		$customerId = Mage::getModel('order/session')->getCustomerId();
        $cart = Mage::getSingleton('order/cart')->load($customerId,'customer_id');
        return $cart;

	}

	public function getBaseTotal(){
		$cart = $this->getCart();
		$cartId = $cart->getId();
		$item = Mage::getModel('order/cart_item');
      	$collection = $cart->getCollection();
        $collection->getSelect()
        ->reset(Zend_Db_Select::FROM)
        ->reset(Zend_Db_Select::COLUMNS)
        ->from('cart_item')
        ->where('cart_id = ?', $cartId);      
        $total = 0;
        if($collection){
            foreach ($collection->getData() as $value){
               $total  += $value['base_price'];
            }
          $cart->total = $total;
          $cart->save();
        }
        return $total;
	}

	 public  function getShippingAmount(){
        $cart = $this->getCart();
        if(!$cart){ 
        	return 0;  
        }
        return $cart->shipping_amount;
       
    }

    public function getGrandTotal(){
        return $this->getBaseTotal() + $this->getShippingAmount();
    }

	public function getHeaderText(){
		return "Total";
	}

}