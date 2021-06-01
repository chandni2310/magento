<?php 

class Ccc_Order_Model_Cart extends Mage_Core_Model_Abstract{
    protected $customer = null;
    protected $billingAddressress = null;
    protected $shippingAddress = null;
    protected $cartItems = null;
    public function _construct()
    {
        $this->_init('order/cart');
    }

    public function addItemToCart($product, $quantity = 1, $addMode = false){
    	$customerId = Mage::getSingleton('order/session')->getCustomerId();
    	$cartId =Mage::getSingleton('order/cart')->load($customerId,'customer_id')->getCartId();
    	$item = Mage::getModel('order/cart_item');
    	$collection = $item->getCollection();
    	$collection->addFieldToFilter('cart_id',['eq'=>$cartId])
    			   ->addFieldToFilter('product_id',['eq'=>$product->getId()]);
    	$itemId = $collection->getData()[0]['cart_item_id'];
      
      $cartItem = Mage::getModel('order/cart_item');
      $data = $cartItem->load($itemId);
     
      if($data->getData()){
        $data->quantity += $quantity;
        $data->basePrice =($product->price*$data->quantity)-($data->quantity*$product->discount);
        $cartItem->save();
        return true;
      }
      
          $cartItem->cartId = $cartId;
          $cartItem->productId = $product->entity_id;
          $cartItem->price = $product->price;
          $cartItem->quantity = $quantity;
          $cartItem->discount = $product->discount;
          $cartItem->basePrice = $product->price - $product->discount;
          date_default_timezone_set('Asia/Kolkata');
          $cartItem->created_at = date('Y-m-d H:i:s');
          $cartItem->save();
          return true;	

    }

    public function setCustomer(Ccc_Order_Model_Customer $customer){
      $this->customer = $customer;
      return $this;
    }

    public function getCustomer(){
      if($this->customer){
        return $this->customer;
      }
      if(!$this->cartId){
        return false;
      }
      $customer = Mage::getModel('customer/customer')->load($this->customer_id);
      $this->setCustomer($customer);
      return $this->customer;
    }

    public function setBillingAddress(Ccc_Order_Model_Cart_Address $billingAddress){
      $this->billingAddress = $billingAddress;
      return $this;

    }

    public function getBillingAddress(){
        if($this->billingAddress){
      return $this->billingAddress;
    }
      if(!$this->cartId){
        return false;
      }
      $address =  Mage::getModel('order/cart_address');
      $addressCollection = $address->getCollection()
        ->addFieldToFilter('cart_id', ['eq' => $this->cartId])
        ->addFieldToFilter('address_type', ['eq' => Ccc_Order_Model_Cart_Address::ADDRESS_TYPE_BILLING]);
      $address = $addressCollection->getFirstItem();
      return $address;  
      }

      public function setShippingAddress(Ccc_Order_Model_Cart_Address $shippingAddress){
    $this->shippingAddress = $shippingAddress;
    return $this;
  }

  public function getShippingAddress(){
    if($this->shippingAddress){
      return $this->shippingAddress;
    }
    if(!$this->cartId){
      return false;
    }
    $address =  Mage::getModel('order/cart_address');
    $addressCollection = $address->getCollection()
      ->addFieldToFilter('cart_id', ['eq' => $this->cartId])
      ->addFieldToFilter('address_type', ['eq' => Ccc_Order_Model_Cart_Address::ADDRESS_TYPE_SHIPPING]);
    $address = $addressCollection->getFirstItem();
    return $address;    
  }

  public function setCartItems(Ccc_Order_Model_Resource_Cart_Item_Collection $cartItems){
    $this->cartItems = $cartItems;
    return $this;
  }

  public function getCartItems(){
    if($this->cartItems){
      return $this->cartItems;
    }

    $cartItems = Mage::getModel('order/cart_item')->getCollection();
    $cartItems->addFieldToFilter('cart_id',['eq'=>$this->cart_id]);
    $this->setCartItems($cartItems);
    return $this->cartItems;
  }


}

