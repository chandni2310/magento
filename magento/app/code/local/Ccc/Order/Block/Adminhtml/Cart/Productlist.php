<?php 
class Ccc_Order_Block_Adminhtml_Cart_Productlist extends Mage_Adminhtml_Block_Template{
    protected $cart = null;
	public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'order';
        $this->_controller = 'adminhtml_cart';
        $this->_headerText = $this->__('Cart');
        $this->setTemplate('order/adminhtml/cart/productlist.phtml');

    }

    public function getProducts(){
    	$products = Mage::getModel('catalog/product')->getCollection();
    	$products->addAttributeToSelect('name',inner)
    			 ->addAttributeToSelect('sku',inner)	
    			 ->addAttributeToSelect('price',inner);
    	return $products;	

    
    }



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



}