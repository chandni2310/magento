<?php
class Ccc_Order_Adminhtml_OrderController extends Mage_Adminhtml_Controller_Action{

	public function indexAction(){

		$this->_title($this->__('Order'))->_title($this->__('Orders'));

        $this->loadlayout()
             ->_setActiveMenu('order')
            ->renderLayout();
	}

	public function newOrderAction(){
		
		$this->loadlayout();
        $this->_setActiveMenu('order');
		$this->getLayout()->getBlock('cart')->setCart($this->getCart());
        $this->renderLayout();
	}

	public function selectCustomerAction(){
		try {
			if(!$this->getRequest()->isPost()){
				throw new Exception("Invalid Request");
				
			}

			$customerId = $this->getRequest()->getPost('customer_id');
			//print_r($customerId);
			if (!$customerId) {
                throw new Exception('Invalid customer id.');
            }
            $cart = $this->getCart($customerId);
            $this->_redirect('*/adminhtml_order/newOrder');
			
		} catch (Exception $e) {
			
		}
	}

	protected function getCart($customerId = null){
		$session = Mage::getSingleton('order/session');
		/*echo '<pre>';
		print_r($session);
		die;*/

		if($customerId){
			$session->setCustomerId($customerId);
		} else{
			$customerId = $session->getCustomerId();
		}

		$cart = Mage::getModel('order/cart')->load($customerId,'customer_id');
		
		if($cart->getCartId()){
			return $cart;
		}
		
		$cart = Mage::getModel('order/cart');
		$cart->customer_id = $customerId;
		$cart->created_at = date('Y-m-d H:i:s' );
		$cart->save();
		return $cart;

	}

	public function addToCartAction(){
		try {
            echo "<pre>";
            $products = $this->getRequest()->getPost('product');
            $cart = $this->getCart();
            foreach ($products as $key => $product) {
                $productData = Mage::getSingleton('catalog/product')->load($product);
                $cart->addItemToCart($productData,1,true);
                # code...
            }
            Mage::getSingleton('adminhtml/session')->addSuccess('Item added to Cart');

            
        } catch (Exception $e) {
            Mage::helper('order')->__($e);
        }
       $this->_redirect('*/adminhtml_order/newOrder');
	}


	public function updateItemAction(){
		  try {

             $quantity = $this->getRequest()->getPost('quantity');
            foreach ($quantity as $key => $value) {
                # code...
                if($value == 0){
                    $cartItem = Mage::getModel('order/cart_item')->load($key);
                    $cartItem->delete();
                    continue;
                }
                $cartItem = Mage::getModel('order/cart_item')->load($key);
                $basePrice = $value * $cartItem->price;
                $cartItem->base_price = $basePrice;
                $cartItem->quantity = $value;
                $cartItem->save();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess('Item updated');
              
          } catch (Exception $e) {
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
              
          }
             
           
        $this->_redirect('*/adminhtml_order/newOrder');
     
    }

    public function deleteCartAction(){
        try {

            $cartItemId = $this->getRequest()->getParam('cartItemId');
            if(!$cartItemId){
                Mage::getSingleton('adminhtml/session')->addError('Invalid item id');
            }
            $cartItem = Mage::getModel('order/cart_item')->load($cartItemId);
            if(!$cartItem){
                Mage::getSingleton('adminhtml/session')->addError('Product no longer exists');
            }
            if(!$cartItem->delete()){
                Mage::getSingleton('adminhtml/session')->addError('Unable to delete Product');
            }
            Mage::getSingleton('adminhtml/session')->addSuccess('Product deleted successfully');
            
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage()); 
        }
        $this->_redirect('*/*/newOrder');
    }
	
    public function saveShippingMethodAction(){

        //echo 'hi';
       try {
        $customerId = Mage::getModel('order/session')->getCustomerId();
        if(!$customerId){
            throw new Exception("Invalid Customer");
        }
        $cart = Mage::getSingleton('order/cart')->load($customerId,'customer_id');
        $shippingMethod = $this->getRequest()->getPost('shippingmethod');
        $data = explode(' ',$shippingMethod);
        $shippingMethod = $data[0];
        $shippingPrice = $data[1];
        $cart->shipping_method = $shippingMethod;
        $cart->shipping_amount = $shippingPrice;
        $cart->save();
        //print_r($cart);
        
       } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
           
       }
       $this->_redirect('*/*/newOrder');
    }

    public function savePaymentMethodAction(){

        //echo 'hi';
       try {
        $customerId = Mage::getModel('order/session')->getCustomerId();
        if(!$customerId){
            throw new Exception("Invalid Customer");
        }
        $cart = Mage::getSingleton('order/cart')->load($customerId,'customer_id');
        $paymentMethod = $this->getRequest()->getPost('paymentMethod');
        $cart->payment_method = $paymentMethod;
        $cart->save();
        
       } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
           
       }
       $this->_redirect('*/*/newOrder');
    }
	
    public function saveBillingAddressAction(){
       // echo 'hii';
        try {
            $cart = $this->getCart();
            $customerId = $cart->getCustomerId();

            $billing = $this->getRequest()->getPost('billing');
            $cartBillingAddress = $cart->getBillingAddress();
            if(!$cartBillingAddress->getCartAddressId()){
                $cartBillingAddress->setCartId($cart->getId());
                $cartBillingAddress->setAddressType('billing');          
            }
            $cartBillingAddress->addData($billing);
            $cartBillingAddress->save();
           /* echo '<pre>';
            print_r($cartBillingAddress);
            die;*/

            $saveInAddress = $this->getRequest()->getPost('saveInAddressBook');
            if($saveInAddress){
                $billingAddress = $cart->getCustomer()->getBillingAddress();
                if(!$billingAddress->getEntityId()){
                    $billingAddress->setParentId($customerId);
                    $billingAddress->setCreatedAt(date("Y-m-d H:i:s"));
                } 
                $billingAddress->addData($billing);
                $billingAddress->save();
                /*echo '<pre>';
                print_r($billingAddress);
                die;*/
            }   
            Mage::getSingleton('adminhtml/session')->addSuccess('Succesfully inserted');    
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/newOrder');
    }

    public function saveShippingAddressAction(){
        try {
            $cart = $this->getCart();
            $customerId = $cart->getCustomerId();

            $shipping = $this->getRequest()->getPost('shipping');

            $cartShippingAddress = $cart->getShippingAddress();
            if(!$cartShippingAddress->getCartAddressId()){
                $cartShippingAddress->setCartId($cart->getId());
                $cartShippingAddress->setAddressType('shipping');
                $cartShippingAddress->setCreatedAt(date("Y-m-d H:i:s"));                
            } 
            $cartShippingAddress->addData($shipping);
            $cartShippingAddress->save();
           /* echo '<pre>';
            print_r($cartShippingAddress);
            die;*/

            $saveInAddress = $this->getRequest()->getPost('save_in_address_book');
            if($saveInAddress){
                $shippingAddress = $cart->getCustomer()->getShippingAddress();
                if(!$shippingAddress->getEntityId()){
                    $shippingAddress->setParentId($customerId);
                    $shippingAddress->setCreatedAt(date("Y-m-d H:i:s"));
                }
                $shippingAddress->addData($shipping);
                $shippingAddress->save();
            }       

            $sameAsBilling = $this->getRequest()->getPost('same_as_billing_address');
            if($sameAsBilling){
                $billing = $cart->getBillingAddress()->getData();
                unset($billing['cart_address_id']);
                if(!$billing){
                    throw new Exception("Add billing address first");
                }
                $shipping = $cart->getShippingAddress();
                $shipping->addData($billing);
                $shipping->setAddressType('shipping');
                $shipping->save();
                /*echo '<pre>';
                print_r($shipping);
                die();*/
            }
            Mage::getSingleton('adminhtml/session')->addSuccess('Shipping address inserted');
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/newOrder'); 
    }

    public function placeOrderAction(){

        //echo 'order';
        try {
             $customerId = Mage::getModel('order/session')->getCustomerId();
             if(!$customerId){
                throw new Exception("customer not found");
             }

            $cart = Mage::getModel('order/cart')->load($customerId,'customer_id');
            $items = $cart->getCartItems();
            date_default_timezone_set('Asia/Kolkata');
            $order = Mage::getModel('order/order');
            $customer = $cart->getCustomer()->load($customerId);
            $customerName = $customer->getFirstname().'  '.$customer->getLastname();
            
            $order->setCustomerId($customerId)
                  ->setCustomerName($customerName) 
                  ->setCustomerName($customerName)
                  ->setCustomerEmail($customer->getEmail())
                  ->setTotal($cart->getTotal())
                  ->setPaymentMethod($cart->getPaymentMethod())
                  ->setShippingMethod($cart->getShippingMethod())
                  ->setShippingAmount($cart->getShippingAmount())
                  ->setCreatedAt(date('Y-m-d H:i:s'));
           if(!$order->save()){
                throw new Exception("Order not saved");
            }

            $cartId = $cart->getId();
            $cartAddress = Mage::getModel('order/cart_address');
            $cartAddressCollection = $cartAddress->getCollection();
            $query = $cartAddressCollection->getselect()
                ->reset(Zend_Db_Select::FROM)
                ->reset(Zend_Db_Select::COLUMNS)
                ->from('cart_address')
                ->where('cart_id = ?' , $cartId)
                ->where('address_type =?','billing');
            $cartAddress = $cartAddressCollection->fetchItem($query);
            if($cartAddress){
                $orderAddress = Mage::getModel('order/order_address');
                $orderAddress->order_id = $order->getId();
                $orderAddress->customer_id = $customerId;
                $orderAddress->address_type = 'billing';
                $orderAddress->street = $cartAddress->getStreet();
                $orderAddress->city = $cartAddress->getCity();
                $orderAddress->region = $cartAddress->getRegion();
                $orderAddress->country_id = $cartAddress->getCountryId();
                $orderAddress->postcode = $cartAddress->getPostcode();
                $orderAddress->save();              
               
            } else {
                Mage::getSingleton('adminhtml/session')->addError("No Billing Address Found");
            }

            $cartAddressShipping = Mage::getModel('order/cart_address');
            $cartAddressCollection = $cartAddressShipping->getCollection();
            $query = $cartAddressCollection->getselect()
                ->reset(Zend_Db_Select::FROM)
                ->reset(Zend_Db_Select::COLUMNS)
                ->from('cart_address')
                ->where('cart_id = ?' , $cartId)
                ->where('address_type = ?','shipping');
            $cartAddressShipping = $cartAddressCollection->fetchItem($query);
            if($cartAddressShipping){
                $orderAddressShipping = Mage::getModel('order/order_address');
                $orderAddressShipping->order_id = $order->getId();
                $orderAddressShipping->customer_id = $customerId;
                $orderAddressShipping->address_type = 'shipping';
                $orderAddressShipping->street = $cartAddressShipping->getStreet();
                $orderAddressShipping->city = $cartAddressShipping->getCity();
                $orderAddressShipping->region = $cartAddressShipping->getRegion();
                $orderAddressShipping->country_id = $cartAddressShipping->getCountryId();
                $orderAddressShipping->postcode = $cartAddressShipping->getPostcode();
                $orderAddressShipping->save();  
            } else {
                Mage::getSingleton('adminhtml/session')->addError(" No Shipping Address Found");
            }

            foreach($items->getData() as $key=>$value){
                $productId = $value['product_id'];
                $product = Mage::getModel('catalog/product')->load($productId);
                $name = $product->getName();
                $sku = $product->getSku();
               
                $orderItemModel = Mage::getModel('order/order_item');
                $orderItemModel->setData($value)
                            ->setOrderId($order->getId())
                            ->setName($name)
                            ->setSku($sku)
                            ->setCreatedAt(date('Y-m-d H:i:s'));
                           
                if(!$orderItemModel->save()){
                    throw new Exception('Unable to save order items');
                }
                /*print_r($orderItemModel);
                die;*/
            }
            Mage::getSingleton('adminhtml/session')->addSuccess('Order Placed Successfully');
            
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());            
        }
        $this->_redirect('*/adminhtml_order/index');
    }

    public function getOrder(){
        try {

            $orderId = $this->getRequest()->getParam('order_id');
            if(!$orderId){
                throw new Exception('Order id not found');
                
            }

            $order= Mage::getModel('order/order')->load($orderId);
            if(!$order->getId()){
                throw new Exception("Order not found");
                
            }
            return $order;
            
        } catch (Exception $e) {
          Mage::getSingleton('adminhtml/session')->addError($e->getMessage());  
        }
    }

    public function viewAction(){
        //echo 'viewOrder';
        $this->loadlayout();
        $this->getLayout()->getBlock('order')->setOrder($this->getOrder());
        $this->renderLayout();
    }

}

