<?php
class Ccc_Order_Block_Adminhtml_Cart_Billing_Address extends Mage_Adminhtml_Block_Template{
    
    protected $cart = null;

    public function setCart(Ccc_Order_Model_Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }
    public function getCart()
    {
       if(!$this->cart){
           throw new Exception('No cart');
       }
       return $this->cart;
    }
    public function getBillingAddress()
    {
        $address = $this->getCart()->getBillingAddress();
        if($address->getId()){
            return $address;
        }
        $customerAddress = $this->getCart()->getCustomer()->getBillingAddress();
        if($customerAddress == null){
            return $address;
        }
        return $customerAddress;
    }

    }
