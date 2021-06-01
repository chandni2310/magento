<?php
class Ccc_Order_Block_Adminhtml_Cart_Shipping_Address extends Mage_Adminhtml_Block_Template{
    protected $cart = null;


    public function setCart($cart){
        $this->cart = $cart;
        return $this;
    }

    public function getCart(){
        if(!$this->cart){
            throw new Exception("Cart not found");
        }
        return $this->cart;
    }

    public function getShippingAddress(){
        $address = $this->getCart()->getShippingAddress();
        if($address->getId()){
            return $address;
        }
        $customerAddress = $this->getCart()->getCustomer()->getShippingAddress();
        if($customerAddress == null){
            return $address;
        }
        return $customerAddress;
    }
}
