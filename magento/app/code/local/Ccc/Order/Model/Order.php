<?php 

class Ccc_Order_Model_Order extends Mage_Core_Model_Abstract{
	protected $customer = null;
	protected $billingAddress = null;
	protected $shippingAddress = null;
	protected $orderItems = null;
    public function _construct()
    {
        $this->_init('order/order');
    }

    public function setCustomer(Ccc_Order_Model_Customer $customer){
      $this->customer = $customer;
      return $this;
    }

    public function getCustomer(){
      if($this->customer){
        return $this->customer;
      }
      if(!$this->orderId){
        return false;
      }
      $customer = Mage::getModel('customer/customer')->load($this->customer_id);
      $this->setCustomer($customer);
      return $this->customer;
    }

    public function setBillingAddress(Ccc_Order_Model_Order_Address $billingAddress){
      $this->billingAddress = $billingAddress;
      return $this;

    }

    public function getBillingAddress(){
        if($this->billingAddress){
      		return $this->billingAddress;
    }
      if(!$this->orderId){
        	return false;
      }
      $address =  Mage::getModel('order/order_address');
      $addressCollection = $address->getCollection()
        ->addFieldToFilter('order_id', ['eq' => $this->orderId])
        ->addFieldToFilter('address_type', ['eq' => Ccc_Order_Model_Cart_Address::ADDRESS_TYPE_BILLING]);
      $address = $addressCollection->getFirstItem();
      return $address;  
      }

      public function setShippingAddress(Ccc_Order_Model_Order_Address $shippingAddress){
		    $this->shippingAddress = $shippingAddress;
		    return $this;
  	}

  public function getShippingAddress(){
    if($this->shippingAddress){
      return $this->shippingAddress;
    }
    if(!$this->orderId){
      return false;
    }
    $address =  Mage::getModel('order/order_address');
    $addressCollection = $address->getCollection()
      ->addFieldToFilter('order_id', ['eq' => $this->orderId])
      ->addFieldToFilter('address_type', ['eq' => Ccc_Order_Model_Cart_Address::ADDRESS_TYPE_SHIPPING]);
    $address = $addressCollection->getFirstItem();
    return $address;    
  }

  public function setOrderItems(Ccc_Order_Model_Resource_Order_Item_Collection $orderItems){
    $this->orderItems = $orderItems;
    return $this;
  }

  public function getOrderItems(){
    if($this->orderItems){
      return $this->orderItems;
    }

    $orderItems = Mage::getModel('order/order_item')->getCollection();
    $orderItems->addFieldToFilter('order_id',['eq'=>$this->order_id]);
    $this->setOrderItems($orderItems);
    return $this->orderItems;
  }

}