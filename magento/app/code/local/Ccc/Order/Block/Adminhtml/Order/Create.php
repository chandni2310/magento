<?php 
class Ccc_Order_Block_Adminhtml_Order_Create extends Mage_Adminhtml_Block_Widget_Form_Container{

	  public function __construct()
    {
        $this->_objectId = 'order_id';
        $this->_controller = 'adminhtml_order';
        $this->_mode = 'create';

        parent::__construct();

        $this->setId('order_create');

        $customerId = $this->_getSession()->getCustomerId();
        $storeId    = $this->_getSession()->getStoreId();

        $this->_updateButton('save', 'label', Mage::helper('order')->__('Place Order'));
        $this->_updateButton('save', 'onclick', "order.submit()");
        $this->_updateButton('save', 'id', 'submit_order_top_button');
        if (is_null($customerId) || !$storeId) {
            $this->_updateButton('save', 'style', 'display:none');
        }

        $this->_updateButton('back', 'id', 'back_order_top_button');
        $this->_updateButton('back', 'onclick', 'setLocation(\'' . $this->getBackUrl() . '\')');

        $this->_updateButton('reset', 'id', 'reset_order_top_button');

        if (!$this->_isCanCancel() || is_null($customerId)) {
            $this->_updateButton('reset', 'style', 'display:none');
        } else {
            $this->_updateButton('back', 'style', 'display:none');
        }

        $confirm = Mage::helper('order')->__('Are you sure you want to cancel this order?');
        $this->_updateButton('reset', 'label', Mage::helper('sales')->__('Cancel'));
        $this->_updateButton('reset', 'class', 'cancel');
        $this->_updateButton('reset', 'onclick', 'deleteConfirm(\''.$confirm.'\', \'' . $this->getCancelUrl() . '\')');
    }

}